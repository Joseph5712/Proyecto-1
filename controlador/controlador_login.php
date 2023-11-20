<?php
session_start();
if (!empty($_POST[ "btningresar" ])){ 
    if (!empty ($_POST["email"]) and !empty($_POST["password"])) {
        $email=$_POST[ "email"];
        $password=$_POST["password"];
        $sql=$conn->query(" select * from users where email= '$email' and password='$password'");
        if ($datos=$sql->fetch_object()){
            $_SESSION["id"]=$datos->id;
            $_SESSION["first_name"]=$datos->first_name;
            $_SESSION["last_name"]=$datos->last_name;
            $_SESSION["role_id"]=$datos->role_id;
            header ("location: MyCover.php");
        }else
            echo "<div class='alert alert-danger '>Acceso denegado</div>";
        }else {
        echo "Campos vacios";
    }
}
?>

