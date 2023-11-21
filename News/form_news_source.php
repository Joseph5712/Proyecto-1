
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Añadir Fuente de Noticias</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid">
    <h1 class="display-4">Añadir Fuente de Noticias</h1>
    <p class="lead">Formulario para Agregar Fuentes de Noticias</p>
    <hr class="my-4">

    <form method="post" action="add_news_source.php" enctype="multipart/form-data">
      <div class="form-group">
        <label for="url">URL del Feed RSS</label>
        <input id="url" class="form-control" type="text" name="url" required>
      </div>
      <div class="form-group">
        <label for="name">Nombre de la Fuente</label>
        <input id="name" class="form-control" type="text" name="name" required>
      </div>
      <div class="form-group">
        <label for="category-id">Categoría</label>
        <select id="category-id" class="form-control" name="category_id" required>
          <?php
          // Conexión a la base de datos (ajusta los detalles según tu configuración)
          include('../modelo/conexion.php');

          // Verificar la conexión
          if ($conn->connect_error) {
            die("Error de conexión: " . $mysqli->connect_error);
          }

          // Consulta para obtener las categorías
          $query = "SELECT * FROM categories";
          $result = $conn->query($query);

          // Generar opciones del menú desplegable
          while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
          }

          // Cerrar la conexión
          $conn->close();
          ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Añadir Fuente</button>
      <a href="../MyCover.php"><button type="button" class="btn btn-primary">Atrás</button></a>
      
    </form>
  </div>

  <?php include('show_news_source.php')?>

</body>

</html>
