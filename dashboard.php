<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Include the navigation bar -->
    <?php include('nav.php'); ?>
    
    <div class="container">
        <h2>Welcome to the Dashboard</h2>

        <!-- Certificate Management System -->
        <h3>About Certificate Management System</h3>
        <p>
            The Certificate Management System by Akbor Ali Mission is a comprehensive platform designed to handle the management of certificates awarded to individuals who have completed training programs conducted by Akbor Ali Mission. This system simplifies the process of creating, modifying, and accessing certificates, providing an efficient and reliable solution for managing certification records.
        </p>
        <p>
            With the Certificate Management System, administrators can easily add new certificates, modify existing certificates, and perform various administrative tasks related to certificate management. Users can search for certificates, view certificate details, and verify the authenticity of certificates issued by Akbor Ali Mission.
        </p>
        <p>
            The system ensures the security and integrity of certificate data, allowing authorized personnel to maintain accurate records and prevent unauthorized access or tampering. It streamlines the certificate management process, saving time and effort for both administrators and certificate recipients.
        </p>
        <p>
            The Certificate Management System plays a vital role in ensuring the credibility and recognition of training programs conducted by Akbor Ali Mission, contributing to the organization's mission of building a skilled and capable workforce in Bangladesh.
        </p>
    </div>
    <?php include('footer.php'); ?>
    <!-- Include Bootstrap JS -->
    <script src="bootstrap.bundle.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
