<?php
	session_start();
	require_once("funktioita.php");
	onkoKirjautunut();
	$otsikko = "Omat tiedot | SiipiLomatOy";
	require_once("yla.php");
	$ostokset = haeOstokset($_SESSION["kayttaja"]);
    $lentotunnus = haeLento($_SESSION["kayttaja"]);
    $lento = haeLennonTiedot($lentotunnus["lentotunnus"]);
?>
	<link rel="stylesheet" type="text/css" href="omat_tiedot_muotoilu.css"/>
		<section>
			<h1>Hei <?php echo $_SESSION["kayttaja"]; ?>! Tekemäsi tilaukset:</h1>
			<table border>
				<tr>
					<th>Lento</th>
					<th>Lähtöpäivämäärä</th>
					<th>Tilauksesi</th>
				</tr>
				<tr>
					<?php
					echo "<td>{$lentotunnus["lentotunnus"]} {$lento["kohde"]}</td>";
					echo "<td>{$lento["lahtopaiva"]}</td>";
					echo "<td>";
					foreach($ostokset as $ostos) {
					    echo "<li>" . haeTuote($ostos["tuote_id"])->nimi . " " .  $ostos["tuotemaara"] . " kpl, " . laskeHinta($ostos["id"]) . " € </li>";
					}
                    echo "</td>";
					?>
				</tr>
				<tr>
					<td id="hinta" colspan="3">Yhteishinta: <?php echo laskeYhteishinta($ostokset); ?> €</td>
				</tr>
			</table>
			<input type="button" value="Muuta tilausta"/>
			<input type="button" value="Peru tilaus"/>
		</section>
<?php require_once("ala.php"); ?>
