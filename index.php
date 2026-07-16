<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD en PHP y MySQL - ADMC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(rgba(15, 15, 15, 0.88), rgba(15, 15, 15, 0.88)), url('imgs/fondo.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #f1f1f1;
            font-family: "Roboto", Arial, sans-serif;
        }
        .yt-card {
            background-color: rgba(33, 33, 33, 0.95);
            border-radius: 12px;
            border: 1px solid #3d3d3d;
        }
        .form-control {
            background-color: #121212;
            border: 1px solid #3d3d3d;
            color: #f1f1f1;
        }
        .form-control:focus {
            background-color: #0f0f0f;
            border-color: #3ea6ff;
            color: #f1f1f1;
            box-shadow: 0 0 0 0.25rem rgba(62, 166, 255, 0.25);
        }
        .table {
            color: #f1f1f1;
        }
        .table thead th {
            background-color: #272727;
            border-bottom: 2px solid #3d3d3d;
            color: #aaaaaa;
        }
        .table tbody td {
            border-bottom: 1px solid #3d3d3d;
            vertical-align: middle;
        }
        .text-secondary {
            color: #aaaaaa !important;
        }
        .btn-primary {
            background-color: #3ea6ff;
            border-color: #3ea6ff;
            color: #0f0f0f;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #65b8ff;
            border-color: #65b8ff;
            color: #0f0f0f;
        }
    </style>
</head>
<body>
    <h1 class="text-center p-4 fw-bold">CRUD de Gatos</h1>
    <div class="container-fluid">
        <div class="row px-3">
            
            <form class="col-12 col-lg-4 p-4 yt-card mb-4" method="POST" enctype="multipart/form-data">
                <h3 class="text-center text-secondary mb-4">Registro de Gatos</h3>
                
                <?php
                include "modelo/conexion.php";
                include "controlador/registro_gato.php";
                ?>
                
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Gato</label>
                    <input type="text" class="form-control" name="nombre">
                </div>
                <div class="mb-3">
                    <label for="raza" class="form-label">Raza</label>
                    <input type="text" class="form-control" name="raza">
                </div>
                <div class="mb-3">
                    <label for="edad" class="form-label">Edad (años)</label>
                    <input type="number" class="form-control" name="edad">
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control" name="color">
                </div>
                <div class="mb-3">
                    <label for="peso" class="form-label">Peso (kg)</label>
                    <input type="text" class="form-control" name="peso">
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label">Foto del Gato (Opcional)</label>
                    <input type="file" class="form-control" name="imagen" accept="image/*">
                </div>
                
                <button type="submit" class="btn btn-primary w-100 mt-2" name="btnregistrar" value="ok">Registrar</button>
            </form>
            
            <div class="col-12 col-lg-8">
                <div class="yt-card p-4">
                    <?php 
                    include "controlador/eliminar_gato.php"; 
                    ?>
                    
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Raza</th>
                                    <th scope="col">Edad</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Peso</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = $conexion->query("SELECT * FROM gatos");
                                while($datos = $sql->fetch_object()){ ?>
                                    <tr>
                                        <td><?= $datos->id_gato ?></td>
                                        <td>
                                            <?php if($datos->imagen != null && $datos->imagen != "") { ?>
                                                <img src="imagenes/<?= $datos->imagen ?>" width="50" height="50" style="border-radius: 8px; object-fit: cover;">
                                            <?php } else { ?>
                                                <span class="text-secondary" style="font-size: 0.85em;">Sin foto</span>
                                            <?php } ?>
                                        </td>
                                        <td><?= $datos->nombre ?></td>
                                        <td><?= $datos->raza ?></td>
                                        <td><?= $datos->edad ?></td>
                                        <td><?= $datos->color ?></td>
                                        <td><?= $datos->peso ?></td>
                                        <td>
                                            <a href="modificar_gato.php?id=<?= $datos->id_gato ?>" class="btn btn-sm btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="#" onclick="confirmarEliminacion(<?= $datos->id_gato ?>)" class="btn btn-sm btn-danger mb-1"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function confirmarEliminacion(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3d3d3d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: '#212121',
                color: '#f1f1f1'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php?id=" + id;
                }
            });
        }
    </script>
</body>
</html>