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
			<?php
			foreach ($tuotteet as $tuote) {
				echo "<div>";
				echo haeKuva($tuote->id);
				echo "<p>";
				echo $tuote->nimi. "<br>";
				echo $tuote->kuvaus . "<br>";
				echo "Hinta: {$tuote->hinta} €<br>";
				echo "<form action=\"tilaa.php\" method=\"POST\">";
				echo "<input type=\"text\" name=\"maara\" size=\"1\" value=\"0\"> kpl";
				echo "<input type=\"hidden\" name=\"asiakas\" value=\"{$_SESSION["kayttaja"]}\">";
				echo "<input type=\"hidden\" name=\"tuote\" value=\"{$tuote->id}\">";
				echo "<input type=\"submit\" value=\"Tilaa\">";
				echo "</form>";
				echo "</p>";
				echo "</div>";
				}
			?>
		</section>
		
<?php require_once("../avusteet/ala.php"); ?>
