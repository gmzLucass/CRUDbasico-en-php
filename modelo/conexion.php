<?php
// Configuración de la conexión
$host = 'localhost';
$usuario = 'root';
$clave = '';
$base_datos = 'crudgomezl';

// Crear conexión
$conexion = new mysqli($host, $usuario, $clave, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres
$conexion->set_charset("utf8");

// Opcional: configurar el tiempo de espera de la conexión
$conexion->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5); // Tiempo en segundos

;
?>

