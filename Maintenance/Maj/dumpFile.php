<?php
function parcourirDossier($pPathIn,$pPathOut) {
	$d = dir($pPathIn);
	while (false !== ($entry = $d->read())) {	   
	   if(	$entry != '.' && $entry != '..' && $entry != 'Maintenance') {
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
parcourirDossier(DOSSIER_SITE,$lDossier);

echo "Sauvegarde des fichiers réalisée avec succès.<br/><br/>";
?>
