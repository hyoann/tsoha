<?php
    require_once("../avusteet.php");

	if (isset($_POST["poista"])) {
		poistaOstos(key($_POST["poista"]));
		header("Location: muuta_tilausta.php");
	
	} elseif (isset($_POST["hyvaksy"])) {
		$maarat = $_POST["maara"];
		$ostokset = $_POST["ostos"];

		//tuote ja sitä vastaava tuotemäärä sijaitsevat taulukoiden samassa indeksissä
		for ($i = 0; $i < count($ostokset); $i++) {
			if(!is_numeric($maarat[$i]) || $maarat[$i] < 0) {
				break;
			} elseif ($maarat[$i] > 0) {
				 muutaOstosta($ostokset[$i], $maarat[$i]);    
			} elseif ($maarat[$i] == '0') {
				poistaOstos($ostokset[$i]);
			}
			header("Location: omat_tiedot.php");
		}
		echo "<p>Tuotemäärä ei kelpaa. <a href = muuta_tilausta.php>Palaa takaisin.</a></p>";
	}

?>
