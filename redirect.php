<?php
include_once('header.php');
?>
<section>
    <br>
    <div class="container">
        <div class="jumbotron" align="center">
            <?php
            session_unset();
            session_destroy();
            header( "refresh:5;url=index.php" );
            ?>
            <h2>Logged Out</h2>
            <br>
            <h4>Returning to Home Screen</h4>
        </div>
    </div>
</section>
