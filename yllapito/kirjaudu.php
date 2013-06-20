<?php
	session_start();
	
	if ($_POST["tunnus"] == "ylla" && $_POST["salasana"] == "pito") {
		$_SESSION["yllapito"] = "ylla";
		header("Location: etusivu.php");
		die();
	}
?>

<p>Tunnus tai salasana väärin! <a href="kirjautumissivu.php">Yritä uudelleen.</a></p>