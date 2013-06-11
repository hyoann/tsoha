<?php
	require_once("yllapito_funktioita.php");
	
	$lista = $_POST['poistolista'];
	
	if(!empty($lista)) {
		foreach($lista as $poistettava) {
			poistaTuote($poistettava);
		}
	}
	
	header("Location: poista_tuote.php");
?>