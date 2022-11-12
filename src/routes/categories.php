<!DOCTYPE html>
<?php
    $categories = ["corda", "vent", "percussió", "teclat"];
?>
<script src="../resources/js/show_products.js"></script>
<html lang=cat>
    <head>
        <meta charset = "UTF-8" />
        <title>Portada</title>
        <link rel="stylesheet" href="resources/css/style.css" />
    </head>
    <body>
        <h1>Categories</h1>
        <ul>
            <?php foreach ($categories as $category) { ?>
                <li class="boto-categoria"><a href="index.php?accio=llistar-categoria&categoria=<?php echo $category; ?>"><?php echo $category; ?></a></li>
            <?php } ?>
    </body>
</html>