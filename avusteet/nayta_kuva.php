<?php
    require_once("kyselyt.php");
    $kysely = muodostaYhteys()->prepare("SELECT kuva FROM tuote WHERE id = ?");
    $kysely->execute(array($_GET["id"]));
    $tiedosto = $kysely->fetch();
    $kuva = base64_decode($tiedosto["kuva"]);
    echo $kuva;
?>
