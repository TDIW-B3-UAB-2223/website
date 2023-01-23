<?php
    function populate_model($model) {
        global $database;
        $model["user"] = $_SESSION["user"] ?? null;
        $model["categories"] = $database->getCategories();
        $model["cart"] = $_SESSION["cart"] ?? ["products" => [], "total" => 0, "total_items" => 0];
        return $model;
    }

    function recalcCart() {
        global $database;
        $cart = $_SESSION["cart"];

        $cart["total_items"] = array_reduce(
            $cart["products"],
            function ($total, $product) {
                return $total + $product["quantity"];
            },
            0
        );
        $cart["total"] = array_reduce(
            $cart["products"],
            function ($total, $product) {
                global $database;
                $product_db = $database->getProduct($product["id"]);
                return $total + $product_db["price"] * $product["quantity"];
            },
            0
        );

        $_SESSION["cart"] = $cart;
    }