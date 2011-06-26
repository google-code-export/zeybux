<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Export du Zeybux</title>
</head>
<body>
<div><a href="./index.php">Retour</a></div>
<?php 
if(isset($_POST['nom']) && isset($_POST['env']) && isset($_POST['version']) && isset($_POST['source'])) {
	$lNom = $_POST['nom'];
	$lEnv = $_POST['env'];
	$lVersion = $_POST['version'];
	$lSource = $_POST['source'];
	
	$lPath = '../../' . $lNom;
	if(is_dir($lPath)) {
?>
	<form action="./ExportZeybux.php" method="post">
	<span>Le dossier d'export existe déjà !!</span><br/>
	<span>Nom du dossier Source</span><input type="text" name="source" /><br/>
	<span>Nom du dossier d'export</span><input type="text" name="nom" /><br/>
	<span>Version</span><input type="text" name="version" /><br/>
	<span>Environnement de destination
		<select name="env">
			<option value="free">Free</option>
			<option value="local">Local</option>
			<option value="localr7">Local R7</option>
		</select>		
	</span><br/>
	<input type="submit" value="Exporter"/>
	</form>
<?php 
	} else { 
		// Génération de l'export
		
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
		$Path = '/home/julien/Informatique/Dev/zeybu/www/'. $lSource . '/css';
		$lJs = '';
		$fp = fopen("./zeybu/css/cssDev.css", 'w');
		fwrite($fp,'@CHARSET "UTF-8";');
		fclose($fp);	
		parcourirDossierCss($Path);
		
		
		$fp = fopen("./zeybu/css/cssDev-min.css", 'w');
		fclose($fp);
		$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/' . $lSource . '/outilsDev/ && java -jar yuicompressor-2.4.2.jar --type css --charset utf-8 ./zeybu/css/cssDev.css -o ./zeybu/css/cssDev-min.css');
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
		$Path = '/home/julien/Informatique/Dev/zeybu/www/'. $lSource . '/js';
		$lJs = '';
		$fp = fopen("./zeybu/js/jsDev.js", 'w');
		fclose($fp);	
		parcourirDossier($Path);
		
		$fp = fopen("./zeybu/js/zeybux-min.js", 'w');
		fclose($fp);
		$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/'. $lSource . '/outilsDev/ && java -jar yuicompressor-2.4.2.jar --type js --charset utf-8 ./zeybu/js/jsDev.js -o ./zeybu/js/zeybux-min.js');
		echo $output;
		
		/************** Création des dossier **************/
		mkdir($lPath);
		
		mkdir($lPath . '/classes');
		mkdir($lPath . '/configuration');
		mkdir($lPath . '/css');
		mkdir($lPath . '/css/Commun');
		mkdir($lPath . '/css/themes');
		mkdir($lPath . '/html');
		mkdir($lPath . '/images');
		mkdir($lPath . '/js');
		mkdir($lPath . '/js/jquery');
		mkdir($lPath . '/logs');
		mkdir($lPath . '/vues');
		/************** Fin Création des dossier **************/

		
		/************** Copie des fichiers **************/	
		function parcourirDossierCopie($pPath,$pDest) {			
			$d = dir($pPath);
			while (false !== ($entry = $d->read())) {	   
			   	if(	$entry != '.' 
			   		&& $entry != '..' 
			   		&& $entry != '.svn' 
			   		&& $entry != '.project'
			   		) {
			   		if(is_dir($d->path.'/'.$entry)) {
				   		if(!is_dir($pDest.'/'.$entry)) {
							mkdir($pDest.'/'.$entry);
						}
			   			parcourirDossierCopie($d->path.'/'.$entry,$pDest.'/'.$entry);
			   		} else {
			   			copy( $d->path.'/'.$entry , $pDest.'/'.$entry);
			   		}
			   	}
			}	
			$d->close();
		}
		
		parcourirDossierCopie('../classes',$lPath . '/classes');
		parcourirDossierCopie('../configuration',$lPath . '/configuration');
		parcourirDossierCopie('../css/themes',$lPath . '/css/themes');
		parcourirDossierCopie('../html',$lPath . '/html');
		parcourirDossierCopie('../images',$lPath . '/images');
		parcourirDossierCopie('../js/jquery',$lPath . '/js/jquery');
		parcourirDossierCopie('../vues',$lPath . '/vues');
				
		copy('../index.php' , $lPath.'/index.php'); // Copie de l'index
		copy('./zeybu/js/zeybux-min.js' , $lPath.'/js/zeybux-min.js'); // Copie du js
		copy('./zeybu/css/cssDev-min.css' , $lPath.'/css/cssDev-min.css'); // Copie du css
		copy('../css/Commun/Entete.css' , $lPath.'/css/Commun/Entete.css'); // Copie du css
		
		// Écrase le fichier d'entête pour passer en version statique des fichiers css et js.
		copy('./zeybu/html/Commun/Entete.html' , $lPath.'/html/Commun/Entete.html'); 

		copy('../Maintenance/update.sql' , $lPath.'/update.sql'); // Le script de mise à jour de la BDD
		
		// Configuration du fichier d'environnement
		switch($lEnv) {
			case 'local':
				copy('./configuration/DB.php' , $lPath . '/configuration/DB.php'); 
				break;
			case 'localr7':
				copy('./configuration/LocalR7DB.php' , $lPath . '/configuration/DB.php'); 
				break;
			case 'free':
				copy('./configuration/freeDB.php' , $lPath . '/configuration/DB.php');
				copy('./classes/utils/JSON.php' , $lPath . '/classes/utils/JSON.php');
				copy('./classes/utils/CompatibiliteFree.php' , $lPath . '/classes/utils/CompatibiliteFree.php');
				
				// Ajout dans l'index du lien avec les classes pour la compatibilité avec les serveurs free
				$handle = @fopen($lPath . "/index.php", "r");
				if ($handle) {
					$fp = fopen('indextmp.php', 'w');
					$i = 1;
				    while (($buffer = fgets($handle)) !== false) {
				    	if($i == 28) {
				    		fwrite($fp,"// Compatibilite avec le server free\n");
							fwrite($fp,"include_once(CHEMIN_CLASSES_UTILS . \"CompatibiliteFree.php\");\n\n");
				    	}
				        fwrite($fp, $buffer);
				        $i++;
				    }
				    fclose($fp);
				    fclose($handle);
				}
				copy('indextmp.php' , $lPath . "/index.php");
				unlink('indextmp.php');
				
				break;
		}
		
		// Création de l'archive
		$lListeArchive = ' ';
		$d = dir($lPath);
		while (false !== ($entry = $d->read())) {
			if(	$entry != '.' && $entry != '..' ) {
				$lListeArchive .= $entry . ' ';
			}
		}
		$d->close();
		$output = shell_exec('cd ' . $lPath . ' && tar -czvf zeybux-' . $lEnv . '-' . $lVersion . '.tar.gz' . $lListeArchive . ' && chmod -R 777 .');
		//echo $output;
		
		/************** Fin Copie des fichiers **************/
		
		echo "<h1>Export Terminé !!</h1>";
	}	
} else {
?>
	<form action="./ExportZeybux.php" method="post">
		<span>Nom du dossier Source</span><input type="text" name="source" /><br/>
		<span>Nom du dossier d'export</span><input type="text" name="nom" /><br/>
		<span>Version</span><input type="text" name="version" /><br/>
		<span>Environnement de destination
			<select name="env">
				<option value="free">Free</option>
				<option value="local">Local</option>
				<option value="localr7">Local R7</option>
			</select>		
		</span><br/>
		<input type="submit" value="Exporter"/>
	</form>
<?php 
}
?>
</body>
</html>