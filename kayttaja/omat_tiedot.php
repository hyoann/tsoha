<?php
	session_start();
	require_once("../avusteet.php");
	onkoKirjautunut();
	$otsikko = "Omat tiedot | SiipiLomatOy";
	require_once("../avusteet/yla.php");
	$ostokset = haeOstokset($_SESSION["kayttaja"]);
    $lentotunnus = haeLento($_SESSION["kayttaja"]);
    $lento = haeLennonTiedot($lentotunnus["lento"]);
?>
		<section id="omat_tiedot">
			<h1>Hei <?php echo haeKayttaja($_SESSION["kayttaja"])-> nimi; ?>! Tekemäsi tilaukset:</h1>
			<?php if (empty($ostokset)) { ?> <p>Et ole tehnyt tilausta. Selaa tuotteita!</p>
			<?php } else { ?>
			<table border>
				<tr>
					<th>Lento</th>
					<th>Lähtöpäivämäärä</th>
					<th>Tilauksesi</th>
				</tr>
				<tr>
					<td><?php echo $lentotunnus["lento"] ." " . $lento["kohde"]; ?></td>
					<td><?php echo $lento["paiva"]; ?></td>
					<td>
						<ul>
						<?php foreach($ostokset as $ostos) { ?>
						    <li><?php echo haeTuote($ostos["tuote_id"])->nimi . " " . $ostos["tuotemaara"] .  "kpl, " . laskeHinta($ostos["id"]) . " €" ?></li>
						<?php } ?>
						</ul>
				    </td>
				</tr>
				<tr>
					<td id="hinta" colspan="3">Yhteishinta: <?php echo laskeYhteishinta($ostokset); ?> €</td>
				</tr>
			</table>
			<form action="muuta.php" method="POST">
				<input type="hidden" name="asiakas_id" value="<?php echo $_SESSION['kayttaja']; ?>"/>
				<input type="submit" name="muuta" value="Muuta tilausta"/>
				<input type="submit" name="peru" value="Peru tilaus"/>
			</form>
			<?php } ?>
		</section>
<?php require_once("../avusteet/ala.php"); ?>
