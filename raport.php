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
        <button class="w-50 btn btn-md btn-primary ajaxTrigger" type="submit" value="Send" id="buttonSubmit" name="buttonSubmit">Generuj raport</button>
    </form>

    <div id="raportContent">

    </div>

    <div id='chart_div'  style="width: 500; height: 250px;"></div>

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

$wartosci = array(
    array('Grupa', 'Netto', 'Brutto'),
    array('A', 123, 500),
    array('B', 250, 600),
    array('C', 300, 480),
);

$wartoscJson = json_encode($wartosci);
//echo $wartoscJson;

?>
<script type="text/javascript">


function wykres(){
    google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = new google.visualization.arrayToDataTable(<?php echo $wartoscJson; ?>);
      /*data.addColumn('number', 'Time of Day');
      data.addColumn('number', 'Netto');
      data.addColumn('number', 'Brutto');

      data.addRows([
        [{v: 8, f: '8 am'}, 1, .25],
        [{v: 9, f: '9 am'}, 2, .5],
        [{v: 10, f:'10 am'}, 3, 1],
        [{v: 11, f: '11 am'}, 4, 2.25],
        [{v: 12, f: '12 pm'}, 5, 2.25],
        [{v: 13, f: '1 pm'}, 6, 3],
      ]);
        */
      var options = {
        title: 'Motivation and Energy Level Throughout the Day',
        hAxis: {
          title: 'Grupa',
          //format: 'h:mm a',
          viewWindow: {
            //min: [7, 30, 0],
            //max: [17, 30, 0]
          }
        },
        vAxis: {
          title: 'Kwota'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
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
            /*
            Request = $.ajax({
                type:'GET',
                url: 'raportScript.php?function=',
                data: 'json',
                success: function (data){
                    //alert data;
                //console.log('success',data);
                    wykres(data);
                }
            });*/

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

