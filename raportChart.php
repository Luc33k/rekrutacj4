<?php
    require_once ('./config.php');

    $begi = $_GET['raport_start'];
    $end = $_GET['raport_end'];


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

      

?>