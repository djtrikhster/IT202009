<?php
class func{

    #Check if user is logged in based on global vars
    public static function isLoggedIn($db){
        if(!isset($_SESSION[`id`]) || !isset($_COOKIE[`PHPSESSID`]))
        {

        }
        if(isset($_COOKIE[`id`]) && isset($_COOKIE[`token`]) && isset($_COOKIE[`serial`]))
        {
            $query = "SELECT * FROM sessions WHERE sessions_uid = :uid AND sessions_token = :token AND sessions_serial = :serial;";

            $uid = $_COOKIE[`uid`];
            $token = $_COOKIE[`token`];
            $serial = $_COOKIE[`serial`];

            $stmt = $db->prepare($query);
            $stmt-> execute(array(`:uid` => $uid, `:token` => $token, `:serial` => $serial));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row[`sessions_uid`] > 0){
                if (
                    $row[`sessions_uid`] == $_COOKIE[`uid`] &&
                    $row[`sessions_token`] == $_COOKIE[`token`] &&
                    $row[`sessions_serial`] == $_COOKIE[`serial`]
                )
                {
                    if (
                        $row[`sessions_uid`] == $_SESSION[`uid`] &&
                        $row[`sessions_token`] == $_SESSION[`token`] &&
                        $row[`sessions_serial`] == $_SESSION[`serial`]
                    )
                    {
                        return true;
                    }
                }
            }
        }
    }

    
    public static function createEntry($db){
        $query = 'INSERT INTO sessions (sessions_uid, sessions_token, sessions_serial, sessions_date) VALUES (:uid, :token, :serial), (date("m/d/Y"))';


        $db-> prepare('DELETE FROM sessions WHERE sessions_id = :sessions_id;')->execute();


        $token = func::createRandom(32);
        $serial = func::createRandom(32);
        func::createCookie($u_name, $uid, $token, $serial);
        func::createSession($u_name, $uid, $token, $serial);

    }

    public static function createCookie($u_name, $uid, $token, $serial){
        setcookie('uid', $uid, time() +(86400)*30 ,  "/");
        setcookie('u_name', $u_name, time() +(86400)*30 ,  "/");
        setcookie('token', $token, time() +(86400)*30 ,  "/");
        setcookie('serial', $serial, time() +(86400)*30 ,  "/");
    }


    public static function logout(){
        session_destroy();
        echo 'LOGGING OUT';
        header( "refresh:5;url=index.php" );
        exit();
    }

    public static function createRandom($len){
        $key = 'mKXSNPMyh8ubiiV9ri3UibkH8dwpAUrc4uJR7gnBx6MnCUWVUGjxmG3Lqmi9wPanQTew9rfzE6WjC3';
        $string = '';
        $random1 = '';
        $random2 = '';
        for ($i = 1; $i < $len; $i ++)
        {
            while ($random2 == $random1){
                $random1 = rand(7,77);
            }
            $random2 = $random1;
            $string = $string.$key[$random1];
        }
        return $string;

    }
}
?>
