<?php
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'base.php';
    
    $product = $_POST["product"] ?? "";
    $quantity = intval($_POST["quantity"] ?? 0, 10);
    $cart = $_SESSION["cart"] ?? ["products" => [], "total" => 0, "total_items" => 0];

    if (array_filter($cart["products"], function ($product) {
        return $product["id"] == $_POST["product"];
    })) {
        $cart["products"] = array_map(
            function ($product) {
                if ($product["id"] == $_POST["product"]) {
                    $product["quantity"] += $_POST["quantity"];
                }
                return $product;
            },
            $cart["products"]
        );
    } else {
        $cart["products"][] = [
            "id" => $_POST["product"],
            "quantity" => $_POST["quantity"]
        ];
    }

    $_SESSION["cart"] = $cart;
    recalcCart();

    header("Location: /index.php?accio=carret");