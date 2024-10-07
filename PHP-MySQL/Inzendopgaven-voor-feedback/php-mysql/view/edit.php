<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Edit</title>
</head>
<body>
    
<h1>Artikel bewerken</h1>
<form action="/index.php/edit?id=<?php echo htmlspecialchars($article->id); ?>" method="post">
    Naam: <input type="text" name="naam" value="<?php echo htmlspecialchars($article->name); ?>"><br>
    Prijs: <input type="text" name="prijs" value="<?php echo htmlspecialchars($article->price); ?>"><br><br>
    <input type="submit" value="Bijwerken">
</form>

</body>
</html>
