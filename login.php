<?php
    session_start(); /* Cookie wird erstellt*/
    require_once("system/data.php");
    $verhalten = 0;

    if(!isset($_SESSION["email"]) and !isset($_GET["page"])){
        $verhalten = 0;
    }

    if(isset($_GET["page"]) && $_GET["page"] == "log") { 
        
    $email = strtolower($_POST["email"]);
    $password = ($_POST["password"]);
    
    $control = 0;
    $abfrage = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $ergebnis = get_result($abfrage)->fetch_assoc();
    $id = $ergebnis['user_id'];
  


    if($ergebnis)
    {
        print_r("login erfolgreich! juhui! hurra");
        $_SESSION["currentUser"]  = $ergebnis;
        //Update duell
        $duell = json_encode($_POST['duell_list']); 
        $typ = $_POST['typ'];
        print_r($typ);
         if($typ == "baby"){
            $query ="INSERT INTO duell (user_id, type, namensliste) VALUES ($id, 1, $duell);";
            $result = get_result_last_id($query);
            $duell_id = $result[0];
        } else if($typ == "hund"){
            $query ="INSERT INTO duell (user_id, type, namensliste) VALUES ($id, 2, $duell);";
             $result = get_result_last_id($query);
             $duell_id = $result[0];
        }
            $sql ="UPDATE duell SET `url` = 'duellmode.php?duell_id=$duell_id' WHERE id = $duell_id;";
            get_result($sql);
        print_r($sql);
        
        //macht url zum teilen
       
         ?>
    <!--Weiterleitung Duell-->
    <script>
      window.location = '/duell.php?duell_id=<?php echo $duell_id; ?>';
    </script>

    <?php


        }
            else
            {
                echo("");
            }

        }

    ?>

        <!DOCTYPE html>
        <html>

        <head>

            <title>Luisa - Die Namensapp</title>

            <!-- Meta Information -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

            <!-- CSS -->
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" type="text/css" href="css/filterSlide.css">

            <!-- SCRIPT -->
            <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

            <!-- FONT -->
            <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

            <?php
        if($verhalten == 1) {
    ?>
                <meta http-equiv="refresh" content="3" ; URL="seite2.php" />
                <?php
        }
    ?>
        </head>

        <body>
            <form method="post" action="login.php?page=log">
                <div class="section">
                    <div class="registrieren topbar">
                        <div class="txt_topbar">Login</div>
                    </div>

                    <div class="formline">

                    </div>

                    <div class="formline">
                        <?php
                    if($verhalten == 0){
                    ?>
                            Bitte logge dich ein:
                            <br/>
                    </div>




                    <div class="formline">
                        <input placeholder="E-Mail" type="email" id="email" name="email" />
                        <br/>
                    </div>

                    <div class="formline">
                        <input type="password" placeholder="Passwort" id="pw" name="password" />
                        <br/>
                    </div>

                    <div class="formline">
                        <?php
                        
                        if (isset($abfrage) && $abfrage == true){
                            echo("Tut uns leid deine Nutzerangaben sind nicht korrekt. Versuche es noch einmal.");
                        }
                        ?>
                    </div>

                    <div class="formline duell_link">
                        <a href="registrieren.php">registrieren</a>
                    </div>

                    <div class="formline">

                    </div>


                    <div class="formline">
                        <input type="hidden" id="duell_list" name="duell_list">
                        <!--hier speichere ich die Namen für die Datenbank-->
                        <input type="hidden" id="typ" name="typ">
                        <!--hier speichere ich den typ für die Datenbank-->

                    </div>

                    <div class="duell_bottom">
                        <input type="submit" id="submit" class="submit" name="einloggen" value="Abschicken"> />
                    </div>
                </div>
                <!-- section -->
            </form>
            <script src="js/jquery.min.js"></script>
            <script>
                $(document).ready(function () {
                    var duell_names = localStorage.getItem("liked");
                    $('#duell_list').val(duell_names);
                    var typ_duell = localStorage.getItem("type");
                    $('#typ').val(typ_duell);
                });
            </script>


            <?php
        }
        if ($verhalten == 1) {
        ?>

                <h2></h2>

                <?php
        }
        ?>

        </body>

        </html>