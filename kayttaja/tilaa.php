<?php

	require_once("funktioita.php");
	if($_POST["maara"] > 0) {
		lisaaOstokseksi($_POST["maara"], $_POST["asiakas"], $_POST["tuote"]);
		header("Location: omat_tiedot.php");
	}
	
?>

<p>Tuotemäärä ei kelpaa</p>
<p><a href="selaa_tuotteita.php">Selaa tuotteita</a></p>