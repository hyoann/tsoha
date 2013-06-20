<?php
	$otsikko = "Kirjautuminen | Yllapito";
	require_once("../avusteet/yla_yllapito.php");
?>

<section class="keskita">

	<h1>Ylläpito</h1>
	
	<form action="kirjaudu.php" method="POST">
		<label>Käyttäjätunnus</label><br>
		<input type="text" name="tunnus"/><br>
		<label>Salasana</label><br>
		<input type="password" name="salasana" /><br>
		<input type="submit" name="sisaan" value="Kirjaudu sisään"/>
	</form>
	
</section>

<?php require_once("../avusteet/ala.php"); ?>