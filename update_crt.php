<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}

// Include the database connection file
require_once 'db.php';

// Retrieve the form data
$roll = $_POST['roll'];
$regNo = $_POST['regNo'];
$name = $_POST['name'];
$courseDuration = $_POST['courseDuration'];
$year = $_POST['year'];
$idType = $_POST['idType'];
$idNumber = $_POST['idNumber'];
$trainerName = $_POST['trainerName'];

// Update the certificate information
$stmt = $conn->prepare("UPDATE certificates SET name = ?, duration = ?, year = ?, idType = ?, idNumber = ?, trainerName = ? WHERE roll = ? AND registrationNumber = ?");
$stmt->bind_param("ssssssss", $name, $courseDuration, $year, $idType, $idNumber, $trainerName, $roll, $regNo);
$stmt->execute();
$stmt->close();

// Redirect back to the Modify Certificate Page
header('Location: mod_crt.php');
exit();
?>
