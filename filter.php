<?php
	require_once("system/data.php");
	require_once("system/security.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Luisa - Die Namensapp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/style.css">
    
    <div class="section">
        
        <div class="topbar">
            <div class="txt_topbar">Einstellungen</div>
        </div>
        
        <div class="formline">
            <input type="text" placeholder="Nachname" id="vname" name="vname">
        </div>
        
        <div class="formline">
            <input type="text" placeholder="Anfangsbuchstabe" id="abst" name="abuchstabe">
        </div>
    
        <div class="formline">
             <input type="checkbox" id="mw" name="alter"> m
             <input type="checkbox" id="wm" name="alter"> w
        </div>
    
        <div class="formline">
            Maximal <input type="text" placeholder="x" id="minimaxi" name="maxi"> Zeichen
        </div>
    
        <div class="formline">
            Minimal <input type="text" placeholder="x" id="minimaxi" name="mini"> Zeichen
        </div>
    
        <div class="formline">
            
            <select id="dropdown"name="Häufigkeit">
                <option value="häufigkeit">Häufigkeit</option>
                <option value="sehr beliebt">Sehr beliebt</option>
                <option value="beliebt">Beliebt</option>
                <option value="selten">Selten</option>
                <option value="sehr selten">Sehr selten</option>
            </select>
    
        </div>
    
        <div class="formline">
        </div>
        <div class="formline">
        </div>
        
        <div class="tickbox">
        <a href="startscreen.php">tick me</a>
        </div>
    
    </div> <!-- section -->

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

</head>
<body>

</body>
</html>