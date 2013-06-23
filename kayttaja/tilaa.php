<?php
	require_once("../avusteet.php");
	
	if(on_kokonaisluku($_POST["maara"]) && $_POST["maara"] > 0) {
		
		$ostos = haeOstos($_POST["asiakas"], $_POST["tuote"]);
		
		//jos tuotetta ei ole vielä tilattu, lisätään ostos-tauluun uusi rivi
		if (is_null($ostos)) {
			lisaaOstokseksi($_POST["maara"], $_POST["asiakas"], $_POST["tuote"]);	
			
		//tuotetta on jo tilattu joten päivitetään vain kyseisen ostoksen tuotemäärä
		} else { 
			$uusiMaara = $_POST["maara"] + $ostos->tuotemaara;
			muutaOstosta($ostos->id, $uusiMaara);
		}
		
		header("Location: omat_tiedot.php");
	}
	
?>

<p>Tuotemäärä ei kelpaa</p>
<p><a href="selaa_tuotteita.php">Selaa tuotteita</a></p>