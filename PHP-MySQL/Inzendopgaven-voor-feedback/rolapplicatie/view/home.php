<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style.css">
    <title>Home</title>
</head>
<body>
    <header>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <span><a href="/index.php/dashboard">Dashboard</a></span>
        <?php endif; ?>
        <span><a href="/index.php/logout">Logout</a></span>
        <span><?php echo "Ingelogd als: " . strtoupper($_SESSION['role']); ?></span>
    </header>
    <h1>Hallo, <?php echo $_SESSION['username']; ?></h1>

    <?php if ($_SESSION['role'] === 'admin'): ?>
    <h2>User aanmaken</h2>
    <form action="/index.php/adminCreate" method="post">
        <label for="username"><strong>Username</strong></label><br>
        <input type="text" name="username" id="username"><br>
        <label for="password"><strong>Password</strong></label><br>
        <input type="password" name="password" id="password"><br>
        <label for="role"><strong>Role</strong></label><br>
        <input type="text" name="role" id="role"><br>
        <input type="submit" value="Create" class="admin-button">
    </form>
<?php endif; ?>

    <h2>User bijwerken</h2>

    <form action="/index.php/update" method="post">
        <label for="user"><strong>Username</strong></label><br>
        <input type="text" name="username" id="user" value="<?php echo $_SESSION['username'] ?>" readonly><br><br>
        <label for="newpassword"><strong>New Password</strong></label><br>
        <input type="password" name="newpassword" id="newpassword"><br><br>
        <input type="submit" value="Edit" class="admin-button">
    </form>

</body>
</html>