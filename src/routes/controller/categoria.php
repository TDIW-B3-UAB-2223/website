<?php
    $categoria = $database->getCategory($_GET["categoria"]);
    $categories = $database->getCategories($_GET["categoria"]);
    $products = $database->getProducts($_GET["categoria"]);

    require_once('routes' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'categoria.php');
