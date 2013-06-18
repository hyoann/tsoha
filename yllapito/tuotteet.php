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
				<?php foreach($tuotteet as $tuote) { 
					echo "<tr>";
					echo "<td><input type=\"checkbox\" name=\"lista[]\" value=\"{$tuote->id}\"></td>";					
					echo "<td>{$tuote->id}</td>";
					echo "<td>{$tuote->nimi}</td>";
					echo "<td>{$tuote->hinta}</td>";
					$ryhma = haeRyhmanNimi($tuote->ryhma_id);
					echo "<td>{$ryhma['nimi']}</td>";
					echo "<td>{$tuote->kuvaus}</td>";
					echo "<td>";
					echo haeKuva($tuote->id);
					echo "</td>";
					echo "<td><input type=\"submit\" name=\"muuta[{$tuote->id}]\" value=\"Muuta\"></td>";					
					echo"</tr>";	
					}
				?>
			</table>
			<input type="submit" name="poista"  value="Poista valitut">
		</form>
		<p><a href="etusivu.php">Palaa takaisin etusivulle</a></p>
	</body>
</html>
