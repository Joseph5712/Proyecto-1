<?php
include('../controlador/session_start.php');
// Verifica si se proporciona un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $news_source_id = $_GET['id'];

    include('../modelo/conexion.php');
    // Elimina la fuente de noticias de la base de datos
    $delete_sql = "DELETE FROM news_source WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $news_source_id);
    $delete_result = $delete_stmt->execute();

    if ($delete_result) {
        echo "Fuente de noticias eliminada con éxito.";
    } else {
        echo "Error al eliminar la fuente de noticias.";
    }

    $delete_stmt->close();
    $conn->close();
} else {
    echo "ID de fuente de noticias no válido.";
}
?>
