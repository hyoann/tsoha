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
			<?php if (isset($_SESSION["kayttaja"])) {
				require_once "navigaatio.php";
			}
			?>
		</header>
	