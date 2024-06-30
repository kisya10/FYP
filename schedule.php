<!-- schedule.php -->

<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $class_name = htmlspecialchars($_POST['class_name']);
    $class_time = htmlspecialchars($_POST['class_time']);

    $stmt = $conn->prepare("INSERT INTO schedules (user_id, class_name, class_time) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $class_name, $class_time);

    if ($stmt->execute()) {
        echo "Schedule added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT class_name, class_time FROM schedules WHERE user_id = $user_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule</title>
</head>
<body>
    <h1>Manage Your Schedule</h1>
    <form method="POST" action="schedule.php">
        <input type="text" name="class_name" placeholder="Class Name" required><br><br>
        <input type="text" name="class_time" placeholder="Class Time" required><br><br>
        <button type="submit">Add Schedule</button>
    </form>
    <h2>Your Schedule</h2>
    <ul>
       
