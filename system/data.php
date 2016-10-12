<?php
	
		
	/* *******************************************************************************************************
	/* data.php regelt die DB-Verbindung und fast den gesammten Datenverkehr der Site.
	/* So ist die gesammte Datenorganisation an einem Ort, was den Verwaltungsaufwand erheblich verringert.
	/*
	/* *******************************************************************************************************/
	
	/* *******************************************************************************************************
	/* get_db_connection()
	/*
	/* liefert als Rückgabewert die Datenbankverbindung
	/* hier werden für die gesammte Site die DB-Verbindungsparameter angegeben.
	/* 	"SET NAMES 'utf8'"  :	Sorgt dafür, dass alle Zeichen als UTF8 übertragen und gespeichert werden.
	/*							http://www.lightseeker.de/wunderwaffe-set-names-set-character-set/
	/* *******************************************************************************************************/
	function get_db_connection()
	{
		$db = mysqli_connect('localhost', DBUSER, DBPW, DBNAME)
 		 or die('Fehler beim Verbinden mit dem MySQL-Server.');
  		mysqli_query($db, "SET NAMES 'utf8'");
		return $db;
	}
	
	/* *******************************************************************************************************
	/* get_result($sql)
	/*
	/* Führt die SQL-Anweisung $sql aus, liefert das Ergebnis zurück und schliesst die DB-Verbindung
	/* Alle Weiteren Funktionen rufen get_result() direkt oder indirekt auf.
	/* *******************************************************************************************************/
	function get_result($sql)
	{
		$db = get_db_connection();	
		$result = mysqli_query($db, $sql);
		mysqli_close($db);
		return $result;
	}
	
	
	/* *********************************************************
	/* Login
	/* ****************************************************** */
	
	/* function login($email , $password){
		$sql = "SELECT * FROM user WHERE email = '".$email."' AND password = '".$password."';";
		return get_result($sql);
	}
	
	function register($email , $password){
    $sql = "INSERT INTO user (email, password) VALUES ('$email', '$password');";
		return get_result($sql);
	}
	
	
	/* *********************************************************
	/* Hundenamen
	/* ****************************************************** */

    function get_dogs_name(){
    $sql = "SELECT hundename, id FROM hunde ORDER BY RAND() LIMIT 20;";
		return get_result($sql); //und id
	}
	
	/* *********************************************************
	/* Profil
	/* ****************************************************** */

	
	/* *********************************************************
	/* Friends
	/* ****************************************************** */
	
	
			
?>