<?php
header("content-type: application/x-javascript; charset=UTF-8");
$filename = "../template/CompteAssociationTemplate.js";
echo file_get_contents($filename);
function parcourirDossier($pPath) {
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
		   			parcourirDossier($d->path.'/'.$entry);
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
$Path = '../vues/CompteAssociation';
parcourirDossier($Path);
?>