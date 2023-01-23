<?php
    $model = populate_model([
        "title" => "Negoci de Instruments Musicals",
        "categoria" => ["name" => "Negoci de Instruments Musicals"],
        "products" => $database->getProducts(null)
    ]);
    render("categoria.php");