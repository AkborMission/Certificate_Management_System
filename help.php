<?php
// Include the database connection file
require_once 'db.php';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert the contact information into the database
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();

    // Redirect back to the Contact Us page
    header('Location: help.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
     <!-- Include the navigation bar -->
     <?php include('nav.php'); ?>
    <div class="container">
        <h2>Contact Us</h2>
        <p>Contact Info:</p>
        <p>Phone: 01304 205 118</p>
        <p>Email: about@akbor.org, inquiry@akbor.org</p>

        <hr>

        <h3>About Akbor Ali Mission</h3>
        <p>The Akbor Ali Mission (AM) is a non-profit organization in Bangladesh focused on skill development for the youth. Their goal is to construct a skilled youth population to assist support the country’s economic growth and development. The slogan of “The dream is to construct skilled youth” reflects the organization’s commitment to empowering youthful people with the skills and knowledge they request to succeed in today’s rapidly changing world. The organization achieves its mission through various training programs, workshops, and other initiatives that assist youthful people build their skills and gain practical experience in their chosen fields. The Akbor Ali Mission (AM) is dedicated to helping young people in Bangladesh achieve their full potential, and their work is an important contribution to the future success of the country.</p>

        <hr>

        <h3>Vision</h3>
        <p>The goal of Akbor Ali Mission (AM), a non-profit organization, is to promote skill development among the youth population. Their slogan, “The dream is to construct skilled youth,” encapsulates their objective of providing the youthful generation with the necessary knowledge and training to succeed in the future.</p>
        <p>AM’s mission is to bridge the skills gap and equip the youth with the latest industry-relevant skills and knowledge. They aim to do this by providing various training and development programs in the field of information technology and other relevant industries. They also aim to provide these programs at an affordable cost or even free of charge to ensure that everyone has access to these opportunities, regardless of their financial background.</p>
        <p>AM’s goal is to contribute to the development of a skilled and capable workforce in Bangladesh. They believe that a well-equipped workforce will create a more productive and prosperous future for the country. By building skilled youth, they aim to help create a better future for the next generation and a brighter future for Bangladesh as a whole.</p>

        <hr>

        <h3>Contact Form</h3>
        <form method="POST" action="help.php">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php include('footer.php'); ?>
    <!-- Include Bootstrap JS -->
    <script src="bootstrap.bundle.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
