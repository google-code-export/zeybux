<?php
header("content-type: text/css; charset=UTF-8");
echo "@CHARSET \"UTF-8\";";

function parcourirDossier($pPath) {
	$d = dir($pPath);
	while (false !== ($entry = $d->read())) {	   
	   if(	$entry != '.' 
	   		&& $entry != '..' 
	   		&& $entry != '.svn' 
	   		&& $entry != '.project'
	   		&& $entry != '.htaccess' 
	   		&& $entry != 'themes' 
	   		&& $entry != 'Entete.css'
	   		&& $entry != 'zeybux.php' 
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
?>