<?php
$email = $_POST["email"];
$contraseña = $_POST["password"];

if (filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)) {
    if ($_POST) {
        $name= $_POST["name"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $adress = $_POST["adress"];
        $city = $_POST["city"];
        $postalCode = $_POST["postalCode"];
    }
    $user = $database->createNewUser($name, $password, $hash, $email, $adress, $city, $postalCode);

    require_once('routes' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'register.php');
}
else {
    echo'<script>alert("Correu electronic introduit no es valid")</script>';
}