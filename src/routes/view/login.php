<!DOCTYPE html>
<html lang=cat>
    <head>
        <meta charset = "UTF-8" />
        <title>Iniciar sessió</title>
        <link rel="stylesheet" href="resources/css/style.css" />
    </head>
    <body>
        <h2>Iniciar Sesio</h2>
        <form action="/index.php?accion=iniciar-sesio" method="POST">
        Email <br />
        <input type="email" name="email" class="input" required/> <br /> <br />
        Contrasenya <br />
        <input type="password" name="contraseña" class="input" required/> <br /> <br />
        <input  type="submit" value="Log In" />
        <a href="index.php?accion=registre">¿No estas registrat? ¡REGISTRAT!</a>
    </body>
</html>

