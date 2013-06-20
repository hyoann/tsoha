<?php
	session_start();
	require_once("../avusteet.php");
	onkoYllapito();
	
	$tuoteryhmat = haeTuoteryhmat();
	
	$otsikko = "Etusivu | Yllapito";
	require_once("../avusteet/yla_yllapito.php");
?>

<section>

	<h1>Ylläpidon sivut</h1>
	
	<ul id = "lisaa">	
	
		<li>
			<form method="POST" action="lisaa.php" enctype="multipart/form-data">
				<fieldset>
					<legend>Lisää tuote</legend>
					<label>Tuotteen nimi *</label>
					<input type="text" name="nimi"/><br>
					<label>Tuotteen hinta *</label>
					<input type="text" name="hinta"/>€<br>
					<label>Tuoteryhmä *</label>
					
					<select name="tuoteryhmat">
						<option value="" selected="selected"></option>;
						<?php 
							foreach ($tuoteryhmat as $tuoteryhma) {
								echo "<option value=\"{$tuoteryhma->id}\">{$tuoteryhma->nimi}</option>";
							}
						?>
					</select><br>
					
					<label>Tuotteen kuvaus</label><br>
					<textarea value="kuvaus" rows="5" cols="40" name="kuvaus"></textarea><br>
					<label>Tuotteen kuva</label>
					<input type="file" name="kuva"/><br>
					<input type="submit" value="Lisää tuote"/>
					
					<p class="pienifontti">* = pakollinen kenttä</p>
				</fieldset>
			</form>					
		</li>		
		
		<li><a href="tuotteet.php">Muokkaa tuotetietoja tai poista tuote</a></li>	
		
		<li> Tulosta tilausraportti lennosta, lennon tunnus:
			<form class="inline" action="tilausraportti.php" method="POST">
				<input type="text" name="lento"/><input type="submit" name="tilaa" value="Tilaa"/>
			</form>
			<p></p>
			Lennot joille on tehty tilauksia:
			<ul id="lennot">	
				<?php foreach (haeLennot() as $lento) {?>
				<li><?php echo $lento["lento"]; ?></li>
				<?php } ?>
			</ul>
		</li>
		
		<li>Tulosta lasku asiakkaalle, asiakasID: 
			<form class="inline" action="lasku.php" method="POST">
				<input type="text" name="id"/><input type="submit" name="lasku" value="Tilaa"/>
			</form>
		</li>
		
	</ul>
	
</section>
			
<?php require_once("../avusteet/ala.php"); ?>
