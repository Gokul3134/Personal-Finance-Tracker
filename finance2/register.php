<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, email) VALUES (?, ?, ?)");
    if ($stmt->execute([$username, $password, $email])) {
        header('Location: login.php');
    } else {
        echo "Registration failed.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="left-side">
            <!-- <img src="img/logo1.png" alt="Logo" class="logo" height="60px" width="60px">
            <h1> Finance Tracker</h1> -->
        </div>
        <div class="middle">
            <nav>
                <ul>
                    <li><a href="login.php">Back</a></li>
                    <!-- <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li> -->
                </ul>
            </nav>
        </div>
        <div class="right-side">
            <!-- <a href="login.php" class="login-link">Login</a> -->
        </div>
    </header>

    <!-- <h2>Login</h2> -->
    
    <form method="POST" action="" style="margin-top:80px">
    <h2>Register</h2>
        <!-- Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Email: <input type="email" name="email" required><br> -->

        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <!-- <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required> -->

        <button type="submit">Register</button>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>

</body>
</html>


