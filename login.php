<?php
//tutorial: https://www.youtube.com/watch?v=cq2uz3rzbIw
include_once( "header.php");
include( 'conf.php')
?>
<section>
    <div class="bs-component">
        <div class="container">

            <?php
    if(isset($_SESSION['user'])){
        echo "<h3> you are already logged in " . var_dump($_SESSION) . "</h3>";
        # header( "refresh:5;url=index.php" );
    }
else
{
    echo '<form action="" method="post" class=""><fieldset><input type="text" name="uname" placeholder="Username" required class="form-control"><input type="password" name="pass" placeholder="********" required class="form-control"><input type="submit" value="login" class="form-control"></fieldset></form>';
    if ( ! empty( $_POST ) ) {
        if ( isset( $_POST['uname'] ) && isset( $_POST['pass'] ) )
        {
            //making connection
            $query = "SELECT * FROM `accounts` WHERE u_name = :u_name AND pass = :pass";
            $u_name = $_POST['uname'];
            $pass = $_POST['pass'];
            $stmt = $db->prepare($query);
            $stmt-> execute(array(':u_name' => $u_name, ':pass' => $pass));
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            echo var_dump($user);

            //checking logged in
            if($user['id'] > 0 && $user['pass'] == $pass){
                echo '<h3>Login Successful... Redirecting... </h3>';
                $_SESSION["user"] = var_export($user);
                session_destroy();
                session_start();
                //echo $_SESSION['user'][0];
                header( "refresh:5;url=index.php" );
                exit();
            }
            else{
                echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.</div>';
            }
        }
    }
}
            ?>
        </div>
    </div>
</section>
