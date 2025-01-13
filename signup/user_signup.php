<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup.css">
    <script src="signupvalidation.js"></script>
</head>
<body>
    <div class="container">
        <h2>Signup For TIC</h2>
        <form action="signup.php" method="post" onsubmit="return signupval()">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
 
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <button type="submit">Signup</button>

        </form>
        <p>Already have an account? <a href="../login/userlogin.php">Login</a></p>
    </div>
</body>
</html>