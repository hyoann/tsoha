<?php
	require_once("../avusteet.php");
	
	if (!on_desimaali($_POST["hinta"]) || ($_POST["hinta"] < 0)) {
	    echo "<p>Hinta ei kelpaa! <a href='etusivu.php'>Palaa takaisin.</a></p>";
	}
	 //tarkistetaan etteivät pakolliset kentät ole tyhjiä
	elseif (!empty($_POST["nimi"]) && !empty($_POST["hinta"]) && !empty($_POST["tuoteryhmat"])) {
		$id = lisaaTuote($_POST["nimi"], $_POST["hinta"], $_POST["kuvaus"], $_POST["tuoteryhmat"]);
		
		//lisätään kuva, jos sellainen on ladattu
		if (!empty($_FILES['kuva']['name'])) {
			lisaaKuva($id, $_FILES["kuva"]["tmp_name"]);
		}
		header("Location: tuotteet.php");
		
	} else {
		echo "<p>Nimi, hinta ja tuoteryhmä ovat pakollisia! <a href='etusivu.php'>Yritä uudelleen.</a></p>";
	}
?>
