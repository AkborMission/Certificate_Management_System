<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}

// Include the database connection file
require_once 'db.php';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $center = $_POST['center'];
    $course = $_POST['course'];
    $duration = $_POST['duration'];
    $year = $_POST['year'];
    $idType = $_POST['idType'];
    $idNumber = $_POST['idNumber'];
    $registrationNumber = $_POST['registrationNumber'];
    $trainerName = $_POST['trainerName'];

    // Add your database insertion logic here
    // For example, you can use prepared statements to insert the data into the database
    $stmt = $conn->prepare("INSERT INTO certificates (name, roll, center, course, duration, year, idType, idNumber, registrationNumber, trainerName) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $name, $roll, $center, $course, $duration, $year, $idType, $idNumber, $registrationNumber, $trainerName);

    if ($stmt->execute()) {
        // Certificate added successfully
        // You can redirect to a success page or display a success message
        header('Location: success.php');
        exit();
    } else {
        // Error in adding the certificate
        // You can redirect to an error page or display an error message
        header('Location: error.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Certificate Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Include the navigation bar -->
    <?php include('nav.php'); ?>

    <div class="container">
        <h2>Add Certificate</h2>
        <form method="POST" action="add_crt.php">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="roll" class="form-label">Roll</label>
                <input type="text" class="form-control" id="roll" name="roll" required>
            </div>
            <div class="mb-3">
                <label for="center" class="form-label">Center</label>
                <input type="text" class="form-control" id="center" name="center" required>
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" class="form-control" id="course" name="course" required>
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Course Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="text" class="form-control" id="year" name="year" required>
            </div>
            <div class="mb-3">
                <label for="idType" class="form-label">ID Type</label>
                <select class="form-select" id="idType" name="idType" required>
                    <option value="NID">NID</option>
                    <option value="Birth Certificate">Birth Certificate</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="idNumber" class="form-label">ID Number</label>
                <input type="text" class="form-control" id="idNumber" name="idNumber" required>
            </div>
            <div class="mb-3">
                <label for="registrationNumber" class="form-label">Registration Number</label>
                <input type="text" class="form-control" id="registrationNumber" name="registrationNumber" required>
            </div>
            <div class="mb-3">
                <label for="trainerName" class="form-label">Trainer Name</label>
                <input type="text" class="form-control" id="trainerName" name="trainerName" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php include('footer.php'); ?>
    <!-- Include Bootstrap JS -->
    <script src="bootstrap.bundle.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
