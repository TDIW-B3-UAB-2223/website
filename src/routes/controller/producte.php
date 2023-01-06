<?php
  $id = $_GET["producte"];
  if ( !isset($id) ) {
    header("Location: index.php?accio=404");
    exit();
  }

  $product = $database->getProduct($id);
  if ( $product == null ) {
    header("Location: index.php?accio=404");
    exit();
  }

  require_once('routes' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'producte.php');