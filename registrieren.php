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

                        if($result) {		
                            echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
                            $showFormular = false;
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
                <input type="submit" class="submit" value="Abschicken">
            </div>

        </div> <!-- section -->
        
    </form>
    
<?php
} //Ende von if($showFormular)
?>
 
</body>
</html>