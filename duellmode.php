<?php
	require_once("system/data.php");
	require_once("system/security.php");
    require_once("system/functions.php");
?>

    <!DOCTYPE html>
    <html>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <?php 
        
        session_start(); 
    if (isset($_SESSION["currentUser"])) { 
        $winner = "empty";
        $duell_id = $_GET["duell_id"];
        $sql = "SELECT namensliste FROM duell WHERE id = $duell_id;";
        $duell = get_result($sql)->fetch_array();
          
        if (isset($_POST['winner'])) {
            $winner = $_POST['winner']; 
            $query = "INSERT INTO wins (win_name, duell_id) VALUES ('$winner', $duell_id);";
            get_result($query); ?>
        <script>
            window.location.href = 'win.php?name=<?php echo $winner; ?>';
        </script>

        <?php
        }

        
        ?>
            <script>
                //hole die gelikeden namen aus der Datenbank
                var duell_array = <?php print_r($duell['namensliste']); ?>;
                //Kontrolle
                console.log("Duell:" + duell_array);

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
                            var winner = document.getElementById('name01').innerHTML;
                            console.log(winner);
                            document.getElementById("hidden_winner").value = winner;
                            document.getElementById("hiddenForm").submit();
                        }
                    }
                    document.getElementById('name02').onclick = function () {
                        if (i < laenge) {
                            document.getElementById('name01').innerHTML = duell_array.shift();
                            i++;
                        } else {
                            var winner = document.getElementById('name02').innerHTML;
                            console.log(winner);
                            document.getElementById("hidden_winner").value = winner;
                            document.getElementById("hiddenForm").submit();
                            //document.hiddenForm.submit();
                            //speichere in hidden field submit und dann in db


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
                        <form id="hiddenForm" method="post">
                            <input type="hidden" id="hidden_winner" name="winner">
                        </form>
                        <!--noch austauschen-->
                    </div>
                </div>

                <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
                <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
                <?php
         } else {
        echo "Bitte erst einloggen, <a href='login.php'>hier</a>.";
    }
        ?>
            </body>

    </html>