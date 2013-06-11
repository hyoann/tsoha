<?php
	session_start();
	require_once("funktioita.php");
	onkoKirjautunut();
	$otsikko = "Omat tiedot | SiipiLomatOy";
	require_once("yla.php");
?>
	<link rel="stylesheet" type="text/css" href="omat_tiedot_muotoilu.css"/>
		<section>
			<h1>Hei <?php echo $_SESSION["kayttaja"]; ?>!Tekemäsi tilaukset:</h1>
			<table border>
				<tr>
					<th>Lento</th>
					<th>Päivämäärä</th>
					<th>Tilauksesi</th>
				</tr>
				<tr>
					<td>AY633 HEL-STO</td>
					<td>29.08.2013</td>
					<td>
						<ul>
							<li>Lakupussi, 2 kpl</li>
							<li>Aurinkolasit, 1 kpl</li>
							<li>Viinipullo, 2 kpl</li>
						</ul>
					</td>
				</tr>
				<tr>
					<td id="hinta" colspan="3">Yhteishinta: 54,3 €</td>
				</tr>
			</table>
			<input type="button" value="Muuta tilausta"/>
			<input type="button" value="Peru tilaus"/>
		</section>
<?php require_once("ala.php"); ?>
