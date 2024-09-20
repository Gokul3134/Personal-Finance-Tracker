<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all expenses of the user
$expenses = $pdo->prepare("SELECT * FROM expenses WHERE user_id = ?");
$expenses->execute([$user_id]);
$expenses = $expenses->fetchAll(PDO::FETCH_ASSOC);

// When the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['expense_id'])) {
    $expense_id = $_POST['expense_id'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    // Update expense
    $stmt = $pdo->prepare("UPDATE expenses SET category = ?, amount = ?, date = ?, description = ? WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$category, $amount, $date, $description, $expense_id, $user_id])) {
        $message = "Expense updated successfully!";
    } else {
        $message = "Failed to update expense.";
    }

    // Fetch updated expenses
    $expenses = $pdo->prepare("SELECT * FROM expenses WHERE user_id = ?");
    $expenses->execute([$user_id]);
    $expenses = $expenses->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense</title>
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
        <h1>Edit Expense</h1>
        <form method="POST" action="" class="expense-form">
            <?php if (isset($message)): ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <label for="expense_id">Select Expense:</label>
            <select id="expense_id" name="expense_id" required>
                <option value="" disabled selected>Select an expense to edit</option>
                <?php foreach ($expenses as $expense): ?>
                    <option value="<?php echo $expense['id']; ?>">
                        <?php echo $expense['category'] . ' - ' . $expense['amount'] . ' - ' . $expense['date']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

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

            <button type="submit">Update Expense</button>
        </form>
    </div>
</body>
</html>
