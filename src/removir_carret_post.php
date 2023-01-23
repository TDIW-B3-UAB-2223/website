<?php
    include_once __DIR__ . DIRECTORY_SEPARATOR . 'base.php';

    $product = $_POST["product"] ?? "";
    $cart = $_SESSION["cart"] ?? ["products" => [], "total" => 0, "total_items" => 0];

    $products = array_filter($cart["products"], function ($product) {
        return $product["id"] != $_POST["product"];
    });
    $_SESSION["cart"]["products"] = $products;
    recalcCart();

    header("Location: /index.php?accio=carret");