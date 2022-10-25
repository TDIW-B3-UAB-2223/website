<?php

    require('lib' . DIRECTORY_SEPARATOR . 'router.php');

    $router = get_router();
    
    $accio = $_GET['accio'] ?? 'portada';
    $route = $router[$accio] ?? $router["404"];

    // TODO: Connect to database
    $database = null;

    if ( $route->get_uses_db() ) {
        require('lib' . DIRECTORY_SEPARATOR . 'database.php');
        $database = databaseConnection::get_instance();
        $database->connect("localhost", 5432, "postgres", "postgres", "music");
    }

    include __DIR__ . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . $route->get_path();
    
?>