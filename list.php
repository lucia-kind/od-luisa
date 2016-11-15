<?php
	require_once("system/data.php");
	require_once("system/security.php");
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title>Luisa - die Namensapp</title>
        <link rel="stylesheet" href="css/style.css">
        <!-- Path to Framework7 Library CSS-->
        <link rel="stylesheet" href="css/framework7.ios.min.css">
        <!-- Path to your custom app styles-->
        <link rel="stylesheet" href="css/my-app.css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

    </head>

    <body>
        <!-- On right side -->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="left">Zwischenstand</div>
            </div>
            <!-- navbar-inner -->
        </div>
        <!-- navbar -->
        <div class="list-block">
            <ul>
                <!-- one element -->
                <li class="swipeout">
                    <div class="swipeout-content item-content duell_bg">
                        <div id="name01" class="item-media">Duell noch 2 Tage</div>
                    </div>
                    <div class="swipeout-actions-right">
                        <!-- Add this button and item will be deleted automatically -->
                        <a style="color:black; background-color:#D7FFF8;" href="#" class="action1">teilen</a>
                    </div>
                </li>
                <!--hier kommt php -->
                <!-- Listenansicht -->
                <?php 
                        $duell_id = $_GET["duell_id"];
                    //aus der url
                        $sql = "SELECT namensliste FROM duell WHERE id = $duell_id;";
                    //hole alle namen im duell
                        $duell = get_result($sql)->fetch_array();
                    //als array
                        $duell_array = json_decode($duell['namensliste']);
                    //erkenne den array durch json_decode
                        $query = "SELECT win_name, COUNT(win_name) as herzen FROM wins WHERE duell_id = $duell_id GROUP BY win_name;";
                    //finde alle gewinnernamen zu dieser duell id und groupiere sie
                        $hearts_result = get_result($query);
                        $hearts = mysqli_fetch_all($hearts_result);

      
      while (list ($key, $val) = each ($duell_array) )  {
          //für jeden namen im duell_array
          $i = 0;
          $number = 0;
          while ($i < count($hearts)) {
              //wenn i kleiner herzensarray
          if($val == $hearts[$i][0]){
              //falls der name dem namen in den herzen entspricht
              $number = $hearts[$i][1];
               $i++;
            
          } else { $i++; }
          }
        
          echo "<li class='swipeout'><div class='swipeout-content item-content'><div class='item-media'>".$val."</div><div class='item-after'><span class='badge bg-green'>".$number."</span></div></li>"; 
      }
                        ?>

            </ul>
        </div>
        <!-- Path to Framework7 Library JS-->
        <script type="text/javascript" src="js/framework7.min.js"></script>
        <!-- Path to your app js-->
        <script type="text/javascript" src="js/my-app.js"></script>

    </body>

    </html>