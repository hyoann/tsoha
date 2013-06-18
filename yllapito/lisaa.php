<?php
	require_once("../avusteet.php");
	
	if (!empty($_POST["nimi"]) && !empty($_POST["hinta"]) && !empty($_POST["tuoteryhmat"])) {
		$id = lisaaTuote($_POST["nimi"], $_POST["hinta"], $_POST["kuvaus"], $_POST["tuoteryhmat"]);
		if (!empty($_FILES['kuva']['name'])) {
			lisaaKuva($id, $_FILES["kuva"]["tmp_name"]);
		}
		header("Location: etusivu.php");
	} else {
		echo "<p>Nimi, hinta ja tuoteryhmä ovat pakollisia! <a href='etusivu.php'>Yritä uudelleen.</a></p>";
	}
?>
