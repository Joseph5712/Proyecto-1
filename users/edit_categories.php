<?php
// Verifica si se proporciona un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $category_id = $_GET['id'];

    include('../modelo/conexion.php');

    // Consulta para obtener los datos del usuario por su ID
    $sql = "SELECT * FROM categories WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $category = $result->fetch_assoc();
    } else {
        echo "No se encontró la categoría.";
        exit;
    }

    // Verifica si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newCategoryName = $_POST['newCategoryName']; 

        // Consulta SQL para actualizar la categoría
        $sql = "UPDATE categories SET name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newCategoryName, $category_id);

        if ($stmt->execute()) {
            echo "Categoría actualizada correctamente";
        } else {
            echo "Error al actualizar la categoría: " . $stmt->error;
        }
    }

} else {
    echo "ID de categoría no válido.";
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <h1>Editar Usuario</h1>
    <form method="post">
        <label for="first_name">Nombre:</label>
        <input type="text" name="newCategoryName" value="<?php echo $category['name']; ?>"><br>

        <input type="submit" value="Guardar Cambios">
    </form>
    
</body>
</html>

