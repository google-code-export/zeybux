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
	   		&& $entry != 'zeybux-configuration.php'
	   		&& $entry != 'zeybux-core.php' 
	   		&& $entry != 'zeybux-jquery.php'
	   		&& $entry != 'MessagesErreurs.js'
	   		&& $entry != 'Configuration.js'
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

$filename = "./template/CommunTemplate.js";
echo file_get_contents($filename);

$filename = "./vues/CommunVue.js";
echo file_get_contents($filename);

$filename = "./template/IdentificationTemplate.js";
echo file_get_contents($filename);

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
$Path = './vues/Identification';
parcourirDossierIdentification($Path);
?>