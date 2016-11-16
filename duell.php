<?php 
    require_once("system/data.php");
    require_once("system/security.php");
    require_once("system/functions.php");
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

        <?php   
          session_start(); 
    if (isset($_SESSION["currentUser"])) { 
        if(isset($_GET['duell_id'])){
            $duell_id = $_GET["duell_id"];
            $sql_link = "SELECT url FROM duell WHERE id = $duell_id;";
            $url = get_result($sql_link);
            $url_link = mysqli_fetch_assoc($url);
            
        }
       
        if(isset($_POST['SubmitButton'])){ //check if form was submitted
            $duell_id = $_GET["duell_id"];
                              
                    
            $dauer = $_POST['dateTo'];
            $duell_dauer = strtotime($dauer);
            $currenttime = strtotime(date('Y-m-d'));
            $timeleft = $duell_dauer-$currenttime;
            $daysleft = round((($timeleft/24)/60)/60); //runde auf Tage 
           $id = $_SESSION["currentUser"]['user_id'];
            if($daysleft < 1) { ?>
            <script>
                alert('Dein Duell muss mindestens einen Tag lang daueren.');
            </script>
            <?php
            } else {
           $query ="UPDATE duell SET `dauer`= '$dauer' WHERE id = $duell_id;";
            get_result($query); 
           
            ?>
                <script>
                    window.location.href = 'duellmode.php?duell_id=<?php echo $duell_id; ?>';
                </script>
                <?php  
            }
        }
          
        ?>

    </head>

    <body>
        <form method="post">

            <div class="section">

                <div class="registrieren topbar">
                    <div class="txt_topbar">Duell</div>
                </div>

                <div class="formline">
                </div>

                <div class="formline">
                </div>

                <div class="formline">
                    <div style="margin: 0!important;" class="list-block">
                        <div class="item-content date_picker">
                            <input id="date" type="date" name="dateTo" value="<?php echo date('Y-m-d'); ?>" text="Dauer"/>
                        </div>
                    </div>
                    <!-- page-content -->
                </div>

                <div class="formline duell_link">
                </div>

                <div class="formline">
                    <!--target-->
                    <button id="copy-button" class="button_duell" data-clipboard-target="#post-shortlink">Link in Zwischenablage kopieren</button>
                </div>

                <div class="formline">
                    <!--Link-->
                    <input id="post-shortlink" value="<?php echo $url_link['url']; ?>">
                </div>

                <div class="formline duell_link">
                </div>

                <div class="formline">
                </div>

                <div class="duell_bottom_einst">
                    <input class="duell_starten" type="submit" id="SubmitButton" name="SubmitButton" value="Duell starten" />
                </div>

            </div>
        </form>

        <!-- section -->

        <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>


        <script>
            (function () {
                new Clipboard('#copy-button');
            })();
        </script>
        <?php
         } else {
        print_r($_SESSION["currentUser"]);
        echo "Bitte erst einloggen, <a href='login.php'>hier</a>.";
    }
        ?>

        <!-- Browserübergreifend Date-Picker -->
        <script>
            if ( $('#date')[0].type != 'date' ) $('#date').datepicker();
        </script>
        
    </body>

    </html>