<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Delete family</title>
</head>
<body>
    
    <h1>Familie verwijderen</h1>

    <form method="post">
        familieID: <input type="text" name="familyID" value="<?php echo htmlspecialchars($family->familyID); ?>"><br><br>
        <input type="submit" value="Verwijderen">
    </form>
    
</body>
</html>