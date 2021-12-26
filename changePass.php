<?php
    session_start();

    $passwordOld = $_POST['pass_old'];
    $passwordNew = $_POST['pass_new'];
    $passwordConf = $_POST['pass_conf'];

    $passwordOld = stripcslashes($passwordOld);
    $passwordNew = stripcslashes($passwordNew);
    $passwordConf = stripcslashes($passwordConf);

    

?>