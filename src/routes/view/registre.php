<!DOCTYPE html>
<html lang=cat>
    <head>
        <meta charset = "UTF-8" />
        <title>Registre</title>
        <link rel="stylesheet" href="resources/css/style.css" />
    </head>
    <body>
        <form action="/index.php?accio=registre" method="POST" >

            Nom <br />
            <input type="text" name="nombre" placeholder="Lucas" required/> <br /> <br />

            Email <br />
            <input type="email" name="email" placeholder="lucas.chuleta@brouston.top" required/> <br /> <br />

            Contrasenya <br />
            <input type="password" name="contraseña" placeholder="**********" required/> <br /> <br />

            Direcció <br />
            <input type="text" id="direccionID" name="direccion" placeholder="Calle del txico Bj 3" required/> <br /> <br />

            Població <br />
            <input type="text" id="localidadID" name="localidad" placeholder="Broustolandia" required/> <br /> <br />

            Codi Postal <br />
            <input type="number" id="codigo_postalID" name="codigo_postal" placeholder="66666" required/> <br /> <br />

            <input type="submit" value="Registra-se" />

        </form>
    </body>
</html>