<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
    <script src="loginvalidation.js"></script>
</head>
<body>
    <div class="container">
        <h2>Login For TIC</h2>
        <form action="login.php" method="post" onsubmit="return loginval()">

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>