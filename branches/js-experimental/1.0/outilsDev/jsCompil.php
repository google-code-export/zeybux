<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Compilation Javascript&css</title>
</head>
<body>
<?php
$lTempsDepart = microtime(true);

/******************************************* Generation Zeybux-Core *************************************/
function parcourirDossierjsCore($pPath) {
	if(is_dir($pPath)) {
		$d = dir($pPath);
		while (false !== ($entry = $d->read())) {	   
			//&& $entry != 'TemplateData.js'
		   if(	$entry != '.' 
		   		&& $entry != '..' 
		   		&& $entry != '.svn' 
		   		&& $entry != '.project'
		   		&& $entry != '.htaccess'		   		
		   		) {
		   		if(is_dir($d->path.'/'.$entry)) {
		   			parcourirDossierjsCore($d->path.'/'.$entry);
		   		} else {
		   			$filename = $d->path.'/'.$entry;
					$handle = fopen($filename, "r");
		   		 	while (!feof($handle)) {
				     	$fp = fopen("./zeybu/js/package/temp/zeybux-core.js", 'a');
			   			fwrite($fp,fgets($handle));
			   			fclose($fp);
				    }
					fclose($handle);
		   		}
		   }
		}
		$d->close();
	} else {
		$handle = fopen($pPath, "r");
   	 	while (!feof($handle)) {
	     	$fp = fopen("./zeybu/js/package/temp/zeybux-core.js", 'a');
   			fwrite($fp,fgets($handle));
   			fclose($fp);
	    }
		fclose($handle);
	}
}

// Création du fichier
$fp = fopen("./zeybu/js/package/temp/zeybux-core.js", 'w');
fclose($fp);

$Path = '../js/classes';
parcourirDossierjsCore($Path);
$Path = '../js/Commun';
parcourirDossierjsCore($Path);
$Path = '../js/vues/Identification';
parcourirDossierjsCore($Path);
$Path = '../js/vues/CommunVue.js';
parcourirDossierjsCore($Path);
$Path = '../js/template/IdentificationTemplate.js';
parcourirDossierjsCore($Path);

$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/0.2.0/outilsDev/ && java -jar yuicompressor-2.4.2.jar --charset utf-8 ./zeybu/js/package/temp/zeybux-core.js -o ./zeybu/js/package/zeybux-core-min.js');
echo $output;

/******************************************* Generation Zeybux-jquery *************************************/
function parcourirDossierJquery($pPath) {
	if(is_dir($pPath)) {
		$d = dir($pPath);
		while (false !== ($entry = $d->read())) {	   
			//&& $entry != 'TemplateData.js'
		   if(	$entry != '.' 
		   		&& $entry != '..' 
		   		&& $entry != '.svn' 
		   		&& $entry != '.project'
		   		&& $entry != '.htaccess'		   		
		   		) {
		   		if(is_dir($d->path.'/'.$entry)) {
		   			parcourirDossierJquery($d->path.'/'.$entry);
		   		} else {
		   			$filename = $d->path.'/'.$entry;
					$handle = fopen($filename, "r");
		   		 	while (!feof($handle)) {
				     	$fp = fopen("./zeybu/js/package/temp/zeybux-jquery.js", 'a');
			   			fwrite($fp,fgets($handle));
			   			fclose($fp);
				    }
					fclose($handle);
		   		}
		   }
		}
		$d->close();
	} else {
		$handle = fopen($pPath, "r");
   	 	while (!feof($handle)) {
	     	$fp = fopen("./zeybu/js/package/temp/zeybux-jquery.js", 'a');
   			fwrite($fp,fgets($handle));
   			fclose($fp);
	    }
		fclose($handle);
	}
}	

// Création du fichier
$fp = fopen("./zeybu/js/package/temp/zeybux-jquery.js", 'w');
fclose($fp);

$Path = '../js/jquery';
parcourirDossierJquery($Path);

$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/0.2.0/outilsDev/ && java -jar yuicompressor-2.4.2.jar --charset utf-8 ./zeybu/js/package/temp/zeybux-jquery.js -o ./zeybu/js/package/zeybux-jquery-min.js');
echo $output;

/******************************************* Generation des templates *************************************/
$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/0.2.0/outilsDev/ && java -jar yuicompressor-2.4.2.jar --charset utf-8 ../js/template/CommandeTemplate.js -o ./zeybu/js/package/zeybux-commande-template-min.js');
echo $output;
$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/0.2.0/outilsDev/ && java -jar yuicompressor-2.4.2.jar --charset utf-8 ../js/template/GestionCommandeTemplate.js -o ./zeybu/js/package/zeybux-gestioncommande-template-min.js');
echo $output;
$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/0.2.0/outilsDev/ && java -jar yuicompressor-2.4.2.jar --charset utf-8 ../js/template/MonCompteTemplate.js -o ./zeybu/js/package/zeybux-moncompte-template-min.js');
echo $output;

/******************************************* Generation Zeybux-vue *************************************/

$Path = '../js/vues';
$lListeVue = array();
$d = dir($Path);
while (false !== ($entry = $d->read())) {	
   if(	$entry != '.' 
   		&& $entry != '..' 
   		&& $entry != '.svn' 
   		&& $entry != '.project'
   		&& $entry != '.htaccess'		   		
   		) {
   		if(is_dir($d->path.'/'.$entry)) {
   			array_push($lListeVue,$entry);
   		} 
   }
}
$d->close();

function parcourirDossierVue($pPath,$pModule) {
	if(is_dir($pPath)) {
		$d = dir($pPath);
		while (false !== ($entry = $d->read())) {	   
			//&& $entry != 'TemplateData.js'
		   if(	$entry != '.' 
		   		&& $entry != '..' 
		   		&& $entry != '.svn' 
		   		&& $entry != '.project'
		   		&& $entry != '.htaccess'		   		
		   		) {
		   		if(is_dir($d->path.'/'.$entry)) {
		   			parcourirDossierVue($d->path.'/'.$entry,$pModule);
		   		} else {
		   			$filename = $d->path.'/'.$entry;
					$handle = fopen($filename, "r");
		   		 	while (!feof($handle)) {
				     	$fp = fopen("./zeybu/js/package/temp/zeybux-vue-" . $pModule . ".js", 'a');
			   			fwrite($fp,fgets($handle));
			   			fclose($fp);
				    }
					fclose($handle);
		   		}
		   }
		}
		$d->close();
	} else {
		$handle = fopen($pPath, "r");
   	 	while (!feof($handle)) {
	     	$fp = fopen("./zeybu/js/package/temp/zeybux-vue-" . $pModule . ".js", 'a');
   			fwrite($fp,fgets($handle));
   			fclose($fp);
	    }
		fclose($handle);
	}
}

foreach($lListeVue as $lModule) {
	// Création du fichier
	$fp = fopen("./zeybu/js/package/temp/zeybux-vue-" . $lModule . ".js", 'w');
	fclose($fp);	
	
	$Path = '../js/vues/' . $lModule;
	parcourirDossierVue($Path,$lModule);
	
	$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/0.2.0/outilsDev/ && java -jar yuicompressor-2.4.2.jar --charset utf-8 ./zeybu/js/package/temp/zeybux-vue-' . $lModule . '.js -o ./zeybu/js/package/zeybux-vue-' . $lModule . '-min.js');
	echo $output;
}


/******************************************* Generation css *************************************/
function parcourirDossierCss($pPath) {
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
	   			parcourirDossierCss($d->path.'/'.$entry);
	   		} else {
	   			$filename = $d->path.'/'.$entry;
				$handle = fopen($filename, "r");
	   		 	while (!feof($handle)) {	   	
	   		 		$lLigne = fgets($handle);	 		
	   		 		$lLigne = preg_replace('/@CHARSET "UTF-8";/',"",$lLigne);   		 		
			     	$fp = fopen("./zeybu/css/cssDev.css", 'a');
		   			fwrite($fp,$lLigne);
		   			fclose($fp);
			    }
				fclose($handle);
	   		}
	   }
	}
	$d->close();
}
$Path = '../css';
$lJs = '';
$fp = fopen("./zeybu/css/cssDev.css", 'w');
fwrite($fp,'@CHARSET "UTF-8";');
fclose($fp);	
parcourirDossierCss($Path);


$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/0.2.0/outilsDev/ && java -jar yuicompressor-2.4.2.jar --charset utf-8 ./zeybu/css/cssDev.css -o ./zeybu/css/cssDev-min.css');
echo $output;

/******************************************* Generation zeybux-dev.js *************************************/

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
	   		&& $entry != 'zeybux-min.js' 
	   		&& $entry != 'package' 
	   		&& $entry != 'jquery'  
	   		&& $entry != 'jsCompil.php' 
	   		&& $entry != 'jquery.numeric.js'
	   		&& $entry != 'jquery.numeric.pack.js'
	   		&& $entry != 'jquery.ui.datepicker-fr.js'
	   		&& $entry != 'jquery-ui-1.8.custom.min.js'
	   		&& $entry != 'jquery-1.4.2.min.js'
	   		&& $entry != 'jquery.selectboxes.pack.js'
	   		) {
	   		if(is_dir($d->path.'/'.$entry)) {
	   			parcourirDossier($d->path.'/'.$entry);
	   		} else {
	   			$filename = $d->path.'/'.$entry;
				$handle = fopen($filename, "r");
	   		 	while (!feof($handle)) {
			     	$fp = fopen("./zeybu/js/jsDev.js", 'a');
		   			fwrite($fp,fgets($handle));
		   			fclose($fp);
			    }
				fclose($handle);
	   		}
	   }
	}
	$d->close();
}
$Path = '../js';
$lJs = '';
$fp = fopen("./zeybu/js/jsDev.js", 'w');
fclose($fp);	
parcourirDossier($Path);

$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/0.2.0/outilsDev/ && java -jar yuicompressor-2.4.2.jar --charset utf-8 ./zeybu/js/jsDev.js -o ./zeybu/js/zeybux-min.js');
echo $output;

// Calcul du temps d'exécution du script
$lTempsFin = microtime(true);
$lTemps = $lTempsFin - $lTempsDepart;

function formatBytes($b,$p = null) {
    /**
     *
     * @author Martin Sweeny
     * @version 2010.0617
     *
     * returns formatted number of bytes.
     * two parameters: the bytes and the precision (optional).
     * if no precision is set, function will determine clean
     * result automatically.
     *
     **/
    $units = array("B","kB","MB","GB","TB","PB","EB","ZB","YB");
    $c=0;
    if(!$p && $p !== 0) {
        foreach($units as $k => $u) {
            if(($b / pow(1024,$k)) >= 1) {
                $r["bytes"] = $b / pow(1024,$k);
                $r["units"] = $u;
                $c++;
            }
        }
        return number_format($r["bytes"],2) . " " . $r["units"];
    } else {
        return number_format($b / pow(1024,$p)) . " " . $units[$p];
    }
}
$lTotal = 0;
$lTotalMin = 0;


	echo "<p>Complation terminée en ". substr($lTemps,0,5) . " secondes.</p><br/>";
?>	
	<table style="border:1px solid black; border-collapse:collapse;">
		<tr>
			<th style="border:1px solid black;padding:3px;padding:3px;">Nom du fichier</th>
			<th style="border:1px solid black;padding:3px;">Version brut</th>
			<th style="border:1px solid black;padding:3px;">Version min</th>
			<th style="border:1px solid black;padding:3px;">Gain</th>
		</tr>
		<tr>
			<td style="border:1px solid black;bold:bold;padding:3px;">jsDev.js</td>
			<td style="border:1px solid black;padding:3px;"><?php $lTaille = filesize("./zeybu/js/jsDev.js");echo formatBytes($lTaille);?></td>
			<td style="border:1px solid black;padding:3px;"><?php $lTailleMin = filesize("./zeybu/js/zeybux-min.js");echo formatBytes($lTailleMin);?></td>
			<td style="border:1px solid black;padding:3px;"><?php echo formatBytes($lTaille-$lTailleMin);?></td>
		</tr>
		<tr>
			<td style="border:1px solid black;bold:bold;padding:3px;">###########################</td>
			<td style="border:1px solid black;bold:bold;padding:3px;">##########</td>
			<td style="border:1px solid black;bold:bold;padding:3px;">##########</td>
			<td style="border:1px solid black;bold:bold;padding:3px;">##########</td>
		</tr>
		<tr>
			<td style="border:1px solid black;padding:3px;">zeybux.css</td>
			<td style="border:1px solid black;padding:3px;"><?php $lTaille = filesize("./zeybu/css/cssDev.css");$lTotal += $lTaille;echo formatBytes($lTaille);?></td>
			<td style="border:1px solid black;padding:3px;"><?php $lTailleMin = filesize("./zeybu/css/cssDev-min.css");$lTotalMin += $lTaille;echo formatBytes($lTailleMin);?></td>
			<td style="border:1px solid black;padding:3px;"><?php echo formatBytes($lTaille-$lTailleMin);?></td>
		</tr>
		<tr>
			<td style="border:1px solid black;padding:3px;">zebux-core.js</td>
			<td style="border:1px solid black;padding:3px;"><?php $lTaille = filesize ("./zeybu/js/package/temp/zeybux-core.js");$lTotal += $lTaille;echo formatBytes($lTaille);?></td>
			<td style="border:1px solid black;padding:3px;"><?php $lTailleMin = filesize ("./zeybu/js/package/zeybux-core-min.js");$lTotalMin += $lTailleMin;echo formatBytes($lTailleMin);?></td>
			<td style="border:1px solid black;padding:3px;"><?php echo formatBytes($lTaille-$lTailleMin);?></td>
		</tr>	
		<tr>
			<td style="border:1px solid black;padding:3px;">zeybux-jquery.js</td>
			<td style="border:1px solid black;padding:3px;"><?php $lTaille = filesize ("./zeybu/js/package/temp/zeybux-jquery.js");$lTotal += $lTaille;echo formatBytes($lTaille);?></td>
			<td style="border:1px solid black;padding:3px;"><?php $lTailleMin = filesize ("./zeybu/js/package/zeybux-jquery-min.js");$lTotalMin += $lTailleMin;echo formatBytes($lTailleMin);?></td>
			<td style="border:1px solid black;padding:3px;"><?php echo formatBytes($lTaille-$lTailleMin);?></td>
		</tr>	
		<tr>
			<td style="border:1px solid black;padding:3px;">zeybux-commande-template.js</td>
			<td style="border:1px solid black;padding:3px;"><?php $lTaille = filesize ("../js/template/CommandeTemplate.js");$lTotal += $lTaille;echo formatBytes($lTaille);?></td>
			<td style="border:1px solid black;padding:3px;"><?php $lTailleMin = filesize ("./zeybu/js/package/zeybux-commande-template-min.js");$lTotalMin += $lTailleMin;echo formatBytes($lTailleMin);?></td>
			<td style="border:1px solid black;padding:3px;"><?php echo formatBytes($lTaille-$lTailleMin);?></td>
		</tr>	
		<tr>
			<td style="border:1px solid black;padding:3px;">zeybux-moncompte-template.js</td>
			<td style="border:1px solid black;padding:3px;"><?php $lTaille = filesize ("../js/template/MonCompteTemplate.js");$lTotal += $lTaille;echo formatBytes($lTaille);?></td>
			<td style="border:1px solid black;padding:3px;"><?php $lTailleMin = filesize ("./zeybu/js/package/zeybux-moncompte-template-min.js");$lTotalMin += $lTailleMin;echo formatBytes($lTailleMin);?></td>
			<td style="border:1px solid black;padding:3px;"><?php echo formatBytes($lTaille-$lTailleMin);?></td>
		</tr>	
		<tr>
			<td style="border:1px solid black;padding:3px;">zeybux-gestioncommande-template.js</td>
			<td style="border:1px solid black;padding:3px;"><?php $lTaille = filesize ("../js/template/GestionCommandeTemplate.js");$lTotal += $lTaille;echo formatBytes($lTaille);?></td>
			<td style="border:1px solid black;padding:3px;"><?php $lTailleMin = filesize ("./zeybu/js/package/zeybux-gestioncommande-template-min.js");$lTotalMin += $lTailleMin;echo formatBytes($lTailleMin);?></td>
			<td style="border:1px solid black;padding:3px;"><?php echo formatBytes($lTaille-$lTailleMin);?></td>
		</tr>
		<?php 
if(isset($lListeVue) && is_array($lListeVue)) {
	foreach($lListeVue as $lModule) {		
		$lTaille = filesize ("./zeybu/js/package/temp/zeybux-vue-" . $lModule . ".js");
		$lTotal += $lTaille;
		$lTailleMin = filesize ("./zeybu/js/package/zeybux-vue-" . $lModule . "-min.js");
		$lTotalMin += $lTailleMin;
		echo "
		<tr>
			<td style=\"border:1px solid black;padding:3px;\">zeybux-vue-" . $lModule . ".js</td>
			<td style=\"border:1px solid black;padding:3px;\">" . formatBytes($lTaille) . "</td>
			<td style=\"border:1px solid black;padding:3px;\">" . formatBytes($lTailleMin) . "</td>
			<td style=\"border:1px solid black;padding:3px;\">" . formatBytes($lTaille-$lTailleMin) . "</td>
		</tr>";
	}
}
		?>
		<tr>
			<td style="border:1px solid black;padding:3px;">Total</td>
			<td style="border:1px solid black;padding:3px;"><?php echo formatBytes($lTotal);?></td>
			<td style="border:1px solid black;padding:3px;"><?php echo formatBytes($lTotalMin);?></td>
			<td style="border:1px solid black;padding:3px;"><?php echo formatBytes($lTotal-$lTotalMin);?></td>
		</tr>		
	</table>
	</body>
</html>