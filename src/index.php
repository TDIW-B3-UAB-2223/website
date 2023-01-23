<?php
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'base.php';

    $accio = $_GET['accio'] ?? 'portada';
    $route = $router[$accio] ?? $router["404"];

    include_once __DIR__ .
     DIRECTORY_SEPARATOR . 'routes' .
     DIRECTORY_SEPARATOR . 'controller' .
     DIRECTORY_SEPARATOR . $route;
