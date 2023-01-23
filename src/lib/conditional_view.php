<?php
function render($viewName) {
    global $model;
    $view = 'routes' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $viewName;
    if (isset($_GET["noTemplate"])) {
        require_once($view);
        return;
    }
    require_once('routes' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'template.php');
}

function renderSubview($viewName) {
    global $model;
    require_once('routes' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $viewName);
}