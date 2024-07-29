<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style.css">
    <title>Contribution</title>
</head>
<body>

    <header>
    <span><a href="/index.php/financial-year?year=<?php echo $year; ?>">Overzicht</a></span>
        <span><a href="/index.php/home">Home</a></span>
        <span><a href="/index.php/logout">Logout</a></span>
        <span><?php echo "Ingelogd als: " . strtoupper($_SESSION['user']); ?></span>
    </header>

    <h2>Overzicht familieleden en hun contributie</h2>

    <table>
        <tr>
            <td>Id</td>
            <td>Naam</td>
            <td>Geboortedatum</td>
            <td>Soort lid</td>
            <td>Contributie</td>
        </tr>
        <?php foreach ($members as $member): ?>
        <tr>
            <td><?php echo $member['id']; ?></td>
            <td><?php echo $member['naam']; ?></td>
            <td><?php echo $member['geboortedatum']; ?></td>
            <td><?php echo $member['soort_lid']; ?></td>
            <td><?php echo $member['bedrag']; ?></td>
        </tr>
        <?php endforeach; ?>
        </table>
</body>
</html>