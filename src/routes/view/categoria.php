<html lang=cat>
    <head>
        <meta charset = "UTF-8" />
        <title></title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <h1><?php echo $categoria["name"] ?></h1>
        Child of  <?php echo implode("/", array_reverse($categoria["parents"])) ?>
        <h2>Sub-Categories</h2>
        <ul>
            <?php foreach ($categories as $subcategory) { ?>
                <li><a href="index.php?accio=mostrar-categoria&categoria=<?php
                    echo $subcategory["slug"];
                ?>">
                    <?php echo $subcategory["name"]; ?>
                </a></li>
            <?php } ?>
    </body>
</html>
