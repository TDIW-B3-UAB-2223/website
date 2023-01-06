<?php
    $categories = $database->getCategories(null);

    require_once('routes' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'categories.php');