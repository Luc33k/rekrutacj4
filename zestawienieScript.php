<?php
    require_once ('./config.php');

    //$begi = $_GET['raport_start'];
    //$end = $_GET['raport_end'];

    $wyniki = [];
    $wynikiWykres = [];
    $daneTemp  = [];
    $daneWykresu = array();
    $result = [];
    $values = [];
    //$testDate = strval('2019-01-01');
    $wyn = [];
    $win = [];
    $tak = [];
    $out=array();
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
                //array_push($wyniki, array('Grupa' => $row['grupNazwa'], 'Data' => $row['zamData'], 'Netto' => $row['netto'], 'Brutto' => $brutto));
                //array_push($wyniki, array($row['grupNazwa'], $row['zamData'], $row['netto'], $brutto));
                array_push($wynikiWykres, array('Grupa' => $row['grupNazwa'], 'Netto' => $row['netto'], 'Brutto' => $brutto));
                //$wyniki[] = $row['grupNazwa'] . $row['zamData'] . $row['netto'];
                //print_r($wyniki);
                array_push($result, array('Grupa' => $row['grupNazwa'], 'Rok' => $row['zamData'], 'Netto' => $row['netto'], 'Brutto' => $brutto));
                array_push($wyniki, array('Grupa' => $row['grupNazwa'], 'Netto' => $row['netto']));

              }

              //$wynikiWykres = array_sum( array_column($wyniki, 'Brutto'));
              //array_push(array_column($wynikiWykres, 'Netto') = array_sum(array_column($wynikiWykres, 'Netto'))));
              
              array_push($wynikiWykres, array_column($wynikiWykres, 'Grupa'), array_sum(array_column($wynikiWykres, 'Netto')), array_sum(array_column($wynikiWykres, 'Brutto'))); // źle wyświetla ostatnie array



                      /*usort($wynikiWykres, function($a, $b) {
                        return $a['Grupa'] <=> $b['Grupa'];
                      });*/


        $daneTemp = array_values($result);
        //print_r($daneTemp);
        //echo (json_encode($daneTemp[0]));


//print_r($wynikiWykres);

    foreach($daneTemp as &$d){
        //print_r(substr($r['Rok'], 0, 4));
        //print_r($result[$r]);
        //print_r($result[$r]);
        $d['Rok'] = (substr($d['Rok'], 0, 4));
        //print_r($d["Rok"]);
        //print_r($r['Rok']);
    }

    foreach ($daneTemp as $entry) {

        // if an entry for this user id hasn't been created in the result, add this object
        if (!isset($out[$entry->Grupa])) {
            $out[$entry->Grupa] = $entry;
    
        // otherwise, iterate this object and add the values of its keys to the existing entry
        } else {
            foreach ($entry as $key => $value) {
                $out[$entry->Grupa]->$key = $value;
            }
        }
    }


    $sum = array_reduce($daneTemp, function ($a, $b) {
        //isset($a[$b['Grupa']]) ? $a[$b['Grupa']]['Netto'] += $b['Netto'] : $a[$b['Grupa']] = $b;  
        //isset($a[$b['Rok']]) ? $a[$b['Rok']]['Netto'] += $b['Netto'] and $a[$b['Rok']]['Brutto'] += $b['Brutto'] : $a[$b['Rok']] = $b;
        //isset($a[$b['Grupa']]) ? $a[$b['Grupa']]['Netto'] += $b['Netto'] and $a[$b['Grupa']]['Brutto'] += $b['Brutto'] : $a[$b['Grupa']] = $b; 
        //isset($a[$b['Rok']]) ? $a[$b['Rok']]['Netto'] += $b['Netto'] and $a[$b['Rok']]['Brutto'] += $b['Brutto'] : $a[$b['Rok']] = $b;
        //isset($a[$b['Grupa']]) ? $a[$b['Grupa']]['Netto'] += $b['Netto'] and $a[$b['Grupa']]['Brutto'] += $b['Brutto'] : $a[$b['Grupa']] = $b; 
        if(isset($a[$b['Grupa']])){
            //if(isset($a[$b['Rok']])){
                $a[$b['Grupa']]['Netto'] += $b['Netto'];
                $a[$b['Grupa']]['Brutto'] += $b['Brutto'];
            //}else{
                //echo('tak');
              //  print_r($b);
                //$a[$b['Rok']] = $b;
            //}
            
        }else{
            //echo(;)
            $a[$b['Grupa']] = $b;
        }
        return $a;
    });

    /*
    foreach($sum as $s){
        $out[$s['Grupa']]['Grupa']=$s['Grupa'];
        $out[$s['Grupa']]['Rok']=$s['Rok'];
        $out[$s['Grupa']]['Netto']=$s['Netto'];
        $out[$s['Grupa']]['Brutto']=$s['Brutto'];
        //$out[$s['Grupa']]['details'][]=array('line'=>$x['line'],'value'=>$x['value']);
    }*/
    //print_r($out);
    //$sum = array_sum(array_column($sum))

    $wyn = array_reduce($sum, function ($a, $b) {
        //isset($a[$b['Grupa']]) ? $a[$b['Grupa']]['Netto'] += $b['Netto'] : $a[$b['Grupa']] = $b;  
        isset($a[$b['Grupa']]) ? $a[$b['Grupa']]['Rok'] += $b['Rok'] : $a[$b['Grupa']] = $b;  
        return $a;
    });

    //print_r($daneTemp);

    $values = array_values($sum);


    foreach($result as &$r){
        //print_r(substr($r['Rok'], 0, 4));
        //print_r($result[$r]);
        //print_r($result[$r]);
        $r['Rok'] = (substr($r['Rok'], 0, 4));
        //print_r($r['Rok']);
    }

    //print_r($result);
/*
    $tak = array_reduce($result, function($a, $b){
        isset($a[$b['Rok']]) ? $a[$b['Rok']]['Netto'] += $b['Netto'] and $a[$b['Rok']]['Brutto'] += $b['Brutto'] : $a[$b['Rok']] = $b;
        return $a;
    });
*/
    //print_r($tak);
    //$tak = array_sum(array_column($result, "Rok"));
    //print_r($tak);


    print_r($out);

function array_flatten($array) {

    $return = array();
    foreach ($array as $key => $value) {
        if (is_array($value)){ $return = array_merge($return, array_flatten($value));}
        else {$return[$key] = $value;}
    }
    return $return;
 
 }

$win = array_flatten($sum);
//print_r($result);
// convert data into JSON format
//$jsonTable = json_encode($table);
//print_r( json_encode( $table['rows']));
//print_r($result);
//$jsonTable1 = json_encode($wyniki);
//echo $jsonTable1;
//echo $jsonTable;
    //$values = call_user_func_array('array_merge', $daneTemp);
    //print_r($result);
//var_dump($wyn);
    //array_push($values, array("year" => "2013", "newbalance" => "50"));
    //array_push($values, array("year" => "2014", "newbalance" => "90"));
    //array_push($values, array("year" => "2015", "newbalance" => "120"));

              //echo '<pre>'; print_r($values); echo '</pre>';
              //print json_encode($values);
              //echo (json_encode($values));
     if (count($daneTemp) > 0): ?>
                <table class="table table-bordered" id="raport">
            <thead>
                <tr>
                    <th rowspan="4">Grupa</th>
                </tr>
                <tr>
                    <th colspan="6">Lata</th>
                </tr>
                <tr>
                    <th colspan="2">2019</th>
                    <th colspan="2">2020</th>
                    <th colspan="2">2021</th>
                </tr>
                <tr>
                    <th>Netto</th>
                    <th>Brutto</th>
                    <th>Netto</th>
                    <th>Brutto</th>
                    <th>Netto</th>
                    <th>Brutto</th>
                </tr> 
            </thead>
            <tbody>
            <?php foreach ($daneTemp as $row): array_map('htmlentities', $row); ?>
                <tr>
                    
                      <td><?php echo implode('</td><td>', $row); ?></td>
                    </tr>
                <?php endforeach ?>
                <tr>  
                    <td>Suma: </td>
                    <td> </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
                
                <?php endif; 

        ?>
            
                
                
        <?php
            }
            
            ?>