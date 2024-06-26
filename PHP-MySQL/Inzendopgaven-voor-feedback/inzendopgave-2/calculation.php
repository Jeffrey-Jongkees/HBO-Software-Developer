<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <title>BMI calculator</title>
        <style>
        .line {
            border-bottom: 5px solid grey;
            margin-top: 5px;
            margin-bottom: 10px;
            width: 90%;
        }
        </style>
    </head>
    <body>

        <h1>BMI Calculator</h1>

        <p>BMI overzicht bij een lengte van <?php echo $_POST["lengte"] ?> m:</p>

        <div class="line"></div>
               
        <?php
                
        function bmi_berekenen($gewicht, $lengte) {
            $bmi = $gewicht / ($lengte * $lengte);
            return $bmi;
        }

        for($gewicht = 40; $gewicht <= 150; $gewicht += 10) {
            
            $bmi = bmi_berekenen($gewicht, $_POST["lengte"]);
            $tekst ="Bij een gewicht van $gewicht kg is de BMI " . round($bmi, 2);
            
            if($bmi < 18.5) {
                echo $tekst . ", ondergewicht<br>";
            }
            elseif($bmi === 18.5 || $bmi < 25) {
                echo $tekst . ", goed gewicht<br>";
           }
           elseif($bmi === 25 || $bmi < 30) {
                echo $tekst . ", matig overgewicht<br>";  
            }
            elseif($bmi === 30 || $bmi < 40) {
                echo $tekst . ", ernstig overgewicht<br>";  
            }
            elseif($bmi >= 40) {
                echo $tekst . ", gevaarlijk overgewicht<br>";  
            }
        }
        ?>

    </body>
</html>
