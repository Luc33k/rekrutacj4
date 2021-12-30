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




              /*
          foreach ($daneTemp as $entry) {
            $i++;
            // if an entry for this user id hasn't been created in the result, add this object
            if (in_array($daneWykresu, $entry[$i]['Grupa'])) {
                $daneWykresu[$entry->Grupa] = $entry;
        
            // otherwise, iterate this object and add the values of its keys to the existing entry
            } else {
                foreach ($daneWykresu as $key => $value) {
                    $daneWykresu[$entry-> Grupa]->$key = $value;
                }
            }
        }
*/

*
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
        //foreach($wynikiWykres as $values){
          //$key = $values['Grupa'];
          //$daneTemp[$key][] = $values;
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
        //}
        

       // $daneTemp = array_values($daneTemp);

        //$daneWykresu = call_user_func_array('array_merge', $daneTemp);



        /*foreach($daneTemp as  $value){
          $i++;
          //if(in_array($value[$i]['Grupa'] ,$daneTemp)){
            //echo ('tak');
          //};
          if($value[$i]['Grupa'] != null){
            print_r($value[$i]['Grupa']);
            echo ('działa');
          }*/


          //$result = call_user_func_array('array_merge', $daneTemp[0]);
          //print_r($value[$i]['Grupa']);
          //$daneWykresu[$i] = call_user_func_array('array_merge', $value);
          //echo ($value[1] . '</br>');
          //$key = array_key($value);
          //$wartosc = key($value);
          //echo ($wartosc) . '</br>';
          //$daneWykresu[$key($value)] = call_user_func_array('array_merge', $value);
          //$daneWykresu = 
        //}
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

        //$daneWykresu = array_sum(array_column($daneTemp, 'Grupa'));


/*
foreach ($daneTemp as $k=>$subArray) {
  foreach ($subArray as $id=>$value) {
    $result[$id]+=$value;
  }
}

foreach($daneTemp as $key => $value){
  //echo ('tak</br>');
  $k = $value['Grupa'];
  $value = array_merge($value, array($k));
  //print_r( json_encode($value));
}

foreach ($daneTemp as $key => $entry) {
  $k = $entry['Grupa'];
  // if an entry for this user id hasn't been created in the result, add this object
  if (!isset($result[$k])) {
      $result[$k] = $entry;

  // otherwise, iterate this object and add the values of its keys to the existing entry
  } else {
      foreach ($entry as $key => $value) {
          $result[$entry->user_id]->$key = $value;
      }
  }
}*/