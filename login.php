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
  


    if($ergebnis)
    {
        print_r("login erfolgreich! juhui!");
        $_SESSION["currentUser"]  = $ergebnis;
    }
        else
        {
            print_r("login falsch! bäh!");
        }
        
    }
    
?>

<!DOCTYPE html> 
<html> 
<head>
  <title>Luisa - Die Namensapp</title>	
    <link rel="stylesheet" href="css/style.css">
    <?php
        if($verhalten == 1) {
    ?>
        <meta http-equiv="refresh" content="3"; URL="seite2.php" />
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
                    Bitte logge dich ein:<br/>
                </div>

                <div class="formline">
                    <input placeholder="E-Mail" type="email" id="email" name="email"/> <br/>
                </div>

                <div class="formline">
                    <input type="password" placeholder="Passwort" id="pw" name="password"/> <br/>
                </div>
                
                <div class="formline">
                 
                </div>
                
                <div class="formline duell_link">
                    <a href="registrieren.php">registrieren</a>
                </div>
                
                <div class="formline">
                 
                </div>
                
                <div class="formline">
                 
                </div>
                
                <div class="duell_bottom">   
                    <input type="submit" class="submit" name="einloggen"/>
                </div>
            </div> <!-- section -->
        </form>
            
        
        <?php
        }
        if ($verhalten == 1) {
        ?>
        
        Du hast dich richtig eingeloggt und wirst nun weitergleitet ....
        
        <?php
        }
        if ($verhalten == 2) {
        ?>
        Du hast dich nicht richtig eingeloggt. <a href="login.php">Zurück</a>
        <?php
        }
        ?>
        
    </body>
</html>
