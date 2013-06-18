<?php
	session_start();
	require_once("../avusteet.php");
	onkoKirjautunut();
	$otsikko = "Selaa tuotteita | SiipiLomatOy";
	if (isset($_GET['id'])) {
		$tuotteet = haeTuoteryhmanTuotteet($_GET['id']);
	} else {
		$tuotteet = haeTuotteet();
	}
	require_once("../avusteet/yla.php");
	$tuoteryhmat = haeTuoteryhmat();
	
?>
		<section id="selaa">
			<nav id="tuoteryhmat">	
				<ul>
					<li><p>Tuoteryhmät<p><li>
					<?php foreach ($tuoteryhmat as $tuoteryhma) {
							$id = $tuoteryhma->id;
							echo "<li><a href='selaa_tuotteita.php?id=$id'>{$tuoteryhma->nimi}</a></li>";
						}
					?>
				</ul>
			</nav>
			
			<?php foreach ($tuotteet as $tuote) { ?>
				<div>
				<?php haeKuva($tuote); ?>
			    <p><?php echo $tuote->nimi; ?> <br>
				<?php echo $tuote->kuvaus; ?> <br>
				Hinta: <?php echo $tuote->hinta; ?> €<br>
				    <form action="tilaa.php" method="POST"/>
				        <input type="text" name="maara" size="1" value="0"/> kpl
				        <input type="hidden" name="asiakas" value="<?php echo $_SESSION['kayttaja']; ?>"/>
				        <input type="hidden" name="tuote" value="<?php echo $tuote->id; ?>" />
				        <input type="submit" value="Tilaa"/>
				    </form>
				</p>
				</div>
				<?php } ?>
		</section>
		
<?php require_once("../avusteet/ala.php"); ?>
