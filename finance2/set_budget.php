<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch all budgets for the user
$budget_stmt = $pdo->prepare("SELECT * FROM budgets WHERE user_id = ?");
$budget_stmt->execute([$user_id]);
$budgets = $budget_stmt->fetchAll(PDO::FETCH_ASSOC);

// When the form is submitted to add a new budget
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['amount'])) {
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Insert a new budget
    $stmt = $pdo->prepare("INSERT INTO budgets (user_id, category, amount, start_date, end_date) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $category, $amount, $start_date, $end_date])) {
        $message = "Budget set successfully!";
    } else {
        $message = "Failed to set budget.";
    }

    // Refresh the page to fetch the updated budget list
    header("Location: set_budget.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $budget_id = $_GET['delete'];

    // Delete the budget
    $delete_stmt = $pdo->prepare("DELETE FROM budgets WHERE id = ? AND user_id = ?");
    $delete_stmt->execute([$budget_id, $user_id]);

    // Refresh the page
    header("Location: set_budget.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Budget</title>
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
            <li><a href="set_budget.php">Set Budget</a></li>
            <li><a href="set_goals.php">Set Goal</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Set Budget</h1>

        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST" action="" class="budget-form">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
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

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>

            <button type="submit">Set Budget</button>
        </form>

        <h2>Your Budgets</h2>
        <table class="budget-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($budgets): ?>
                    <?php foreach ($budgets as $budget): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($budget['id']); ?></td>
                            <td><?php echo htmlspecialchars($budget['category']); ?></td>
                            <td><?php echo htmlspecialchars($budget['amount']); ?></td>
                            <td><?php echo htmlspecialchars($budget['start_date']); ?></td>
                            <td><?php echo htmlspecialchars($budget['end_date']); ?></td>
                            <td>
                                <a href="update_budget.php?id=<?php echo $budget['id']; ?>" style="color: #169322;" >Update</a> |
                                <a href="set_budget.php?delete=<?php echo $budget['id']; ?>" style="color: #c00404;" onclick="return confirm('Are you sure you want to delete this budget?' );">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No budgets set yet.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
