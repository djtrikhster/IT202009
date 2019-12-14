<?php
include_once('header.php');
include_once('functions.php')
?>
<section class="parent" style="background-color:white">
    <div class="child">
        <?php
            echo var_dump($_SESSION);
            if(isset($_SESSION['uname'])){
                echo '<form action="logout.php"method="post"><input type="submit" name="logout" value="logout" /> </form>;';
                if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['logout']))
                    {
                        func::logout();
                    }
                exit();
            } else {
                echo "For Logged In Users";
                #header( "refresh:5;url=index.php" );
            }
        ?>
    </div>
</section>
