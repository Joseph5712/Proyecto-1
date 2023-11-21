<?php
include('../modelo/conexion.php');
include('../controlador/session_start.php');
// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se proporciona un ID válido en la URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $news_source_id = $_GET['id'];
        
        // Consulta para obtener los datos de la fuente de noticias por su ID
        $sql = "SELECT * FROM news_source WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $news_source_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica si se encontró la fuente de noticias
        if ($result->num_rows === 1) {
            $news_source = $result->fetch_assoc();

            // Procesa los datos del formulario y actualiza la fuente de noticias
            $newUrl = $_POST['newUrl'];
            $newName = $_POST['newName'];
            $newCategoryId = $_POST['newCategoryId'];

            // Consulta SQL para actualizar la fuente de noticias
            $sql = "UPDATE news_source SET url = ?, nombre_fuente = ?, category_id = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssii", $newUrl, $newName, $newCategoryId, $news_source_id);

            if ($stmt->execute()) {
                echo "Fuente de noticias actualizada correctamente";
            } else {
                echo "Error al actualizar la fuente de noticias: " . $stmt->error;
            }
        } else {
            echo "No se encontró la fuente de noticias.";
        }
    } else {
        echo "ID de fuente de noticias no válido.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Editar Fuente de Noticias</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <h1>Editar Fuente de Noticias</h1>
    <form method="post">
        <label for="newUrl">URL del Feed RSS:</label>
        <input type="text" name="newUrl" value="<?php echo $news_source['url']; ?>"><br>

        <label for="newName">Nombre de la Fuente:</label>
        <input type="text" name="newName" value="<?php echo $news_source['nombre_fuente']; ?>"><br>

        <label for="newCategoryId">Categoría:</label>
        <select name="newCategoryId">
            <?php
            // Consulta para obtener las categorías
            $query = "SELECT * FROM categories";
            $result = $conn->query($query);

            // Generar opciones del menú desplegable
            while ($row = $result->fetch_assoc()) {
                $selected = ($row['id'] == $news_source['category_id']) ? 'selected' : '';
                echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Guardar Cambios">
    </form>
    
</body>
</html>

