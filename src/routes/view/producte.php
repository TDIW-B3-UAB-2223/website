<html lang=cat>
    <head>
        <meta charset = "UTF-8" />
        <title><?php echo $product["name"]?></title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <h1>Productes</h1>
        <h3><?php echo $product['name'] ?> </h3>
        <p><?php echo $product['description'] ?> </p>
        <p><?php if ( isset($product["image"]) ): ?>
           <img src="<?php echo $product["image"] ?>" alt="<?php echo $product["name"]?>" height=300></img>
        <?php endif ?></p>
        <p><?php echo $product['price'] ?> </p>
        <input type="number">
        <input type="button" value="Afegir al cabas">

    </body>
</html>
