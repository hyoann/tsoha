<?php
	require_once("yllapito_funktioita.php");
	$tuotteet = haeTuotteet();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"></meta>
		<link rel="stylesheet" type="text/css" href="yllapito_etusivu_muotoilu.css"/>
		<title>Poista tuote | Yllapito </title>
	</head>
	<body>
		<header><h1>Poista tuotteita</h1></header>
		<form action="poista.php" method="POST">
			<table>
				<tr>
					<th></th>
					<th>ID</th>
					<th>Nimi</th>
					<th>Hinta</th>
					<th>Tuoteryhmä</th>
					<th>Kuvaus</th>
					<th>Kuva</th>
				</tr>
				<?php foreach($tuotteet as $tuote) { 
					echo "<tr>";
					echo "<td><input type=\"checkbox\" name=\"poistolista[]\" value=\"{$tuote->id}\"><td>";
					echo "<td>{$tuote->id}<td>";
					echo "<td>{$tuote->nimi}<td>";
					echo "<td>{$tuote->hinta}<td>";
					$nimir = haeRyhmanNimi($tuote->ryhma_id);
					echo "<td>{$nimir['nimi']}<td>";
					echo "<td>{$tuote->kuvaus}<td>";
					echo "<td>" . haeKuva($tuote->id) . "</td>";					
					echo"</tr>";	
					}
				?>
			</table>
			<input type="submit" name="poista"  value="Poista valitut">
		</form>
	</body>
</html>
