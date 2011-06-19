<?php session_start(); ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Maintenance Zeybux</title>
</head>
<body>
	<?php

	if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) {
		require_once("./parametres.php");
		if(isset($_GET['e']) && !empty($_GET['e'])) {
			switch($_GET['e']) {
				case 1 :
					echo "<h2>Étape 2 : Sauvegarde de la base & fichiers</h2>";			
					include("./fermetureAcces.php");
					echo "<a href=\"./index.php?e=2\">Sauvegarde de la base & fichiers</a>";
				break;

				case 2 :
					echo "<h2>Étape 2 : Sauvegarde de la base & fichiers</h2>";			
					include("./dumpMySQL.php");
					include("./dumpFile.php");
					echo "<a href=\"./index.php?e=3\">Upload du Package</a>";
				break;

				case 3 :
					echo "<h2>Étape 3 : Upload du package</h2>";
					include("./formUpload.php");
				break;

				case 4 :
					echo "<h2>Étape 3 : Upload du package</h2>";
					include("./upload.php");
				break;

				case 5 :
					echo "<h2>Étape 4 : Extraire le package</h2>"; 
					include("./extractPackage.php");
					echo "<a href=\"./index.php?e=6\">Déploiement du Package</a>";
				break;

				case 6 :
					echo "<h2>Étape 5 : Déploiement du package</h2>";
					include("./updateMySQL.php");
					include("./deploiementFile.php");
					echo "<a href=\"./index.php?e=7\">Ouvrir l'accès</a>";
				break;

				case 7 :
					echo "<h2>Étape 6 : Ouverture du zeybux</h2>";
					include("./OuvertureAcces.php");
				break;
			}

		} else {?>

		<h2>Étape 1 : Fermeture du zeybux</h2>
		<a href="./index.php?e=1">Fermeture des accès</a><br/>
	
		<?php } 

		echo "<br/><br/><a href=\"./deconnexion.php\">Déconnexion</a><br/>";
	} else {
		include("./formConnexion.php");
	}
?>
</html>
