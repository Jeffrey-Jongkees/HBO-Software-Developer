<?php 
    $cars = array(
        array('Volvo', '@', 'Blauw'),
        array('Audi', '@', 'Groen'),
        array('BMW', '@', 'Geel'),
        array('Skoda', '@', 'Geel')
    );

    echo "We like:" . "<br>";

    for($i = 0; $i < 4; $i++) {
        echo "<ul>" . "$cars[i]" . "<br>";

    }
?>
