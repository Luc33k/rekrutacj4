<?php      

    require_once('./config.php');  
    $username = $_POST['user'];  
    $password = $_POST['password'];  
    //public $_SESSION['username']
      
        //zabezpieczenie przed mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);  
      
        $sql = "SELECT * FROM users WHERE user = '$username' AND password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            session_start();
            $_SESSION["username"] = $username;
            //$_SESSION["name"] = $memberRecord[0]["name"];
            session_write_close();
            header("Location: index.php");
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     


?>  