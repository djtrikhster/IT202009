<?php
include_once('header.php');
?>
<section>
    <br>
    <div class="container">
        <div class="jumbotron" align="center">
            <?php
                //echo var_dump($_SESSION);
                if (isset($_SESSION['username'])){
                    echo '<form action="redirect.php" method="post" class=""><input type="submit" value="Logout" id="logout" class="btn btn-primary btn-lg"></form>';
                } else {
                    echo "<h2>For Logged In Users</h2><br><h4>Returning to Home Screen<h4>";
                    #header( "refresh:5;url=index.php" );
                    exit();
                }
            ?>
        </div>
    </div>
</section>
