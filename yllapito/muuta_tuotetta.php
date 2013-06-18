<?php
    require_once("../avusteet.php");
    $tuote = haeTuote($_GET['id']);
    $tuoteryhmat = haeTuoteryhmat();
	$otsikko = "Muuta tietoja | Yllapito";
	require_once("../avusteet/yla.php");
?>

		<h1>Muuta tuotteen tietoja</h1>
        <form method="POST" action="suorita_muutokset.php" enctype="multipart/form-data">
			<fieldset id = "muutos">
			<label>Tuotteen nimi:</label>
			<input type="text" name="nimi" value="<?php echo $tuote->nimi; ?>" /><br>
			<label>Tuotteen hinta:</label>
			<input type="text" name="hinta" value= "<?php echo $tuote->hinta; ?>" /><br>
			<label>Tuoteryhmä:</label>
			<select name="tuoteryhmat">";
			<?php foreach ($tuoteryhmat as $tuoteryhma) {
					if($tuoteryhma->id == $tuote->ryhma_id) {
						 $selected = "selected";
						 } else {
						     $selected = "";
						 }
					echo "<option {$selected} value=\"{$tuoteryhma->id}\">{$tuoteryhma->nimi}</option>";
				  }
		    ?>
			</select><br>
			<label>Tuotteen kuvaus:</label>
			<p id="kuvaus"><?php echo $tuote->kuvaus; ?></p>
	        <p>Kirjoita uusi kuvaus:</p>
			<textarea value="kuvaus" rows="5" cols="40" name="kuvaus"></textarea><br>
			<pl>Tuotteen kuva:</p>
			<?php haeKuva($tuote); ?>
			<br> <label>Valitse uusi kuva:</label>
			<input type="hidden" value="<?php echo $_GET['id']; ?>" name="id"/>
			<input type="file" name="kuva"/><br>
			<input type="submit" name="muuta" value="Hyväksy muutokset"/>
			</fieldset>	
			<a href="tuotteet.php">Palaa takaisin tuotelistaan</a>
		</form>		
    </body>
</html>
