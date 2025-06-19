<?php
$usuario = "dayana";
$clave_plana = "12345";

// Encriptar la contraseña
$clave_encriptada = password_hash($clave_plana, PASSWORD_DEFAULT);

// Conectar a tu base de datos (usamos "pagina_principal")
$conexion = new mysqli("localhost", "root", "", "pagina_principal");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Insertar usuario en la tabla usuarios
$sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $usuario, $clave_encriptada);

if ($stmt->execute()) {
    echo "✅ Usuario registrado correctamente.";
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
