<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Mascotas Básico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style> 
        .container { max-width: 900px; } 
        .table-container { margin-bottom: 15px; } 
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Listado de Mascotas</h1>
        <div class="table-container">
            <table class="table table-light table-striped table-bordered">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($mascota = pg_fetch_assoc($resultado)): 
                    ?>
                    <tr>
                        <th scope="row"><?= $mascota['id'] ?></th>
                        <td><?= $mascota['nombre'] ?></td>
                        <td><?= $mascota['tipo'] ?></td>
                        <td><?= $mascota['edad'] ?></td>
                        <td>
                            <a href="editar.php?id=<?= $mascota['id'] ?>" class="btn btn-secondary btn-sm">Editar</a>
                            <a href="eliminar.php?id=<?= $mascota['id'] ?>" class="btn btn-warning btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            <a href="crear.php" class="btn btn-primary">Registrar Nueva Mascota</a>
        </div>
    </div>
    <?php
    pg_close($con); 
    ?>
</body>
</html>