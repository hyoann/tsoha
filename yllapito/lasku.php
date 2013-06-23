<?php
    session_start();
    require_once("../avusteet.php");
    onkoYllapito();
	
    $otsikko = "Lasku | Yllapito";
    require_once("../avusteet/yla_yllapito.php");
   
   if(!is_numeric($_POST['id'])) {
         die("AsiakasID ei kelpaa!");
    
	} else {		
		$asiakas = haeKayttaja($_POST['id']);
		
		if (empty($asiakas)) { 
			die ("Asiakasta ei löydy!");
        } 
	   
	   $ostokset = ostostenHinnat($_POST['id']);
	   
	   if(empty($ostokset)) {
			die("Asiakkaalla ei ole ostoksia!");
		}
    } 
	
	$lento = haeLento($_POST['id']);
	
?> 
	
<section>

    <h1>Lasku</h1>
	
    <ul id = "lasku">
        <li>Asiakkaan nimi: <?php echo $asiakas->nimi; ?></li>
        <li>Osoite: <?php echo $asiakas->osoite;?></li>
        <li>Puhelinnumero: <?php echo $asiakas->puhelin;?></li>
        <li>Lento: <?php echo $lento['tunnus'] . " " . $lento['kohde']; ?></li>
        <li>Lähtöpäivä: <?php echo $lento['paiva']; ?></li>
        
		<li>Tilaus:
            <table border>
              
			  <tr>
                    <th>Tuote</th>
                    <th>Kappalemäärä</th>
                    <th>Kappalehinta (€)</th>
                    <th>Yhteishinta</th>
                </tr>
				
                <?php $yhteishinta = 0;
                foreach($ostokset as $ostos) {
                    $yhteishinta += $ostos['hinta']; ?>
                <tr>
                    <td><?php echo htmlspecialchars($ostos['nimi']); ?></td>
                    <td><?php echo htmlspecialchars($ostos['tuotemaara']); ?></td>
                    <td><?php echo htmlspecialchars($ostos['yksikkohinta']); ?></td>
                    <td><?php echo $ostos['hinta']; ?></td>
                </tr>
                <?php } ?>
				
                <tr>
                    <td colspan="4">Yhteensä: <?php echo $yhteishinta; ?> €</td>
                </tr>
				
            <table>
        </li>
		
        <li>Tilinumero: 42367-2345646</li>
        <li>Viitenumero: 13145235<?php echo $_POST['id']; ?></li>
        <li>Eräpäivä: <?php echo $lento['paiva']; ?></li>
    </ul>  
	
</section>

<?php require_once("../avusteet/ala.php"); ?>
    

