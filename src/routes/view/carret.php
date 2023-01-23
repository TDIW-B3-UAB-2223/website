<h1>El meu cabàs</h1>
<table>
    <tr>
        <th colspan=2>Producte</th>
        <th>Preu</th>
        <th colspan=2>Quantitat</th>
        <th>Eliminar</th>
    </tr>
    <?php foreach ($model["populated_cart"] as $product) { ?>
        <tr>
            <td><img src="<?php saneEcho($product["product"]["image"]) ?>" alt="<?php saneEcho($product["product"]["name"]) ?>" style="height:100px;"></td>
            <td><a href="javascript:open_product(<?php saneEcho($product["id"]) ?>)"><?php saneEcho($product["product"]["name"]) ?></a></td>
            <td><?php saneEcho($product["product"]["price"]) ?> €</td>
            <form action="/edit_carret_post.php" method="post">
                <input type="hidden" name="product" value="<?php saneEcho($product["id"]) ?>">
                <td><input type="number" name="quantity" value="<?php saneEcho($product["quantity"]) ?>" min="1" max="100"></td>
                <td><input type="submit" value="Editar"></td>
            </form>
            <form action="/removir_carret_post.php" method="post">
                <input type="hidden" name="product" value="<?php saneEcho($product["id"]) ?>">
                <td><input type="submit" value="Eliminar"></td>
            </form>
        </tr>
    <?php } ?>
    
    <tr>
        <td colspan=6 style="text-align:center">
            <form action="/buidar_carret_post.php" method="post">
                <input type="submit" value="Buidar">
            </form>
        </td>
    </tr>
    <tr>
        <td colspan=6 style="text-align:center">
            <form action="/comprar_post.php" method="post">
                <input type="submit" value="Comprar">
            </form>
        </td>
    </tr>
</table>