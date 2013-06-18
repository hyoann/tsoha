<?php
	session_start();
	require_once("../avusteet.php");
	onkoKirjautunut();
	$otsikko = "Muuta tilausta | SiipiLomatOy";
	require_once("../avusteet/yla.php");
	$ostokset = haeOstokset($_SESSION["kayttaja"]);
    $lentotunnus = haeLento($_SESSION["kayttaja"]);
    $lento = haeLennonTiedot($lentotunnus["lento"]);
?>

		<section id="muuta">
		    <h1>Muuta tilausta lennolle <?php echo $lentotunnus["lento"]; echo " " . $lento["kohde"]; ?></h1>
           <form action="tilauksen_muutos.php" method="POST">
               <table> 
		            <?php foreach($ostokset as $ostos) { ?>
			        <tr>
			            <td><?php echo haeTuote($ostos["tuote_id"])->nimi ?></td>
					    <td>
				            <input type="hidden" name="asiakas" value="<?php echo $_SESSION['kayttaja']; ?>"/>
					        <input type="hidden" name="ostos[]" value="<?php echo $ostos['id']; ?>"/>
					        <input type="text" name="maara[]" size="1" value="<?php echo $ostos['tuotemaara']; ?>"/> kpl
					    </td>
					    <td><?php echo haeTuote($ostos["tuote_id"])->hinta ?> € / kpl </td>
					    <td><input type="submit" name="poista[<?php echo $ostos['id']?>]" value="Poista" /></td>
				    <?php } ?>
				    </tr>
			    </table>
                <p id="hinta">Yhteishinta: <?php echo laskeYhteishinta($ostokset); ?> </p>
                <input id="hyvaksy" type="submit" name="hyvaksy" value="Hyvaksy muutokset"/>
		    </form>
		</section>
		
<?php require_once("../avusteet/ala.php"); ?>
