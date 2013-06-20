<?php
	session_start();
	require_once("../avusteet.php");
	onkoKirjautunut();
	
	$otsikko = "Muuta tilausta | SiipiLomatOy";	
	require_once("../avusteet/yla.php");
	
	$ostokset = ostostenHinnat($_SESSION["kayttaja"]);
	
	if (empty($ostokset)) {
		die("Tilauksessasi ei ole tuotteita.");
	}
	
    $lento = haeLento($_SESSION["kayttaja"]);
?>

<section id="muuta">
	
	<h1>Muuta tilausta lennolle <?php echo $lento["tunnus"] . " " . $lento["kohde"]; ?></h1>
	
    <form action="tilauksen_muutos.php" method="POST">
	
        <table> 
		<?php $yhteishinta = 0; 
		    foreach($ostokset as $ostos) {
		        $yhteishinta += $ostos["hinta"]; ?>
			<tr>
			    <td><?php echo htmlspecialchars($ostos["nimi"]); ?></td>
				<td>
				    <input type="hidden" name="asiakas" value="<?php echo $_SESSION["kayttaja"]; ?>"/>
					<input type="hidden" name="ostos[]" value="<?php echo $ostos["id"]; ?>"/>
					<input type="text" name="maara[]" size="1" value="<?php echo htmlspecialchars($ostos["tuotemaara"]); ?>"/> kpl
				</td>
				<td><?php echo htmlspecialchars($ostos["yksikkohinta"]); ?> € / kpl </td>
				<td><input type="submit" name="poista[<?php echo $ostos["id"]?>]" value="Poista" /></td>
			</tr>
		<?php } ?>
		</table>
		
        <p id="hinta">Yhteishinta: <?php echo $yhteishinta; ?> €</p>
		
        <input id="hyvaksy" type="submit" name="hyvaksy" value="Hyvaksy muutokset"/>
		
	</form>
	
</section>
		
<?php require_once("../avusteet/ala.php"); ?>
