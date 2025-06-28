<?php
include 'config.php'; // Your database connection

$query = "SELECT COUNT(*) AS users FROM users";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalUsers = $row['users'];

$query = "SELECT COUNT(*) AS predictions FROM predictions";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalPredictions = $row['predictions'];

$query = "SELECT AVG(accuracy) AS accuracy FROM predictions";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$accuracy = round($row['accuracy'], 2);

echo json_encode(["users" => $totalUsers, "predictions" => $totalPredictions, "accuracy" => $accuracy]);
?>
