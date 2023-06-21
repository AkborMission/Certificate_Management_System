<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['userID'])) {
    header('Location: dashboard.php');
    exit();
}

// Include the database connection file
require_once 'db.php';

// Process the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $userID = $_POST['userID'];
    $password = $_POST['password'];
    $phoneNumber = $_POST['phoneNumber'];

    // Add your login validation logic here
    // For example, you can check the user credentials against the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE userID = ? AND password = ? AND phone = ?");
    $stmt->bind_param("sss", $userID, $password, $phoneNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Login successful
        // Store the user ID in the session
        $_SESSION['userID'] = $userID;

        // Redirect to the dashboard page
        header('Location: dashboard.php');
        exit();
    } else {
        // Login failed
        // You can redirect to an error page or display an error message
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h2>Login Page</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="userID" class="form-label">User ID</label>
                <input type="text" class="form-control" id="userID" name="userID" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberLogin" name="rememberLogin">
                <label class="form-check-label" for="rememberLogin">Remember login</label>
            </div>
            <button type="submit" class="btn btn-primary">LOGIN</button>
        </form>
        <div class="mt-3">
            <a href="forgot_password.php">Forget password?</a>
        </div>
        <div class="alert alert-info mt-3" role="alert">
            Please contact crt_ms@akbor.org using Subject: Password Reset<br>
            Or contact 01304205118 on WhatsApp
        </div>
    </div>
    <?php include('footer.php'); ?>

    <!-- Include Bootstrap JS -->
    <script src="bootstrap.bundle.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>