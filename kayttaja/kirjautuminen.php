<?php
	session_start();
	require_once "../avusteet.php";
	$asiakas_id = tunnistaKayttaja($_POST["tunnus"], $_POST["salasana"]);

	if ($asiakas_id) {
			$_SESSION["kayttaja"] = $asiakas_id->id;
			header("Location: omat_tiedot.php");
			die();
	}
	
?>

<p>Tunnus tai salasana väärin!</p>
<p><a href="etusivu.php">Palaa takaisin etusivulle</a></p>
