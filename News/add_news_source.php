<?php
session_start(); // Asegúrate de iniciar la sesión al principio de tu script

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
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }

    $conn->close();
}
?>
