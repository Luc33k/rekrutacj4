<main class = "raport">
    <form id="formRaport" >
        <label for="start">Od:</label>
        <input type="date" id="start" name="raport_start"
            value="2019-07-22"
            min="2019-01-01" max="2021-11-24">
        <label for="start">Do:</label>

        <input type="date" id="end" name="raport_end"
            value="2019-07-22"
            min="2019-01-01" max="2021-11-24">
        <button class="w-50 btn btn-md btn-primary ajaxTrigger" type="submit" value="Send" id="buttonSubmit" name="buttonSubmit">Zaloguj</button>
    </form>

    <div class="ajaxContent">

    </div>

</main>
<script type="text/javascript">
    //alert('test');



/*

    $(document).ready(function(){
        var values = $(this).serialize();

        $.ajax({
            url: "raportScript.php",
            type: "get",
            data: values,
            success: function (){

            },
            error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
        })
    });




*/
    $(document).ready(function(){
        var request;
        $("#formRaport").submit(function(event){
            event.preventDefault();
            
            if (request){
                request.abort();
            }

            var $form = $(this);

            var $inputs = $form.find("#start, #end");

            var serializedData = $form.serialize();

            $inputs.prop("disabled", true);

            request = $.ajax({
                url: "raportScript.php",
                type: "GET",
                data: serializedData,
                success: function(data){
                    $("#ajaxContent").html(data);
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

/*
    $(document).ready(function(){
       $("#buttonSubmit").click(function(){
        var Serialized = $("#formRaport").serialize();
            $.ajax({
                type: "GET",
                url: "raportScript.php",
                data: "Serialized",
                success: function(data){
                    //$("#ajaxContent").html(respone);
                }

            });
        }); 
    });
    


    $("#submitId").click(function(){
   var Serialized =  $("#contactForm").serialize();
    $.ajax({
       type: "POST",
        url: "infoct.php",
        data: Serialized,
        success: function(data) {
            //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
            // do what ever you want with the server response
        },
   error: function(){
        alert('error handing here');
    }
    });
});
      $(document).ready(function(){
        $('.ajaxTrigger').click(function(){
          var pageName = $(this).attr('load');
          $('#ajaxContent').load('./'+pageName);
        });
      });*/
    </script>


<?# require_once ('./raportScript.php')?>

