<?php
$conn = new mysqli('localhost:3306', 'root', '', 'php_proyecto1');
if($_POST){
    $categoryName=$_POST[ "categoryName"];
    
    $sql=" INSERT INTO categories (name) VALUES ('$categoryName')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-danger '>Categoria Agregada Exitosamente</div>";
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }
    $conn->close();
}
?>