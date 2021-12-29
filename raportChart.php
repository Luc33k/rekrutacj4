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




            /*
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
            
            foreach($wynikiWykres as $rodzajGrupy){
              foreach($rodzajGrupy as $Grupa => $values){
                $daneWykresu[$Grupa] = $values;
                $daneWykresu[$Grupa] = array_merge($daneWykresu[$Grupa], $values);
              }
            }

            foreach($wynikiWykres as $key => $val){
              $valkey = key($val);
              if(isset($daneTemp[$valkey])){
                $daneWykresu[] = array_merge($daneTemp[$valkey], $val[$valkey]);
              }
              else{
                $daneTemp[$valkey] = $val[$valkey];
              }
            }

            foreach($wynikiWykres as $tat){

            }

            public static function getAll()
            {
              $usergroup['groups'] = self::find();
              $usergroup['lang'] = self::findInTable(array(
                'id_lang' => Language_Model::getDefaultLanguage()
              ), self::dbTranslationTable);
              $out = array();
              foreach ($usergroup['groups'] as $key => $value) {
                $out[] = (object) array_merge((array) $usergroup['lang'][$key], (array) $value);
              }
              return $out;
}
*/
            //$daneWykresu = call_user_func_array('array_merge', $wynikiWykres);



              //array_push($values, array("year" => "2013", "newbalance" => "50"));
              //array_push($values, array("year" => "2014", "newbalance" => "90"));
              //array_push($values, array("year" => "2015", "newbalance" => "120"));

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