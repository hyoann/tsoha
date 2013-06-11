<?php
	require_once("yllapito_funktioita.php");
	
	$id = lisaaTuote($_POST["nimi"], $_POST["hinta"], $_POST["kuvaus"], $_POST["tuoteryhmat"]);
	lisaaKuva($id, $_FILES["kuva"]["tmp_name"]);
	
	header("Location: yllapito_etusivu.php")
?>
