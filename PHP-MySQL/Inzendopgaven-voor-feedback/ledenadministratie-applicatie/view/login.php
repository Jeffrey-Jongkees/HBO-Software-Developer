<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style.css">
    <title>Login</title>
</head>
<body>
    
    <form method="post">
        <label for="dbUser"><strong>Rol</strong></label><br>
        <select name="dbUser" id="dbUser">
            <option></option>
            <option>Penningmeester</option>
            <option>Secretaris</option>
        </select><br>
        <label for="password"><strong>Wachtwoord</strong></label><br>
        <input type="password" name="password" placeholder="Vul hier uw wachtwoord in" id="password"><br><br>
        <input type="submit" value="Inloggen" class="login-button">
    </form>
    
</body>
</html>
