<?php
	require_once('config.php');
		
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
	
    $pdo = new PDO('mysql:host=luisa.local;dbname=467536_2_1', 'root', '');

    /* $pdo = new PDO('mysql:host=luisa.local;dbname=467536_2_1', '467536_2_1', 'NjiUgM756lGA');

	/* *******************************************************************************************************
	/* get_result($sql)
	/*
	/* Führt die SQL-Anweisung $sql aus, liefert das Ergebnis zurück und schliesst die DB-Verbindung
	/* Alle Weiteren Funktionen rufen get_result() direkt oder indirekt auf.
	/* *******************************************************************************************************/

	function get_result($sql)
	{
		$db = get_db_connection();
        //echo $sql;
		$result = mysqli_query($db, $sql);
		mysqli_close($db);
		return $result;
	}
	
function get_result_last_id($sql)
	{
		$db = get_db_connection();
        echo $sql;
		$result = mysqli_query($db, $sql);
        $last_id = mysqli_insert_id($db);
		mysqli_close($db);
		return array($last_id, $result);
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