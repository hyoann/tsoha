<?php
	session_start();
	require_once("../avusteet.php");
	onkoKirjautunut();
	
	$otsikko = "Omat tiedot | SiipiLomatOy";
	require_once("../avusteet/yla.php");
	
	$ostokset = ostostenHinnat($_SESSION["kayttaja"]);
    $lento = haeLento($_SESSION["kayttaja"]);
	
?>

<section id="omat_tiedot">

	<h1>Hei <?php echo haeKayttaja($_SESSION["kayttaja"])-> nimi; ?>! Tekemäsi tilaukset:</h1>
	
	<?php if (empty($ostokset)) { 
		die("<p>Et ole tehnyt tilausta. Selaa tuotteita!</p>"); 
	} ?>
			
	<table border>
		<tr>
			<th>Lento</th>
			<th>Lähtöpäivämäärä</th>
			<th>Tilauksesi</th>
		</tr>
		<tr>
			<td><?php echo $lento["tunnus"] ." " . $lento["kohde"]; ?></td>
			<td><?php echo $lento["paiva"]; ?></td>
			<td>
				<ul>

				<?php $yhteishinta = 0;
					foreach($ostokset as $ostos) { 
						//lasketaan samalla ostosten kokonaishinta
						$yhteishinta += $ostos["hinta"]; ?>
					<li><?php echo htmlspecialchars($ostos["nimi"]) . " " . htmlspecialchars($ostos["tuotemaara"]) . " kpl, " . htmlspecialchars($ostos["hinta"]) . " €" ?></li>
				<?php } ?>
				</ul>
			</td>
		</tr>
		<tr>
			<td id="hinta" colspan="3">Yhteishinta: <?php echo $yhteishinta; ?> €</td>
		</tr>
	</table>
	
	<form action="muuta.php" method="POST">
		<input type="hidden" name="asiakas_id" value="<?php echo $_SESSION['kayttaja']; ?>"/>
		<input type="submit" name="muuta" value="Muuta tilausta"/>
		<input type="submit" name="peru" value="Peru tilaus"/>
	</form>
	
</section>

<?php require_once("../avusteet/ala.php"); ?>
