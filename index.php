<?php 
  session_start();
  //include ("authentication.php");
  if(!isset($_SESSION['username'])){
    header('location: login.php');
    exit();
  }
  //include_once('changePassScript.php');
?>

<!doctype html>
<html lang="pl" class="h-100">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Zmiana hasła</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">

    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./assets/css/index.css" rel="stylesheet">
    
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

    
    
    
  </head>
  <body class="d-flex h-100 text-center text-dark bg-light">
    
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="mb-auto ">
        <div>
          <h3 class="float-md-start mb-0 text-dark">Witaj: <?php echo $_SESSION["username"]?> </h3>
          <nav class="nav nav-masthead justify-content-center float-md-end text-dark">
            <a class="nav-link active text-dark" href = "index.php" aria-current="page" >Zmiana hasła</a>
            <a class="nav-link text-dark" href = "raport.php">Raport</a>
            <a class="nav-link text-dark" href = "zestawienie.php">Zestawienie</a>
            <a class="nav-link text-dark" href = "logout.php">Wyloguj</a>
          </nav>
        </div>
      </header>

      <main class="form-changepass">
    
    <form  method="POST" name= "formChngPass" id="fomrChngPass" class="needs-validation"  action="changePassScript.php">
        
        <h1 class="h3 mb-3 fw-normal" id="title">Tutaj możesz zmienić swoje hasło!</h1>

        <div class="form-floating" style="padding-top: 15px">
            <input type="password" class="form-control" id="pass_old" name="pass_old" placeholder="Podaj stare hasło" required>
            <label for="pass_old">Stare hasło</label>
            <div class="valid-feedback">
        </div>
        <div class="form-floating" style="padding-top: 15px">
            <input type="password" class="form-control" id="pass_new" name="pass_new" placeholder="Podaj nowe hasło" required>
            <label for="pass_new1">Podaj nowe hasło</label>
            <div class="valid-feedback">
        </div>
        <div class="form-floating" style="padding-top: 15px">
            <input type="password" class="form-control" id="pass_conf" name="pass_conf" placeholder="Powtórz nowe hasło" required>
            <label for="pass_new2">Potwierdź nowe hasło</label>
            <div class="valid-feedback">
        </div>



        
        <button class="w-100 btn btn-lg btn-primary" type="submit" id="button_submit" name="button_submit">Zmień hasło</button>
        
        
    </form>

    

    <script>  

      $(document).ready(function(){
        var request;
        $("#fomrChngPass").submit(function(event){
            event.preventDefault();
            
            if (request){
                request.abort();
            }

            var $form = $(this);

            var $inputs = $form.find("#pass_old, #pass_new, #pass_conf");

            var serializedData = $form.serialize();

            $inputs.prop("disabled", true);

            request = $.ajax({
                url: "changePassScript.php",
                type: "POST",
                data: serializedData,
                success: function(data){
                    $("#title").html(data);
                }
            });


            request.done(function (response, textStatus, jqXHR){
            // Log a message to the console
            console.log("Hooray, it worked!");
            });
            // Callback handler that will be called on failure
            request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
                console.error(
                    "The following error occurred: "+
                    textStatus, errorThrown
                );
            });

            // Callback handler that will be called regardless
            // if the request failed or succeeded
            request.always(function () {
                // Reenable the inputs
                $inputs.prop("disabled", false);
            });


        });
    });

    </script>  

  </main>

      <footer class="mt-auto text-white-50 ">
        <p class="text-dark">Aplikacja do zmiany hasła, wyświetlenia raportu oraz zestawienia zamówień.</p>
      </footer>
    </div>


  </body>
</html>