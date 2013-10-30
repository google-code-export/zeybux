<?php

$lArchives = array();
if(is_dir(DOSSIER_UPLOAD)) {
	$d = dir(DOSSIER_UPLOAD);
	while (false !== ($entry = $d->read())) {

		if( $entry != '.'
		&& $entry != '..'
			) {
			array_push($lArchives,$entry);
		}
	}
	$d->close();
}
sort($lArchives);
foreach($lArchives as $lArchive) {

echo '<a href="./index.php?m=Maj&amp;e=4&amp;p=' . $lArchive . '">' . $lArchive . '
	<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Déployer</button>
</a><br/><br/>';

}


?>