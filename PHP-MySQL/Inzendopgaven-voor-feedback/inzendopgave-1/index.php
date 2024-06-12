<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <title>Persoonlijke informatie weergeven</title>
    </head>
    <body>
        Hello, World!
        
        <?php 
        $voornaam = "Jeffrey";
        $achternaam = "Jongkees";
        $leeftijd = 39;
        $beroep = "Software Tester";
        $hobbys = array('fitness', 'dansen');

        echo "<h3>Voornaam:</h3> $voornaam";
        echo "<h3>Achternaam:</h3> $achternaam";
        echo "<h3>Leeftijd:</h3> $leeftijd";
        echo "<h3>Beroep:</h3> $beroep";
        echo "<h3>Hobby's:</h3> $hobbys[0], $hobbys[1]";

        echo "<br><br><strong>Voornaam:</strong> $voornaam <br>";
        echo "<strong>Achternaam:</strong> $achternaam <br>";
        echo "<strong>Leeftijd:</strong> $leeftijd <br>";
        echo "<strong>Beroep:</strong> $beroep <br>";
        echo "<strong>Hobby's:</strong> $hobbys[0], $hobbys[1]";
        ?>
    </body>
</html>