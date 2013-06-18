<?php
	require_once("../avusteet.php");
	$matkustajat = haeMatkustajat($_POST['lento']);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"></meta>
		<link rel="stylesheet" type="text/css" href="yllapito_etusivu_muotoilu.css"/>
		<title>Tilausraportti | Yllapito </title>
	</head>
	<body>
		<header>
			<h1>Tilausraportti lennolle <?php echo $_POST['lento']; ?></h1>
		</header>
		<section>
			<table border>
				<tr>
					<th>Istumapaikka</th>
					<th>Matkustaja</th>
					<th>Tuotteet</th>
				</tr>
				<?php		
					foreach ($matkustajat as $matkustaja) {
						$ostokset = haeOstokset($matkustaja['id']);
						echo "<tr>";
						echo "<td>";
						echo $matkustaja['istumapaikka'];
						echo "</td>";	
						echo "<td>";
						echo $matkustaja['nimi'];
						echo "</td>";
						echo "<td>";
						foreach ($ostokset as $ostos) {
							echo "<ul>";
								echo "<li>" . haeTuote($ostos['tuote_id'])->nimi  . "{$ostos['tuotemaara']} kpl</li>";
							echo "</ul>";
						}
						echo "</td>";
					}
					
				?>
			</table>
		</section>
		<section>
			<p>Yhteenveto lennolle tilatuista tuotteista:</p>
		<section>
	</body>
</html>