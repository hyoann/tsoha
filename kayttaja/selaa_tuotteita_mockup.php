<?php
	session_start();
	require_once("funktioita.php");
	onkoKirjautunut();
	$otsikko = "Selaa tuotteita | SiipiLomatOy";
	require_once("yla.php");
?>
	<link rel="stylesheet" type="text/css" href="selaa_tuotteita_muotoilu.css"/>
	<body>
		<section>
			<div>
				<img src="http://farm4.staticflickr.com/3498/5728995874_ba112a373b_m.jpg" alt="lasit" width="240" height="161">
				<p>Huippuhienot UV-suojalliset aurinkolasit. Mustat kehykset kestävää muovia ja linssit huipputeknologiaa. Hinta: 299,9 €</p>
				<p>Tilaa:
					<select>
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					kpl <input type="button" value="Tilaa"/>
				</p>
			</div>
			<div>
				<img src="http://farm4.staticflickr.com/3102/3089742179_c44ffb56e8_m.jpg" alt="pullo" width="160" height="240">
				<p>Minipullo kuohuvaa! Nauti hedelmäisen makeasta ranskalaisesta kuohuviinistä. Pullon koko: 200 ml, hinta: 11 €</p>
			</div>
			<div>
				<img src="http://farm4.staticflickr.com/3108/2577927445_f123c53801_m.jpg" alt="karkkia" width="240" height="180">
				<p>Suositut suklaakarkit nyt Suomessa. Karkkipussi: 150 g, hinta: 2,4 €</p>
			</div>
		</section>
<?php require_once("ala.php"); ?>
