<?php
// delete_goal.php
session_start();
include 'db.php'; // Your database connection

$user_id = $_SESSION['user_id']; // Assuming the user_id is stored in the session

$id = $_GET['id'];

// Delete the goal using PDO
$stmt = $pdo->prepare("DELETE FROM goals WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $user_id]);

header('Location: set_goals.php');
exit;
?>
