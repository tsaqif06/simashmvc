<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <form method="post" action="<?= base_url('auth/register') ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Register</button>
    </form>
    <a href="<?= base_url('auth/login') ?>">Login</a>
</body>

</html>