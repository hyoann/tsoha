<?php
	session_start();
	unset($_SESSION["yllapito"]);
	header("Location: kirjautumissivu.php");
?>