<?php
    $id = $_GET["categoria"];
    if ( !isset($id) ) {
        header("Location: index.php?accio=404");
        exit();
    }
    $categoria = $database->getCategory($id);
    if ( $categoria == null ) {
        header("Location: index.php?accio=404");
        exit();
    }

    $categories = $database->getCategories($id);
    $products = $database->getProducts($id);

    require_once('routes' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'categoria.php');
