<? 
  session_start();
  if(isset($_SESSION['username'])){
    header('location: index.php');
    exit();
  }
?>

<!doctype html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Panel logowania</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

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
    <link href="./assets/css/login.css" rel="stylesheet">
  </head>
  <body class="text-center">

    <div class="sidenav">
      <div class="text-white m-5">
        <h1>
          Logowanie <br/> użytkownika<br />
        </h1>
        <p>
            Zaloguj się<br /> by uzyskać dostęp do aplikacji.
        </p>
      </div>
    </div>
    
    <main class="form-signin">
      <form  method="POST" name= "f1" onsubmit = "return validation()" action="./authentication.php">
        <!--<img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
        <h1 class="h3 mb-3 fw-normal">Zaloguj się</h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="user" name="user" placeholder="Login">
          <label for="user">Login</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <label for="password">Hasło</label>
        </div>

        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Zapamiętaj mnie
          </label>
        </div>
          
        <button class="w-100 btn btn-lg btn-primary" type="submit" id="button_submit" name="button_submit">Zaloguj</button>
          
      </form>
    </main>

    <script>  
      function validation(){  
        var id = document.f1.user.value;  
        var ps = document.f1.password.value;  
        if(id.length=="" && ps.length=="") {  
          alert("Pole login oraz hasło są puste");  
          return false;  
        }  
        else{  
          if(id.length=="") {  
            alert("Pole użytkownika jest puste");  
            return false;  
          }   
          if (ps.length=="") {  
            alert("Pole hasła jest puste");  
            return false;  
          }  
        }                             
      }  
    </script>  
  </body>
</html>