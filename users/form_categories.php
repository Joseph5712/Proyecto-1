<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="container-fluid">
    <h1 class="display-4">Registro de Categorías</h1>
    <p class="lead">Formulario para agregar categorías</p>
    <hr class="my-4">
    

    <form method="post" action="add_categories.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="category-name">Nombre de la Categoría</label>
            <input id="category-name" class="form-control" type="text" name="categoryName" required>
        </div>
        <button type="submit" class="btn btn-primary">Añadir Categoría</button>
        <a href="../MyCover.php"><button type="button" class="btn btn-primary">Atrás</button></a>
    </form>
</div>
</body>
</html>