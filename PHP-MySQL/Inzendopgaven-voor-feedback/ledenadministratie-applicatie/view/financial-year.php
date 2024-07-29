<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style.css">
    <title>Boekjaar</title>
</head>
<body>

    <header>
        <span><a href="/index.php/home">Home</a></span>
        <span><a href="/index.php/logout">Logout</a></span>
        <span><?php echo "Ingelogd als: " . strtoupper($_SESSION['user']); ?></span>
    </header>

    <h1>Overzicht ingeschreven families en de bijbehorende contributie over jaar <?php echo $year ?></h1>

    <table>
        <?php foreach ($families as $family): ?>
        <tr>
            <th>Familie</th>
            <td><?php echo $family['naam']; ?></td>
            <td class="td"><a href="/index.php/contribution?familyID=<?php echo $family['familieID'];?>&year=<?php  echo $year?>">Overzicht contributie</a></td>
          
        <tr>
            <th>Adres</th>
            <td><?php echo $family['adres']; ?></td>
        </tr>
        <tr>
            <th>Contributie</th>
            <td><?php echo $family['totalContributie']; ?></td>
        </tr>
        <tr>
            <th>Familie ID</th>
            <td><?php echo $family['familieID']; ?></td>
        </tr>
        <tr>
            <td class="empty-space" colspan="2"></td>
        </tr>
        <?php endforeach; ?>
    </table>
    

</body>
</html>