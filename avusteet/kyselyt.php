<?php
	require_once("muodosta_yhteys.php");	
	
	function tunnistaKayttaja($tunnus, $salasana) {
		$kysely = muodostaYhteys()->prepare('SELECT id FROM asiakas WHERE kayttajatunnus = ? AND salasana = ?');
	   
		if ($kysely->execute(array($tunnus, $salasana))) {
			return $kysely->fetchObject();
		} else {
			return null;
		}
	}
	
	function haeKayttaja($asiakas_id) {
		$kysely = muodostaYhteys()->prepare('SELECT nimi, osoite, puhelin FROM asiakas WHERE id = ?');
		$kysely->execute(array($asiakas_id));
		$asiakas = $kysely->fetchObject();
		return $asiakas;
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
		$kysely = muodostaYhteys()->prepare("SELECT id, nimi, hinta, kuvaus, ryhma_id, kuva IS NOT NULL AS onkoKuvaa  FROM tuote WHERE poistettu = ? ORDER BY id");
		if($kysely->execute(array('false'))) {
			$rivit = array();
			while($rivi = $kysely->fetchObject()) {
				$rivit[] = $rivi;
			}
			return $rivit;
		}
		return null;
	}
	
	function haeTuoteryhmanTuotteet($ryhma_id) {
		$kysely = muodostaYhteys()->prepare('SELECT id, nimi, hinta, kuvaus, kuva IS NOT NULL AS onkoKuvaa, poistettu FROM tuote WHERE ryhma_id = ? AND poistettu = ?');
		if ($kysely->execute(array($ryhma_id, 'false'))) {
			$rivit = array();
			while($rivi = $kysely->fetchObject()) {
				$rivit[] = $rivi;
			}
			return $rivit;
		}
		return null;
	}


	function poistaTuote($id) {
		$kysely = muodostaYhteys()->prepare("UPDATE tuote SET poistettu = ? WHERE id = ?");
		$kysely->execute(array('true', $id));
	}

	function lisaaKuva($id, $tiedosto) { 
		$kuva = file_get_contents($tiedosto);
		$kysely = muodostaYhteys()->prepare("UPDATE tuote SET kuva = ? WHERE id = ?");
		$kysely->execute(array(base64_encode($kuva), $id));
	}

	function haeKuva($tuote) {
	    if ($tuote->onkokuvaa) {
   	        $id = $tuote->id;
		    echo "<img src=\"../avusteet/nayta_kuva.php?id=$id\" />";
	    }
	}

	function haeTuote($id) {
		$kysely = muodostaYhteys()->prepare('SELECT id, nimi, hinta, kuvaus, ryhma_id, kuva IS NOT NULL AS onkoKuvaa FROM tuote WHERE id = ?');
		$kysely->execute(array($id));
		$tuote = $kysely->fetchObject();
		return $tuote;
	}		

	function muutaTuotetietoja($id, $nimi, $hinta, $kuvaus, $ryhma_id) {
		$kysely = muodostaYhteys()->prepare('UPDATE tuote SET (nimi, hinta, kuvaus, ryhma_id) = (?, ?, ?, ?) WHERE id = ?');
		$kysely->execute(array($nimi, $hinta, $kuvaus, $ryhma_id, $id));
	}
	
	function lisaaOstokseksi($tuotemaara, $asiakas_id, $tuote_id) {
		$kysely = muodostaYhteys()->prepare('INSERT INTO ostos (tuotemaara, asiakas_id, tuote_id) VALUES (?, ?, ?)');
		$kysely->execute(array($tuotemaara, $asiakas_id, $tuote_id));
	}
	
	function haeOstos($asiakas_id, $tuote_id) {
		$kysely = muodostaYhteys()->prepare('SELECT * FROM ostos WHERE asiakas_id = ? AND tuote_id = ?');
		$kysely->execute(array($asiakas_id, $tuote_id)); 
		$ostos = $kysely->fetchObject();
		if (!$ostos) {
			return null;
		} else {
			return $ostos;
		}
	}

	function muutaOstosta($ostos, $maara) {
		$kysely = muodostaYhteys()->prepare('UPDATE ostos SET tuotemaara = ? WHERE id = ?');
		$kysely->execute(array($maara, $ostos));
	}

	function poistaOstos($poistettava) {
		$kysely = muodostaYhteys()->prepare('DELETE FROM ostos WHERE id = ?');
		$kysely->execute(array($poistettava));
	}

	function haeOstokset($asiakas) {
		$kysely = muodostaYhteys()->prepare('SELECT * FROM ostos WHERE asiakas_id = ? ORDER BY id');
		if($kysely->execute(array($asiakas))) {
			$rivit = $kysely->fetchAll();
			return $rivit;		
		}
		return null;
	}
	
	function poistaTilaus($id) {
		$kysely = muodostaYhteys()->prepare('DELETE FROM ostos WHERE asiakas_id = ?');
		$kysely->execute(array($id));
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
	
	function haeLento($asiakas) {
		$kysely = muodostaYhteys()->prepare('SELECT lento FROM asiakas WHERE id = ?');
		$kysely->execute(array($asiakas));
		$lento = $kysely->fetch();
		return $lento;
	}

	function haeLennonTiedot($tunnus) {
		$kysely = muodostaYhteys()->prepare('SELECT kohde, to_char(lahtopaiva, \'DD.MM.YYYY\') AS paiva FROM lento WHERE tunnus = ?');
		if($kysely->execute(array($tunnus))) {
			$rivit = $kysely->fetch();
			return $rivit;
			}
		return null;
	}
	
	function haeMatkustajat($lento) {
		$kysely = muodostaYhteys()->prepare('SELECT id, nimi, istumapaikka FROM asiakas WHERE lento = ? ORDER BY istumapaikka');
		$kysely->execute(array($lento));
		$matkustajat = $kysely->fetchAll();
		return $matkustajat;
	}
?>
