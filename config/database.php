<?php
// Configuration de la connexion MySQL pour XAMPP/WAMP ou Docker
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$database = getenv('DB_DATABASE') ?: 'gestion_commerciale';

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');

function sanitize($value)
{
    global $conn;
    return mysqli_real_escape_string($conn, trim($value));
}
