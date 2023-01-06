<html lang=cat>
    <head>
        <meta charset = "UTF-8" />
        <title></title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <h1><?php echo $categoria["name"] ?></h1>
        Child of <?php foreach ($categoria["parents"] as $p): ?>
            / <a href="index.php?accio=mostrar-categoria&categoria=<?php echo $p["slug"];?>">
                <?php echo $p["name"]; ?>
            </a> 
        <?php endforeach ?>
        <h2>Sub-Categories</h2>
        <ul>
            <?php foreach ($categories as $subcategory) { ?>
                <li><a href="index.php?accio=mostrar-categoria&categoria=<?php
                    echo $subcategory["slug"];
                ?>">
                    <?php echo $subcategory["name"]; ?>
                </a></li>
            <?php } ?>
        </ul>
        <h2>Products</h2>
        <ul>
            <?php foreach ($products as $product) { ?>
                <li><a href="index.php?accio=mostrar-producte&producte=<?php
                    echo $product["id"];
                ?>">
                    <?php echo $product["name"]; ?>
                </a></li>
            <?php } ?>
        </ul>
    </body>
</html>
