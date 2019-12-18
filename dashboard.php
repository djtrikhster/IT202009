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

//echo var_dump($_SESSION);

if(!$data)
{
    die('invalid query'. mysql_error());
}

?>

<section>
    <br>
    <div class="bs-component" align="center">
        <div class="container">
            <div class="jumbotron">
                <?php

                $query = "SELECT id, username, password, firstname, lastname, email FROM `accounts` WHERE username = :username";
                $username = $_SESSION['username'];
                $stmt = $db->prepare($query);

                $stmt-> execute(array(":username" => $username));
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                //echo var_dump($result);

                echo '
                <form method="post" action="">
                    <input type="text" name="username" value="" placeholder="'.$result['username'].'" class="form-control">
                    <input type="text" name="firstname" value="" placeholder="'.$result['firstname'].'" class="form-control">
                    <input type="text" name="lastname" value="" placeholder="'.$result['lastname'].'" class="form-control">
                    <input type="email" name="email" value="" placeholder="'.$result['email'].'" class="form-control" class="form-control">
                    <input type="password" name="password" placeholder="password" class="form-control">
                    <input type="password" name="password_conf" placeholder="confirm password" class="form-control">
                    <select name="stationlist" id="stationlist" class="form-control">
                    <option value=""></option>
                    ';
                foreach($data as $row) {
                    echo '<option value="'.$row['STATION 2CHAR'].'">'.$row['STATION NAME'].'</option>';
                }
                echo '
                </select>
                <button type="submit" class="btn btn-primary btn-lg" name="register_btn">Update</button
                >';

                if ( ! empty( $_POST ) ) {
                    if ( isset( $_POST['password'] ) && isset( $_POST['password_conf'] ) )
                    {
                        //making connection
                        $query = "SELECT id, username, password, firstname FROM `accounts` WHERE username = :username";
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        $stmt = $db->prepare($query);
                        $stmt-> execute(array(":username" => $username));
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                }
                echo '</form>';
                ?>
            </div>
        </div>
    </div>
</section>
