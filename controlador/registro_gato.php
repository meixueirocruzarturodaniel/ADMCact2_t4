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
            echo '<div class="alert alert-success">Gato registrado correctamente</div>';
        } else {
            echo '<div class="alert alert-danger">Error al registrar al gato</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos obligatorios está vacío</div>';
    }
}
?>