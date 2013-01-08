<?php

// Supression de l'ancien site excepté dossier maintenance, index.php, dossier configuration et Maintenance.php du dossier configuration
// Pas de suppression des logs
function supprimerDossier($pPath) {
	$d = dir($pPath);
	while (false !== ($entry = $d->read())) {	   
	   if(	$entry != '.' && $entry != '..' && $entry != 'index.html' && $entry != 'Maintenance.php' && $entry != 'Maintenance' && $entry != 'logs' && $entry != "DB.php" && $entry != "Mail.php"
	    && $entry != ".htaccess") {
   		if(is_dir($d->path.'/'.$entry)) {
   			supprimerDossier($d->path.'/'.$entry);
			if($entry != 'configuration') {
				rmdir($d->path.'/'.$entry);
			}
   		} else {
   			$filename = $d->path.'/'.$entry;
			unlink($filename);
   		}
	   }
	}
	$d->close();
}
supprimerDossier(DOSSIER_SITE);


function parcourirDossier($pPathIn,$pPathOut) {
	$d = dir($pPathIn);
	while (false !== ($entry = $d->read())) {	   
	   if(	$entry != '.' && $entry != '..' && $entry != 'index.html' && $entry != 'Maintenance.php' 
	   		&& $entry != 'Maintenance' && $entry != 'update.sql' && $entry != "DB.php" && $entry != "Mail.php"
	   		&& $entry != "bdd"
	   && $entry != ".htaccess") {
   		if(is_dir($d->path.'/'.$entry)) {
			if(!is_dir($pPathOut .'/'. $entry)) {
				mkdir($pPathOut .'/'. $entry);
			}
   			parcourirDossier($d->path.'/'.$entry,$pPathOut.'/'. $entry);
   		} else {
   			$filename = $d->path.'/'.$entry;
			copy($filename , $pPathOut .'/'. $entry);
   		}
	   }
	}
	$d->close();
}
parcourirDossier(DOSSIER_EXTRACT,DOSSIER_SITE);

echo "Déploiement des fichiers réalisé avec succès.<br/><br/>";

?>
