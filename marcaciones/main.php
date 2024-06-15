<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Marcaciones</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
		@import url("https://kit-pro.fontawesome.com/releases/v6.4.2/css/pro.min.css");

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Poppins', sans-serif;
		}

		.container {
			width: 100%;
			height: 100vh;
			background-color: #88cb99;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.modal {
			background-color: #fff;
			width: min(85%, 600px);
			height: min(85%, 500px);
			padding: 30px 30px;
			border-radius: 15px;
			display: flex;
			flex-direction: column;
			gap: 20px;
			box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
		}

		.header {
			display: flex;
			font-weight: bold;
			justify-content: space-between;
			align-items: center;
		}

		.drop-zone {
			border: 2px dashed #bbb;
			height: 100%;
			border-radius: 5px;
			padding: 14px;
			text-align: center;
			color: #bbb;
			grid-template-columns: repeat(5, minmax(89px, 1fr));
			gap: 16px;
		}

		.drop-zone.grid {
			display: grid;
		}

		.drop-zone.active {
			color: #000;
			background-color: #eee;
		}

		.drop-zone .empty {
			width: 100%;
			height: 100%;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}

		.drop-zone .empty i {
			font-size: 69px;
			padding-bottom: 25px;
		}

		.drop-zone .empty button {
			border: none;
			text-decoration: none;
			background-color: #61a4f7;
			cursor: pointer;
			padding: 15px 32px;
			font-size: 16px;
			border-radius: 8px;
			color: white;
		}

		.drop-zone .loading {
			height: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}

		.drop-zone .loading i {
			color: #09f;
			font-size: 2rem;
		}

		.delete-icon {
			position: absolute;
			top: -8px;
			right: 0;
			cursor: pointer;
		}
	</style>
</head>

<body>
	<input type="file" name="markings" accept=".txt" hidden />
	<div class="container">
		<div class="modal">
			<div class="header">
				<div class="title">Carga el archivo de marcaciones:</div>
			</div>
			<div class="drop-zone">
				<!-- <div class="loading">
					<i class="fa-duotone fa-spinner-third fa-spin"></i>
					<div class="text">Registrando</div>
				</div> -->
				<!-- <div class="empty">
					<i class="fa-duotone fa-upload"></i>
					<div class="text">Arrastra y suelta tus archivos</div>
					<div class="text">o</div>
					<button>Selecciona archivos</button>
				</div> -->
			</div>
		</div>
	</div>
	<script>
		window.addEventListener("load", async function(event) {
			const loadEmptyDropZone = function() {
				const empty = document.createElement("div");
				empty.classList.add("empty");
				const icon = document.createElement("i");
				icon.classList.add("fa-duotone", "fa-upload");
				const text_0 = document.createElement("div");
				text_0.textContent = "Arrastra y suelta tu(s) archivo(s)";
				const text_1 = document.createElement("div");
				text_1.textContent = "o";
				const button = document.createElement("button");
				button.textContent = "Selecciona archivo(s)";
				button.addEventListener("click", function(event) {
					input_file.click();
				});
				empty.append(icon, text_0, text_1, button);
				drop_zone.classList.remove("grid");
				drop_zone.replaceChildren(empty);
			};
			const loadingDropZone = function() {
				const loading = document.createElement("div");
				loading.classList.add("loading");
				const icon = document.createElement("i");
				icon.classList.add("fa-duotone", "fa-spinner-third", "fa-spin");
				const text = document.createElement("div");
				text.textContent = "Convirtiendo";
				loading.append(icon, text);
				drop_zone.replaceChildren(loading);
			};

			const drop_zone = document.querySelector(".drop-zone");
			const container = document.querySelector(".container");
			const input_file = document.querySelector("input");

			loadEmptyDropZone();

			const loadFile = async function(file) {
				if (file === undefined) return;

				loadingDropZone();
				const body = new FormData();
				body.append("action", "convertir-marcaciones");
				body.append("markings", file);
				await fetch("./api.php", {
						method: "POST",
						body
					}).then(async function(value) {
						if (value.status >= 400) throw await value.text();
						return value.blob();
					})
					.then(function(blob) {
						const url = URL.createObjectURL(blob);
						const a = document.createElement("a");
						a.href = url;
						a.download = "marcareloj.txt";
						a.click();
						setTimeout(() => {
							input_file.value = "";
							loadEmptyDropZone();
						}, 1234);
					})
					.catch(function(reason) {
						input_file.value = "";
						loadEmptyDropZone();
						alert(reason);
					});
			}
			input_file.addEventListener("change", function(event) {
				const {
					files
				} = this
				const [file] = files
				loadFile(file)
			});
			drop_zone.addEventListener("dragover", function(event) {
				event.preventDefault();
				this.classList.add("active");
			});
			drop_zone.addEventListener("dragleave", function(event) {
				this.classList.remove("active");
			});
			drop_zone.addEventListener("drop", function(event) {
				event.preventDefault();
				this.classList.remove("active");
				const [file] = event.dataTransfer.files
				loadFile(file);
			});
		});
	</script>
</body>

</html>