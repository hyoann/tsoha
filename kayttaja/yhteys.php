<?php
try {
	$yhteys = new PDO("pgsql:host=localhost;dbname=ahyotyla", "ahyotyla", "1tunnus2_");
} catch (PDOException $e) {
	die("VIRHE: " . $e->getMessage());
}
$yhteys->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
