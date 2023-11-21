<?php

function parseDatabase() {
    // Conectarse a la base de datos (Asegúrate de reemplazar 'tudb_servidor', 'tudb_usuario', 'tudb_contrasena', 'tudb_nombre' con tus propias credenciales)
    include('../modelo/conexion.php');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SQL para obtener las fuentes de noticias
    $stmt = $conn->prepare('SELECT * FROM news_source');
    $stmt->execute();
    $result = $stmt->get_result();
    $sources = $result->fetch_all(MYSQLI_ASSOC);

    $items = [];
    $foundImages = []; // Array para almacenar imágenes ya encontradas

    foreach ($sources as $source) {
        $rssUrl = $source['url'];
        $newsSourceId = $source['id'];

        // Cargar el contenido XML de la fuente RSS
        $rss = simplexml_load_file($rssUrl);

        foreach ($rss->channel->item as $item) {
            $title = (string)$item->title;
            $description = (string)$item->description;
            $link = (string)$item->link;
            $pubDate = strtotime((string)$item->pubDate);
            $doc = new DOMDocument();
            $doc->loadHTML($description);
            $img = $doc->getElementsByTagName('img')->item(0);
            if ($img) {
            $imgurl = $img->getAttribute('src');
        } else {
            // Si no se encuentra ninguna etiqueta de imagen, asignar un valor predeterminado o dejarlo vacío según tu lógica
            $imgurl = 'https://ayudawp.com/wp-content/uploads/2016/01/icono-enlace-roto.png'; // Puedes ajustar esto según tus necesidades
        }
        
        // se eliminan los elementos o etiquetas html
            $description = strip_tags($description);
        // se obtienen los primeros 200 caracteres
            $description = substr($description, 0, 200);
            $date=date('Y-m-d H:i:s', $pubDate);
            $useid =$source['user_id'];
            $catid =$source['category_id'];

            // Verificar si la noticia ya existe en la base de datos por el enlace permanente
            $existingNews = $conn->prepare("SELECT id FROM news WHERE perman_link = ?");
            $existingNews->bind_param("s", $link);
            $existingNews->execute();
            $existingNews->store_result();
        
        if ($existingNews->num_rows == 0) {
            // La noticia no existe, insertarla en la base de datos
            $sql = "INSERT INTO news(title, short_description, perman_link, date, news_source_id, user_id, category_id, img_url) VALUES 
                                ('$title','$description','$link','$date',$newsSourceId,$useid,$catid,'$imgurl')";
            mysqli_query($conn, $sql);
        }
    }
}
    // Obtener noticias de la base de datos filtradas por categoría (si es proporcionada)
    $stmt = $conn->prepare('SELECT * FROM news');
    $stmt->execute();
    $result = $stmt->get_result();
    $news = $result->fetch_all(MYSQLI_ASSOC);

    // Ordenar las noticias por fecha en orden descendente (más recientes primero)
    usort($news, function ($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });

    $stmt->close();
    $conn->close();

    return $news;
}




function getNewsFromDatabase() {
    // Conectarse a la base de datos (Asegúrate de reemplazar 'tudb_servidor', 'tudb_usuario', 'tudb_contrasena', 'tudb_nombre' con tus propias credenciales)
    include('./modelo/conexion.php');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Verificar si hay una sesión activa
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Verificar si el usuario está logueado
    if (empty($_SESSION['id'])) {
        // Redireccionar al usuario a la página form_news_source.php para que cree sus fuentes
        header('Location: form_news_source.php');
        exit();
    }

    // Obtener el ID del usuario
    $userId = $_SESSION['id'];

    // Consulta SQL para obtener las noticias del usuario ordenadas por fecha
    $sql = "SELECT * FROM news WHERE user_id = ? ORDER BY date DESC";
    
    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);
    
    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();

    // Verificar si se encontraron noticias
    if ($result) {
        $news = $result->fetch_all(MYSQLI_ASSOC);

        // Mostrar las noticias en el formato deseado
        echo '<!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <title>MyCover - Últimas Noticias</title>
                <link rel="stylesheet" href="css/noticias.css">
            </head>
            <body>
                <h1>MyCover - Últimas Noticias</h1>';

        foreach ($news as $item) {
            echo '<div>
                    <h2><a href="' . $item['perman_link'] . '" target="_blank">' . $item['title'] . '</a></h2>
                    <p>' . date('Y-m-d H:i:s', strtotime($item['date'])) . '</p>
                    <p>' . $item['short_description'] . '</p>';

            // Mostrar la imagen si está disponible
            if (!empty($item['img_url'])) {
                echo '<div>';
                echo '<a href="' . $item['perman_link'] . '">';
                echo '<img alt="news" src="' . $item['img_url'] . '">';
                echo '</a>';
                echo '</div>';
            }

            echo '</div>
                    <hr>';
        }

        echo '</body>
            </html>';
    } else {
        echo "No se encontraron noticias.";
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
}
?>







