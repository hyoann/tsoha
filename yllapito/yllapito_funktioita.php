<?php
function muodostaYhteys() {
	static $yhteys = null;

	if ($yhteys == null) {
		try {
			$yhteys = new PDO("pgsql:host=localhost;dbname=ahyotyla", "ahyotyla", "1tunnus2_");
		} catch (PDOException $e) {
			die("VIRHE: " . $e->getMessage());
		}
	$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
	return $yhteys;    
}

function valintalista($nimi, $sisalto) {
    echo "<select name=\"{$nimi}\">";
    foreach ($sisalto as $kohta) {
        echo "<option value=\"{$kohta}\">{$kohta}";
    }
    echo "</select>";
}

function haeTuoteryhmat() {
	$kysely = muodostaYhteys()->prepare("SELECT * FROM tuoteryhma");
	if($kysely->execute()) {

	$rivit = array();
		while($rivi = $kysely->fetchObject()) {
			$rivit[] = $rivi;
		}
		return $rivit;
	}
	return null;
}	

function haeRyhmanNimi($id) {
	$kysely = muodostaYhteys()->prepare("SELECT nimi FROM tuoteryhma WHERE id = ?");
	if($kysely->execute(array($id))) {
		$nimi = $kysely->fetch();
		return $nimi;
	}
	return null;
}

function lisaaTuote($nimi, $hinta, $kuvaus, $ryhmaid) {
	$yhteys = muodostaYhteys();
	$kysely = $yhteys->prepare("INSERT INTO tuote (nimi, hinta, kuvaus, ryhma_id) VALUES (?, ?, ?, ?)");
	$kysely->execute(array($nimi, $hinta, $kuvaus, $ryhmaid));
	
	return $yhteys->lastInsertId("tuote_id_seq");
}

function haeTuotteet() {
	$kysely = muodostaYhteys()->prepare("SELECT * FROM tuote");
	if($kysely->execute()) {
		$rivit = array();
		while($rivi = $kysely->fetchObject()) {
			$rivit[] = $rivi;
		}
		return $rivit;
	}
	return null;
}

function poistaTuote($id) {
	$kysely = muodostaYhteys()->prepare("DELETE FROM tuote WHERE id = ?");
	$kysely->execute(array($id));
}

function lisaaKuva($id, $tiedosto) { 
    $kuva = file_get_contents($tiedosto);
    $kysely = muodostaYhteys()->prepare("UPDATE tuote SET kuva = ? WHERE id = ?");
    $kysely->execute(array(base64_encode($kuva), $id));
}

function haeKuva($id) {
    echo "<img src=\"naytakuva.php?id=$id\"></img>";
}
?>
