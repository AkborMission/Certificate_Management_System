<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="add_crt.php">Add Certificate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mod_crt.php">Modify Certificate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="help.php">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['userID'])) {?>
                     <a class="nav-link" href="logout.php">Logout</a>   
                    <?php }
                    else{ ?>
                    <a class="nav-link" href="login.php">Login</a>   
                    <?php }
                    ?>
                    
                </li>
            </ul>
        </div>
    </div>
</nav>
</class>