<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style.css">
    <title>edit</title>
</head>
<body>

    <header>
        <span><a href="/index.php/home">Home</a></span>
        <span><a href="/index.php/logout">Logout</a></span>
        <span><?php echo "Ingelogd als: " . strtoupper($_SESSION['user']); ?></span>
    </header>

    <h1>Aanpassingen maken aan de familie</h1>

    <h2>Overzicht familieleden</h2>

    <table>
        <tr>
            <td>Id</td>
            <td>Naam</td>
            <td>Geboortedatum</td>
            <td>Familielid</td>
        </tr>
        <?php foreach ($members as $member): ?>
        <tr>
            <td><?php echo $member['id']; ?></td>
            <td><?php echo $member['naam']; ?></td>
            <td><?php echo $member['geboortedatum']; ?></td>
            <td><?php echo $member['familielidRol']; ?></td>
            <td class="td"><a href="/index.php/edit-family-member?id=<?php echo $member['id']; ?>&familyID=<?php echo $family->familyID; ?>">Aanpassen</a></td>
            <td class="td"><a href="/index.php/delete-family-member?id=<?php echo $member['id']; ?>&familyID=<?php echo $family->familyID; ?>" 
            onclick="return confirm('Weet u zeker dat dit familielid verwijderd moet worden?');">Verwijderen</a></td>
        </tr>
        <?php endforeach; ?>
        </table>

    <h2>Algemene aanpassingen van de familie</h2>
    <form action="/index.php/edit-family?familyID=<?php echo htmlspecialchars($family->familyID); ?>" method="post">
        <strong><label for="familyname">Familie naam</label></strong><br>
        <input type="text" name="familyName" id="familyname" value="<?php echo htmlspecialchars($family->familyName); ?>"><br>
        <strong><label for="address">Adres</label></strong><br>
        <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($family->address); ?>"><br>
        <strong><label for="id">Familie ID</label></strong><br>
        <input type="text" name="familyID" value="<?php echo htmlspecialchars($family->familyID); ?> " readonly><br><br>
        <input type="submit" id="id" value="Bijwerken">
    </form>

    <h2>Nieuw familielid toevoegen</h2>
    <form action="/index.php/create-family-member?familyID=<?php echo htmlspecialchars($family->familyID); ?>" method="post">
        <strong><label for="name">Naam</label></strong><br>
        <input type="text" name="name" id="name"><br>
        <strong><label for="birthday">Geboortedatum</label></strong><br>
        <input type="text" name="birthday" id="birthday" placeholder="Vul in: jaar-maand-dag"><br>
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
        <input type="submit" value="Aanmaken">
    </form>

        <script src="/scripts.js"></script>
</body>
</html>