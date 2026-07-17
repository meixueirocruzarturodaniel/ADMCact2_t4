<?php
if (isset($_POST["btnmodificar"])) {
    if (!empty($_POST["id"]) and !empty($_POST["nombre"]) and !empty($_POST["raza"]) and !empty($_POST["edad"]) and !empty($_POST["color"]) and !empty($_POST["peso"])) {
        
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $raza = $_POST["raza"];
        $edad = $_POST["edad"];
        $color = $_POST["color"];
        $peso = $_POST["peso"];

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
            
            $nombre_imagen = time() . "_" . $_FILES["imagen"]["name"];
            $ruta_temporal = $_FILES["imagen"]["tmp_name"];
            move_uploaded_file($ruta_temporal, "imagenes/" . $nombre_imagen); 
            
            $actualizacion = $conexion->query("UPDATE gatos SET nombre='$nombre', raza='$raza', edad=$edad, color='$color', peso=$peso, imagen='$nombre_imagen' WHERE id_gato=$id");
        } else {
            $actualizacion = $conexion->query("UPDATE gatos SET nombre='$nombre', raza='$raza', edad=$edad, color='$color', peso=$peso WHERE id_gato=$id");
        }
        
        if ($actualizacion == 1) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({ 
                        icon: 'success', 
                        title: '¡Actualizado!', 
                        text: 'Los cambios fueron hechos correctamente', 
                        background: '#212121', 
                        color: '#f1f1f1', 
                        showConfirmButton: false, 
                        timer: 1500 
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({ 
                        icon: 'error', 
                        title: 'Error', 
                        text: 'No se pudo modificar el registro', 
                        background: '#212121', 
                        color: '#f1f1f1', 
                        showConfirmButton: false, 
                        timer: 1500 
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                });
            </script>";
        }
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({ 
                    icon: 'warning', 
                    title: 'Atención', 
                    text: 'Alguno de los campos obligatorios está vacío o falta el ID', 
                    background: '#212121', 
                    color: '#f1f1f1', 
                    confirmButtonColor: '#3ea6ff' 
                });
            });
        </script>";
    }
}
?>