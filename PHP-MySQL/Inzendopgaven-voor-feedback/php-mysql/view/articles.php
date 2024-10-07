<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Artikelen</title>
</head>
<body>
    <h2>Artikelen</h2>
    <a href="/index.php/create">Artikel toevoegen</a>
    <table>
        <tr>
            <td>Id</td>
            <td>Naam</td>
            <td>Prijs</td>
            <td>Edit</td>
            <td>Verwijder</td>
        </tr>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?php echo $article['ID']; ?></td>
                <td><?php echo $article['Naam']; ?></td>
                <td><?php echo $article['Prijs']; ?></td>
                <td><a href="/index.php/edit?id=<?php echo $article['ID']; ?>">Edit</a></td>
                <td><a href="/index.php/delete?id=<?php echo $article['ID']; ?>">Verwijder</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>


