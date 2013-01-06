<?php
header("content-type: application/x-javascript; charset=UTF-8");
$filename = "./jquery/jquery-1.4.2.min.js";
echo file_get_contents($filename);
//$filename = "./jquery/jquery-ui-1.8.custom.min.js";
$filename = "./jquery/jquery-ui-1.8.15.custom.min.js";
echo file_get_contents($filename);
function parcourirDossierJquery($pPath) {
	if(is_dir($pPath)) {
		$d = dir($pPath);
		while (false !== ($entry = $d->read())) {
		   if(	$entry != '.' 
		   		&& $entry != '..' 
		   		&& $entry != '.svn' 
		   		&& $entry != '.project'
		   		&& $entry != '.htaccess'	
		   		&& $entry != 'jquery-1.4.2.min.js'	
		   		&& $entry != 'jquery-ui-1.8.custom.min.js'	
		   		&& $entry != 'jquery-ui-1.8.15.custom.min.js'
		   		) {
		   		if(is_dir($d->path.'/'.$entry)) {
		   			parcourirDossierJquery($d->path.'/'.$entry);
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
parcourirDossierJquery($Path);
?>