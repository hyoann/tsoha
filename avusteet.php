<?php
	require_once("avusteet/kyselyt.php");
		
	function onkoKirjautunut() {
		if(!isset($_SESSION["kayttaja"])) {
		header("Location: kayttaja/etusivu.php");
		die();
		}
	}
?>