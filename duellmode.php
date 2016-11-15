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
   
        $winner = "empty";
        $duell_id = $_GET["duell_id"];
        $sql = "SELECT namensliste, dauer FROM duell WHERE id = $duell_id;";
        $duell = get_result($sql)->fetch_array();
        
        $duell_dauer= strtotime($duell['dauer']); //Enddatum              
        $timefromdb = strtotime(date('Y-m-d'));
        $timeleft = $duell_dauer-$timefromdb;
        $daysleft = round((($timeleft/24)/60)/60); //runde auf Tage
       
          
        if (isset($_POST['winner'])) {
            $winner = $_POST['winner']; 
            $query = "INSERT INTO wins (win_name, duell_id) VALUES ('$winner', $duell_id);";
            get_result($query); ?>
        <script>
            window.location.href = 'win.php?name=<?php echo $winner; ?>&duell_id=<?php echo $duell_id; ?>';
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
                    <?php 
                    if ($daysleft > 0) { ?>
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
                        <?php } else {
                        ?>
                            <div class="txt_one">
                                <?php echo "Duell vorbei!"; //falls daysleft 0 ist
                        echo "<br>Zum Endresultat: <a href='list.php?duell_id=".$duell_id."'>hier</a>"; ?>
                            </div>
                            <?php }
                ?>
                </div>

                <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
                <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

            </body>

    </html>