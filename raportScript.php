<?php
    require_once ('./config.php');

    $begi = $_GET['raport_start'];
    $end = $_GET['raport_end'];

    $wyniki = [];
    $wynikiWykres = [];
    $daneTemp  = [];
    $daneWykresu = array();
    $result = [];
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
                array_push($wynikiWykres, array('Grupa' => $row['grupNazwa'], 'Netto' => $row['netto'], 'Brutto' => $brutto));
                //$wyniki[] = $row['grupNazwa'] . $row['zamData'] . $row['netto'];
                //print_r($wyniki);
              }

              //$wynikiWykres = array_sum( array_column($wyniki, 'Brutto'));
              //array_push(array_column($wynikiWykres, 'Netto') = array_sum(array_column($wynikiWykres, 'Netto'))));
              
              //array_push($wynikiWykres, array_column($wynikiWykres, 'Grupa'), array_sum(array_column($wynikiWykres, 'Netto')), array_sum(array_column($wynikiWykres, 'Brutto'))); // źle wyświetla ostatnie array
              //foreach($wynikiWykres as $wynik){
                //echo '<pre>'; print_r($wynik); echo '</pre>';
              //}
/*
              foreach ($wynikiWykres as $entry) {

                // if an entry for this user id hasn't been created in the result, add this object
                if (!isset($daneWykresu[$entry->Grupa])) {
                    $daneWykresu[$entry->Grupa] = $entry;
            
                // otherwise, iterate this object and add the values of its keys to the existing entry
                } else {
                    foreach ($entry as $key => $value) {
                        $daneWykresu[$entry->Grupa]->$key = $value;
                    }
                }
            }*/
            //$daneWykresu = array_merge($wynikiWykres[0], $wynikiWykres[1], $wynikiWykres[2], $wynikiWykres[3], $wynikiWykres[4], $wynikiWykres[5]);

            //foreach($wynikiWykres as $key -> $item){
              //$daneWykresu[$item['Grupa']][$key] = $item;
            //}
/*
            function array_merge_recursive_custom($wynikiWykres) {
              $processed = null;
              foreach ($wynikiWykres as &$subArray) {
                  if (empty($processed)) {
                      $processed = $subArray;
                      continue;
                  }
                  foreach ($subArray as $key => $value) {
                      if (is_numeric($value)) {
                          $subArray[$key] += $processed[$key];
                      }
                  }
                  $processed = $subArray;
              }
              return end($wynikiWykres);
            }
            var_dump(array_merge_recursive_custom($wyniki));*/


            //foreach($wynikiWykres as $row){
              //if(!isset($daneWykresu[$row['Grupa']]))
            //}

                      /*usort($wynikiWykres, function($a, $b) {
                        return $a['Grupa'] <=> $b['Grupa'];
                      });*/
/*
          foreach($wynikiWykres as $key => $value){
            echo $wynikiWykres[$value];
          }*/


         /* foreach($wynikiWykres as $key => $value){
            foreach($second as $value2){
                if($value['id'] === $value2['id']){
                    $first[$key]['title'] = $value2['title'];
                }               
            }
        }*/
        foreach($wynikiWykres as $values){
          $key = $values['Grupa'];
          $daneTemp[$key][] = $values;
          //$daneWykresu = call_user_func_array('array_merge', $daneTemp[$key]);
          //array_push($daneWykresu, $daneWykresu);
          //)
          //foreach($daneTemp[$key] as $value){
            //$daneTemp = call_user_func_array("array_merge", $daneTemp[$key]);
          //}
          //foreach($daneTemp[$key] as $value){
            //$daneWykresu = $value;
          //}
          //foreach($key as $value){
            //$daneWykresu = array_merge($daneWykresu, $daneTemp);
          //}
          //foreach($daneTemp as $value){
           // $daneWykresu = 
          //}
          //$daneTemp[$key][] = array_merge($daneTemp , $values);
          //foreach($values as $value){
            //$daneWykresu[$key] = array_merge($daneWykresu, $daneTemp);
          //}
        }
        

        $daneTemp = array_values($daneTemp);

        //$daneWykresu = call_user_func_array('array_merge', $daneTemp);



        foreach($daneTemp as  $value){
          $i++;
          //if(in_array($value[$i]['Grupa'] ,$daneTemp)){
            //echo ('tak');
          //};
          if($value[$i]['Grupa'] != null){
            print_r($value[$i]['Grupa']);
            echo ('działa');
          }
          //print_r($value[$i]['Grupa']);
          //$daneWykresu[$i] = call_user_func_array('array_merge', $value);
          //echo ($value[1] . '</br>');
          //$key = array_key($value);
          //$wartosc = key($value);
          //echo ($wartosc) . '</br>';
          //$daneWykresu[$key($value)] = call_user_func_array('array_merge', $value);
          //$daneWykresu = 
        }
        //foreach($daneWykresu as $key => $value){
          //echo ('działa </br>'). $value;
        //}
        /*foreach ($daneWykresu as $entry) {

          // if an entry for this user id hasn't been created in the result, add this object
          if (!isset($result[$entry->Grupa])) {
              $result[$entry->Grupa] = $entry;
      
          // otherwise, iterate this object and add the values of its keys to the existing entry
          } else {
              foreach ($entry as $key => $value) {
                  $result[$entry->Grupa]->$key = $value;
              }
          }
      }*/
        //foreach($daneWykresu as $value){
          //$key = $value['Grupa'];
          //$daneWykresu = call_user_func_array('array_merge', $key);
        //}
       

        //foreach($daneTemp as $value){
          //$daneWykresu[] = array_merge($daneWykresu, $value);
        //}

              echo '<pre>'; print_r($daneTemp); echo '</pre>';



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