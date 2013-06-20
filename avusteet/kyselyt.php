<?php
	require_once("muodosta_yhteys.php");	
	
	function tunnistaKayttaja($tunnus, $salasana) {
		$kysely = muodostaYhteys()->prepare('SELECT id FROM asiakas WHERE kayttajatunnus = ? AND salasana = ?');
	    if ($kysely->execute(array($tunnus, $salasana))) {
			return $kysely->fetchObject();
		}
		return null;
	}

	
	function haeKayttaja($asiakas_id) {
		$kysely = muodostaYhteys()->prepare('SELECT nimi, osoite, puhelin FROM asiakas WHERE id = ?');
		if($kysely->execute(array($asiakas_id))) {
			$asiakas = $kysely->fetchObject();
			return $asiakas;
		}
		return null;
	}
	
	function haeTuoteryhmat() {
		$kysely = muodostaYhteys()->prepare('SELECT * FROM tuoteryhma');
		if($kysely->execute()) {
			$rivit = array();
			while($rivi = $kysely->fetchObject()) {
				$rivit[] = $rivi;
			}
			return $rivit;
		}
		return null;
	}	

	function lisaaTuote($nimi, $hinta, $kuvaus, $ryhmaid) {
		$yhteys = muodostaYhteys();		
		$kysely = $yhteys->prepare('INSERT INTO tuote (nimi, hinta, kuvaus, ryhma_id) VALUES (?, ?, ?, ?)');
		if ($kysely->execute(array($nimi, $hinta, $kuvaus, $ryhmaid))) {
			return $yhteys->lastInsertId("tuote_id_seq");
		}	
		return null;
	}

	function haeTuotteet() {
		$kysely = muodostaYhteys()->prepare('SELECT tuote.id, tuote.nimi, hinta, kuvaus, tuoteryhma.nimi AS ryhma, kuva IS NOT NULL AS onkoKuvaa 
		FROM tuote 
		JOIN tuoteryhma ON tuote.ryhma_id = tuoteryhma.id
		WHERE poistettu = ?
		ORDER BY id DESC');
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
		$kysely = muodostaYhteys()->prepare('UPDATE tuote SET poistettu = ? WHERE id = ?');
		if ($kysely->execute(array('true', $id))) {
			return $id;
		}
		return null;
	}

	function lisaaKuva($id, $tiedosto) { 
		$kuva = file_get_contents($tiedosto);
		$kysely = muodostaYhteys()->prepare('UPDATE tuote SET kuva = ? WHERE id = ?');
		if ($kysely->execute(array(base64_encode($kuva), $id))) {
			return $id;
		}
		return null;
	}

	function haeKuva($tuote) {
	    if ($tuote->onkokuvaa) {
   	        $id = $tuote->id;
		    echo "<img src=\"../avusteet/nayta_kuva.php?id=$id\" />";
	    }
	}

	function haeTuote($id) {
		$kysely = muodostaYhteys()->prepare('SELECT id, nimi, hinta, kuvaus, ryhma_id, kuva IS NOT NULL AS onkoKuvaa FROM tuote WHERE id = ?');
		if ($kysely->execute(array($id))) {
			$tuote = $kysely->fetchObject();
			return $tuote;
		}
		return null;
	}		

	function muutaTuotetietoja($id, $nimi, $hinta, $kuvaus, $ryhma_id) {
		$kysely = muodostaYhteys()->prepare('UPDATE tuote SET (nimi, hinta, kuvaus, ryhma_id) = (?, ?, ?, ?) WHERE id = ?');
		if ($kysely->execute(array($nimi, $hinta, $kuvaus, $ryhma_id, $id))) {
			return $id;
		}
		return null;
	}
	
	function lisaaOstokseksi($tuotemaara, $asiakas_id, $tuote_id) {
		$yhteys = muodostaYhteys();	
		$kysely = $yhteys->prepare('INSERT INTO ostos (tuotemaara, asiakas_id, tuote_id) VALUES (?, ?, ?)');
		if ($kysely->execute(array($tuotemaara, $asiakas_id, $tuote_id))) {
			return $yhteys->lastInsertId("ostos_id_seq");
		}	
		return null;
	}
	
	function haeOstos($asiakas_id, $tuote_id) {
		$kysely = muodostaYhteys()->prepare('SELECT * FROM ostos WHERE asiakas_id = ? AND tuote_id = ?');
		$kysely->execute(array($asiakas_id, $tuote_id)); 
		$ostos = $kysely->fetchObject();
		if (!$ostos) {
			return null;
		} 
		return $ostos;
	}

	function muutaOstosta($ostos, $maara) {
		$kysely = muodostaYhteys()->prepare('UPDATE ostos SET tuotemaara = ? WHERE id = ?');
		if ($kysely->execute(array($maara, $ostos))) {
			return $ostos;
		}
		return null;
	}

	function poistaOstos($poistettava) {
		$kysely = muodostaYhteys()->prepare('DELETE FROM ostos WHERE id = ?');
		if( $kysely->execute(array($poistettava))) {
			return $poistettava;
		}
		return null;
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
		if ($kysely->execute(array($id))) {
			return $id;
		}
		return null;
	}
	
	function ostostenHinnat($asiakas) {
		$kysely = muodostaYhteys()->prepare('SELECT ostos.id, tuote.nimi, ostos.tuotemaara, tuote.hinta AS yksikkohinta, (ostos.tuotemaara*tuote.hinta) AS hinta
		FROM ostos 
		JOIN tuote ON ostos.tuote_id = tuote.id
		WHERE ostos.asiakas_id = ?');
		if($kysely->execute(array($asiakas))) {
			$ostokset = $kysely->fetchAll();		
			return $ostokset;
		}
		return null;
	}
	
	function haeLento($asiakas) {
		$kysely = muodostaYhteys()->prepare('SELECT lento.tunnus, lento.kohde, to_char(lento.lahtopaiva, \'DD.MM.YYYY\') AS paiva 
		FROM lento, asiakas
		WHERE lento.tunnus = asiakas.lento
		AND asiakas.id = ?');
		if($kysely->execute(array($asiakas))) {
			$lento = $kysely->fetch();
			return $lento;
			}
		return null;
	}
	
	function haeMatkustajatJaOstokset($lento) {
		$kysely = muodostaYhteys()->prepare('SELECT asiakas.id, asiakas.nimi, asiakas.istumapaikka, ostos.tuote_id, tuote.nimi AS tuotenimi, ostos.tuotemaara 
		FROM ostos
		JOIN tuote ON ostos.tuote_id = tuote.id
		JOIN asiakas ON ostos.asiakas_id = asiakas.id
		WHERE asiakas.id IN
		(SELECT id FROM asiakas WHERE lento = ?)
		ORDER BY asiakas.istumapaikka');
		if ($kysely->execute(array($lento))) {
			$matkustajat = $kysely->fetchAll();
			return $matkustajat;
		}
		return null;
	}
	
	function tuotteidenMaara($lento) {
	    $kysely = muodostaYhteys()->prepare('SELECT tuote.nimi, SUM(ostos.tuotemaara) AS maara 
	    FROM ostos
	    JOIN tuote ON ostos.tuote_id = tuote.id
	    WHERE ostos.asiakas_id IN 
	    (SELECT id FROM asiakas WHERE lento = ?) 
	    GROUP BY tuote.nimi');
	    if ($kysely->execute(array($lento))) {
			$tuotteet = $kysely->fetchAll();
			return $tuotteet;
		}
		return null;
	}
	
	function haeLennot() {
		$kysely = muodostaYhteys()->prepare('SELECT DISTINCT lento 
		FROM asiakas 
		WHERE asiakas.id IN 
		(SELECT asiakas_id FROM ostos)');
		if ($kysely->execute()) {
			$lennot = $kysely->fetchAll();
			return $lennot;
		}
		return null;
	}
?>
