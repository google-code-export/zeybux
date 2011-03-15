<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Zeybux - Css File Generator</title>
</head>
<body>
<div><a href="./index.php">Retour</a></div>
<?php

$lCheminTemplate = "../html";
$lCheminCss = "../css";

parcoursDossier($lCheminTemplate,$lCheminCss);

function parcoursDossier($pCheminTemplate,$pCheminCss) {

	$lDossier = dir($pCheminTemplate);
	//echo "Dossier " . $lDossier->path ."<br/>";
	
	while (false !== ($lEntree = $lDossier->read())) {
		$lFichierEnfant = $lDossier->path . '/' . $lEntree;
		//echo "FichierDossier " . var_dump( is_file($lFichierEnfant) ) . $lFichierEnfant . "<br/>";
		
		if( is_dir($lFichierEnfant) && $lEntree != "." && $lEntree != ".." && $lEntree != ".svn") {
			parcoursDossier($lFichierEnfant,$pCheminCss);
						
		} else if(is_file($lFichierEnfant) && $lEntree != ".htaccess") {
			$lFichierEnfantCss = substr_replace ($lFichierEnfant,$pCheminCss,0,7);
			$lFichierEnfantCss = substr_replace ($lFichierEnfantCss,"css",strlen($lFichierEnfantCss) - 4,4);			
			
			if( !file_exists($lFichierEnfantCss) ) {
				$fp = fopen($lFichierEnfantCss, 'w');
				fwrite($fp,"@CHARSET \"UTF-8\";\n");
				fclose($fp);
				echo "Création du fichier : " . substr_replace ($lFichierEnfantCss,"",0,3) . "<br/>";
			}
		}
	}
	
	$lDossier->close();
}
?>
	<h3>Traitements Terminés !!</h3>
</body>
</html>