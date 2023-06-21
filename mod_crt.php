<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}

// Include the database connection file
require_once 'db.php';

// Initialize variables
$roll = '';
$regNo = '';
$certificate = null;
$error = '';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $roll = $_POST['roll'];
    $regNo = $_POST['regNo'];

    // Perform the certificate query
    $stmt = $conn->prepare("SELECT * FROM certificates WHERE roll = ? AND registrationNumber = ?");
    $stmt->bind_param("ss", $roll, $regNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Certificate found
        $certificate = $result->fetch_assoc();
    } else {
        // Certificate not found
        $error = 'Wrong information';
    }
}
?>
<?php if (isset($_GET['success']) && $_GET['success'] == 1) { ?>
    <div class="alert alert-success mt-3" role="alert">
        Certificate updated successfully!
    </div>
<?php } ?>
<!DOCTYPE html>
<html>
<head>
    <title>Modify Certificate Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
     <!-- Include the navigation bar -->
     <?php include('nav.php'); ?>
    <div class="container">
        <h2>Modify Certificate Page</h2>
        <form method="POST" action="mod_crt.php">
            <div class="mb-3">
                <label for="roll" class="form-label">Roll</label>
                <input type="text" class="form-control" id="roll" name="roll" required value="<?php echo $roll; ?>">
            </div>
            <div class="mb-3">
                <label for="regNo" class="form-label">Reg No</label>
                <input type="text" class="form-control" id="regNo" name="regNo" required value="<?php echo $regNo; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Find</button>
        </form>

        <?php if ($error !== '') { ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <?php if ($certificate !== null) { ?>
            <form method="POST" action="update_crt.php">
                <input type="hidden" name="roll" value="<?php echo $roll; ?>">
                <input type="hidden" name="regNo" value="<?php echo $regNo; ?>">

                <div class="mt-3">
                    <h4>Certificate Details:</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?php echo $certificate['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="courseDuration" class="form-label">Course Duration</label>
                        <input type="text" class="form-control" id="courseDuration" name="courseDuration" required value="<?php echo $certificate['duration']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="text" class="form-control" id="year" name="year" required value="<?php echo $certificate['year']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="idType" class="form-label">ID Type</label>
                        <input type="text" class="form-control" id="idType" name="idType" required value="<?php echo $certificate['idType']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="idNumber" class="form-label">ID Number</label>
                        <input type="text" class="form-control" id="idNumber" name="idNumber" required value="<?php echo $certificate['idNumber']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="trainerName" class="form-label">Trainer Name</label>
                        <input type="text" class="form-control" id="trainerName" name="trainerName" required value="<?php echo $certificate['trainerName']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        <?php } ?>
    </div>
    <?php include('footer.php'); ?>
    <!-- Include Bootstrap JS -->
    <script src="bootstrap.bundle.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
