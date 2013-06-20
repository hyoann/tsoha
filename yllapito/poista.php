<?php
	require_once("../avusteet.php");
	
	if (isset($_POST["muuta"])) {
		$id = key($_POST["muuta"]);
		header("Location: muuta_tuotetta.php?id=$id");
	
	} else {
	
		if(!empty($_POST["lista"])) {
			$lista = $_POST["lista"];
			foreach($lista as $poistettava) {
				poistaTuote($poistettava);
			}
		header("Location: tuotteet.php");
		}
		
		echo "<p>Et valinnut yhtään tuotetta. <a href=\"tuotteet.php\">Palaa takaisin.</a></p>";
	}
?>
