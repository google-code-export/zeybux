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
	   		&& $entry != 'cssDev.php' 
	   		&& $entry != 'cssDev.css' 
	   		&& $entry != 'cssDev-min.css' 
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