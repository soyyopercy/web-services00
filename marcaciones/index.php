<?php

session_start();
date_default_timezone_set("America/Lima");

die(require_once(__DIR__ . "/main.php"));
if (isset($_SESSION["user"]) === false) {
  require_once(__DIR__ . "/login.php");
} else {
  require_once(__DIR__ . "/main.php");
}
