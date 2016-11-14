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
        <title>Calendar</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/framework7/1.4.2/css/framework7.ios.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/framework7/1.4.2/css/framework7.ios.colors.min.css">
        <link rel="stylesheet" href="css/style.css">

        <?php   
          session_start(); 
    if (isset($_SESSION["currentUser"])) { 
       
        if(isset($_POST['SubmitButton'])){ //check if form was submitted
             $duell_id = $_GET["duell_id"];
           $dauer = $_POST['dateTo'];
           $id = $_SESSION["currentUser"]['user_id'];
           $query ="UPDATE duell SET `dauer`= '$dauer', `url` = 'duellmode.php?duell_id=$duell_id' WHERE id = $duell_id;";
            get_result($query); 
        }
          
        ?>


            <script>
                window.location.href = 'duellmode.php?duell_id=<?php echo $duell_id; ?>';
            </script>

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


                <div class="dauer">
                    <div class="page-content">
                        <div class="list-block">
                            <ul>
                                <li>
                                    <div style="width: 92.5%; background-color: #f0414b;" class="item-content">
                                        <input style="padding-left:42%;" name="dauer" type="text" placeholder="Dauer" readonly id="calendar-range" value="">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- page-content -->
                </div>


                <div class="formline duell_link">
                    <input type="date" name="dateTo" value="<?php echo date('Y-m-d'); ?>" />

                </div>




                <div class="formline">
                    <button class="button_duell">Link teilen</button>

                </div>

                <div class="formline duell_link">

                </div>

                <div class="formline">
                </div>

                <div class="duell_bottom_einst">
                    <input type="submit" id="SubmitButton" name="SubmitButton" value="Duell starten" />
                </div>

            </div>
        </form>

        <!-- section -->


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/framework7/1.4.2/js/framework7.min.js"></script>
        <script>
            var myApp = new Framework7();

            // Range Picker
            var calendarRange = myApp.calendar({
                input: '#calendar-range',
                dateFormat: 'dd M yyyy',
                rangePicker: false
            });
        </script>
        <?php
         } else {
        print_r($_SESSION["currentUser"]);
        echo "Bitte erst einloggen, <a href='login.php'>hier</a>.";
    }
        ?>

    </body>

    </html>