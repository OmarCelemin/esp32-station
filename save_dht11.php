<?php
$host     = getenv("MYSQLHOST");
$db       = getenv("MYSQLDATABASE");
$user     = getenv("MYSQLUSER");
$password = getenv("MYSQLPASSWORD");
$port     = getenv("MYSQLPORT") ?: 3306;

header("Content-Type: application/json");

$raw  = file_get_contents("php://input");
$data = json_decode($raw, true);

$temperature = isset($data["temperature"]) ? floatval($data["temperature"]) : null;
$humidity    = isset($data["humidity"])    ? floatval($data["humidity"])    : null;
$fanStatus   = isset($data["fanStatus"])   ? intval($data["fanStatus"])     : null;

if ($temperature === null || $humidity === null) {
    http_response_code(400);
    echo json_encode(["error" => "Datos incompletos", "raw" => $raw]);
    exit;
}

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8",
        $user, $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare(
        "INSERT INTO dht11_data (temperature, humidity, fanStatus) VALUES (?, ?, ?)"
    );
    $stmt->execute([$temperature, $humidity, $fanStatus]);

    echo json_encode([
        "ok"          => true,
        "temperature" => $temperature,
        "humidity"    => $humidity,
        "fanStatus"   => $fanStatus
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
