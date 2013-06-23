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
	
	function on_kokonaisluku($arvo) {
		$arvo = filter_var($arvo, FILTER_VALIDATE_INT);
		return ($arvo !== FALSE);
	}
	
	function on_desimaali($arvo) {
		$arvo = filter_var($arvo, FILTER_VALIDATE_FLOAT);
		return ($arvo !== FALSE);
	}
?>