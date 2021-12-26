<?php
    session_start();
    require_once('./config.php');

    $passwordOld = $_POST['pass_old'];
    $passwordNew = $_POST['pass_new'];
    $passwordConf = $_POST['pass_conf'];
    $user = $_SESSION['username'];

    $passwordOld = stripcslashes($passwordOld);
    $passwordNew = stripcslashes($passwordNew);
    $passwordConf = stripcslashes($passwordConf);

    $result = mysqli_query($conn, "SELECT password FROM users WHERE user = '$user'");
    //$sql = ;

   
    if($result == $passwordOld){
        $sql=mysqli_query($conn, "UPDATE users SET password='$passwordNew' WHERE user='$user'");
    
    }
    else{
        echo "old password is wrong";
    }

?>