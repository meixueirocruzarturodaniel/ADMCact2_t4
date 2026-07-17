<?php
include "modelo/conexion.php";
$id = $_GET["id"];
$sql = $conexion->query("SELECT * FROM gatos WHERE id_gato = $id");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Gato - ADMC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .btn-secondary {
            background-color: #3d3d3d;
            border-color: #3d3d3d;
            color: #f1f1f1;
        }
        .btn-secondary:hover {
            background-color: #4d4d4d;
            border-color: #4d4d4d;
        }
    </style>
</head>
<body>
    <h1 class="text-center p-4 fw-bold">Modificar Datos del Gato</h1>
    <div class="container-fluid d-flex justify-content-center">
        
        <!-- Importante: enctype="multipart/form-data" para poder procesar la nueva imagen -->
        <form class="col-12 col-md-6 col-lg-4 p-4 yt-card" method="POST" enctype="multipart/form-data">
            <h3 class="text-center text-secondary mb-4">Editar Registro</h3>
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            
            <?php
            include "controlador/modificar_gato.php";
            while($datos = $sql->fetch_object()){ ?>
                
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Gato</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $datos->nombre ?>">
                </div>
                <div class="mb-3">
                    <label for="raza" class="form-label">Raza</label>
                    <input type="text" class="form-control" name="raza" value="<?= $datos->raza ?>">
                </div>
                <div class="mb-3">
                    <label for="edad" class="form-label">Edad (años)</label>
                    <input type="number" class="form-control" name="edad" value="<?= $datos->edad ?>">
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control" name="color" value="<?= $datos->color ?>">
                </div>
                <div class="mb-3">
                    <label for="peso" class="form-label">Peso (kg)</label>
                    <input type="text" class="form-control" name="peso" value="<?= $datos->peso ?>">
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Foto Actual</label><br>
                    <?php if($datos->imagen != null && $datos->imagen != "") { ?>
                        <img src="imagenes/<?= $datos->imagen ?>" width="80" style="border-radius: 8px; margin-bottom: 10px;">
                        <!-- Guardamos el nombre de la imagen actual de forma oculta por si no sube una nueva -->
                        <input type="hidden" name="imagen_actual" value="<?= $datos->imagen ?>">
                    <?php } else { ?>
                        <span class="text-secondary d-block mb-2">Sin foto actual</span>
                        <input type="hidden" name="imagen_actual" value="">
                    <?php } ?>
                    
                    <br><label for="imagen" class="form-label">Subir nueva foto (reemplaza la anterior)</label>
                    <input type="file" class="form-control" name="imagen" accept="image/*">
                </div>

            <?php }
            ?>
          <button type="submit" class="btn btn-primary w-100 mt-3" name="btnmodificar" value="ok">Actualizar Gato</button>
            <a href="index.php" class="btn btn-secondary w-100 mt-2">Cancelar y Volver</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Evitar el reenvío del formulario al recargar
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>