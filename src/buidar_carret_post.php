<?php
    include __DIR__ . DIRECTORY_SEPARATOR . 'base.php';
    
    $cart = ["products" => [], "total" => 0, "total_items" => 0];
    $_SESSION["cart"] = $cart;
    recalcCart();

    header("Location: /index.php");