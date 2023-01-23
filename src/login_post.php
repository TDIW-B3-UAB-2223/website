<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . 'base.php';

$password = $_POST["password"] ?? "";
$email = $_POST["email"] ?? "";

$user = $database->getUser($email);

if ($user == null || !password_verify($password, $user["password"])) {
    $model = populate_model([
        "error" => "Error en el login",
        "message" => "Verificar els camps",
        "title" => "Error en el login"
    ]);
    render("error.php");
    exit();
} else {
    $_SESSION["user"] = $user;
    $model = populate_model([
        "title" => "Sessiò iniciada"
    ]);
    render("login_success.php");
    exit();
}