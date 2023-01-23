<!DOCTYPE html>
<html lang=cat>
    <head>
        <meta charset = "UTF-8" />
        <title><?php saneEcho($model["title"]) ?></title>
        <link rel="stylesheet" href="/css/style.css" />
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script src="/js/open_page.js"></script>
    </head>
    <body>
    <nav>
        <div class="container">
            <ul>
            <li><a href="/index.php">Home</a></li>
            <?php if ($model["user"] == null) : ?>
            <li><a href="/index.php?accio=iniciar-sessio">Login</a></li>
            <?php else: ?>
            <li> <a href="#"><?php saneEcho($model["user"]["username"]) ?></a>
                <ul>
                <li><a href="/index.php?accio=mostrar-comandes">Les meves compres</a></li>
                <li><form action="/logout_post.php" method="POST">
                    <a href="javascript:;" onclick="parentNode.submit();">Tancar sessió</a>
                </form></li>
                </ul>
            </li>
            <?php endif; ?>
        </div>
    </nav>
    </div>
    <div style="width:100%;">
        <div style="float:left; display:inline-block; width:10%;">
            <h2>Carret</h2>
                El teu carret conté <?php saneEcho($model["cart"]["total_items"]) ?>
                productes per un total de <?php saneEcho($model["cart"]["total"]) ?>€
                <br />
                <br/>
                <a href="/index.php?accio=carret">Veure carret</a>
            <h2>Categories</h2>
            <ul>
                <?php foreach ($model["categories"] as $category) : ?>
                    <li>
                        <a href="javascript:open_category('<?php saneEcho($category["slug"]);?>')"><?php saneEcho($category["name"]); ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>
        <div style="float:right; display:inline-block; width:80%;" id="content">
                <?php renderSubview($viewName) ?>
        </div>
    </div> ​
    </body>
    <footer>
        <script src="/js/dropdown.js"></script>
        <script src="/js/validate.js"></script>
    </footer>
</html>