<?php
  $id = $_GET["producte"];
  if ( !isset($id) ) {
    $model = populate_model([
      "title" => "Producte no trobat",
      "error" => "Producte no trobat",
      "message" => "No vas demanar ningun producte.",
    ]);
    render("error.php");
    exit();
  }
  $product = $database->getProduct($id);
  if ( $product == null ) {
    $model = populate_model([
      "title" => "Producte no trobat",
      "error" => "Producte no trobat",
      "message" => "El producte que has demanat no existeix.",
    ]);
    render("error.php");
    exit();
  }

  $model = populate_model([
    "title" => $product["name"],
    "product" => $product,
  ]);
  
  render("producte.php");