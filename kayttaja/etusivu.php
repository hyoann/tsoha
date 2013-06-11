<?php
	$otsikko = "Etusivu | SiipiLomatOy";
	require_once("logo.php");
?>
	<body>
		<article>
			<p>Tervetuloa SiipiLomatOy:n sivuille! Täällä voit tilata tax free -tuotteita ja me toimitamme ne suoraan lentokoneeseen paikallesi.
			Kirjaudu sisään lentoyhtiösi Sinulle toimittamilla tunnuksilla ja nauti lomastasi jo heti ilmassa!</p>
		</article>

		<form action="kirjautuminen.php" method="post">
				<label>Käyttäjätunnus:</label><br/>
				<input type="text" name="tunnus"/><br/>
				<label >Salasana:</label><br/>
				<input type="password" name="salasana"/><br/>		
				<input type="submit" value="Kirjaudu sisään"/>
		</form>
<?php require_once("ala.php"); ?>
