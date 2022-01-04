<?php
    session_start();
    require_once('./config.php');

    //if (count($_POST) > 0){
        $passwordOld = $_POST['pass_old'];
        $passwordNew = $_POST['pass_new'];
        $passwordConf = $_POST['pass_conf'];
        $user = $_SESSION['username'];

        $passwordOld = stripcslashes($passwordOld);
        $passwordOld = md5($passwordOld);
        $passwordNew = stripcslashes($passwordNew);
        $passwordConf = stripcslashes($passwordConf);

        $result = mysqli_query($conn, "SELECT * FROM users WHERE users.user = '$user' and users.password = '$passwordOld'");

      
        if(mysqli_num_rows($result) == 1){
            if($passwordNew == $passwordConf){
                if(strlen($passwordNew >= 5) && preg_match('/[0-9]/', $passwordNew) && preg_match('/[A-Z]/', $passwordNew)){
                    $hashPass = md5($passwordNew);
                    $sql=mysqli_query($conn, "UPDATE users SET users.password='$hashPass' WHERE user='$user'");
                    echo ("Hasło zmienione");
                }else{
                    echo('Hasło nie jest silne');
                }
                
            }else{
                echo('Nowe hasło nie jest równe potwierdzonemu');
            }
        }
        else{
            echo('błędne hasło');
        }   

?>