<?php
    require_once ('./config.php');

    $grupy = $conn->query("SELECT * FROM grupy_produktow");
    $produkty = $conn->query("SELECT * FROM produkty");
    $zamowienia = $conn->query("SELECT * FROM zamowienia");



?>