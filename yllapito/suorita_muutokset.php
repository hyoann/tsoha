<?php
    require_once("../avusteet.php");

	// Jos kuvaus-kenttään ei kirjoiteta uutta kuvausta, tuotteen vanha kuvaus säilyy
	if (!empty($_POST["kuvaus"])) {
		$kuvaus = $_POST["kuvaus"];
	} else {
		$kuvaus = haeTuote($_POST['id'])->kuvaus;
	}	
    
	if (on_desimaali($_POST["hinta"]) && $_POST["hinta"] > 0) {
		muutaTuotetietoja($_POST['id'], $_POST["nimi"], $_POST["hinta"], $kuvaus, $_POST["tuoteryhmat"]);
		
		if (!empty($_FILES['kuva']['name'])) {
			lisaaKuva($_POST['id'], $_FILES["kuva"]["tmp_name"]);
		}
		header("Location: tuotteet.php");
	}
	
	$id = $_POST['id'];
	echo "<p>Hinta ei kelpaa! <a href='muuta_tuotetta.php?id=$id'>Palaa takaisin</a></p>";
?>
