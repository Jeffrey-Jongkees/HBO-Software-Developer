<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <title>Lengte invoeren</title>
    </head>
    <body>

        <h3>Voer op deze pagina uw lengte in om uw BMI te berekenen</h3>
        <h4>Uw lengte graag in meters invullen</h4><br>

        <form action="calculation.php" method="post">
        <label for="lengte"><strong>Lengte:</strong></label><br>
        <input type="text" id="lengte" name="lengte" placeholder="Voorbeeld 1.80"><br><br>
        <input type="submit" value="Invoeren">
        </form>

    </body>
</html>
