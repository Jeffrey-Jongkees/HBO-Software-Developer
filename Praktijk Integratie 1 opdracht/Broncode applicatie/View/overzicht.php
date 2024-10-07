<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Overzicht inkomen en voorraad</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body >

    <header>
        <span class="uitloggen-overzicht"><a href="/index.php/home-pagina">Home</a></span>
        <span class="uitloggen-overzicht"><a href="/index.php/logout">Uitloggen</a></span>
    </header>

    <h2>Overzicht Voorraad</h2>

    <table class="table-voorraad" border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Voorraad</th>
            <th>Gevulde producten in de automaat</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stock as $product): ?>
        <tr>
        <td><?php echo $product['ID']; ?></td>
            <td><?php echo $product['Naam']; ?></td>
            <td><?php echo $product['Prijs']; ?></td>
            <td><?php echo $product['Voorraad']; ?></td>
            <td><?php echo $product['Gevulde_Producten_Automaat']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table> <br><br>

<h2>Overzicht inkomsten</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <thead class="table-inkomen-product">  

    <tr>
            <th>Inkomsten Appels</th>
            <td><?php echo isset($revenuePerProduct['Appels']) ? number_format($revenuePerProduct['Appels'], 2, '.', '.') : '0.00'; ?></td>
        </tr>
        <tr>
            <th>Inkomsten Aardappelen</th>
            <td><?php echo isset($revenuePerProduct['Aardappelen']) ? number_format($revenuePerProduct['Aardappelen'], 2, '.', '.') : '0.00'; ?></td>
        </tr>
        <tr>
            <th>Inkomsten Peren</th>
            <td><?php echo isset($revenuePerProduct['Peren']) ? number_format($revenuePerProduct['Peren'], 2, '.', '.') : '0.00'; ?></td>
        </tr>
        <tr>
            <th>Inkomsten Eieren</th>
            <td><?php echo isset($revenuePerProduct['Eieren']) ? number_format($revenuePerProduct['Eieren'], 2, '.', '.') : '0.00'; ?></td>
        </tr>
        <tr>
            <th>Inkomsten Melk</th>
            <td><?php echo isset($revenuePerProduct['Melk']) ? number_format($revenuePerProduct['Melk'], 2, '.', '.') : '0.00'; ?></td>
        </tr>
        <tr>
            <th>Betalingen contant geld</th>
            <td><?php echo isset($revenuePerMethod['Contant']) ? number_format($revenuePerMethod['Contant'], 2, '.', '.') : '0.00'; ?></td>
        </tr>
        <tr>
            <th>Pin betalingen</th>
            <td><?php echo isset($revenuePerMethod['Pin']) ? number_format($revenuePerMethod['Pin'], 2, '.', '.') : '0.00'; ?></td>
        </tr>
        <tr>
            <th>Totale omzet</th>
            <td><?php echo isset($total['TotaalInkomen']) ? number_format($total['TotaalInkomen'], 2, '.', '.') : '0.00' ; ?></td>
    </tr>
    </thead>
</table>

    
</body>
</html>
