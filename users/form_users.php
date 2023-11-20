<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Users</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

  <div class="container-fluid">
    <h1 class="display-4">Registro de Usuarios</h1>
    <p class="lead">Formulario Datos de Usuarios</p>
    <hr class="my-4">

<form method="post" action="add_users.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first-name">First Name</label>
        <input id="first-name" class="form-control" type="text" name="firstName">
    </div>
    <div class="form-group">
        <label for="last-name">Last Name</label>
        <input id="last-name" class="form-control" type="text" name="lastName">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" class="form-control" type="text" name="email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" class="form-control" type="text" name="password">
    </div>
    <div class="form-group">
        <label for="profilePic">Profile Picture</label>
        <input type="file" class="form-control" name="profilePic" id="profilePic">
    </div>
    <button type="submit" class="btn btn-primary">Añadir</button>
    <a href="../index.php"><button type="button" class="btn btn-primary">Atras</button></a>


</form>

    
      <!-- <input type="submit" class="btn btn-primary" value="Sign up"></input> -->
    
  </div>


</body>

</html>