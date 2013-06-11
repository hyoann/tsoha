<?php 

function onkoKirjautunut() {
	if(!isset($_SESSION["kayttaja"])) {
	header("Location: etusivu.php");
	die();
	}
}

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

function tunnistaKayttaja($tunnus, $salasana) {
    $kysely = muodostaYhteys()->prepare('SELECT id FROM asiakas WHERE kayttajatunnus = ? AND salasana = ?');
   
    if ($kysely->execute(array($tunnus, $salasana))) {
	    return $kysely->fetchObject();
	} else {
	    return null;
    }
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

function lisaaOstokseksi($tuotemaara, $asiakas_id, $tuote_id) {
	$kysely = muodostaYhteys()->prepare('INSERT INTO ostos (tuotemaara, asiakas_id, tuote_id) VALUES (?, ?, ?)');
	$kysely->execute(array($tuotemaara, $asiakas_id, $tuote_id));
}

function haeOstokset($asiakas) {
	$kysely = muodostaYhteys()->prepare('SELECT * FROM ostos WHERE asiakas_id = ?');
	if($kysely->execute(array($asiakas))) {
        $rivit = $kysely->fetchAll();
		return $rivit;		
	}
	return null;
}



function haeLento($asiakas) {
	$kysely = muodostaYhteys()->prepare('SELECT lentotunnus FROM asiakas WHERE id = ?');
	$kysely->execute(array($asiakas));
	$lento = $kysely->fetch();
	return $lento;
}

function haeLennonTiedot($tunnus) {
    $kysely = muodostaYhteys()->prepare('SELECT * FROM lento WHERE tunnus = ?');
    	if($kysely->execute(array($tunnus))) {
		$rivit = $kysely->fetch();
		return $rivit;
		}
	return null;
}

function haeTuote($id) {
    $kysely = muodostaYhteys()->prepare('SELECT nimi, hinta FROM tuote WHERE id = ?');
    $kysely->execute(array($id));
    $tuote = $kysely->fetchObject();
    return $tuote;
}	

function laskeHinta($ostos_id) {
    $kysely = muodostaYhteys()->prepare('SELECT tuotemaara, tuote_id FROM ostos WHERE id = ?');
    $kysely->execute(array($ostos_id));
    $ostos = $kysely->fetchObject();
    
    return haeTuote($ostos->tuote_id)->hinta * $ostos->tuotemaara;
}

function laskeYhteishinta($ostokset) {
    $yhteishinta = 0;
    foreach ($ostokset as $ostos) {
        $yhteishinta += laskeHinta($ostos["id"]);
      }
     return $yhteishinta;
}
?>
