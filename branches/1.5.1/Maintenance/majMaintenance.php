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
	// 4/ Lancement des scripts	
		// Version actuelle
		require_once("./version.php");
		
		// Fonction qui permet de décomposer le numéro de version et de mettre 0 si il n'y a rien
		function decomposerVersion($pVersion) {
			$lVersion = explode("\.",$pVersion);
			$lVersionRetour = array(0,0,0);
			if(isset($lVersion[0])) {
				$lVersionRetour[0] = $lVersion[0];
			}
			if(isset($lVersion[1])) {
				$lVersionRetour[1] = $lVersion[1];
			}
			if(isset($lVersion[2])) {
				$lVersionRetour[2] = $lVersion[2];
			}
			return $lVersionRetour;
		}
		
		$lTabVersion = array();
		$lVersionZeybux = decomposerVersion(ZEYBUX_VERSION_MAINTENANCE); // Décomposition de la version actuelle

		$lListeNomFichier = array();
		$d = dir("./script/");
		// Scan du dossier des scripts
		while (false !== ($entry = $d->read())) {
			if(		$entry != '.'
					&& $entry != '..'
					&& $entry != '.svn'
					&& $entry != '.project'
					&& $entry != '.htaccess'
					&& is_file($d->path . '/' . $entry)
			) {

				// enleve l'extention, tout ce qui se trouve apres le '.'
				$lNomFichier = substr($entry, 0, strrpos($entry,"."));
				$lVersion = decomposerVersion($lNomFichier);

				// Si la version de la modification est supérieure à celle du site on l'ajoute
				if($lVersion[0] > $lVersionZeybux[0]
						|| ($lVersion[0] = $lVersionZeybux[0] && $lVersion[1] > $lVersionZeybux[1])
						|| ($lVersion[0] = $lVersionZeybux[0] && $lVersion[1] = $lVersionZeybux[1] & $lVersion[2] > $lVersionZeybux[2])
				) {
					if(!isset($lTabVersion[$lVersion[0]])) {
						$lTabVersion[$lVersion[0]] = array();
					}
					if(!isset($lTabVersion[$lVersion[0]][$lVersion[1]])) {
						$lTabVersion[$lVersion[0]][$lVersion[1]] = array();
					}
					$lTabVersion[$lVersion[0]][$lVersion[1]][$lVersion[2]] = $entry;
				}
			}
		}
		// Lancement des scripts dans l'ordre des versions
		foreach($lTabVersion as $lMaj) {
			foreach($lMaj as $lMin) {
				foreach($lMin as $lLigne) {
					require_once($d->path.'/'.$lLigne);
				}
			}
		}
		$d->close();

	// 5/ Suppression de l'archive
		unlink("./" . $lNouvelleVersion["maintenance"]["phar"]);
		// Suppression des scripts
		viderDossier("./script/");
		rmdir("./script/");
		shell_exec('chmod -R 705 .');
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