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
	   		&& $entry != 'template.js' 
	   		&& $entry != 'jsDev.js' 
	   		&& $entry != 'jsDev.php' 
	   		&& $entry != 'jquery' 
	   		&& $entry != 'jquery.numeric.js'
	   		&& $entry != 'jquery.numeric.pack.js'
	   		&& $entry != 'jquery.ui.datepicker-fr.js'
	   		&& $entry != 'jquery-ui-1.8.custom.min.js'
	   		&& $entry != 'jquery-1.4.2.min.js'
	   		&& $entry != 'jquery.selectboxes.pack.js'
	   		&& $entry != 'zeybux-min.js'
	   		&& $entry != 'package'
	   		) {
	   		if(is_dir($d->path.'/'.$entry)) {
	   			parcourirDossier($d->path.'/'.$entry);
	   		} else {
	   			$filename = $d->path.'/'.$entry;
				$handle = fopen($filename, "r");
	   		 	while (!feof($handle)) {
			      echo fgets($handle);
			    }
				fclose($handle);
	   		}
	   }
	}
	$d->close();
}
$Path = '.';
parcourirDossier($Path);
?>