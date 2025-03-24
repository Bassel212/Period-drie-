<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<header>
    <nav>
        <a href="/index.php">Home</a>
        <a href="/register.php">Login</a>
    </nav>

    <main>
        <h2>Registreren</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="username" required>
            <input type="email" name="email" placeholder="e-mail" required>
            <input type="password" name="password" placeholder="password" required>
            <button type="submit">Register</button>
        </form>
    </main>
</body>
</html>