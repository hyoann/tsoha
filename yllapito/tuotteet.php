<?php
	require_once("../avusteet.php");
	$tuotteet = haeTuotteet();
	$otsikko = "Tuotteet | Yllapito";
	require_once("../avusteet/yla.php");
?>
		<h1>Poista tuotteita</h1>
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
					<td> <?php echo $tuote->nimi; ?></td>
					<td> <?php echo $tuote->hinta; ?></td>
					<?php $ryhma = haeRyhmanNimi($tuote->ryhma_id); ?>
					<td> <?php echo $ryhma["nimi"]; ?></td>
					<td> <?php echo $tuote->kuvaus; ?> </td>
					<td> <?php haeKuva($tuote); ?> </td>
					<td><input type="submit" name= "muuta[ <?php echo $tuote->id; ?>]" value="Muuta"></td>					
				</tr>	
				<?php } ?>
			</table>
			<input type="submit" name="poista"  value="Poista valitut">
		</form>
		<p><a href="etusivu.php">Palaa takaisin etusivulle</a></p>
	</body>
</html>
