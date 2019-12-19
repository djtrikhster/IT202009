<?php
include_once('header.php')
?>
<section>
    <br>
    <div class="bs-component">
        <div class="container">
            <div class="jumbotron" align="center">
                <form method="post" action="">
                    <fieldset>

                        <h4>
                            Registration Form
                        </h4>

                        <input type="text" name="username" value="" placeholder="Username" class="form-control">

                        <input type="text" name="firstname" value="" placeholder="First Name" class="form-control">
                        <input type="text" name="lastname" value="" placeholder="Last Name" class="form-control">

                        <input type="email" name="email" value="" placeholder="email" class="form-control" class="form-control">

                        <input type="password" name="password" placeholder="password" class="form-control">
                        <input type="password" name="password_conf" placeholder="confirm password" class="form-control">

                        <button type="submit" class="btn btn-primary btn-lg" name="register_btn">Register</button>
                        <a class="btn btn-primary btn-lg" href="login.php" role="button">Log In Existing</a>

                    </fieldset>
                </form>
                <?php
    if(isset($_POST['username'])
       && isset($_POST['password'])
       && isset($_POST['firstname'])
       && isset($_POST['lastname'])
       && isset($_POST['email'])
       && isset($_POST['password_conf'])
      )
    {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_conf = $_POST['password_conf'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];

        $stmt = $db->prepare("SELECT username FROM `accounts` WHERE username = :username LIMIT 1");
        $stmt->execute(array(":username"=>$username));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['username'] == $username){
            echo 'existing username';
            exit();
        }
        $stmt = $db->prepare("SELECT email FROM `accounts` WHERE email = :email LIMIT 1");
        $stmt->execute(array(":email"=>$email));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['email'] == $email){
            echo 'existing email';
            exit();
        }

        if($password != $password_conf){
            echo "Passwords don't match";
            exit();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<h2>Email address '$email' is invalid.</h2>";
            exit();
        }
        try{
            $password = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $db->prepare("INSERT into `accounts` (`username`, `password`, `firstname`, `lastname`, `email`) VALUES(:username, :password, :firstname, :lastname, :email)");


            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $firstname, PDO::PARAM_STR);
            $stmt->bindParam(3, $lastname, PDO::PARAM_STR);
            $stmt->bindParam(4, $email, PDO::PARAM_STR);
            $stmt->bindParam(5, $password, PDO::PARAM_STR);

            $result = $stmt->execute(
                array(":username"=>$username,
                      ":firstname"=>$firstname,
                      ":lastname"=>$lastname,
                      ":email"=>$email,
                      ":password"=>$password,
                     )
            );

            echo '<br><h3>Registration Successful '. $result['firstname'] . '... Redirecting... </h3>';
            //$_SESSION["user"] = var_export($user);
            session_destroy();
            session_start();
            //echo $_SESSION['user'][0];
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['active'] = true;
            #echo var_dump($_SESSION);
            header( "refresh:5;url=index.php" );
            exit();
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
include_once('footer.php');
?>
