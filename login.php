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
    echo '<form action="" method="post" class=""><fieldset><input type="text" name="username" placeholder="Username" required class="form-control"><input type="password" name="password" placeholder="********" required class="form-control"><input type="submit" value="login" class="form-control"></fieldset></form>';
    if ( ! empty( $_POST ) ) {
        if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) )
        {
            //making connection
            $query = "SELECT id, username, password FROM `accounts` WHERE username = :username";
            $username = $_POST['username'];
            $password = $_POST['password'];
            $stmt = $db->prepare($query);
            $stmt-> execute(array(":username" => $username));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo var_dump($username);

            //checking logged in
            if($result['id'] > 0 ){
                if(password_verify($password, $result['password'])){
                    echo '<h3>Login Successful... Redirecting... </h3>';
                    //$_SESSION["user"] = var_export($user);
                    //session_destroy();
                    //session_start();
                    //echo $_SESSION['user'][0];
                    //header( "refresh:5;url=index.php" );
                    exit();
                }
                else echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oh snap!</strong> <a href="#" class="alert-link">Password Incorrect</a></div>';
            }
            else{
                echo '<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oh snap!</strong> <a href="#" class="alert-link">Username or Password Incorrect</a></div>';
            }
        }
    }
}
            ?>
        </div>
    </div>
</section>
