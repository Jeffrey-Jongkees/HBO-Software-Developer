<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <title>Lege vakken vullen</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body >
<h1>Vul het lege vak</h1>

<form method="post">
    ID: <input type="text" name="id" value="<?php echo htmlspecialchars($product->id); ?>"><br><br>
    <input type="submit" value="bijvullen">
</form>
    
</body>
</html>
