<?php
	session_start();
	require_once("../avusteet.php");
	onkoYllapito();
	
	$otsikko = "Tilausraportti | Yllapito";
	require_once("../avusteet/yla_yllapito.php");
	
	$matkustajat = haeMatkustajatJaOstokset($_POST['lento']);
	
	if (empty($matkustajat)) {
		die("Lennolla ei ole matkustajia.");
	}
?>

<section>

	<h1>Tilausraportti lennolle <?php echo $_POST['lento']; ?></h1>
	 
	 <table border>
	 
		<tr>
			<th>Istumapaikka</th>
			<th>AsiakasID</th>
			<th>Matkustaja</th>
			<th>TuoteID</th>			
			<th>Tuotteet</th>
			<th>Kpl</th>
		</tr>
		
		<?php		
			 foreach ($matkustajat as $matkustaja) { ?>
		<tr>
			<td><?php echo $matkustaja['istumapaikka']; ?></td>
			<td><?php echo $matkustaja['id']; ?></td>
			<td><?php echo $matkustaja['nimi']; ?></td>
			<td><?php echo $matkustaja['tuote_id']; ?></td>
			<td><?php echo htmlspecialchars($matkustaja['tuotenimi']); ?></td>
			<td><?php echo htmlspecialchars($matkustaja['tuotemaara']); ?></td>
		</tr>
		<?php } ?>
		
	</table>
	
</section>

<section>
	<p>Yhteenveto lennolle tilatuista tuotteista:</p>

	<ul>
	<?php
		$tuotteet = tuotteidenMaara($_POST['lento']);
		foreach ($tuotteet as $tuote) {?>
		<li><?php echo htmlspecialchars($tuote['nimi']) . ", " . htmlspecialchars($tuote['maara']) . " kpl"; ?></li>
	<?php } ?>
	</ul>
</section>

<?php require_once("../avusteet/ala.php"); ?>
