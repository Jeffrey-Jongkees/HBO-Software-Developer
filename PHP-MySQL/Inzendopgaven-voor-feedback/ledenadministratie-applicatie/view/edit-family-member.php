<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style.css">
    <title>Edit family member</title>
</head>
<body>

    <header>
        <span><a href="/index.php/edit-family?familyID=<?php echo $member->familyID ?>">Overzicht</a></span>
        <span><a href="/index.php/home">Home</a></span>
        <span><a href="/index.php/logout">Logout</a></span>
        <span><?php echo "Ingelogd als: " . strtoupper($_SESSION['user']); ?></span>
    </header>

    <h2>Familielid bijwerken</h2>
    <form action="/index.php/edit-family-member?id=<?php echo htmlspecialchars($member->id); ?>&familyID=<?php echo htmlspecialchars($member->familyID); ?>" method="post">
        <input type="text" name="id" id="memberID" value="<?php echo htmlspecialchars($member->id); ?>" readonly><br>    
        <strong><label for="name">Naam</label></strong><br>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($member->name); ?>"><br>
        <strong><label for="birthday">Geboortedatum</label></strong><br>
        <input type="text" name="birthday" id="birthday" value="<?php echo htmlspecialchars($member->birthday); ?>"><br>
        <strong><label for="fm">Rol familielid</label></strong><br>
        <select name="familyMember" id="fm">
            <option></option>
            <option name="vader">Vader</option>
            <option name="moeder">Moeder</option>
            <option name="dochter">Dochter</option>
            <option name="zoon">Zoon</option>
            <option name="oom">Oom</option>
            <option name="tante">Tante</option>
            <option name="neef">Neef</option>
            <option name="nicht">Nicht</option>
            <option name="man">Man</option>
            <option name="vrouw">Vrouw</option>
        </select><br><br>
        <input type="submit" value="Bijwerken">
    </form>
</body>
</html>