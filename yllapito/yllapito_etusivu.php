<?php 
	require_once("yllapito_funktioita.php"); 
	$tuoteryhmat = haeTuoteryhmat();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"></meta>
		<link rel="stylesheet" type="text/css" href="yllapito_etusivu_muotoilu.css"/>
		<title>Etusivu | Yllapito </title>
	</head>
	<body>
		<header>
			<h1>Ylläpidon sivut</h1>
		</header>
			<ul>	
				<li>
					<form method="POST" action="lisaa.php" enctype="multipart/form-data">
						<fieldset>
							<legend>Lisää tuote</legend>
							<label>Tuotteen nimi:</label>
							<input type="text" name="nimi"/><br>
							<label>Tuotteen hinta:</label>
							<input type="text" name="hinta"/><br>
							<label>Tuoteryhmä:</label>
							<select name="tuoteryhmat">
							<?php 
								foreach ($tuoteryhmat as $tuoteryhma) {
									echo "<option value=\"{$tuoteryhma->id}\">{$tuoteryhma->nimi}";
								}
							?>
							</select><br>
							<label>Tuotteen kuvaus:</label>
							<textarea value="kuvaus" rows="5" cols="40" name="kuvaus"></textarea><br>
							<label>Tuotteen kuva:</label>
							<input type="hidden" value="" name="max_koko"/>
							<input type="file" name="kuva"/><br>
							<input type="submit" value="Lisää tuote"/>
						</fieldset>
					</form>			
				</li>		
				<li><a href="poista_tuote.php">Muuta tuotetietoja tai poista tuote</a></li>
				<li>Tilaa tilausraportti lennosta. Syötä lennon tunnus: <input type="text"/><input type="button" value="Tilaa"/></li>
				<li>Tilaa lasku ja toimitusasiakirja asiakkaalle, asiakasID: <input type="text"/><input type="button" value="Tilaa"/></li>
			</ul>	
	</body>
</html>