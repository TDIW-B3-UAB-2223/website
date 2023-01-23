<?php
    $id = $_GET["categoria"];
    if ( !isset($id) ) {
        $model = populate_model([
            "title" => "Categoria no trobada",
            "error" => "Categoria no trobada",
            "message" => "No vas demanar ninguna categoria.",
        ]);
        render("error.php");
        exit();
    }
    $categoria = $database->getCategory($id);
    if ( $categoria == null ) {
        $model = populate_model([
            "title" => "Categoria no trobada",
            "error" => "Categoria no trobada",
            "message" => "La categoria que has demanat no existeix.",
        ]);
        render("error.php");
        exit();
    }

    $products = $database->getProducts($id);
    
    $model = populate_model([
        "title" => $categoria["name"],
        "categoria" => $categoria,
        "products" => $products,
    ]);
    render("categoria.php");
