<?php
    require_once ('./config.php');

    //$grupy = $conn->query("SELECT * FROM grupy_produktow");
    //$produkty = $conn->query("SELECT * FROM produkty");
    //$zamowienia = $conn->query("SELECT * FROM zamowienia");

    //$dane = $conn->query("SELECT * FROM grupy_produktow INNER JOIN produkty ON grupy_produktow.id = produkty.id_grupa");
    /*
    $dane = mysqli_query($conn,"SELECT 
    
    produkty.id AS produktyID,
    produkty.id_grupa AS produktyIdGrupy,
    produkty.nazwa AS produktyNazwa,
    produkty.cena_netto AS produktyNetto,
    produkty.vat AS produktyVat,
    grupy_produktow.id AS grupProdID,
    grupy_produktow.nazwa AS GrupyProdNazw,
    zamowienia.id AS zamowieniaId.
    zamowienia.numer_zamowienia AS zamowieniaNrZam,
    zamowienia.data AS zamData,
    zamowienia.ilosc AS zamIlos,
    zamowienia.id_produkt AS zamIdProd
    FROM produkty
    WHERE zamData BETWEEN $begi AND $end
    WHERE zamData BETWEEN $startDate AND $endDate
       WHERE zamData = $startDate
       WHERE zamowienia.data = $testDate

           WHERE zamowienia.data BETWEEN strval($begi) AND strval($end)
    ");*/


    $begi = $_GET['raport_start'];
    $end = $_GET['raport_end'];

    #$startDate = date(date_create_from_format('Y-m-d', $begi));
    #$endDate = date(date_create_from_format('Y-m-d', $end));


    #$startDate = date('Y-m-d', $begi);
    #$endDate = date('Y-m-d', $end);

    $testDate = strval('2019-01-01');

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
    ORDER BY zamData, grupNazwa DESC
    ");


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
        <tbody>";
         
            if( mysqli_num_rows( $dane )==0 ){
              echo '<tr><td colspan="4">No Rows Returned</td></tr>';
            }else{
              while( $row = mysqli_fetch_assoc( $dane )){

                $brutto = $row['netto'] + ($row['netto'] * ($row['vat']/100));
                echo "<tr><td>{$row['grupNazwa']}</td><td>{$row['zamData']}</td><td>{$row['netto']}</td><td>{$brutto}</td></tr>\n";
              }
              
         echo'
        </tbody>
      </table>
              ';
      }
    

?>