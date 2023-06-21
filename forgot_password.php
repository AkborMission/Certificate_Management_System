<?php
session_start();

// Include the database connection file
require_once 'db.php';

// Process the password reset form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $userID = $_POST['userID'];
    $phoneNumber = $_POST['phoneNumber'];
    $otp = $_POST['otp'];

    // Verify the OTP
    if ($otp === '2066403') { // Replace with your desired OTP value
        // Add your password reset logic here
        // For example, you can update the password in the database for the specified user
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE userID = ? AND phone = ?");
        $newPassword = generateRandomPassword(); // Generate a random password
        $stmt->bind_param("sss", $newPassword, $userID, $phoneNumber);
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            // Password reset successful
            // You can redirect to a success page or display a success message
            $success = "Password reset successful. Your new password is: $newPassword";
        } else {
            // Password reset failed
            // You can redirect to an error page or display an error message
            $error = "Invalid credentials";
        }
    } else {
        // Invalid OTP
        // You can redirect to an error page or display an error message
        $error = "Invalid OTP";
    }
}

// Function to generate a random password
function generateRandomPassword($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <?php if (isset($success)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php } elseif (isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form method="POST" action="forgot_password.php">
            <div class="mb-3">
                <label for="userID" class="form-label">User ID</label>
                <input type="text" class="form-control" id="userID" name="userID" required>
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
            </div>
            <div class="mb-3">
                <label for="otp" class="form-label">OTP</label>
                <input type="text" class="form-control" id="otp" name="otp" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="bootstrap.bundle.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
