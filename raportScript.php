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
    ");*/

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
    ");

    if($dane->num_rows > 0){
        //echo "<tr>";
        //while($row = $produkty->fetch_assoc()){
        //    echo "tr";
        //    echo "id: " . $row["id"]. " id_grupa: " . $row["id_grupa"]. " Nazwa: ". $row['nazwa']. " netto: ". $row['cena_netto']. " VAT: ". $row['vat'] ;
        //}
        //echo"</tr>";

        ?>
        <table border="2">
        <thead>
          <tr>
            <th>Grupa</th>
            <th>Dzień</th>
            <th>Kwota netto</th>
            <th>Kwota Brutto</th>
          </tr>
        </thead>
        <tbody>
          <?php
    
            if( mysqli_num_rows( $dane )==0 ){
              echo '<tr><td colspan="4">No Rows Returned</td></tr>';
            }else{

              while( $row = mysqli_fetch_assoc( $dane )){
              $brutto = $row['netto'] + ($row['netto'] * ($row['vat']/100));
                echo "<tr><td>{$row['grupNazwa']}</td><td>{$row['zamData']}</td><td>{$row['netto']}</td><td>{$brutto}</td></tr>\n";
                //echo ($row['vat'] * $row['netto']);
              }

          ?>
        </tbody>
      </table>
      <?php
    }
}

?>