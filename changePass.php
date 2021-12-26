  
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
