<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <script src="aloginvalidation.js"></script>
</head>
<body>
    <div class="container">
        <h2>Login For Admin</h2>
        <form action="alogin.php" method="post" onsubmit="return aloginval()">

            <label for="username">User Name:</label>
            <input type="text" id="username" name="username">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>