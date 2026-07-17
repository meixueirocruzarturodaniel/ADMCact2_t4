<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["raza"]) and !empty($_POST["edad"]) and !empty($_POST["color"]) and !empty($_POST["peso"])) {
        
        $nombre = $_POST["nombre"];
        $raza = $_POST["raza"];
        $edad = $_POST["edad"];
        $color = $_POST["color"];
        $peso = $_POST["peso"];
        
        $nombre_imagen = "";

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
            $nombre_imagen = time() . "_" . $_FILES["imagen"]["name"];
            $ruta_temporal = $_FILES["imagen"]["tmp_name"];
            move_uploaded_file($ruta_temporal, "imagenes/" . $nombre_imagen); 
        }

        $sql = $conexion->query("INSERT INTO gatos(nombre, raza, edad, color, peso, imagen) VALUES ('$nombre', '$raza', $edad, '$color', $peso, '$nombre_imagen')");
        
        if ($sql == 1) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({ 
                        icon: 'success', 
                        title: '¡Registrado!', 
                        text: 'Gato registrado correctamente', 
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
                        text: 'No se pudo registrar al gato', 
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
                    text: 'Alguno de los campos obligatorios está vacío', 
                    background: '#212121', 
                    color: '#f1f1f1', 
                    confirmButtonColor: '#3ea6ff' 
                });
            });
        </script>";
    }
}
?>