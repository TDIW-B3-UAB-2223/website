<!DOCTYPE html>
<?php
    $categories = ["corda", "vent", "percussió", "teclat"];
?>
<html lang=cat>
    <head>
        <meta charset = "UTF-8" />
        <title>Portada</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <h1>Categories</h1>
        <ul>
            <?php foreach ($categories as $category) { ?>
                <li><a href="index.php?accio=mostrar-categoria&categoria=<?php echo $category; ?>"><?php echo $category; ?></a></li>
            <?php } ?>
    </body>
</html>