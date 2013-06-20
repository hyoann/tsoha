<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"></meta>
		<link rel="stylesheet" type="text/css" href="../avusteet/tyyli.css"/>
		<title><?php echo $otsikko; ?></title>
	</head>
	<body>
		<header>
			<h1>SiipiLomat Oy</h1>
			
			<?php if(isset($_SESSION["yllapito"])) { ?>
			<nav class="navigaatio">
				<ul>
					<li><a href="ulos.php">Kirjaudu ulos</a></li>
					<li><a href="etusivu.php">Etusivu</a></li>
				</ul>
			</nav>
			<?php } ?>
			
		</header>