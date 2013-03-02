<?php
header("content-type: application/x-javascript; charset=UTF-8");
$filenameJQuery = "jquery-1.8.3.min.js";
$filename = "./jquery/" . $filenameJQuery;
echo file_get_contents($filename);
$filenameJQUI = "jquery-ui-1.9.2.custom.min.js";
$filename = "./jquery/" . $filenameJQUI;
echo file_get_contents($filename);

function parcourirDossierJquery($pPath, $filenameJQuery, $filenameJQUI) {
	if(is_dir($pPath)) {
		$d = dir($pPath);
		while (false !== ($entry = $d->read())) {
		   if(	$entry != '.' 
		   		&& $entry != '..' 
		   		&& $entry != '.svn' 
		   		&& $entry != '.project'
		   		&& $entry != '.htaccess'
		   		&& $entry != 'Old'
		   		&& $entry != $filenameJQuery
		   		&& $entry != $filenameJQUI
		   		) {
		   		if(is_dir($d->path.'/'.$entry)) {
		   			parcourirDossierJquery($d->path.'/'.$entry, $filenameJQuery, $filenameJQUI);
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
$Path = './jquery';
parcourirDossierJquery($Path, $filenameJQuery, $filenameJQUI);
?>