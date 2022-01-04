<?php
    require_once ('./config.php');



    $daneTemp  = [];
    $result = [];

 

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

         

    if( mysqli_num_rows( $dane )==0 ){
        echo '<tr><td colspan="4">No Rows Returned</td></tr>';
    }else{
              
        while( $row = mysqli_fetch_assoc( $dane )){

            $brutto = $row['netto'] + ($row['netto'] * ($row['vat']/100));
            array_push($result, array('Grupa' => $row['grupNazwa'], 'Rok' => $row['zamData'], 'Netto' => $row['netto'], 'Brutto' => $brutto));
        }



        $daneTemp = array_values($result);



        foreach($daneTemp as &$d){
            $d['Rok'] = (substr($d['Rok'], 0, 4));
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
                $a[$b['Grupa']] = $b;
            }
            return $a;
        });



        if (count($sum) > 0): ?>
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
                    <?php foreach ($sum as $row): array_map('htmlentities', $row); ?>
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
    }
?>