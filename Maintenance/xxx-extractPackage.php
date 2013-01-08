<?php
if(isset($_GET['p']) && !empty($_GET['p'])) {



	function supprimerDossier($pPath) {
		$d = dir($pPath);
		while (false !== ($entry = $d->read())) {	   
		   if(	$entry != '.' && $entry != '..' && $entry != 'Maintenance' ) {
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
	supprimerDossier(DOSSIER_EXTRACT);




	require_once('./lib/pclerror.lib.php');
	require_once('./lib/pcltrace.lib.php');
	require_once('./lib/pcltar.lib.php');
	require_once('./lib/arrayToFile.lib.php');

	$p_tarname = DOSSIER_UPLOAD . $_GET['p'];
	$p_path = DOSSIER_EXTRACT;
	$p_remove_path = '';
	$p_mode = '';

	$lExtract =  PclTarExtract($p_tarname, $p_path, $p_remove_path, $p_mode);
	Array2File($lExtract,LOG_EXTRACT . date('Y-m-d_H:i:s') . "_" . $_GET['p'] . '.log');


	if(is_array($lExtract)) {
		echo 'Extraction effectuée avec succès !<br/><br/>';
	}
	else {
		echo 'Echec de l\'extraction !';
	}
} else {
	echo 'Echec de l\'extraction !';
}
?>
