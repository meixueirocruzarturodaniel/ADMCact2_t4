<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["raza"]) and !empty($_POST["edad"]) and !empty($_POST["color"]) and !empty($_POST["peso"])) {
        
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $raza = $_POST["raza"];
        $edad = $_POST["edad"];
        $color = $_POST["color"];
        $peso = $_POST["peso"];
        $imagen_actual = $_POST["imagen_actual"];
        
        // Por defecto mantenemos el nombre de la imagen que ya tenía en la base de datos
        $nombre_imagen = $imagen_actual; 

        // Si el usuario seleccionó un archivo nuevo, lo procesamos
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
            $nombre_imagen = time() . "_" . $_FILES["imagen"]["name"];
            $ruta_temporal = $_FILES["imagen"]["tmp_name"];
            move_uploaded_file($ruta_temporal, "imagenes/" . $nombre_imagen);
        }

        // Ejecutamos el UPDATE incluyendo la columna imagen
        $sql = $conexion->query("UPDATE gatos SET nombre='$nombre', raza='$raza', edad=$edad, color='$color', peso=$peso, imagen='$nombre_imagen' WHERE id_gato=$id");
        
        if ($sql == 1) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({ 
                        icon: 'success', 
                        title: '¡Actualizado!', 
                        text: 'Los datos del gato se modificaron correctamente', 
                        background: '#212121', 
                        color: '#f1f1f1', 
                        confirmButtonColor: '#3ea6ff' 
                    }).then((result) => {
                        window.location.href = 'index.php';
                    });
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo actualizar al gato', background: '#212121', color: '#f1f1f1', confirmButtonColor: '#3ea6ff' });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({ icon: 'warning', title: 'Atención', text: 'Alguno de los campos obligatorios está vacío', background: '#212121', color: '#f1f1f1', confirmButtonColor: '#3ea6ff' });
            });
        </script>";
    }
}
?>