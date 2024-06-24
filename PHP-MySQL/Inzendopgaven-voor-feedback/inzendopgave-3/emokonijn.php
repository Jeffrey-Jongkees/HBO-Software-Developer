<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Emo konijntjes</title>
    <link rel="stylesheet" href="styling.css">
</head>
<body>
         
    <?php        
    include "konijnen.php";

    // Arrays definieren
    $konijnen = array();

    // De emotie functie waardes toewijzen aan de arrays
    for ($i = 0; $i < 2; $i++) {
        for ($j = 0; $j < 15; $j++) {
            $konijnen[$i][$j] = new Konijn("()_()", '("")("")');
        }
    }

    $score = berekenScore($konijnen);
    $emotieTellingen = telEmoties($konijnen);

    // Functie om de scores bij te houden
    function berekenScore($konijnen) {
        if (!file_exists("score")) {
            mkdir("score");
        }
    
        $score = array();
        for ($j = 0; $j < 15; $j++) {
            $filePath = 'score/Konijn_' . ($j + 1) . '.txt';
    
            // Lees de huidige score uit het bestand of initialiseer met 0
            if (file_exists($filePath)) {
                $score[$j] = intval(file_get_contents($filePath));
            } else {
                $score[$j] = 0;
            }
    
            // Update de score als de emoties gelijk zijn
            if ($konijnen[0][$j]->getEmotie() === $konijnen[1][$j]->getEmotie()) {
                $score[$j]++;
            }
    
            // Schrijf de bijgewerkte score terug naar het bestand
            file_put_contents($filePath, $score[$j]);
        }
    
        return $score;
    }

    // Functie om de emotie tellingen te berekenen als de konijnen overeenkomen
    function telEmoties($konijnen) {
        $filePath = 'score/emotie_tellingen.txt';
        
        // Lees de huidige emotietellingen uit het bestand of initialiseer met 0 voor elke emotie
        if (file_exists($filePath)) {
            $emotieTellingen = json_decode(file_get_contents($filePath), true);
        } else {
            $emotieTellingen = array(
                "(^.^)" => 0,
                "(o.o)" => 0,
                "(>.<)" => 0,
                "(?.?)" => 0,
                "(&.&)" => 0
            );
        }

        for ($j = 0; $j < 15; $j++) {
            if ($konijnen[0][$j]->getEmotie() === $konijnen[1][$j]->getEmotie()) {
                $emotie = $konijnen[0][$j]->getEmotie();
                if (isset($emotieTellingen[$emotie])) {
                    $emotieTellingen[$emotie]++;
                }
            }
        }

        // Schrijf de bijgewerkte emotietellingen terug naar het bestand
        file_put_contents($filePath, json_encode($emotieTellingen));

        return $emotieTellingen;
    }
    ?>
        
    <main>
        <table>
            <?php for ($i = 0; $i < 2; $i++): ?>
            <tr>
                <?php for ($j = 0; $j < 15; $j++): ?>
                <td><?php echo $konijnen[$i][$j]->getKonijnOren(); ?></td>
                <?php endfor; ?>
            </tr>

            <tr>
                <?php for ($j = 0; $j < 15; $j++): ?>
                <td><?php echo $konijnen[$i][$j]->getEmotie(); ?></td>
                <?php endfor; ?>
            </tr>

            <tr>
                <?php for ($j = 0; $j < 15; $j++): ?>
                <td><?php echo $konijnen[$i][$j]->getKonijnVoeten(); ?></td>
                <?php endfor; ?>
            </tr>

            <tr class="spacer"></tr>
            <?php endfor; ?>
            
            <tr>
                <?php for ($j = 0; $j < 15; $j++): ?>
                <td>Score: <?php echo $score[$j]; ?></td>
                <?php endfor; ?>
            </tr>
        </table>
    </main>

    <div id="emotie-tellingen">
        <h2>Hoe vaak komen scores voor?</h2>
        <ul>
            <?php foreach ($emotieTellingen as $emotie => $telling): ?>
            <li><?php echo htmlspecialchars($emotie) . ": " . $telling; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
