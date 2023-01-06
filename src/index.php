<?php
    define('ROOT', dirname(__FILE__));

    require_once('lib' . DIRECTORY_SEPARATOR . 'router.php');

    $router = getRouter();
    
    $accio = $_GET['accio'] ?? 'portada';
    $route = $router[$accio] ?? $router["404"];

    // TODO: Connect to database
    $database = null;

    if ( $route->getUsesDB() ) {
        require_once('database_credentials.php');
        require_once('lib' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'postgresql_database.php');
        $database = PostgresDatabaseConnection::getInstance();
        $database->connect($DB_URL, $DB_PORT, $DB_USER, $DB_PASS, $DB_NAME);
    }

    include_once __DIR__ . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $route->getPath();
