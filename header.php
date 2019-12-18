<?php
include_once('initDB.php');
//ini_set('display_errors',1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE HTML>
<html>
    <header>
        <link rel="stylesheet" type="text/css" href="css/darkly.css">
        <script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">NJT Skimmer</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php
                if(!isset($_SESSION['username']))
                {
                    echo '<li class="nav-item"><a class="nav-link" href="registration.php">Sign Up/Login</a></li>';

                }
                else
                {
                    echo '<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>';
                }
                ?>

                <li class="nav-item">
                    <a class="nav-link" href="#">PLACEHOLDER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">PLACEHOLDER</a>
                </li>
            </ul>
        </div>
    </nav>

</html>
