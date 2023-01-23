<h1><?php saneEcho($model["categoria"]["name"]) ?></h1>
<table>
    <tr>
        <th colspan=2>Producte</th>
        <th>Preu</th>
        <th>Comprar</th>
    </tr>
    <?php foreach ($model["products"] as $product) { ?>
        <tr>
            <td><img src="<?php saneEcho($product["image"]) ?>" alt="<?php saneEcho($product["name"]) ?>" style="height:100px;"></td>
            <td><a href="javascript:open_product(<?php saneEcho($product["id"]) ?>)"><?php saneEcho($product["name"]) ?></a></td>
            <td><?php saneEcho($product["price"] / 100) ?> €</td>
            <td>
                <form action="/afegir_carret_post.php" method="POST">
                    <input type="hidden" name="product" value="<?php saneEcho($product["id"]) ?>">
                    <input type="hidden" name="quantity" value="1">
                    <input type="submit" value="Afegir al carret">
                </form>
            </td>
        </tr>
    <?php } ?>
</table>