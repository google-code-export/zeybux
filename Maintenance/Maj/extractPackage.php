<?php
if(isset($_GET['p']) && !empty($_GET['p'])) {
	function supprimerDossierExtract($pPath) {
		$d = dir($pPath);
		while (false !== ($entry = $d->read())) {	   
		   if(	$entry != '.' && $entry != '..' && $entry != 'Maintenance' ) {
	   		if(is_dir($d->path.'/'.$entry)) {
	   			supprimerDossierExtract($d->path.'/'.$entry);
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
	supprimerDossierExtract(DOSSIER_EXTRACT);
	
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
		echo 'Extraction effectuée avec succès.<br/><br/>';
		$lTraitementOK = true;
	}
	else {
		echo 'Echec de l\'extraction.';
		echo '<br/><br/><a id="lien_btn_fermer_acces" href="./index.php?m=Maj&amp;e=3&amp;p=' .$_GET['p'] . '">
			<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Retour</button>
		</a>';
	}
} else {
	echo 'Echec de l\'extraction.';
}
?>
