<?php

    require_once("system/data.php");
	require_once("system/security.php");
?>

    <!DOCTYPE html>
    <html class="with-statusbar-overlay">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <title>Luisa - Die Namensapp</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/framework7/1.4.2/css/framework7.ios.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/framework7/1.4.2/css/framework7.ios.colors.min.css">
        <link rel="stylesheet" href="css/style.css">

    </head>


    <body>
        <div class="section">

            <div class="registrieren topbar">
                <div class="txt_topbar">Duell beendet</div>
            </div>

            <div class="formline">
                Dein Favorit heisst
            </div>

            <div class="heart_win">
                <div class="winner">
                    <?php $name = $_GET["name"]; 
                    echo $name;
                      $duell_id = $_GET["duell_id"];
                    ?>
                </div>
            </div>

            <div class="duell_bottom_einst" style="background-color:white;">
           
            </div>

            <div class="duell_bottom">
                <input type="submit" class="submit" value="Endresultat" onclick="liste();">
            </div>

        </div>
        <!-- section -->


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/framework7/1.4.2/js/framework7.min.js"></script>
        <?php   
          session_start(); 
    if (isset($_SESSION["currentUser"])) { 
    ?>
            <script>
                function liste() {
                    window.location.href = 'list-admin.php?duell_id=<?php echo $duell_id; ?>';

                }
            </script>
            <?php
         } else { ?>
                <script>
                    function liste() {
                        window.location.href = 'list.php?duell_id=<?php echo $duell_id; ?>';
                    }
                </script>
                <?php } ?>
    </body>


    </html>