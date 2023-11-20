

<?php
include('./modelo/conexion.php');

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

// Verifica si hay resultados y muestra los usuarios en la tabla
if ($result->num_rows > 0) {
    echo '<h1>Categorias</h1>';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Categoria</th>';
    echo '<th>Accion</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td><a href="users/edit_categories.php?id=' . $row['id'] . '">Edit</a> | <a href="users/delete_categories.php?id=' . $row['id'] . '">Delete</a></td>';
        echo '</tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No hay Catergorias registradas.';
}
?>
