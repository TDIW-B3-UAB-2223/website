<?php
    if (isset($_SESSION["cart"])) {
        $populated_cart = $populated_carret = array_map(function ($product) {
            global $database;
            $product["product"] = $database->getProduct($product["id"]);
            return $product;
        }, $_SESSION["cart"]["products"]);
    } else {
        $populated_cart = [];
    }

    $model = populate_model([
        "title" => "El meu carret",
        "populated_cart" => $populated_cart
    ]);

    render("carret.php");