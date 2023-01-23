<h1>Las meves compres</h1>
<p><?php if ( isset($model["orders"]) ): ?>
    <table>
        <tr>
            <th>Data</th>
            <th>Preu</th>
            <th>Detalls</th>
        </tr>
        <?php foreach ($model["orders"] as $order): ?>
            <tr>
                <td><?php saneEcho($order["date"]) ?></td>
                <td><?php saneEcho($order["price_paid"]) ?> €</td>
                <td>
                    <ul>
                    <?php foreach ($order["products"] as $product): ?>
                        <li><?php saneEcho($product["quantity"]) ?> <?php saneEcho($product["product"]["name"]) ?></p>
                    <?php endforeach ?>
                    </ul>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php else: ?>
    <p>No hi ha cap comanda</p>
<?php endif ?></p>