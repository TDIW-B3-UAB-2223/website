<h1>Producte</h1>
<p><?php if ( isset($model["product"]["image"]) ): ?>
    <img src="<?php saneEcho($product["image"]) ?>" alt="<?php saneEcho($product["name"])?>" height=300></img>
<?php endif ?></p>
<h3><?php saneEcho($model["product"]['name']) ?> </h3>
<p><?php saneEcho($model["product"]['description']) ?> </p>
<p>€<?php saneEcho($model["product"]['price']) ?> </p>
<form action="/afegir_carret_post.php" method="post">
    <input type="hidden" name="product" value="<?php saneEcho($model["product"]['id']) ?>">
    <input type="number" name="quantity" value="1" min="1" max="100">
    <input type="submit" value="Afegir al carret">
</form>