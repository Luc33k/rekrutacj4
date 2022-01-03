<?php
    require_once ('./config.php');

    $begi = $_GET['raport_start'];
    $end = $_GET['raport_end'];

    $wyniki = [];


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


         
            if( mysqli_num_rows( $dane )==0 ){
              echo '<tr><td colspan="4">No Rows Returned</td></tr>';
            }else{
              
              while( $row = mysqli_fetch_assoc( $dane )){

                $brutto = $row['netto'] + ($row['netto'] * ($row['vat']/100));

                array_push($wyniki, array('Grupa' => $row['grupNazwa'], 'Data' => $row['zamData'], 'Netto' => $row['netto'], 'Brutto' => $brutto));

                //array_push($wynikiWykres, array('Grupa' => $row['grupNazwa'], 'Netto' => $row['netto'], 'Brutto' => $brutto));

              }




              print_r($wyniki);

               if (count($wyniki) > 0): ?>
                <table class="table" id="raport">
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
                    
                    <td colspan="2">Suma: </td>
                    <td> <?php echo(array_sum(array_column($wyniki, 'Netto'))) . ' zł'; ?></td>
                    <td><?php echo(array_sum(array_column($wyniki, 'Brutto'))) . ' zł'; ?></td>
                  </tr>
                  </tbody>
                </table>
                
                <?php endif; 

            }
            
            ?>