<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    
    $sql = $conexion->query("DELETE FROM gatos WHERE id_gato=$id");
    
    if ($sql == 1) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({ 
                    icon: 'success', 
                    title: '¡Eliminado!', 
                    text: 'Gato eliminado correctamente', 
                    background: '#212121', 
                    color: '#f1f1f1', 
                    showConfirmButton: false, 
                    timer: 1500 
                }).then(() => {
                    // Redirigir para limpiar la URL y evitar que se repita la acción al recargar
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
                    text: 'No se pudo eliminar al gato', 
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
}
?>