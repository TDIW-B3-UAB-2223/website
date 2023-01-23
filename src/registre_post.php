<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . 'base.php';

$name= $_POST["name"] ?? "";
$password = $_POST["password"] ?? "";
$email = $_POST["email"] ?? "";
$address = $_POST["address"] ?? "";
$city = $_POST["city"] ?? "";
$postalCode = $_POST["postalCode"] ?? "";

function validateInput($name, $email, $password, $address, $city, $postalCode) {
    return !empty($name) &&
        !empty($email) &&
        !empty($password) &&
        !empty($address) &&
        !empty($city) &&
        !empty($postalCode) &&
        filter_var($email, FILTER_VALIDATE_EMAIL) &&
        preg_match("/^\d{5}$/",$postalCode);
}

if (validateInput($name, $email, $password, $address, $city, $postalCode)) {
    $user = $database->createUser($name, $password, $email, $address, $city, $postalCode);

    if ($user == null) {
        $model = populate_model([
            "error" => "Error en la creació de l'usuari",
            "message" => "No se ha pogut crear l'usuari",
            "title" => "Error en la creació de l'usuari"
        ]);
        render("error.php");
        exit();
    } else {
        $model = populate_model([
            "title" => "Usuari creat"
        ]);
        render("register_success.php");
        exit();
    }
} else {
    $model = populate_model([
        "error" => "Error en la creació de l'usuari",
        "message" => "Informacciòns incorrectes o incompletes",
        "title" => "Error en la creació de l'usuari"
    ]);
    render("error.php");
    exit();
}