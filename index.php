<?php
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
<!DOCTYPE html>
<html>
<head>
    <title>Certificate Query Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h2>Certificate Find Page</h2>
        <form method="POST" action="index.php">
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
            <div class="alert alert-success mt-3" role="alert">
                Certificate found!
            </div>
            <div class="mt-3">
                <h4>Certificate Details:</h4>
                <p>Name: <?php echo $certificate['name']; ?></p>
                <p>Roll: <?php echo $certificate['roll']; ?></p>
                <p>Center: <?php echo $certificate['center']; ?></p>
                <p>Course: <?php echo $certificate['course']; ?></p>
                <p>Course Duration: <?php echo $certificate['duration']; ?></p>
                <p>Year: <?php echo $certificate['year']; ?></p>
                <p>ID Type: <?php echo $certificate['idType']; ?></p>
                <p>ID Number: <?php echo $certificate['idNumber']; ?></p>
                <p>Registration Number: <?php echo $certificate['registrationNumber']; ?></p>
                <p>Trainer Name: <?php echo $certificate['trainerName']; ?></p>
            </div>
        <?php } ?>
    </div>
    <?php include('footer.php'); ?>

    <!-- Include Bootstrap JS -->
    <script src="bootstrap.bundle.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
