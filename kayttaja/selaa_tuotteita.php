<?php
	session_start();
	require_once("../avusteet.php");
	onkoKirjautunut();
	
	$otsikko = "Selaa tuotteita | SiipiLomatOy";
	require_once("../avusteet/yla.php");
	
	if (isset($_GET["id"])) {
		$tuotteet = haeTuoteryhmanTuotteet($_GET["id"]);
	} else {
		$tuotteet = haeTuotteet();
	}
	
	$tuoteryhmat = haeTuoteryhmat();
	
?>
<section id="selaa">

	<nav id="ryhmavalikko">	
		<ul>
			<li id="otsikko"><p>Tuoteryhmät</p></li>
			<?php foreach ($tuoteryhmat as $tuoteryhma) {
					$id = $tuoteryhma->id; ?>
			<li><a href='selaa_tuotteita.php?id=<?php echo $id; ?>'><?php echo $tuoteryhma->nimi; ?></a></li>
			<?php } ?>
		</ul>
	</nav>
			
	<?php foreach ($tuotteet as $tuote) { ?>
	<div id="tuote">
		<div id="kuva">
			<?php haeKuva($tuote); ?>
		</div>
		
		<div id="tuotetiedot">
			<p><?php echo htmlspecialchars($tuote->nimi); ?></p><br>
			<p><?php echo htmlspecialchars($tuote->kuvaus); ?></p><br>
			<p>Hinta: <?php echo htmlspecialchars($tuote->hinta); ?> €</p><br>
			
			<form action="tilaa.php" method="POST"/>
				<input type="text" name="maara" size="1" value="0"> kpl</input>
				<input type="hidden" name="asiakas" value="<?php echo $_SESSION['kayttaja']; ?>"/>
				<input type="hidden" name="tuote" value="<?php echo $tuote->id; ?>" />
				<input type="submit" value="Tilaa"/>
			</form>
		</div>
		
	</div>
	<?php } ?>

</section>
		
<?php require_once("../avusteet/ala.php"); ?>
