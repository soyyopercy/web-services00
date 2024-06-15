<?php

$pdo = new PDO("sqlsrv:Server=172.16.20.8\TPALOMINOSQL;Database=Empresa", "sax", "1230");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
