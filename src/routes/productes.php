<!DOCTYPE html>
<?php
    $categoria_id = $_GET['id_categoria'];
    $productes = getProductes($categoria_id);
?>
<script src="../resources/js/show_infoproducts.js"></script>
<html lang=cat>
    <head>
        <meta charset = "UTF-8" />
        <title>Productes</title>
        <link rel="stylesheet" href="resources/css/style.css" />
    </head>
    <body>
        <h1>Productes</h1>
        <ul>
            <?php foreach ($productes as $producte) { ?>
                <li class="boto-producte"><a href="index.php?accio=llistar-productes&producte=<?php echo $producte; ?>"><?php echo $producte["nom"], " ", echo $producte["preu"]; ?></a></li>
            <?php } ?>
    </body>
</html>