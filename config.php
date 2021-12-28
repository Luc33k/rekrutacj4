<?php

    // dane logowania
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'rekrutacja';

    // nawiązanie połączenia
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->query("SET NAMES 'utf8'");

    //sprawdzenie połączenia
    if ($conn -> connect_error){
        die ('Connection failed: ' . $conn -> connect_error);
    }
    
    //echo 'Connected succesfully';

?>