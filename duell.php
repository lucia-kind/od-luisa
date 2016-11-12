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
    
    $duell_id = 74;
    
       if(isset($_POST['SubmitButton'])){ //check if form was submitted
           $dauer = $_POST['dateTo'];
           $duell_id; //wie?woher?
           //$id = $ergebnis['user_id']; //über session?
           $query ="UPDATE duell SET `dauer`= '$dauer' WHERE id = 44;";
            get_result($query); 
           ?>


        <script>
            window.location.href = 'duellmode.php?duell_id=<?php echo $duell_id; ?>';
        </script>
        <?php
        }
         if(isset($_GET["duell_id"])) {
        $duell_id = $_GET["duell_id"];
     } else {
          $duell_id = "not defined";
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
</body>

</html>