<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Afrekenen</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header>
        <span class="uitloggen-overzicht"><a href="/index.php/home-pagina">Home</a></span>
        <span class="uitloggen-overzicht"><a href="/index.php/logout">Uitloggen</a></span>
    </header>

    <h1>U kunt hier uw product afrekenen</h1>
    
    <!-- Formulier voor productgegevens (alleen ter weergave, geen betaling) -->
    <div>
        Naam: <input type="text" name="naam" value="<?php echo htmlspecialchars($product->name); ?>" readonly><br>
        Prijs: <input type="text" name="prijs" value="<?php echo htmlspecialchars($product->price); ?>" readonly><br><br>
    </div>

    <!-- Formulier voor contante betaling -->
    <form action="/index.php/betaling-contant?id=<?php echo htmlspecialchars($product->id); ?>" method="post">
        <h2>Betaling met Contant</h2>
        <input type="hidden" name="prijs" value="<?php echo htmlspecialchars($product->price); ?>">
        <input type="hidden" name="contant" value="1">
        Contant: <input type="text" name="cash" placeholder="Voer contant bedrag in"
                        pattern="^\d+(\.\d{1,2})?$" 
                        title="Voer een geldig bedrag in, bijvoorbeeld 1.00 of 1.99"><br><br>
        <input type="submit" value="Betalen met Contant">
    </form>
    
    <br>

    <!-- Formulier voor pinbetaling -->
    <form action="/index.php/betaling-pin?id=<?php echo htmlspecialchars($product->id); ?>" method="post">
        <h2>Betaling met Pin</h2>
        <input type="hidden" name="pin" value="2">
        Pin: <input type="text" name="prijs" value="<?php echo htmlspecialchars($product->price); ?>" readonly><br><br>
        <input type="submit" value="Betalen met Pin">
    </form>
</body>
</html>
