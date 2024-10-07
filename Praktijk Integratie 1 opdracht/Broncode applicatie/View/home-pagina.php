<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Boerderijautomaat</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<?php
    // Maak een mapping aan van alle sessievariabelen en hun dimensies
    $rows = [
        [
            "appel1" => ["id" => 1, "class" => "appels"],
            "appel2" => ["id" => 1, "class" => "appels"],
            "peer1" => ["id" => 3, "class" => "peren"],
            "peer2" => ["id" => 3, "class" => "peren"]
        ],
        [
            "melk1" => ["id" => 5, "class" => "melk"],
            "melk2" => ["id" => 5, "class" => "melk"],
            "melk3" => ["id" => 5, "class" => "melk"],
            "melk4" => ["id" => 5, "class" => "melk"]
        ],
        [
            "ei1" => ["id" => 4, "class" => "eieren"],
            "ei2" => ["id" => 4, "class" => "eieren"],
            "ei3" => ["id" => 4, "class" => "eieren"],
            "ei4" => ["id" => 4, "class" => "eieren"]
        ],
        [
            "aardappel1" => ["id" => 2, "class" => "aardappelen"],
            "aardappel2" => ["id" => 2, "class" => "aardappelen"],
        ],
    ];
?>

<?php
   
?>

<body class="body-home-view">
<header>
    <span class="uitloggen"><a href="/index.php/logout">Uitloggen</a></span>
    <?php if ($_SESSION['user'] === 'Admin'): ?>
    <span class="uitloggen"><a href="/index.php/overzicht">Overzicht</a></span>
    <?php endif; ?>
</header>

    <div class="container">
        <div class="vending-machine">
            <div class="machine-container">

            <?php 
                foreach ($rows as $row) {
                    echo '<div class="row">';

                    foreach ($row as $session_key => $product) {
                        if ($_SESSION[$session_key] === 0) {
                            echo '<a href="' . ($_SESSION['user'] === 'Admin' ? '/index.php/lege-vakken-vullen?id=' . $product["id"] : 'javascript:void(0);" onclick="alert(\'Het vak is leeg!\')"') . '">';
                            echo '<div class="slot ' . $product["class"] . ' empty"></div>';
                            echo '</a>';
                        } else {
                            echo '<a href="' . ($_SESSION['user'] === 'Admin' ? 'javascript:void(0);" onclick="alert(\'Er ligt al een product in het vak!\')"' : '/index.php/betaal-pagina?id=' . $product["id"]) . '">';
                            echo '<div class="slot ' . $product["class"] . '"></div>';
                            echo '</a>';
                        }
                    }

                    echo '</div>';
                }
            ?>

        </div>
            
            <div class="temperatuur-regelaar">
                <label for="temperatuur">Temperatuur regelaar</label><br>
                <input  type="number" id="temperatuur" name="temperatuur" value="7">
                <button onclick="controleerTemperatuur()">Controleer</button>
                <p id="temperatuur-melding" onclick="verbergMelding()"></p>
            </div>
        </div>
    </div>
    <script src="../Assets/functies/functies.js"></script>
</body>
</html>
