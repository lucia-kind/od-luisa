<?php //Einstellungsübermittlung
    $hauf ="";
    $anfang="";
    $nachname="";
    $max="";
    $min="";
    $geschlecht="";
 if(isset($_GET["typ"])) {
    $type = $_GET["typ"];
 } else {
     $type = "not defined";
 }

if(isset($_POST['SubmitButton'])){ //check if form was submitted
    $hauf = $_POST['Häufigkeit'];//Achtung: wie berechnen wir die?
    $anfang = $_POST["abuchstabe"];
    $nachname = $_POST["vname"];//What tun wir damit?
    $max = $_POST["maxi"];
    $min = $_POST["mini"];
    if(isset($_POST["geschlecht"])) {
       $geschlecht = $_POST['geschlecht'];
        }
    update_namelist($type, $hauf, $anfang, $max, $min, $geschlecht);
}



function update_namelist($type, $hauf, $anfang, $max, $min, $geschlecht)
  {
    $sql_ok = false;
    $sql ="";
    if($hauf != ""){
        if($hauf== "sehr beliebt"){
            $sql .= "SELECT name
                    FROM    (
                        SELECT hunde_merge_name_anzahl.*, @counter := @counter +1 AS counter
                        FROM (select @counter:=0) AS initvar, hunde_merge_name_anzahl
                        ORDER BY anzahl DESC   
                    ) AS X
                    where counter <= (33/100 * @counter) AND ";
                      $sql_ok = true;            
        }
        else if($hauf== "beliebt"){
             $sql .= "SELECT name
                    FROM    (
                        SELECT hunde_merge_name_anzahl.*, @counter := @counter +1 AS counter
                        FROM (select @counter:=0) AS initvar, hunde_merge_name_anzahl
                        ORDER BY anzahl DESC   
                    ) AS X
                    where counter <= (66/100 * @counter) AND counter >= (33/100 * @counter) AND ";
                      $sql_ok = true;    
            
        } else if($hauf=="selten"){
            $sql .= "SELECT name
                    FROM    (
                        SELECT hunde_merge_name_anzahl.*, @counter := @counter +1 AS counter
                        FROM (select @counter:=0) AS initvar, hunde_merge_name_anzahl
                        ORDER BY anzahl ASC   
                    ) AS X
                    where counter <= (33/100 * @counter) AND ";
                      $sql_ok = true;            
        }
    }
    if($anfang != ""){
      $sql .= "name LIKE '$anfang%' AND ";
      $sql_ok = true;
    }
    if($max != ""){
      $sql .= "CHAR_LENGTH(name) <= $max AND ";
      $sql_ok = true;
    }
    if($min != ""){
      $sql .= "CHAR_LENGTH(name) >= $min AND ";
      $sql_ok = true;
    }
    if($geschlecht != ""){
      $sql .= "geschlecht = '$geschlecht' AND ";
      $sql_ok = true;
    }
    
    $sql = substr_replace($sql, '', -4);

    $sql .= "ORDER BY anzahl DESC;";

    if($sql_ok){
        return get_result($sql);
    }else {
        $sql = "SELECT name FROM hunde_merge_name_anzahl ORDER BY RAND() LIMIT 20;"; //Limit später weg
     return get_result($sql);
    }
  }
?>