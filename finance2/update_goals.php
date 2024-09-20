<?php
// update_goal.php
session_start();
include 'db.php'; // Your database connection

$user_id = $_SESSION['user_id']; // Assuming the user_id is stored in the session

// Fetch the goal to be updated
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM goals WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);
$goal = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $goal_name = $_POST['goal'];
    $target_amount = $_POST['target_amount'];
    $current_amount = $_POST['current_amount'];
    $deadline = $_POST['deadline'];

    // Update the goal in the database
    $stmt = $pdo->prepare("UPDATE goals SET goal = ?, target_amount = ?, current_amount = ?, deadline = ? WHERE id = ? AND user_id = ?");
    $stmt->execute([$goal_name, $target_amount, $current_amount, $deadline, $id, $user_id]);

    // Redirect back to the set_goals.php page
    header('Location: set_goals.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Goal</title>
    <link rel="stylesheet" href="update_goals.css">
    <link rel="stylesheet" href="styles.css">
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
        <h1>Update Goal</h1>
        <form action="update_goals.php?id=<?php echo $id; ?>" method="POST" class="goal-form">
            <label for="goal">Goal:</label>
            <input type="text" id="goal" name="goal" value="<?php echo htmlspecialchars($goal['goal']); ?>" required>

            <label for="target_amount">Target Amount:</label>
            <input type="number" id="target_amount" name="target_amount" value="<?php echo htmlspecialchars($goal['target_amount']); ?>" step="0.01" required>

            <label for="current_amount">Current Amount:</label>
            <input type="number" id="current_amount" name="current_amount" value="<?php echo htmlspecialchars($goal['current_amount']); ?>" step="0.01" required>

            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline" value="<?php echo htmlspecialchars($goal['deadline']); ?>" required>

            <button type="submit">Update Goal</button>
        </form>
    </div>
</body>
</html>
