<?php
// Apache no hereda env vars del sistema, leerlas desde el entorno del proceso
$host     = $_ENV["MYSQLHOST"]     ?? getenv("MYSQLHOST")     ?? "";
$db       = $_ENV["MYSQLDATABASE"] ?? getenv("MYSQLDATABASE") ?? "";
$user     = $_ENV["MYSQLUSER"]     ?? getenv("MYSQLUSER")     ?? "";
$password = $_ENV["MYSQLPASSWORD"] ?? getenv("MYSQLPASSWORD") ?? "";
$port     = $_ENV["MYSQLPORT"]     ?? getenv("MYSQLPORT")     ?? 3306;

header("Content-Type: application/json");

// Debug temporal
echo json_encode([
    "host" => $host,
    "db"   => $db,
    "user" => $user,
    "port" => $port
]);
?>
