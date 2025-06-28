<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
header('Content-Type: application/json');

session_start();
include "config.php"; // Ensure the database connection is correct

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$query = "SELECT steps, calories, heart_rate FROM health_data WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(["error" => "No data found"]);
}
?>
