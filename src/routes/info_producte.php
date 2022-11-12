<!DOCTYPE html>
<?php
    $producte_id = $_GET['id_producte'];
    $producte = getInfoProducto($producte_id);
?>
<html lang=cat>
    <head>
        <meta charset = "UTF-8" />
        <title>Informació Producte</title>
        <link rel="stylesheet" href="resources/css/style.css" />
    </head>
    <body>
        <img src="../resources/img/<?php echo $producte['id'];?>.png" width="300" height="300" />  
        <br />
        <?php  echo $producte['nom'];
               echo $producte['descripcio'];
               echo $producte['preu'];
        ?>
    </body>
</html>