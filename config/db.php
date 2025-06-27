<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'db_mig_unificada';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
