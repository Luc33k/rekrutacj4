<?php
    require_once ('./config.php');

    $begi = $_GET['raport_start'];
    $end = $_GET['raport_end'];

    $wyniki = [];
    $wynikiWykres = [];
    $daneTemp  = [];
    $daneWykresu = array();
    $result = [];
    $values = [];
    //$testDate = strval('2019-01-01');

    $i = -1;

    $dane = mysqli_query($conn, "SELECT 
    produkty.id AS produktID,
    produkty.id_grupa AS  produktIdGrup,
    produkty.nazwa AS produktNazwa,
    produkty.cena_netto AS netto,
    produkty.vat AS vat,
    grupy_produktow.id AS grupID,
    grupy_produktow.nazwa AS grupNazwa,
    zamowienia.id AS zamId,
    zamowienia.numer_zamowienia AS zamNum,
    zamowienia.data AS zamData,
    zamowienia.id_produkt AS zamIdProd
    FROM produkty  
    INNER JOIN grupy_produktow ON produkty.id_grupa = grupy_produktow.id
    INNER JOIN zamowienia ON produkty.id = zamowienia.id_produkt 
    WHERE zamowienia.data BETWEEN '$begi' AND '$end' 
    GROUP BY zamData, grupNazwa
    ORDER BY zamData, grupNazwa DESC");


/*
      echo"
        <table border='2'>
        <thead>
          <tr>
            <th>Grupa</th>
            <th>Dzień</th>
            <th>Kwota Netto</th>
            <th>Kwota Brutto</th>
          </tr>
        </thead>
        <tbody>";*/
         
            if( mysqli_num_rows( $dane )==0 ){
              echo '<tr><td colspan="4">No Rows Returned</td></tr>';
            }else{
              
              while( $row = mysqli_fetch_assoc( $dane )){

                $brutto = $row['netto'] + ($row['netto'] * ($row['vat']/100));
                //echo "<tr><td>{$row['grupNazwa']}</td><td>{$row['zamData']}</td><td>{$row['netto']}</td><td>{$brutto}</td></tr>\n";
                array_push($wyniki, array('Grupa' => $row['grupNazwa'], 'Data' => $row['zamData'], 'Netto' => $row['netto'], 'Brutto' => $brutto));
                //array_push($wyniki, array($row['grupNazwa'], $row['zamData'], $row['netto'], $brutto));
                array_push($wynikiWykres, array('Grupa' => $row['grupNazwa'], 'Netto' => $row['netto'], 'Brutto' => $brutto));
                //$wyniki[] = $row['grupNazwa'] . $row['zamData'] . $row['netto'];
                //print_r($wyniki);
              }

              //$wynikiWykres = array_sum( array_column($wyniki, 'Brutto'));
              //array_push(array_column($wynikiWykres, 'Netto') = array_sum(array_column($wynikiWykres, 'Netto'))));
              
              //array_push($wynikiWykres, array_column($wynikiWykres, 'Grupa'), array_sum(array_column($wynikiWykres, 'Netto')), array_sum(array_column($wynikiWykres, 'Brutto'))); // źle wyświetla ostatnie array



                      /*usort($wynikiWykres, function($a, $b) {
                        return $a['Grupa'] <=> $b['Grupa'];
                      });*/


        $daneTemp = array_values($wynikiWykres);
        //echo (json_encode($daneTemp[0]));




      $sum = array_reduce($daneTemp, function ($a, $b) {
        //isset($a[$b['Grupa']]) ? $a[$b['Grupa']]['Netto'] += $b['Netto'] : $a[$b['Grupa']] = $b;  
        isset($a[$b['Grupa']]) ? $a[$b['Grupa']]['Netto'] += $b['Netto'] and $a[$b['Grupa']]['Brutto'] += $b['Brutto'] : $a[$b['Grupa']] = $b;  
        return $a;
    });

    $values = array_values($sum);

    $rows = array();
    $table = array();
    $table['cols'] = array(

      // Labels for your chart, these represent the column titles.
      /* 
          note that one column is in "string" format and another one is in "number" format 
          as pie chart only required "numbers" for calculating percentage 
          and string will be used for Slice title
      */

      array('label' => 'Weekly Task', 'type' => 'string'),
      array('label' => 'Percentage', 'type' => 'number')

    );
    /* Extract the information from $result */
    foreach($values as $r) {

      $temp = array();

      // The following line will be used to slice the Pie chart

      $temp[] = array('v' => (string) $r['Grupa']); 

      // Values of the each slice

      $temp[] = array('v' => (int) $r['Netto']); 
      $rows[] = array('c' => $temp);
    }

$table['rows'] = $rows;

// convert data into JSON format
$jsonTable = json_encode($table);
//print_r( json_encode( $table['rows']));

//$jsonTable1 = json_encode($wyniki);
//echo $jsonTable1;
//echo $jsonTable;
    //$values = call_user_func_array('array_merge', $daneTemp);

    //array_push($values, array("year" => "2013", "newbalance" => "50"));
    //array_push($values, array("year" => "2014", "newbalance" => "90"));
    //array_push($values, array("year" => "2015", "newbalance" => "120"));

              //echo '<pre>'; print_r($values); echo '</pre>';
              //print json_encode($values);
              //echo (json_encode($values));
?>

              <?php if (count($wyniki) > 0): ?>
                <table border="2" id="raport">
                  <thead>
                    <tr>
                      <th><?php echo implode('</th><th>', array_keys(current($wyniki))); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                <?php foreach ($wyniki as $row): array_map('htmlentities', $row); ?>
                    <tr>
                      <td><?php echo implode('</td><td>', $row); ?></td>
                    </tr>
                    
                <?php endforeach; ?>
                  <tr>
                    <td></td>
                    <td>Suma: </td>
                    <td> <?php echo(array_sum(array_column($wyniki, 'Netto'))); ?></td>
                    <td><?php echo(array_sum(array_column($wyniki, 'Brutto'))); ?></td>
                  </tr>
                  </tbody>
                </table>
                
                <?php endif; 

            }
            
            ?>