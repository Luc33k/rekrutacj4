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

    <script src="./assets/js/jquery-3.6.0.min.js"></script>

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
            <a class="nav-link active ajaxTrigger" load = "changePass.php" aria-current="page" >Zmiana hasła</a>
            <a class="nav-link ajaxTrigger" load = "raport.php">Raport</a>
            <a class="nav-link ajaxTrigger" load = "zestawienie.php">Zestawienie</a>
            <a class="nav-link ajaxTrigger" href = "./logout.php">Wyloguj</a>
          </nav>
        </div>
      </header>

      <div id="ajaxContent"></div>

      <footer class="mt-auto text-white-50">
        <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>, by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>.</p>
      </footer>
    </div>
    <script>
      $(document).ready(function(){
        $('.ajaxTrigger').click(function(){
          var pageName = $(this).attr('load');
          $('#ajaxContent').load('./'+pageName);
        });
      });
    </script>
  </body>
</html>