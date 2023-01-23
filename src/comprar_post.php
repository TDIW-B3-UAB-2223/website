<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . 'base.php';

$cart = $_SESSION["cart"] ?? ["products" => [], "total" => 0, "total_items" => 0];
$user = $_SESSION["user"] ?? null;

if ($user == null) {
    $model = populate_model([
        "title" => "Error",
        "error" => "No estàs logejat",
        "message" => "No pots comprar sense estar logejat"
    ]);
    render("error.php");
}

if ($cart["total_items"] == 0) {
    $model = populate_model([
        "title" => "Carret buit",
        "error" => "El carret està buit",
        "message" => "El carret està buit. No pots comprar res.",
    ]);
    render("error.php");
    exit;
}

try {
    $database->createOrder($_SESSION["user"]["id"], $cart["total"], $cart["products"], new DateTimeImmutable());

    $_SESSION["cart"] = ["products" => [], "total" => 0, "total_items" => 0];
    recalcCart();

    $model = populate_model([
        "title" => "Compra realitzada"
    ]);
    render("compra_success.php");
} catch (Exception $e) {
    $model = populate_model([
        "title" => "Error en la compra",
        "error" => "Error en la compra",
        "message" => "S'ha produït un error en la compra. Torna-ho a provar."
    ]);
    render("error.php");
}

