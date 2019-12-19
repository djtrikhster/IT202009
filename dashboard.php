<?php
include_once("header.php");
if ( !isset($_SESSION['username']))
{
    header("location:index.php");
    exit();
}

$query = "SELECT * FROM `Stations`";
$stmt = $db->prepare($query);
$stmt-> execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo var_dump($_SESSION);

if(!$data)
{
    die('invalid query'. mysql_error());
}

$query = "SELECT * FROM `accounts` WHERE username = :username LIMIT 1";
$username = $_SESSION['username'];
$stmt = $db->prepare($query);
$stmt-> execute(array(":username" => $username));
$result = $stmt->fetch(PDO::FETCH_ASSOC);
//echo var_export($stmt->errorInfo());
//echo var_export($result);

?>

<section>
    <br>
    <div class="bs-component" align="center">
        <div class="container">
            <div class="jumbotron">
                <h1>Make changes to any field and confirm password to update</h1>
                <h3>NOTE: Any changes will that are made will be updated when you click update</h3>
                <?php

                $id = $result['id'];
                $username = $result['username'];
                $firstname = $result['firstname'];
                $lastname = $result['lastname'];
                $email = $result['email'];
                $password = $result['password'];
                $fav1 = $result['fav1'];
                $fav1 = $result['fav2'];
                $fav1 = $result['fav3'];

                //echo var_dump($result);

                echo '
                <form method="post" action="">
                    <label class="control-label" for="disabledInput">Username</label>
                    <input class="form-control" id="disabledInput" name="username" type="text" placeholder="'.$result['username'].'" disabled="">
                    <br>
                    <label class="control-label" for="disabledInput">First Name</label>
                    <input type="text" name="firstname" value="'.$result['firstname'].'" class="form-control">
                    <label class="control-label" for="disabledInput">Last Name</label>
                    <input type="text" name="lastname" value="'.$result['lastname'].'" class="form-control">
                    <br>
                    <label class="control-label" for="disabledInput">e-Mail</label>
                    <input type="email" name="email" value="'.$result['email'].'" class="form-control" class="form-control">
                    <br>
                    <label class="control-label" for="disabledInput">Password</label>
                    <input type="password" name="password" value="" class="form-control">
                    <input type="password" name="password_conf" value="" class="form-control">
                    <input type="password" name="password_new" value="" class="form-control">
                    <br>
                    <label class="control-label" for="disabledInput">Favorite 1</label>
                    <select name="fav1" value="'. $result['fav1'] .'" id="stationlist1" class="form-control">
                    <option '.  ($result['fav1'] == $result['STATION 2CHAR']?'selected':'') . '></option>';
                
                //<option ($result['fav1'] == $result['STATION 2CHAR']?'selected':''>
                foreach($data as $row){
                    if ($result['fav1'] == $row['
                    echo '<option value="'.$row['STATION 2CHAR'].'">'.$row['STATION NAME'].'</option>';
                }

                echo  '</select><label class="control-label" for="disabledInput">Favorite 2</label>
                <br><select name="fav2" id="stationlist2" class="form-control">
                    <option value="' . $result['fav2'] . '"></option>';
                foreach($data as $row){
                    echo '<option value="' . $row['STATION 2CHAR']. '">' . $row['STATION NAME'] . '</option>';
                }

                echo '</select><label class="control-label" for="disabledInput">Favorite 3</label><br><select name="fav3" id="stationlist3" class="form-control">
                    <option value="'. $result['fav3'] .'"></option>';
                foreach($data as $row){
                    echo '<option value="' . $row['STATION 2CHAR']. '">' . $row['STATION NAME'] . '</option>';
                }

                echo '</select><button type="submit" class="btn btn-primary btn-lg" name="register_btn">Update</button>';

                if ( ! empty( $_POST ) ) {
                    if ( isset( $_POST['password'] ) && isset( $_POST['password_conf'] ) )
                    {
                        if ( $_POST['password'] == $_POST['password_conf']  ){

                            if (password_verify($_POST['password'], $result['password'])){
                                $password =  password_hash($_POST['password_new'], PASSWORD_BCRYPT);
                            }
                            else{
                                $password = $result['password'];
                            }

                            $username = $result['username'];
                            $firstname = $_POST['firstname'];
                            $lastname = $_POST['lastname'];
                            $email = $_POST['email'];
                            $fav1 = $_POST['fav1'];
                            $fav2 = $_POST['fav2'];
                            $fav3 = $_POST['fav3'];

                            $stmt = $db->prepare("UPDATE accounts 
                            SET firstname = :firstname, lastname = :lastname, email = :email, password = :password, fav1 = :fav1, fav2 = :fav2, fav3 = :fav3 
                            WHERE username = :username");
                            
                            /*
                            $stmt->bindParam(1, $username, PDO::PARAM_STR);
                            $stmt->bindParam(2, $firstname, PDO::PARAM_STR);
                            $stmt->bindParam(3, $lastname, PDO::PARAM_STR);
                            $stmt->bindParam(4, $email, PDO::PARAM_STR);
                            $stmt->bindParam(5, $password, PDO::PARAM_STR);
                            $stmt->bindParam(6, $fav1, PDO::PARAM_STR);
                            $stmt->bindParam(7, $fav2, PDO::PARAM_STR);
                            $stmt->bindParam(8, $fav3, PDO::PARAM_STR);
                            */
                            
                            $stmt->execute(
                                array(":username"=>$username,
                                      ":firstname"=>$firstname,
                                      ":lastname"=>$lastname,
                                      ":email"=>$email,
                                      ":password"=>$password,
                                      ":fav1"=>$fav1,
                                      ":fav2"=>$fav2,
                                      ":fav3"=>$fav3,

                                     )
                            );
                            //echo var_export($stmt->errorInfo());
                        }
                    }
                     else{
                         echo "incorrect password";
                     }
                }
                echo '</form>';
                ?>
            </div>
        </div>
    </div>
</section>
<?php
include_once('footer.php');
?>
