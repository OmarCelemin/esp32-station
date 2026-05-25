<?php
$host     = getenv("MYSQLHOST");
$db       = getenv("MYSQLDATABASE");
$user     = getenv("MYSQLUSER");
$password = getenv("MYSQLPASSWORD");
$port     = getenv("MYSQLPORT") ?: 3306;

header("Content-Type: application/json");

// Debug temporal
echo json_encode([
    "host" => $host,
    "db"   => $db,
    "user" => $user,
    "port" => $port
]);
?>
