<?php
include __DIR__ . '/../modelo/conexion.php'; // Ajusta la ruta según tu estructura de directorios

// Obtener el ID desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Si se envía el formulario para actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnActualizar'])) {
    // Obtener datos del formulario
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $apellido = $conexion->real_escape_string($_POST['apellido']);
    $dni = $conexion->real_escape_string($_POST['dni']);
    $fecha = $conexion->real_escape_string($_POST['fecha']);
    $email = $conexion->real_escape_string($_POST['email']);

    // Actualizar los datos en la base de datos
    $update_sql = "UPDATE personas SET Nombre = '$nombre', Apellido = '$apellido', DNI = '$dni', Fecha_nacimiento = '$fecha', Correo = '$email' WHERE ID = $id";

    if ($conexion->query($update_sql)) {
        echo '<div class="alert alert-success">Datos actualizados correctamente</div>';
    } else {
        echo '<div class="alert alert-danger">Error al actualizar los datos: ' . $conexion->error . '</div>';
    }
}

// Consultar los datos actuales de la persona
$sql = $conexion->query("SELECT * FROM personas WHERE ID = $id");

if ($sql) {
    $datos = $sql->fetch_object();
} else {
    echo '<div class="alert alert-danger">Error al consultar la persona</div>';
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Styles.css">
</head>

<body>
    <div class="container mt-5">
        <form class="col-lg-6 col-md-8 col-sm-12 p-4 mx-auto border rounded shadow-sm bg-light" method="POST" action="">
            <h3 class="text-center text-secondary mb-4">Modificar Persona</h3>
            <?= isset($message) ? $message : '' ?>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($datos->Nombre) ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?= htmlspecialchars($datos->Apellido) ?>" required>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" value="<?= htmlspecialchars($datos->DNI) ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?= htmlspecialchars($datos->Fecha_nacimiento) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($datos->Correo) ?>" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary" name="btnActualizar">Actualizar</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>