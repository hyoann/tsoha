<?php
	session_start();
    require_once("../avusteet.php");
	onkoYllapito();
	
	$otsikko = "Muuta tietoja | Yllapito";
	require_once("../avusteet/yla_yllapito.php");
	
    $tuote = haeTuote($_GET["id"]);
    $tuoteryhmat = haeTuoteryhmat();	
?>
<section>
		
	<h1>Muuta tuotteen tietoja</h1>
	
    <form method="POST" action="suorita_muutokset.php" enctype="multipart/form-data">
		<fieldset id = "muutos">
			<label>Tuotteen nimi *</label>
			<input type="text" name="nimi" value="<?php echo htmlspecialchars($tuote->nimi); ?>" /><br>
			
			<label>Tuotteen hinta *</label>
			<input type="text" name="hinta" value= "<?php echo htmlspecialchars($tuote->hinta); ?>" /><br>
			
			<label>Tuoteryhmä *</label>	
			<select name="tuoteryhmat">";
			<?php foreach ($tuoteryhmat as $tuoteryhma) {
					if($tuoteryhma->id == $tuote->ryhma_id) {
						//tuotteen tuoteryhmä valitaan
						 $selected = "selected";
						 } else {
						     $selected = "";
						 }
					echo "<option {$selected} value='{$tuoteryhma->id}'>{$tuoteryhma->nimi}</option>";
				  }
		    ?>
			</select><br>
			
			<label>Tuotteen kuvaus</label>
			<p id="kuvaus"><?php echo htmlspecialchars($tuote->kuvaus); ?></p>
			
	        <label>Kirjoita uusi kuvaus</label><br>
			<textarea value="kuvaus" rows="5" cols="40" name="kuvaus"></textarea><br>
			
			<label>Tuotteen kuva</label><br>
			<?php haeKuva($tuote); ?><br>
			
			<label>Valitse uusi kuva</label>
			<input type="hidden" value="<?php echo $_GET["id"]; ?>" name="id"/>
			<input type="file" name="kuva"/><br>
			
			<p></p>
			
			<input class="inline" type="submit" name="muuta" value="Hyväksy muutokset"/>
			<p class="inline">tai <a href="tuotteet.php">palaa takaisin tuotelistaan</a></p>
			
			<p class="pienifontti">* = pakollinen kenttä</p>		
		</fieldset>	
	</form>		
	
</section>

<?php require_once("../avusteet/ala.php"); ?>
