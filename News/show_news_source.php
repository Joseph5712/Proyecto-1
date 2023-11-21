<?php
include('../modelo/conexion.php');

// Modificamos la consulta para obtener el nombre de la categoría
$sql = "SELECT ns.id, ns.nombre_fuente, c.name AS categoria_nombre FROM news_source ns
        LEFT JOIN categories c ON ns.category_id = c.id";
$result = $conn->query($sql);

// Verifica si hay resultados y muestra las fuentes de noticias en la tabla
if ($result->num_rows > 0) {
    echo '<h1>News Sources</h1>';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nombre Fuente</th>';
    echo '<th>Categoria</th>';
    echo '<th>Accion</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['nombre_fuente'] . '</td>';
        echo '<td>' . $row['categoria_nombre'] . '</td>';
        // Ahora, verificamos si la columna 'id' existe en el array $row
        echo '<td><a href="edit_news_source.php?id=' . (isset($row['id']) ? $row['id'] : '') . '">Edit</a> | <a href="delete_news_source.php?id=' . (isset($row['id']) ? $row['id'] : '') . '">Delete</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No hay Fuentes de Noticias registradas.';
}

$conn->close();
?>
