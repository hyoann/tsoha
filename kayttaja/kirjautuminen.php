<?php
	session_start();
	require_once("../avusteet.php");
	$asiakas = tunnistaKayttaja($_POST["tunnus"], $_POST["salasana"]);

	if($asiakas) {
		$_SESSION["kayttaja"] = $asiakas->id;
		header("Location: omat_tiedot.php");
		die();
	}
	
?>

<p>Tunnus tai salasana väärin!</p>
<p><a href="etusivu.php">Palaa takaisin etusivulle</a></p>
