<?php
header("content-type: application/x-javascript; charset=UTF-8");
function parcourirDossier($pPath) {
	$d = dir($pPath);
	while (false !== ($entry = $d->read())) {
	   if(	$entry != '.' 
	   		&& $entry != '..' 
	   		&& $entry != '.svn' 
	   		&& $entry != '.project'
	   		&& $entry != '.htaccess'
	   		&& $entry != 'jquery'
	   		&& $entry != 'package'
	   		&& $entry != 'template'
	   		&& $entry != 'vues'
	   		&& $entry != 'Configuration'
	   		&& $entry != 'zeybux-configuration.php'
	   		&& $entry != 'zeybux-core.php' 
	   		&& $entry != 'zeybux-jquery.php'
	   		&& $entry != 'MessagesErreurs.js'
	   		) {
	   		if(is_dir($d->path.'/'.$entry)) {
	   			parcourirDossier($d->path.'/'.$entry);
	   		} else {
	   			$filename = $d->path.'/'.$entry;
				echo file_get_contents($filename);
	   		}
	   }
	}
	$d->close();
}
$Path = '.';
parcourirDossier($Path);

function parcourirDossierIdentification($pPath) {
	if(is_dir($pPath)) {
		$d = dir($pPath);
		while (false !== ($entry = $d->read())) {
		   if(	$entry != '.' 
		   		&& $entry != '..' 
		   		&& $entry != '.svn' 
		   		&& $entry != '.project'
		   		&& $entry != '.htaccess'	   		
		   		) {
		   		if(is_dir($d->path.'/'.$entry)) {
		   			parcourirDossierIdentification($d->path.'/'.$entry);
		   		} else {
		   			$filename = $d->path.'/'.$entry;
				    echo file_get_contents($filename);
		   		}
		   }
		}
		$d->close();
	} else {
		echo file_get_contents($pPath);
	}
}
/* Identification */
$filename = "./template/IdentificationTemplate.js";
echo file_get_contents($filename);
$Path = './vues/Identification';
parcourirDossierIdentification($Path);

/* Core */
$filename = "./template/CoreTemplate.js";
echo file_get_contents($filename);
$Path = './vues/Core';
parcourirDossierIdentification($Path);

$filename = "./template/TypePaiementServiceTemplate.js";
echo file_get_contents($filename);

?>