<?php
    $model = populate_model([
        "title" => "Pagina no trobada",
        "error" => "Pagina no trobada",
        "message" => "La pagina que has demanat no existeix.",
    ]);
    render("error.php");
