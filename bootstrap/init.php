<?php
include "constants.php";
include "config.php";
include "libs/helpers.php";
include "vendor/autoload.php";


$dsn = "mysql:dbname=$database_config->db;host=$database_config->host";
$user = $database_config->user;
$password = $database_config->pass;

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    diePage('Connection failed: ' . $e->getMessage());
}


include "libs/lib-auth.php";
include "libs/lib-tasks.php";