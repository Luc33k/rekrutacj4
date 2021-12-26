<?php 
  session_start();
  //include ("authentication.php");
  if(!isset($_SESSION['username'])){
    header('location: login.php');
    exit();
  }
?>

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Cover Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">

    

    <!-- Bootstrap core CSS -->
<link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="./assets/css/index.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="mb-auto">
        <div>
          <h3 class="float-md-start mb-0">Witaj: <?php echo $_SESSION["username"]?> </h3>
          <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link active" aria-current="page" href="#">Zmiana hasła</a>
            <a class="nav-link" href="#">Raport</a>
            <a class="nav-link" href="#">Zestawienie</a>
            <a class="nav-link" href = "./logout.php">Wyloguj</a>
          </nav>
        </div>
      </header>

      <main class="form-changepass">
    
        <form  method="POST" name= "f2" onsubmit = "return validation()" action="./changePass.php">
            
            <h1 class="h3 mb-3 fw-normal">Tutaj możesz zmienić swoje hasło!</h1>

            <div class="form-floating">
                <input type="password" class="form-control" id="pass_old" name="pass_old" placeholder="Podaj stare hasło">
                <label for="pass_old">Stare hasło</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="pass_new" name="pass_new" placeholder="Podaj nowe hasło">
                <label for="pass_new1">Podaj nowe hasło</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="pass_conf" name="pass_conf" placeholder="Powtórz nowe hasło">
                <label for="pass_new2">Potwierdź nowe hasło</label>
            </div>

            
            <button class="w-100 btn btn-lg btn-primary" type="submit" id="button_submit" name="button_submit">Zmień hasło</button>
            
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
        </form>
        <script>  
          function validation(){  
          var psOld = document.f2.pass_old.value;  
          var psNew = document.f2.pass_new.value;
          var psNewConf = document.f2.pass_conf.value;  
          
          if(psOld.length=="" && psNew.length=="" && psNewConf.length == "") {  
            alert("Wypełnij pola");  
            return false;  
          }  
          else{  
            if(psOld.length=="") {  
              alert("Pole stare hasło jest puste");  
              return false;  
            }   
            if (psNew.length=="") {  
              alert("Pole nowe hasło jest puste");  
              return false;  
            }  
            if (psNewConf.length=="") {  
              alert("Pole potwierdź hasło jest puste");  
              return false;  
            }   
          }                             
          }  
        </script>  
        <!--
        <p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
        <p class="lead">
          <a href="#" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Learn more</a>
        </p>
        -->
      </main>

      <footer class="mt-auto text-white-50">
        <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
      </footer>
    </div>
  </body>
</html>