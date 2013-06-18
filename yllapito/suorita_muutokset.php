<?php
    require_once("../avusteet.php");

	if (!empty($_POST["kuvaus"])) {
		$kuvaus = $_POST["kuvaus"];
	} else {
		$kuvaus = haeTuote($_POST['id'])->kuvaus;
	}	
    	
	muutaTuotetietoja($_POST['id'], $_POST["nimi"], $_POST["hinta"], $kuvaus, $_POST["tuoteryhmat"]);
	if (!empty($_FILES['kuva']['name'])) {
		lisaaKuva($_POST['id'], $_FILES["kuva"]["tmp_name"]);
	}
	header("Location: tuotteet.php");
?>
