<?php
session_start();
include 'db.php'; // Your database connection

$user_id = $_SESSION['user_id']; // Assuming the user_id is stored in the session

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $goal = $_POST['goal'];
    $target_amount = $_POST['target_amount'];
    $current_amount = $_POST['current_amount'];
    $deadline = $_POST['deadline'];

    // Insert goal into the database using $pdo
    $stmt = $pdo->prepare("INSERT INTO goals (user_id, goal, target_amount, current_amount, deadline) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $goal, $target_amount, $current_amount, $deadline]);
}

// Fetch user's goals using $pdo
$stmt = $pdo->prepare("SELECT * FROM goals WHERE user_id = ?");
$stmt->execute([$user_id]);
$goals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Goals</title>
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
            <!-- <li><a href="set_budget.php">Set Budget</a></li> -->
            <li><a href="set_budget.php">Set Budget</a></li>
            <li><a href="set_goals.php">Set Goal</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Set Goals</h1>
        <form action="set_goals.php" method="POST" class="goal-form">
            <label for="goal">Goal For:</label>
            <input type="text" id="goal" name="goal" required>

            <label for="target_amount">Target Amount:</label>
            <input type="number" id="target_amount" name="target_amount" step="0.01" required>

            <label for="current_amount">Current Amount:</label>
            <input type="number" id="current_amount" name="current_amount" step="0.01" required>

            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline" required>

            <button type="submit">Set Goal</button>
        </form>

        <h2>Your Goals</h2>
        <table class="goal-table">
            <thead>
                <tr>
                    <th>Goal</th>
                    <th>Target Amount</th>
                    <th>Current Amount</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($goals as $goal): ?>
                <tr>
                    <td><?php echo htmlspecialchars($goal['goal']); ?></td>
                    <td><?php echo htmlspecialchars($goal['target_amount']); ?></td>
                    <td><?php echo htmlspecialchars($goal['current_amount']); ?></td>
                    <td><?php echo htmlspecialchars($goal['deadline']); ?></td>
                    <td>
                        <a href="update_goals.php?id=<?php echo $goal['id']; ?>" style="color: #169322" >Update</a> |
                        <a href="delete_goal.php?id=<?php echo $goal['id']; ?>" style="color: #c00404;" >Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
