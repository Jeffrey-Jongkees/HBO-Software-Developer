<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style.css">
    <title>Dashboard</title>
</head>
<body>
    <header>
        <span><a href="/index.php/home">Home</a></span>
        <span><a href="/index.php/logout">Logout</a></span>
    </header>
    <h1>Totaal aantal gebruikers: <?php echo count($allUsers); ?></h1>

<table>
    <tr>
        <td>Id</td>
        <td>Username</td>
        <td>Password</td>
        <td>Role</td>
    </tr>
    <?php foreach ($allUsers as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['password']; ?></td>
            <td><?php echo $user['role']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>