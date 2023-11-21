<?php
 // Asegúrate de iniciar la sesión al principio de tu script
include('../controlador/session_start.php');
if ($_POST) {
    // Obtener los datos del formulario
    $url = $_POST["url"];
    $name = $_POST["name"];
    $category_id = $_POST["category_id"];
    
    include('../modelo/conexion.php');

    // Obtener el ID del usuario actualmente autenticado
    $user_id = $_SESSION['id']; // Ajusta según cómo manejas la autenticación

    // Realizar la inserción en la base de datos
    
    $sql = "INSERT INTO `news_source`(`nombre_fuente`, `url`, `category_id`, `user_id`) VALUES ('$name','$url','$category_id','$user_id')";
	
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-danger'>Fuente de Noticias Agregada Exitosamente</div>";
        include('../RSS/logic_RSS.php');
        $filteredCategory = isset($_GET['category']) ? $_GET['category'] : null;
        $news = parseDatabase($filteredCategory);
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }

    $conn->close();
}
?>
