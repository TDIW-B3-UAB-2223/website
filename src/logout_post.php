<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . 'base.php';
$_SESSION = [];
$model = populate_model([
    "title" => "Sessiò tancada"
]);
render("logout_success.php");