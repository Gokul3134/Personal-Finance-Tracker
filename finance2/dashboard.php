<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
// Fetch the username
$username_query = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$username_query->execute([$user_id]);
$username = $username_query->fetchColumn();

// Fetch daily expenses for line chart
$daily_expenses = $pdo->prepare("SELECT DATE(date) as date, SUM(amount) as total FROM expenses WHERE user_id = ? GROUP BY DATE(date) ORDER BY DATE(date)");
$daily_expenses->execute([$user_id]);
$daily_expenses = $daily_expenses->fetchAll(PDO::FETCH_ASSOC);

// Fetch monthly expenses for pie chart
$monthly_expenses = $pdo->prepare("SELECT category, SUM(amount) as total FROM expenses WHERE user_id = ? AND MONTH(date) = MONTH(CURRENT_DATE()) GROUP BY category");
$monthly_expenses->execute([$user_id]);
$monthly_expenses = $monthly_expenses->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <!-- <img src="img/pro_logo1.jpg" alt="profile_picture" width="100px" height="100px"/> -->
        <h2>Finance Tracker</h2>
        <!-- Display the username -->
        <h3>Welcome, <?php echo htmlspecialchars($username); ?>!</h3>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="add_expense.php">Add Expense</a></li>
            <li><a href="edit_expense.php">Edit Expense</a></li>
            <li><a href="set_budget.php">Set Budget</a></li>
            <li><a href="set_goals.php">Set Goals</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Dashboard</h1>
        <div class="charts">
            <div class="chart-container">
                <h2>Daily Expenses</h2>
                <canvas id="lineChart"></canvas>
            </div>
            <div class="chart-container">
                <h2>Monthly Expenses</h2>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <script>
    // Line Chart
    var ctxL = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctxL, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_column($daily_expenses, 'date')); ?>,
            datasets: [{
                label: 'Daily Expenses',
                data: <?php echo json_encode(array_column($daily_expenses, 'total')); ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
            }]
        }
    });

    // Pie Chart
    var ctxP = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctxP, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode(array_column($monthly_expenses, 'category')); ?>,
            datasets: [{
                label: 'Monthly Expenses by Category',
                data: <?php echo json_encode(array_column($monthly_expenses, 'total')); ?>,
                backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(153, 204, 102, 0.2)']
            }]
        }
    });
    </script>
</body>
</html>
