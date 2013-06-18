<?php 
	require_once("../avusteet.php"); 
	$tuoteryhmat = haeTuoteryhmat();
	$otsikko = "Etusivu | Yllapito";
	require_once("../avusteet/yla.php");
?>

			<h1>Ylläpidon sivut</h1>
			<ul id = "lisaa">	
				<li>
					<form method="POST" action="lisaa.php" enctype="multipart/form-data">
						<fieldset>
							<legend>Lisää tuote</legend>
							<label>Tuotteen nimi*</label>
							<input type="text" name="nimi"/><br>
							<label>Tuotteen hinta*</label>
							<input type="text" name="hinta"/>€<br>
							<label>Tuoteryhmä*</label>
							<select name="tuoteryhmat">
								<option value="" selected="selected"></option>;
							<?php 
							
								foreach ($tuoteryhmat as $tuoteryhma) {
									echo "<option value=\"{$tuoteryhma->id}\">{$tuoteryhma->nimi}</option>";
								}
							?>
							</select><br>
							<label>Tuotteen kuvaus*</label>
							<textarea value="kuvaus" rows="5" cols="40" name="kuvaus"></textarea><br>
							<label>Tuotteen kuva</label>
							<input type="hidden" value="" name="max_koko"/>
							<input type="file" name="kuva"/><br>
							<input type="submit" value="Lisää tuote"/>
						</fieldset>
					</form>			
				</li>		
				<li><a href="tuotteet.php">Muuta tuotetietoja tai poista tuote</a></li>
				<form action="tilausraportti.php" method="POST">
					<li>Tulosta tilausraportti lennosta. Lennon tunnus: <input type="text" name="lento"/><input type="submit" name="tilaa" value="Tilaa"/></li>
				</form>
				<li>Tulosta lasku ja toimitusasiakirja asiakkaalle, asiakasID: <input type="text"/><input type="button" value="Tilaa"/></li>
			</ul>	
	</body>
</html>
