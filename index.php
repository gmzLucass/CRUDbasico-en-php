<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD en PHP y MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a931c9771f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Styles.css">
</head>

<body>
    <div class="container-fluid">
        <header class="header text-center p-4">
            <h1>CRUD Gomez Lucas</h1>
        </header>

        <!-- Barra de búsqueda -->
        <nav class="navbar navbar-light bg-light mb-4">
            <div class="container">
                <form class="d-flex" role="search" method="GET" action="">
                    <input class="form-control me-2" type="search" name="search" placeholder="Buscar por Nombre, Apellido o DNI" aria-label="Search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                    <button class="btn btn-outline-success" type="submit" name="btnBuscar">Buscar</button>
                </form>
            </div>
        </nav>

        <div class="row">
            <!-- Formulario de registro -->
            <div class="col-md-4 p-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center text-secondary">Registro de Personas</h3>
                        <form method="POST" action="">
                            <?php
                            include("modelo/conexion.php");
                            include("controlador/registro_persona.php");
                            ?>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre de la Persona</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido de la Persona</label>
                                <input type="text" class="form-control" name="apellido" required>
                            </div>
                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI de la Persona</label>
                                <input type="text" class="form-control" name="dni" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="fecha" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary" name="btnRegistrar" value="ok">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla de datos -->
            <div class="col-md-8 p-4">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Fecha de Nac</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "modelo/conexion.php";

                            // Obtener la búsqueda desde la URL
                            $search = isset($_GET['search']) ? $conexion->real_escape_string($_GET['search']) : '';

                            // Consulta SQL con búsqueda
                            $search_query = '';
                            if (!empty($search)) {
                                $search_query = " WHERE Nombre LIKE '%$search%' OR Apellido LIKE '%$search%' OR DNI LIKE '%$search%'";
                            }

                            // Consulta para obtener datos
                            $sql = $conexion->query("SELECT * FROM personas" . $search_query);

                            // Mostrar los resultados
                            while ($datos = $sql->fetch_object()) {
                            ?>
                                <tr>
                                    <td><?= $datos->ID ?></td>
                                    <td><?= htmlspecialchars($datos->Nombre) ?></td>
                                    <td><?= htmlspecialchars($datos->Apellido) ?></td>
                                    <td><?= htmlspecialchars($datos->DNI) ?></td>
                                    <td><?= htmlspecialchars($datos->Fecha_nacimiento) ?></td>
                                    <td><?= htmlspecialchars($datos->Correo) ?></td>
                                    <td>
                                        <a href="controlador/modificar.php?id=<?= $datos->ID ?>" class="btn btn-warning btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="controlador/eliminar.php?id=<?= $datos->ID ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

