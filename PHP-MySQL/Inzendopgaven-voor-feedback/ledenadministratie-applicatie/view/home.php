<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style.css">
    <title>Home</title>
</head>
<body>
<?php
    
?>
    <header>
        <span><a href="/index.php/logout">Logout</a></span>
        <span><?php echo "Ingelogd als: " . strtoupper($_SESSION['user']); ?></span>
    </header>
    <?php if ($_SESSION['user'] === 'Secretaris'): ?>   
    <h1>Aantal ingeschreven families op de vereniging: <?php echo count($families); ?></h1>

    <table>
        <?php foreach ($families as $family): ?>
        <tr>
            <th>Familie</th>
            <td><?php echo $family['naam']; ?></td>
            
            <td class="td"><a href="/index.php/edit-family?familyID=<?php echo $family['familieID']; ?>">Aanpassen</a></td>
            <td class="td"><a href="/index.php/delete-family?familyID=<?php echo $family['familieID']; ?>" 
            onclick="return confirm('Weet u zeker dat deze familie verwijderd moet worden?');">Verwijderen</a></td>
          
        <tr>
            <th>Adres</th>
            <td><?php echo $family['adres']; ?></td>
        </tr>
        <tr>
            <th>Familie ID</th>
            <td><?php echo $family['familieID']; ?></td>
        </tr>
        <tr>
            <td class="empty-space" colspan="2"></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <span class="toevoegen"><a href="/index.php/create-family">Familie toevoegen</a></span>
    <?php endif; ?>

    <?php if ($_SESSION['user'] === 'Penningmeester'): ?>
    <h2>Overzicht boekjaren</h2>

    <ul>
        <li class="toevoegen"><a href="/index.php/financial-year?year=2024">2024</a></li>
        <li class="toevoegen"><a href="/index.php/financial-year?year=2023">2023</a></li>
    </ul>
    <?php endif; ?>

    <br>
    <br>
    <form action="/index.php/home" method="post">
        <!-- <label for="user"><strong>Rol</strong></label><br> -->
        <input type="hidden" name="username" id="user" value="<?php echo $_SESSION['user'] ?>" readonly><br><br>
        <label for="newpassword"><strong>Nieuw wachtwoord</strong></label><br> <!-- wachtwoord 1234 of 123456 -->
        <input type="password" name="newpassword" id="newpassword"><br><br>
        <input type="submit" value="Aanpassen" class="admin-button">
    </form>

</body>
</html>