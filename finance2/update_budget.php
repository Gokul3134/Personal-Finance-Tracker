<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$budget_id = $_GET['id'];

// Fetch the current budget details
$budget_stmt = $pdo->prepare("SELECT * FROM budgets WHERE id = ? AND user_id = ?");
$budget_stmt->execute([$budget_id, $user_id]);
$budget = $budget_stmt->fetch(PDO::FETCH_ASSOC);

if (!$budget) {
    die("Budget not found.");
}

// When the form is submitted to update the budget
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['amount'])) {
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Update the budget
    $stmt = $pdo->prepare("UPDATE budgets SET category = ?, amount = ?, start_date = ?, end_date = ? WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$category, $amount, $start_date, $end_date, $budget_id, $user_id])) {
        $message = "Budget updated successfully!";
        header("Location: set_budget.php");
        exit();
    } else {
        $message = "Failed to update budget.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Budget</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="set_budget.css">
</head>
<body>
    <div class="sidebar">
        <h2>Finance Tracker</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <!-- <li><a href="add_expense.php">Add Expense</a></li>
            <li><a href="edit_expense.php">Edit Expense</a></li> -->
            <!-- <li><a href="set_budget.php">Set Budget</a></li> -->
            <li><a href="set_budget.php">Set Budget</a></li>
            <li><a href="set_goals.php">Set Goal</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Update Budget</h1>

        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" action="" class="budget-form">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="Electricity" <?php echo $budget['category'] == 'Electricity' ? 'selected' : ''; ?>>Electricity</option>
                <option value="Rent" <?php echo $budget['category'] == 'Rent' ? 'selected' : ''; ?>>Rent</option>
                <option value="Groceries" <?php echo $budget['category'] == 'Groceries' ? 'selected' : ''; ?>>Groceries</option>
                <option value="Transportation" <?php echo $budget['category'] == 'Transportation' ? 'selected' : ''; ?>>Transportation</option>
                <option value="Entertainment" <?php echo $budget['category'] == 'Entertainment' ? 'selected' : ''; ?>>Entertainment</option>
                <option value="Healthcare" <?php echo $budget['category'] == 'Healthcare' ? 'selected' : ''; ?>>Healthcare</option>
                <option value="Others" <?php echo $budget['category'] == 'Others' ? 'selected' : ''; ?>>Others</option>
            </select>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" value="<?php echo htmlspecialchars($budget['amount']); ?>" step="0.01" required>

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($budget['start_date']); ?>" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($budget['end_date']); ?>" required>

            <button type="submit">Update Budget</button>
        </form>
    </div>
</body>
</html>
