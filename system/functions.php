<?php //Einstellungsübermittlung
function update_namelist($type, $hauf, $anfang, $max, $min, $geschlecht)
  {
    $sql_ok = false;
    $sql ="";
    $removeAnd = false;
     $removeWhere = false;
        if($hauf == "" && $type == "hund"){
            $sql .= "SELECT name, id FROM hunde_merge_name_anzahl WHERE ";
             $removeWhere = true;
            $sql_ok = "true";
        } if($hauf == "" && $type == "baby"){
             $removeWhere = true;
            $sql .= "SELECT name, id FROM baby_merge_vorname_anzahl WHERE ";
            $sql_ok = "true";
        }
        if($hauf== "haeufig" && $type == "hund"){
            $removeAnd = true;
             $removeWhere = false;
            $sql .= "SELECT name
                    FROM    (
                        SELECT hunde_merge_name_anzahl.*, @counter := @counter +1 AS counter
                        FROM (select @counter:=0) AS initvar, hunde_merge_name_anzahl
                        ORDER BY anzahl DESC   
                    ) AS X
                    where counter <= (33/100 * @counter) AND ";
                      $sql_ok = true;            
        } else if($hauf== "haeufig" && $type == "baby"){
            $removeAnd = true;
             $removeWhere = false;
            $sql .= "SELECT name
                    FROM    (
                        SELECT baby_merge_vorname_anzahl.*, @counter := @counter +1 AS counter
                        FROM (select @counter:=0) AS initvar, baby_merge_vorname_anzahl
                        ORDER BY anzahl DESC   
                    ) AS X
                    where counter <= (33/100 * @counter) AND ";
                      $sql_ok = true;            
        }
        else if($hauf== "regulaer" && $type == "hund"){
             $removeAnd = true;
             $removeWhere = false;
             $sql .= "SELECT name
                    FROM    (
                        SELECT hunde_merge_name_anzahl.*, @counter := @counter +1 AS counter
                        FROM (select @counter:=0) AS initvar, hunde_merge_name_anzahl
                        ORDER BY anzahl DESC   
                    ) AS X
                    where counter <= (66/100 * @counter) AND counter >= (33/100 * @counter) AND ";
                      $sql_ok = true;    
            
        } else if($hauf== "regulaer" && $type == "baby"){
             $removeAnd = true;
             $removeWhere = false;
             $sql .= "SELECT name
                    FROM    (
                        SELECT baby_merge_vorname_anzahl.*, @counter := @counter +1 AS counter
                        FROM (select @counter:=0) AS initvar, baby_merge_vorname_anzahl
                        ORDER BY anzahl DESC   
                    ) AS X
                    where counter <= (66/100 * @counter) AND counter >= (33/100 * @counter) AND ";
                      $sql_ok = true;    
            
        } else if($hauf=="selten" && $type == "hund"){
             $removeAnd = true;
             $removeWhere = false;
            $sql .= "SELECT name
                    FROM    (
                        SELECT hunde_merge_name_anzahl.*, @counter := @counter +1 AS counter
                        FROM (select @counter:=0) AS initvar, hunde_merge_name_anzahl
                        ORDER BY anzahl ASC   
                    ) AS X
                    where counter <= (33/100 * @counter) AND ";
                      $sql_ok = true;            
        } else if($hauf=="selten" && $type == "baby"){
             $removeAnd = true;
             $removeWhere = false;
            $sql .= "SELECT name
                    FROM    (
                        SELECT baby_merge_vorname_anzahl.*, @counter := @counter +1 AS counter
                        FROM (select @counter:=0) AS initvar, baby_merge_vorname_anzahl
                        ORDER BY anzahl ASC   
                    ) AS X
                    where counter <= (33/100 * @counter) AND ";
                      $sql_ok = true;            
        }
    if($anfang != ""){
         $removeAnd = true;
         $removeWhere = false;
      $sql .= "name LIKE '$anfang%' AND ";
      $sql_ok = true;
    }
    if($max != ""){
         $removeAnd = true;
         $removeWhere = false;
      $sql .= "CHAR_LENGTH(name) <= $max AND ";
      $sql_ok = true;
    }
    if($min != ""){
         $removeAnd = true;
         $removeWhere = false;
      $sql .= "CHAR_LENGTH(name) >= $min AND ";
      $sql_ok = true;
    }
    if($geschlecht != ""){
        $removeAnd = true;
         $removeWhere = false;
      $sql .= "geschlecht = '$geschlecht' AND ";
      $sql_ok = true;
    }
    
    if($removeAnd) $sql = substr_replace($sql, '', -4);
    if($removeWhere) $sql = substr_replace($sql, '', -6);

    $sql .= "ORDER BY RAND();";

    if($sql_ok){
        return get_result($sql);
    }else if($type == "hund"){
        $sql = "SELECT name, id FROM hunde_merge_name_anzahl ORDER BY RAND() LIMIT 20;"; //Limit später weg
     return get_result($sql);
    }
    else if($type == "baby"){
        $sql = "SELECT name, id FROM baby_merge_vorname_anzahl ORDER BY RAND() LIMIT 20;"; //Limit später weg
     return get_result($sql);
    }
  }
?>