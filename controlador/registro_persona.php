<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["dni"]) && !empty($_POST["fecha"]) && !empty($_POST["email"])) {
        // Obtener datos del formulario y sanitizar
        $nombre = htmlspecialchars(trim($_POST["nombre"]));
        $apellido = htmlspecialchars(trim($_POST["apellido"]));
        $dni = htmlspecialchars(trim($_POST["dni"]));
        $fecha = htmlspecialchars(trim($_POST["fecha"]));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

        // Validar el correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alert alert-warning">Correo electrónico no válido</div>';
            exit();
        }

        // Preparar la consulta SQL
        $stmt = $conexion->prepare("INSERT INTO personas (Nombre, Apellido, DNI, Fecha_nacimiento, correo) VALUES (?, ?, ?, ?, ?)");

        // Verificar si la preparación fue exitosa
        if (!$stmt) {
            echo '<div class="alert alert-danger">Error en la preparación de la consulta</div>';
            exit();
        }

        // Vincular los parámetros
        $stmt->bind_param("sssss", $nombre, $apellido, $dni, $fecha, $email);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Redirigir a la misma página para evitar reenvío del formulario
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo '<div class="alert alert-danger">Error al registrar la persona: ' . $stmt->error . '</div>';
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos están vacíos</div>';
    }
}
?>
