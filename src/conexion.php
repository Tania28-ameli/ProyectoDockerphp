<?php
$host     = getenv('DB_HOST') ?: 'mysql';
$db       = getenv('DB_NAME') ?: 'proyecto_db';
$user     = getenv('DB_USER') ?: 'usuario';
$password = getenv('DB_PASSWORD') ?: 'contraseña123';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>