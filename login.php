<?php 
session_start();
$pdo = new PDO('mysql:host=luisa.local;dbname=467536_2_1', 'root', '');
 
if(isset($_GET['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$statement = $pdo->prepare("SELECT * FROM user WHERE email = :email");
	$result = $statement->execute(array('email' => $email));
	$user = $statement->fetch();
	
    //Überprüfung des Passworts
	if ($user !== false && password_verify($password, $user['password'])) {
		$_SESSION['userid'] = $user['user_id'];
		die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
	} else {
		$errorMessage = "E-Mail oder Passwort war ungültig<br>";
	}
	
}
?>

<!DOCTYPE html> 
<html> 
<head>
  <title>Login</title>	
</head> 
<body>
 
<?php 
if(isset($errorMessage)) {
	echo $errorMessage;
}
?>
 
<form action="?login=1" method="post">
E-Mail:<br>
<input type="email" size="40" maxlength="250" name="email"><br><br>
 
Dein Passwort:<br>
<input type="password" size="40"  maxlength="250" name="password"><br>
 
<input type="submit" value="Abschicken">
    
    Abfrage schicken
mysqli_num_rows wieviele zeilen kommen zurück?
</form> 
</body>
</html>