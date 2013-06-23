<?php
	session_start();
	require_once("../avusteet.php");
	onkoYllapito();
	
	$otsikko = "Tuotteet | Yllapito";
	require_once("../avusteet/yla_yllapito.php");
	
	$tuotteet = haeTuotteet();
	
	if (empty($tuotteet)) {
		die("Valikoimassa ei ole tuotteita.");
	}
?>

<section>

	<h1>Tuotteet</h1>
	
	<p>Valitse listasta poistettavat tuotteet tai valitse tuote, jonka tietoja haluat muuttaa.</p>
	
	<form action="poista.php" method="POST">
	
		<table id="tuotteet" >
		
			<tr>
				<th></th>
				<th>ID</th>
				<th>Nimi</th>
				<th>Hinta (€)</th>
				<th>Tuoteryhmä</th>
				<th>Kuvaus</th>
				<th>Kuva</th>
				<th></th>
			</tr>
			
			<?php foreach($tuotteet as $tuote) {;?>
			<tr>
				<td><input type="checkbox" name="lista[]" value="<?php echo $tuote->id; ?>"/></td>					
				<td> <?php echo $tuote->id; ?></td>
				<td> <?php echo htmlspecialchars($tuote->nimi); ?></td>
				<td> <?php echo htmlspecialchars($tuote->hinta); ?></td>
				<td> <?php echo $tuote->ryhma; ?></td>
				<td> <?php echo htmlspecialchars($tuote->kuvaus); ?> </td>
				<td> <?php haeKuva($tuote); ?> </td>
				<td id="oikealaita"><input type="submit" name="muuta[ <?php echo $tuote->id; ?>]" value="Muokkaa"></td>					
			</tr>	
			<?php } ?>
			
		</table>
		
		<input class="tilaaymparille" type="submit" name="poista"  value="Poista valitut" />
		
	</form>
	
</section>

<?php require_once("../avusteet/ala.php") ?>
