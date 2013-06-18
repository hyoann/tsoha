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
?>