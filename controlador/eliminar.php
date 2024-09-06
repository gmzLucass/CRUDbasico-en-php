<?php
include __DIR__ . '/../modelo/conexion.php'; // Ajusta la ruta según tu estructura de directorios

// Obtener el ID desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si el ID es válido
if ($id > 0) {
    // Preparar la consulta DELETE
    $delete_sql = "DELETE FROM personas WHERE ID = $id";

    if ($conexion->query($delete_sql)) {
        // Redirigir a la página principal si el usuario fue eliminado correctamente
        header("Location: http://localhost/ProyectosPHP/Crud1PHP/");
        exit;
    } else {
        // Mostrar un mensaje de error
        echo '<div class="alert alert-danger">Error al eliminar el usuario: ' . $conexion->error . '</div>';
    }
} else {
    echo '<div class="alert alert-warning">ID inválido</div>';
}
?>
