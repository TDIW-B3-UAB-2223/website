<?php

    require_once('lib' . DIRECTORY_SEPARATOR . 'router.php');

    $router = getRouter();
    
    $accio = $_GET['accio'] ?? 'portada';
    $route = $router[$accio] ?? $router["404"];

    // TODO: Connect to database
    $database = null;

    if ( $route->getUsesDB() ) {
        require_once('lib' . DIRECTORY_SEPARATOR . 'database.php');
        $database = DatabaseConnection::getInstance();
        $database->connect("localhost", 5432, "postgres", "postgres", "music");
    }

    include_once __DIR__ . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . $route->getPath();
    
