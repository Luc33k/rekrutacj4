<?php
    require_once ('./config.php');

    $begi = $_GET['raport_start'];
    $end = $_GET['raport_end'];

    $wyniki = [];
    $wynikiWykres = [];
    $values  =[];

    //$testDate = strval('2019-01-01');

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
              
/*
              $chartRows = array();
              $chartTable = array();
              $chartTable['cols'] = array(
                array('label' => 'grupNazwa', 'type' => 'string'),
                array('label' => 'netto', 'type' => 'number')
              );
                  
              foreach($dane as $d){
                $temp = array();
                  
                $temp[] = array('v' => (string) $d['grupNazwa']);
                  
                $temp[] = array('v' => (int) $d['netto']);
                $chartRows[] = array('c' => $temp);
              }
              $chartTable['rows'] = $chartRows;

              $jsonTable = json_encode($chartTable);

              //$wyniki[] = 'grupa' . 'data' . 'netto';*/
              while( $row = mysqli_fetch_assoc( $dane )){

                $brutto = $row['netto'] + ($row['netto'] * ($row['vat']/100));
                //echo "<tr><td>{$row['grupNazwa']}</td><td>{$row['zamData']}</td><td>{$row['netto']}</td><td>{$brutto}</td></tr>\n";
                array_push($wyniki, array('Grupa' => $row['grupNazwa'], 'Data' => $row['zamData'], 'Netto' => $row['netto'], 'Brutto' => $brutto));
                array_push($wynikiWykres, array('Grupa' => $row['grupNazwa'], 'Netto' => $row['netto'], 'Brutto' => $brutto));
                //$wyniki[] = $row['grupNazwa'] . $row['zamData'] . $row['netto'];
                //print_r($wyniki);
              }

              //$wynikiWykres = array_sum( array_column($wyniki, 'Brutto'));
              //array_push(array_column($wynikiWykres, 'Netto') = array_sum(array_column($wynikiWykres, 'Netto'))));
              
              array_push($wynikiWykres, array_column($wynikiWykres, 'Grupa'), array_sum(array_column($wynikiWykres, 'Netto')), array_sum(array_column($wynikiWykres, 'Brutto')));
              

              foreach ($wynikiWykres as $entry) {

                // if an entry for this user id hasn't been created in the result, add this object
                if (!isset($result[$entry->Grupa])) {
                    $wynikiWykres[$entry->Grupa] = $entry;
            
                // otherwise, iterate this object and add the values of its keys to the existing entry
                } else {
                    foreach ($entry as $key => $value) {
                        $result[$entry->user_id]->$key = $value;
                    }
                }
            }

              array_push($values, array("year" => "2013", "newbalance" => "50"));
              array_push($values, array("year" => "2014", "newbalance" => "90"));
              array_push($values, array("year" => "2015", "newbalance" => "120"));
              echo '<pre>'; print_r($wynikiWykres); echo '</pre>';
              //print_r(array_sum( array_column($wyniki, 'Brutto'))) ;
              
              //print_r($wynikiWykres);
              /*
              function converteToJson($wynikiWykres){
                 $jsonTable = json_encode($wynikiWykres);
                 print ($jsonTable);
              }
              while( $row = mysqli_fetch_assoc($dane)){
                array_push($wynikiWykres, array('c' => array(
                  array('v' => array_sum(array_column($wyniki, 'Netto'))), 
                  array('v' => array_sum(array_column($wyniki, 'Brutto')))))); 
              }
             */
            //print_r($wyniki);

               if (count($wyniki) > 0): ?>
                <table border='2'>
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
                  </tbody>
                </table>
                <?php endif; 

            }
            
            ?>