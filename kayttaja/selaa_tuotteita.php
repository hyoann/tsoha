<?php
	session_start();
	require_once("funktioita.php");
	onkoKirjautunut();
	$otsikko = "Selaa tuotteita | SiipiLomatOy";
	$tuotteet = haeTuotteet();
	require_once("yla.php");
	
?>

<link rel="stylesheet" type="text/css" href="selaa_tuotteita_muotoilu.css"/>
	<body>
		<section>
		<ul>
			<li>Tuoteryhmat</li>
		</ul>
			<?php
			foreach($tuotteet as $tuote) {
				echo "<div><p>{$tuote->nimi}<br>
							{$tuote->kuvaus}<br>
							Hinta: {$tuote->hinta}<br>
							<form action=\"tilaa.php\" method=\"POST\">
								<input type=\"text\" name=\"maara\" size=\"1\" value=\"0\"> kpl
								<input type=\"hidden\" name=\"asiakas\" value=\"{$_SESSION["kayttaja"]}\">
								<input type=\"hidden\" name=\"tuote\" value=\"{$tuote->id}\">
								<input type=\"submit\" value=\"Tilaa\">
							</form>
							</p>
					</div>";
				}
			?>
		</section>
<?php require_once("ala.php"); ?>
