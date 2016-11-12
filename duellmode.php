<?php
	require_once("system/data.php");
	require_once("system/security.php");
?>

    <!DOCTYPE html>
    <html>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <?php 
        require_once("system/data.php");
	    require_once("system/security.php");
	    require_once("system/functions.php");
        
        $duell_id = 74;
        
        if(isset($_GET["duell_id"])) {
        $duell_id = $_GET["duell_id"];
        } else {
          $duell_id = "not defined";
        }
        $sql = "SELECT namensliste FROM duell WHERE id = 74;";
        $duell = get_result($sql)->fetch_array();
        
        ?>
        <script>
            var duellArray = <?php echo print_r($duell); ?>;
            console.log("Duell:" + duellArray);

            var duell = localStorage.getItem('liked');
            var duell_array = JSON.parse(duell);
            //console.log(duell_array);
            //console.log(duell_array.length);
            $(document).ready(function () {
                var i = 0;
                var laenge = duell_array.length - 2;
                document.getElementById('name01').innerHTML = duell_array.shift();
                document.getElementById('name02').innerHTML = duell_array.shift();

                document.getElementById('name01').onclick = function () {
                    if (i < laenge) {
                        document.getElementById('name02').innerHTML = duell_array.shift();
                        i++;
                    } else {
                        console.log("Halt! Du bist zu weit gegangen.");
                        var winner = document.getElementById('name01').innerHTML;
                        console.log(winner);
                    }
                }
                document.getElementById('name02').onclick = function () {
                    if (i < laenge) {
                        document.getElementById('name01').innerHTML = duell_array.shift();
                        i++;
                    } else {
                        var winner = document.getElementById('name02').innerHTML;
                        console.log(winner);
                    }

                }
            });
        </script>

        <head>
            <title>Luisa - Die Namensapp</title>

            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <link rel="stylesheet" href="css/style.css">
        </head>

        <body>
            <div class="section">
                <div class="topbar">
                    <div class="txt_topbar">Duell</div>
                </div>
                <div class="select_duellone">
                    <div id="name01" class="txt_one">
                        Name 01
                    </div>
                    <!--noch austauschen-->
                </div>
                <div class="select_duelltwo">
                    <div id="name02" class="txt_two">
                        Name 02
                    </div>
                    <!--noch austauschen-->
                </div>
            </div>

            <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
        </body>

    </html>