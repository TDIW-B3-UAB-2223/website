<?php
    session_start();

    define('ROOT', dirname(__FILE__));

    require_once('lib' . DIRECTORY_SEPARATOR . 'router.php');
    require_once('lib' . DIRECTORY_SEPARATOR . 'conditional_view.php');
    require_once('lib' . DIRECTORY_SEPARATOR . 'sane_echo.php');
    require_once('lib' . DIRECTORY_SEPARATOR . 'populate_model.php');
    require_once('database_credentials.php');
    require_once('lib' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'postgresql_database.php');
    $database = PostgresDatabaseConnection::getInstance();
    $database->connect($DB_URL, $DB_PORT, $DB_USER, $DB_PASS, $DB_NAME);