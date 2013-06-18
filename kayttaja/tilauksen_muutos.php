<?php
    require_once("../avusteet.php");

	if (isset($_POST['poista'])) {
		poistaOstos(key($_POST['poista']));
		header("Location: muuta_tilausta.php");
	
	} else {
		$maarat = $_POST['maara'];
		$ostokset = $_POST['ostos'];

		for ($i = 0; $i < count($ostokset); $i++) {
			if ($maarat[$i] > 0) {
				muutaOstosta($ostokset[$i], $maarat[$i]);     
			} elseif ($maarat[$i] == 0) {
				poistaOstos($ostokset[$i]);
			} else {
				break;
			}
			header("Location: omat_tiedot.php");
		}
		echo "<p>Tuotemäärä ei kelpaa. <a href = muuta_tilausta.php>Palaa takaisin.</a></p>";
	}

?>