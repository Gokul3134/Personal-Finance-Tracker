<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO expenses (user_id, category, amount, date, description) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $category, $amount, $date, $description])) {
        $message = "Expense added successfully!";
    } else {
        $message = "Failed to add expense.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="add_expense.css">
</head>
<body>
    <div class="sidebar">
        <h2>Finance Tracker</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="add_expense.php">Add Expense</a></li>
            <li><a href="edit_expense.php">Edit Expense</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Add Expense</h1>
        <form method="POST" action="" class="expense-form">
            <?php if (isset($message)): ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="" disabled selected>Select a category</option>
                <option value="Electricity">Electricity</option>
                <option value="Rent">Rent</option>
                <option value="Groceries">Groceries</option>
                <option value="Transportation">Transportation</option>
                <option value="Entertainment">Entertainment</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Others">Others</option>
            </select>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" step="0.01" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description"></textarea>

            <button type="submit">Add Expense</button>
        </form>
    </div>
</body>
</html>
