<!DOCTYPE html>
<html lang="es">
<head>
    <?php require "bd.php"?>
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
                            <button type="button" class="btn btn-secondary btn-sm"data-bs-toggle="modal"data-bs-target="#editarModal<?= $mascota['id'] ?>"> Editar</button>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarModal<?= $mascota['id'] ?>">Eliminar</button>
                        </td>
                    </tr>
                    <div class="modal fade" id="eliminarModal<?= $mascota['id'] ?>" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="eliminarModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p>¿Estás seguro de que quieres ELIMINAR a <?= $mascota['nombre'] ?>?</p>
                            <p class="text-danger small">Esta acción es irreversible.</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a href="crud.php?accion=eliminar&id=<?= $mascota['id'] ?>" class="btn btn-danger">Sí, Eliminar</a>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="editarModal<?= $mascota['id'] ?>" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header bg-secondary text-white">
                            <h5 class="modal-title" id="editarModalLabel">Editar Mascota: <?= $mascota['nombre'] ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form method="POST" action="crud.php">
                            <div class="modal-body">
                                <input type="hidden" name="accion" value="actualizar">
                                <input type="hidden" name="id" value="<?= $mascota['id'] ?>">
                                
                                <div class="mb-3">
                                    <label for="nombre_<?= $mascota['id'] ?>" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_<?= $mascota['id'] ?>" name="nombre" value="<?= $mascota['nombre'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_<?= $mascota['id'] ?>" class="form-label">Tipo</label>
                                    <input type="text" class="form-control" id="tipo_<?= $mascota['id'] ?>" name="tipo" value="<?= $mascota['tipo'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edad_<?= $mascota['id'] ?>" class="form-label">Edad</label>
                                    <input type="number" class="form-control" id="edad_<?= $mascota['id'] ?>" name="edad" value="<?= $mascota['edad'] ?>" required min="1">
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        </div>
        <?= $mensaje_crud ?> 
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#formularioCrear" aria-expanded="false" aria-controls="formularioCrear">
                Registrar Nueva Mascota
            </button>
        </div>
        <div class="collapse" id="formularioCrear">
            <div class="card card-body mb-4">
                <h3 class="card-title">Nuevo Registro</h3>
                <form method="POST" action="crud.php">
                    <input type="hidden" name="accion" value="crear">
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-4">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="tipo" name="tipo" required>
                        </div>
                        <div class="col-md-2">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" required min="1">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    pg_close($con); 
    ?><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
        