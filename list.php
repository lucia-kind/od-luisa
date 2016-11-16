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
        <?php  
        $duell_id = $_GET["duell_id"];
                    //aus der url
                 $sql = "SELECT namensliste, dauer, url FROM duell WHERE id = $duell_id;";
                    //hole alle namen im duell und dauer
                        $duell = get_result($sql)->fetch_array();
                    //als array
                    //erkenne den array durch json_decode
                        $duell_array = json_decode($duell['namensliste']);
                    //und berechne die dauer aus dem enddatum
                    $duell_dauer= strtotime($duell['dauer']); //Enddatum              
                    $timefromdb = strtotime(date('Y-m-d'));
                    $timeleft = $duell_dauer-$timefromdb;
                    $daysleft = round((($timeleft/24)/60)/60); //runde auf Tage 
                    $url = $duell['url'];
        
        ?>

    </head>

    <body>
        <div id="orr"></div>
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
                        <div id="name01" class="item-media">Duell noch
                            <?php echo $daysleft?> Tage</div>
                    </div>
                    <div class="swipeout-actions-right">
                           <a style="color:black; background-color:#D7FFF8;" href="#" class="action1"> <button id="copy-button" class="" data-clipboard-target="#post-shortlink">   <!--target-->
                            <input id="post-shortlink" value="<?php echo $url; ?>">Link kopieren</button></a>
                    </div>
                </li>
                <!--hier kommt php -->
                <!-- Listenansicht -->
                <?php 
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
        <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>


        <script>
            //ZWISCHENABLAGE LINK
            (function () {
                new Clipboard('#copy-button');
            })();
        </script>
               
        <script>
                        jQuery(function($) {
                        $('body').bind('orientationchange', function(e) {
                            check_orientation();
                        });

                        check_orientation();
                        });
                            var check_orientation = function() {
                            if(typeof window.orientation == 'undefined') {
                                //not a mobile 
                                return true;
                            }
                            if(Math.abs(window.orientation) != 0) {
                                //landscape mode
                                $('#orr').fadeIn().bind('touchstart', function(e) {
                                    e.preventDefault();
                                });
                                alert("Bitte drehen sie das Gerät");
                                return false;
                            }
                            else {
                                //portrait mode
                                $('#orr').fadeOut();
                                return true;
                            }
                        };
        </script>
        

    </body>

    </html>