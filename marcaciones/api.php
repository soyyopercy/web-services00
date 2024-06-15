<?php

session_start();
date_default_timezone_set("America/Lima");

require_once("db.php");

if (isset($_POST["action"]) === false) {
	http_response_code(205);
	die();
}

switch ($_POST["action"]) {
	case "inicio-sesion": {
			@["usuario" => $usuario, "password" => $password] = $_POST;
			$stmt = $pdo->prepare("SELECT * FROM V_Usuarios WHERE Usuario = ? AND Password = ?");
			$stmt->execute([$usuario, $password]);
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($user === false) {
				http_response_code(400);
				die("Usuario o contraseña incorrecto");
			}
			if ($user["Activo"] != 1) {
				http_response_code(400);
				die("Usuario inactivo");
			}
			$_SESSION["user"] = $user;
			die("");

			break;
		}

	case "convertir-marcaciones": {
			@["markings" => $markings] = $_FILES;

			if (is_null($markings)) {
				http_response_code(400);
				die("No subió ningún archivo.");
			}

			@["extension" => $extension] = pathinfo($markings["name"]);
			$extension = strtolower($extension);
			$mime_type = mime_content_type($markings["tmp_name"]);
			if ($extension !== "txt" || $mime_type !== "text/plain") {
				http_response_code(400);
				die("No es un archivo de texto válido.");
			}

			function array_findIndex($array, $callback)
			{
				/** @var int $index  */
				$index = null;
				foreach ($array as $key => $value) {
					$response = $callback($value, $key);
					if ($response === true) {
						$index = $key;
						break;
					}
				}
				return $index;
			}

			function array_findLastIndex($array, $callback)
			{
				$index = array_findIndex(array_reverse($array), $callback);
				if ($index === null) return $index;
				return count($array) - ($index + 1);
			}

			$user = $_SESSION["user"];
			$nomUsuario = str_replace($user["nomUsuario"], " ", ".");

			$markings = file_get_contents($markings["tmp_name"]);

			$markings = explode("\r\n", $markings);
			$markings = array_filter($markings);

			$failed_format = false;
			$failed_date_format = false;

			$data = array_map(function ($marking) use (&$failed_format, &$failed_date_format) {
				if (boolval(preg_match('/^(\d+)\s+([^	 ]+)\s+(.+)$/', $marking, $match))) {
					@[, $DNI, $date, $time] = $match;
					try {
						$timezone = new DateTimeZone("America/Lima");
						$date = implode("/", array_reverse(explode("/", $date)));
						$datetime = new DateTime("$date $time", $timezone);
						$formatted_datetime = $datetime->format("YmdHis");
						return [
							"DNI" => $DNI,
							"datetime" => $formatted_datetime,
						];
					} catch (\Throwable $th) {
						$failed_date_format = true;
					}
				} else {
					$failed_format = true;
				}
			}, $markings);
			$data = array_filter($data);

			if (count($data) === 0) {
				$message = "El archivo no cumple con el formato.";
				$now = (new DateTime("now", new DateTimeZone("America/Lima")))->format("d/m/Y	H:i:s");
				http_response_code(400);
				if ($failed_format) die("$message\nEjemplo:\n12345678	$nomUsuario	$now	Reloj Arriola Principal");
				if ($failed_date_format) die("$message\nEl formato de fecha es: dd/MM/yyyy HH:mm:ss");
				die($message);
			}


			$DNIs = array_unique(array_map(function ($marking) {
				return $marking["DNI"];
			}, $data));

			usort($data, function ($marking_a, $marking_b) use ($DNIs) {
				$comparation_DNI = array_search($marking_a['DNI'], $DNIs) - array_search($marking_b['DNI'], $DNIs);
				if ($comparation_DNI === 0) {
					return strcmp($marking_a['datetime'], $marking_b['datetime']);
				} else {
					return $comparation_DNI;
				}
			});

			$data = array_reduce($data, function ($previous, $current) {
				[
					"DNI" => $DNI,
					"datetime" => $formatted_datetime,
				] = $current;
				$date = substr($formatted_datetime, 0, 8);
				$first_index = array_findIndex($previous, function ($string) use ($date, $DNI) {
					return boolval(preg_match('/^.*?' . $date . '.*?' . $DNI . '$/', $string));
				});
				$last_index = array_findLastIndex($previous, function ($string) use ($date, $DNI) {
					return boolval(preg_match('/^.*?' . $date . '.*?' . $DNI . '$/', $string));
				});
				$formatted_datetime = str_pad($formatted_datetime, 20, " ");
				$item = "   $formatted_datetime $DNI";
				if ($first_index === null || $first_index === $last_index) {
					array_push($previous, $item);
				} else {
					array_splice($previous, $last_index, 1, $item);
				}
				return $previous;
			}, []);

			$content = implode("\r\n", $data);
			if (count($data) > 0) {
				$content .= "\r\n";
			}

			$temp_txt = tempnam(sys_get_temp_dir(), "txt");
			file_put_contents($temp_txt, $content);

			header("Content-Type: text/plain");
			header("Content-Disposition: attachment; filename=\"marcareloj.txt\"");
			header("Content-Length: " . filesize($temp_txt));
			readfile($temp_txt);
			die();
			break;
		}
}
