<?php
	require_once("../avusteet.php");

	if (isset($_POST["muuta"])) {
		header("Location: muuta_tilausta.php");
	
	} elseif (isset($_POST["peru"])) {
		poistaTilaus($_POST["asiakas_id"]);
		header("Location: omat_tiedot.php");
	}
?>