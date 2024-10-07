<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Delete</title>
</head>
<body>
    
    <h1>Artikel verwijderen</h1>

    <form method="post">
        ID: <input type="text" name="id" value="<?php echo htmlspecialchars($article->id); ?>"><br><br>
        <input type="submit" value="Verwijderen">
    </form>
    
</body>
</html>