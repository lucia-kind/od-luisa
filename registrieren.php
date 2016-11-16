<?php 
session_start();
require_once("system/data.php");
require_once("system/security.php");

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

    </head>

    <body>
        <div id="orr"></div>
        <form action="?register=1" method="post">

            <div class="section">

                <div class="registrieren topbar">
                    <div class="txt_topbar">Registrieren</div>
                </div>

                <div class="formline">
                </div>

                <div class="formline">
                    Um ein Duell zu erstellen, musst du dich registrieren.
                </div>

                <div class="formline">

                    <?php
                $showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

                if(isset($_GET['register'])) {
                    $error = false;
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $password2 = $_POST['password2'];

                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
                        $error = true;
                    } 	
                    if(strlen($password) == 0) {
                        echo 'Bitte ein Passwort angeben<br>';
                        $error = true;
                    }
                    if($password != $password2) {
                        echo 'Die Passwörter müssen übereinstimmen<br>';
                        $error = true;
                    }

                    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
                    if(!$error) { 
                        $statement = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                        $result = $statement->execute(array('email' => $email));
                        $user = $statement->fetch();

                        if($user !== false) {
                            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
                            $error = true;
                        }	
                    }

                    //Keine Fehler, wir können den Nutzer registrieren
                    if(!$error) {	

                        // TODO: Wie Passwort verschlüsseln?
                        $password_hash = $password;
                            //password_hash($password, PASSWORD_DEFAULT);

                        $statement = $pdo->prepare("INSERT INTO user (email, password) VALUES (:email, :password)");
                        $result = $statement->execute(array('email' => $email, 'password' => $password_hash));
                        
        $abfrage = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        $ergebnis = get_result($abfrage)->fetch_assoc();               
        $_SESSION["currentUser"]  = $ergebnis;
          $id = $ergebnis['user_id'];
        //Update duell
        $duell = json_encode($_POST['duell_list']); 
        $typ = $_POST['typ'];
        
         if($typ == "baby"){
            $query ="INSERT INTO duell (user_id, type, namensliste) VALUES ($id, 1, $duell);";
            $result = get_result_last_id($query);
            $duell_id = $result[0];
        } else if($typ == "hund"){
            $query ="INSERT INTO duell (user_id, type, namensliste) VALUES ($id, 2, $duell);";
             $result = get_result_last_id($query);
             $duell_id = $result[0];
        }
            $sql ="UPDATE duell SET `url` = 'http://467536-2.web.fh-htwchur.ch/duellmode.php?duell_id=$duell_id' WHERE id = $duell_id;";
            get_result($sql);
        //macht url zum teilen
                        


                        if($result) {		
                            echo 'erfolg.';
                            $showFormular = false;
                              ?>
                        <script>
                            window.location = '/duell.php?duell_id=<?php echo $duell_id; ?>';
                        </script>
                        <?php
                            
                            
                        } else {
                            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
                        }
                    } 
                }

                if($showFormular) {
                ?>
                </div>

                <div class="formline">
                    <input type="email" placeholder="E-Mail" id="email" name="email">
                </div>

                <div class="formline">
                    <input type="password" placeholder="Passwort" name="password" id="pw">
                </div>

                <div class="formline">
                    <input type="password" placeholder="Passwort wiederholen" name="password2" id="pw">
                </div>

                <div class="formline duell_link">
                    <a href="login.php">einloggen</a>
                </div>

                <div class="formline">
                </div>

                <div class="duell_bottom">
                    <input type="submit" class="submit" value="Registrieren">
                </div>
                <div class="formline">
                    <input type="hidden" id="duell_list" name="duell_list">
                    <!--hier speichere ich die Namen für die Datenbank-->
                    <input type="hidden" id="typ" name="typ">
                    <!--hier speichere ich den typ für die Datenbank-->

                </div>

            </div>
            <!-- section -->

        </form>

        <?php
} //Ende von if($showFormular)
?>
            <script src="js/jquery.min.js"></script>
            <script>
                $(document).ready(function () {
                    var duell_names = localStorage.getItem("liked");
                    $('#duell_list').val(duell_names);
                    var typ_duell = localStorage.getItem("type");
                    $('#typ').val(typ_duell);
                });
                
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