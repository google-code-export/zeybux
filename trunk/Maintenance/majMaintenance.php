<?php 
session_start();
if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) {
	require_once("./parametres.php");	
	$lResponse = file_get_contents("http://" . ADRESSE_DEPOT_ZEYBUX . "/index.php");
	$lNouvelleVersion = json_decode($lResponse,true);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Maintenance Zeybux</title>
</head>	
<body>
<?php 
	if(isset($_GET['e']) && $_GET['e'] == 1) {
// 1/ Supprimer les fichiers
		function viderDossier($pPath) {
			if(is_dir($pPath)) {
				$d = dir($pPath);
				while (false !== ($entry = $d->read())) {
					if(		$entry != '.'
							&& $entry != '..'
							&& $entry != '.svn'
							&& $entry != '.project'
							&& $entry != 'conf'
							&& $entry != 'ancien'
					) {
						if(is_dir($d->path.'/'.$entry)) {
							viderDossier($d->path.'/'.$entry);
							rmdir($d->path.'/'.$entry);
						} else {
							unlink( $d->path.'/'.$entry );
						}
					}
				}
				$d->close();
			}
		}
		viderDossier(".");
		@unlink( "./conf/.htaccess" );
		@unlink( "./ancien/.htaccess" );
		
	// 2/ Télécharger le phar
		copy("http://" . ADRESSE_DEPOT_ZEYBUX . "/maintenance/" . $lNouvelleVersion["maintenance"]["phar"], "./" . $lNouvelleVersion["maintenance"]["phar"]);
	// 3/ Extraire le phar
		// Création du phar
		$p = new Phar("./" . $lNouvelleVersion["maintenance"]["phar"]);
		// Extraction de l'archive
		$p->extractTo(".");
	// 4/ Suppression de l'archive
		unlink("./" . $lNouvelleVersion["maintenance"]["phar"]);
?>
	Mise à jour OK : <a href="./index.php?m=Maj"><button>OK</button></a>
<?php
	} else {
		if($lNouvelleVersion["maintenance"]["version"] == ZEYBUX_VERSION_MAINTENANCE) {
			echo "Le Zeybux est à jour <a href=\"./index.php?m=Maj\"><button>OK</button></a>";
		} else {
			echo "<a href=\"./majMaintenance.php?e=1\" ><button>Installer la nouvelle version du module de maintenance : " . $lNouvelleVersion["maintenance"]["version"] . "</button></a>";
		}
	}
}
?>
</body>
</html>