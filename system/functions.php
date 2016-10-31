<?php //Einstellungsübermittlung
    $hauf ="";
    $anfang="";
    $nachname="";
    $max="";
    $min="";
    $geschlecht="";

if(isset($_POST['SubmitButton'])){ //check if form was submitted
    $hauf = $_POST['Häufigkeit'];//Achtung: wie berechnen wir die?
    $anfang = $_POST["abuchstabe"];
    $nachname = $_POST["vname"];//What tun wir damit?
    $max = $_POST["maxi"];
    $min = $_POST["mini"];
    $geschlecht = $_POST["geschlecht"];
    update_namelist($hauf, $anfang, $max, $min, $geschlecht);
}

function update_namelist($hauf, $anfang, $max, $min, $geschlecht)
  {
    $sql_ok = false;
    $sql = "SELECT vorname FROM baby WHERE";//baby oder hund?
    if($anfang != ""){
      $sql .= "'vorname' LIKE '$anfang'% AND ";
      $sql_ok = true;
    }
    if($max != ""){
      $sql .= "CHAR_LENGTH(vorname) <= '$max' AND ";
      $sql_ok = true;
    }
    if($min != ""){
      $sql .= "CHAR_LENGTH(vorname) >= '$min' AND ";
      $sql_ok = true;
    }
    if($geschlecht != ""){
      $sql .= "geschlecht = '$geschlecht' AND ";
      $sql_ok = true;
    }
    
    $sql = substr_replace($sql, ' ', -4);

    $sql .= ";";

    if($sql_ok){
      $result = get_result($sql);
    }else {
      console.log("FEHLERFEHLERFEHLER. Aber keine Panik. Wir schaffen das.");
    }
  }
?>