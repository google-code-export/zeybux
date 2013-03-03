<?php
function parcourirDossier($pPath,$pNbLigne) {
	$d = dir($pPath);
	echo "<h3> Dossier " . $d->path . "</h3><br/>\n";
	while (false !== ($entry = $d->read())) {	   
	   if(	$entry != '.' 
	   		&& $entry != '..' 
	   		&& $entry != '.svn' 
	   		&& $entry != '.project' 
	   		&& $entry != 'logs' 
	   		&& $entry != 'Logging' 
	   		&& $entry != 'outilsDev' 
	   		&& $entry != 'images' 
	   		&& $entry != '.htaccess' 
	   		&& $entry != 'install'
	   		&& $entry != 'jquery.numeric.js'
	   		&& $entry != 'jquery.numeric.pack.js'
	   		&& $entry != 'jquery.ui.datepicker-fr.js'
	   		&& $entry != 'jquery-ui-1.8.custom.min.js'
	   		&& $entry != 'jquery-1.4.2.min.js'
	   		&& $entry != 'jquery.selectboxes.pack.js'
	   		) {
	   		if(is_dir($d->path.'/'.$entry)) {
	   			$pNbLigne = parcourirDossier($d->path.'/'.$entry,$pNbLigne);
	   		} else {
	   			$lNbLigneFichier = 0;
	   			$filename = $d->path.'/'.$entry;
				$handle = fopen($filename, "r");
	   		 	while (!feof($handle)) {
			        fgets($handle);
			        $lNbLigneFichier++;
			    }
				fclose($handle);
				$pNbLigne += $lNbLigneFichier;
				echo $filename.' : '.$lNbLigneFichier.' lignes<br/>';
				//echo $lNbLigneFichier.'+';
				//$lLigneDossier += $lNbLigneFichier;
	   		}
	   }
	}
	$d->close();
	return $pNbLigne;
}
$Path = '..';
echo "<br/>Nombre de ligne total : " . number_format(parcourirDossier($Path,0), '', ',', ' ') ;
?>