<?php


// Verifica si se proporciona un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = $_GET['id'];

    include('../modelo/conexion.php');
    // Elimina el usuario de la base de datos
    $delete_sql = "DELETE FROM categories WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $user_id);
    $delete_result = $delete_stmt->execute();

    if ($delete_result) {
        echo "Usuario eliminado con éxito.";
    } else {
        echo "Error al eliminar el usuario.";
    }

    $delete_stmt->close();
    $conn->close();
} else {
    echo "ID de usuario no válido.";
}
?>
