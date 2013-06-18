<?php
	require_once("../avusteet.php");
	
	if (isset($_POST['muuta'])) {
		$id = key($_POST['muuta']);
		header("Location: muuta_tuotetta.php?id=$id");
	}
	else {
	
	$lista = $_POST['lista'];
	
	if(!empty($lista)) {
		foreach($lista as $poistettava) {
			poistaTuote($poistettava);
		}
		header("Location: tuotteet.php");
    }
	 echo "<p>Et valinnut yhtään tuotetta. <a href=\"poista_tuote.php\">Palaa takaisin.</a></p>";
	}
?>
