<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style.css">
    <title>Add family</title>
</head>
<body>

    <header>
        <span><a href="/index.php/home">Home</a></span>
        <span><a href="/index.php/logout">Logout</a></span>
        <span><?php echo "Ingelogd als: " . strtoupper($_SESSION['user']); ?></span>
    </header>

    <h1>Nieuwe familie toevoegen</h1>

    <form action="/index.php/submit" method="post">
        <strong><label for="familyname">Familie naam</label></strong><br>
        <input type="text" name="familyName" id="familyname" placeholder="Hoogedoorn"><br>
        <strong><label for="address">Adres</label></strong><br>
        <input type="text" name="address" id="address" placeholder="Kalverstraat 79 AAJA Amsterdam"><br><br>
        <input type="submit" id="id" value="Toevoegen">
    </form>

</body>
</html>