<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password_hash FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php');
    } else {
        echo "Invalid credentials.";
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
                    <li><a href="index.php">Back</a></li>
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
    
    <form method="POST" action="" style="margin-top:100px">
        <h2>Login</h2>
        <!-- Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br> -->

        <label for="email">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
        <p>Don't have an account? <a href="register.php">Register here.</a></p>
    </form>

</body>
</html>



