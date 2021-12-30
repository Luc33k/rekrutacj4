<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
</head>
<div class = "raport">
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

    <div id="raportContent">

    </div>

    <div id='chart_div'  style="width: 500; height: 250px;">
    test
    </div>

</div>
<?php 
//create array variable
$values = [];

//pushing some variables to the array so we can output something in this example.
array_push($values, array("year" => "2013", "newbalance" => "50"));
array_push($values, array("year" => "2014", "newbalance" => "90"));
array_push($values, array("year" => "2015", "newbalance" => "120"));

//counting the length of the array
$countArrayLength = count($values);

?>
<script type="text/javascript">


function wykres(wyk){
    google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMaterial);

function drawMaterial(wyk) {
      /*var data = new google.visualization.DataTable();
      data.addColumn('number', 'Grupa');
      data.addColumn('number', 'Netto');
      data.addColumn('number', 'Brutto');

      data.addRows([
        [{v: 1000, f: '8 am'}, 1, .25],
        [{v: 359, f: '9 am'}, 2, .5],
        [{v: 1239, f:'10 am'}, 3, 1],
        [{v: 800, f: '11 am'}, 4, 2.25],
      ]);
*/
      var data = new google.visualization.arrayToDataTable(wyk);

      var options = {
        title: 'Motivation and Energy Level Throughout the Day',
        hAxis: {
          title: 'Raport sprzedaży',
          //format: 'h:mm a',
          viewWindow: {
            //min: [7, 30, 0],
            max: [100]
          }
        },
        vAxis: {
          title: 'Rating (scale of 1-10)'
        }
      };

      var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
      materialChart.draw(data, options);
    }
}

       
    
      
    //wykres();
    
    //function wykres(){


    
   
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
                    $("#raportContent").html(data);
                    //wykres();
                    //allert($jsonTable);
                    
                }
            });
            Request = $.ajax({
                type:'GET',
                url: 'raportScript.php?function=',
                data: 'json',
                success: function (data){
                    //alert data;
                //console.log('success',data);
                    wykres(data);
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

