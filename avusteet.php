<?php
	require_once("avusteet/kyselyt.php");
		
	function onkoKirjautunut() {
		if(!isset($_SESSION["kayttaja"])) {
		header("Location: kayttaja/etusivu.php");
		die();
		}
	}
		
	function onkoYllapito() {
		if(!isset($_SESSION["yllapito"])) {
		header("Location: yllapito/kirjautumissivu.php");
		die();
		}
	}	
	
?>