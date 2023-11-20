<?php
include('./modelo/conexion.php');
if($_POST){
    $first_name=$_POST[ "firstName"];
    $last_name=$_POST[ "lastName"];
    $email=$_POST[ "email"];
    $password=$_POST["password"];
    $role = 2;
    $sql=" INSERT INTO users (first_name, last_name,email,password,role_id) VALUES ('$first_name', '$last_name', '$email', '$password','$role')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro insertado correctamente";
        header ("location: ../index.php");
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }
    $conn->close();

}