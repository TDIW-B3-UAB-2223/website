<?php
    $orders = $database->getOrdersByUser($_SESSION["user"]["id"]);
    $model = populate_model([
        "title" => "Les meves comandes",
        "orders" => $orders
    ]);
    render("orders.php");