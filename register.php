<?php
  session_start();
	if(isset($_SESSION['id'])) unset($_SESSION['id']);
	session_destroy();
	
	// externe Dateien Laden
	// data.php beinhaltet alle DB-Anweisungen wie SELECT, INSERT, UPDATE, etc.
	//   Funktionen in data.php liefern das Ergebnis der Anweisungen zurück
	// security.php enthält sicherheitsrelevante Funktionen
	require_once("system/data.php");
	require_once("system/security.php");
  
  // für Spätere Verwendung initialisieren wir die Variablen $error, $error_msg, $success, $success_msg
  $error = false;
  $error_msg = "";
  $success = false;
  $success_msg = "";
  // Kontrolle, ob die Seite direkt aufgerufen wurde oder vom Login-Formular
  if(isset($_POST['login-submit'])){
    // Kontrolle mit isset, ob email und password ausgefüllt wurde
    if(!empty($_POST['email']) && !empty($_POST['password'])){
      
      // Werte aus POST-Array auf SQL-Injections prüfen und in Variablen schreiben
      $email = filter_data($_POST['email']);
      $password = filter_data($_POST['password']);
      
      // Liefert alle Infos zu User mit diesen Logindaten
      $result = login($email,$password);
      
      // Anzahl der gefundenen Ergebnisse in $row_count
  		$row_count = mysqli_num_rows($result);
      if( $row_count == 1){
        session_start();
        $user = mysqli_fetch_assoc($result);
        $_SESSION['userid'] = $user['user_id'];
        header("Location:home.php");
      }else{
        // Fehlermeldungen werden erst später angezeigt
        $error = true;
        $error_msg .= "Leider konnte wir Ihre E-Mailadresse oder Ihr Passwort nicht finden.</br>";
      }
    }else{
      $error = true;
      $error_msg .= "Bitte füllen Sie beide Felder aus.</br>";
    }
  }


  if(isset($_POST['register-submit'])){
    // Kontrolle mit isset, ob email und password ausgefüllt wurde
    if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm-password'])){
      
      // Werte aus POST-Array auf SQL-Injections prüfen und in Variablen schreiben
      $email = filter_data($_POST['email']);
      $password = filter_data($_POST['password']);
      $confirm_password = filter_data($_POST['confirm-password']);
      if($password == $confirm_password){
        // register liefert bei erfolgreichem Eintrag in die DB den Wert TRUE zurück, andernfalls FALSE
        $result = register($email, $password);
        if($result){
          $success = true;
          $success_msg = "Sie haben erfolgreich registriert.</br>
          Bitte loggen Sie sich jetzt ein.</br>";
        }else{
          $error = true;
          $error_msg .= "Es gibt ein Problem mit der Datenbankverbindung.</br>";
        }
      }else{
        $error = true;
        $error_msg .= "Die Passwörter stimmen nicht überein.</br>";
      }
    }else{
      $error = true;
      $error_msg .= "Bitte füllen Sie alle Felder aus.</br>";
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>p42 - Login</title>

    <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  
  </head>

  <body>
    <!-- http://bootsnipp.com/snippets/featured/login-and-register-tabbed-form -->
    <div class="container">
    	<div class="row">
  			<div class="col-md-6 col-md-offset-3">
  				<div class="panel panel-login">
  					<div class="panel-heading">
  						<div class="row">
  							<div class="col-xs-6">
  								<a href="#" class="active" id="login-form-link">Login</a>
  							</div>
  							<div class="col-xs-6">
  								<a href="#" id="register-form-link">anmelden</a>
  							</div>
  						</div>
  						<hr>
  					</div>
  					<div class="panel-body">
  						<div class="row">
  							<div class="col-lg-12">
  								<!-- Login-Formular -->
  								<form id="login-form" action="index.php" method="post" role="form" style="display: block;">
  									<div class="form-group">
  										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="E-Mail-Adresse" value="">
  									</div>
  									<div class="form-group">
  										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Passwort">
  									</div>
  									<div class="form-group">
  										<div class="row">
  											<div class="col-sm-6 col-sm-offset-3">
  												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="einloggen">
  											</div>
  										</div>
  									</div>
  								</form>
  								<!-- /Login-Formular -->
  								
  								<form id="register-form" action="#" method="post" role="form" style="display: none;">
  									<div class="form-group">
  										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="E-Mail-Adresse" value="">
  									</div>
  									<div class="form-group">
  										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Passwort">
  									</div>
  									<div class="form-group">
  										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Passwort bestätigen">
  									</div>
  									<div class="form-group">
  										<div class="row">
  											<div class="col-sm-6 col-sm-offset-3">
  												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="jetzt registrieren">
  											</div>
  										</div>
  									</div>
  								</form>
  								
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  		<!-- Die beiden BS-Allert-Boxen geben Rückmeldung über den Registrierungsprozess. Sie werden erst später benötigt. -->
  <?php 
    // Gibt es einen Erfolg zu vermelden?
    if($success == true){
  ?>
      <div class="alert alert-success" role="alert"><?php echo $success_msg; ?></div>
  <?php 
    }   // schliessen von if($success == true)
    // Gibt es einen Fehler?
    if($error == true){ 
  ?>
      <div class="alert alert-danger" role="alert"><?php echo $error_msg; ?></div>
  <?php
    }   // schliessen von if($success == true)
  ?>
  	</div><!-- /container -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script>
      $(function() {
        
        $('#login-form-link').click(function(e) {
      		$("#login-form").delay(100).fadeIn(100);
       		$("#register-form").fadeOut(100);
      		$('#register-form-link').removeClass('active');
      		$(this).addClass('active');
      		e.preventDefault();
      	});
      	
      	$('#register-form-link').click(function(e) {
      		$("#register-form").delay(100).fadeIn(100);
       		$("#login-form").fadeOut(100);
      		$('#login-form-link').removeClass('active');
      		$(this).addClass('active');
      		e.preventDefault();
      	});
      
      });
    </script>

  </body>
</html>
