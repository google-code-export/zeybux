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
	   				&& $entry != 'zeybux.php' 
			   		) {
			   		if(is_dir($d->path.'/'.$entry)) {
			   			parcourirDossierCss($d->path.'/'.$entry);
			   		} else {
			   			$filename = $d->path.'/'.$entry;						
						$lLigne = preg_replace('/@CHARSET "UTF-8";/',"",file_get_contents($filename));
						$fp = fopen("./zeybu/css/zeybux.css", 'a');
					    fwrite($fp,$lLigne);
					    fclose($fp);
						
			   		}
			   }
			}
			$d->close();
		}
		$Path = '/home/julien/Informatique/Dev/zeybu/www/'. $lSource . '/css';
		$lJs = '';
		$fp = fopen("./zeybu/css/zeybux.css", 'w');
		fwrite($fp,'@CHARSET "UTF-8";');
		fclose($fp);	
		parcourirDossierCss($Path);
		
		
		$fp = fopen("./zeybu/css/zeybux-min.css", 'w');
		fclose($fp);
		$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/' . $lSource . '/outilsDev/ && java -jar yuicompressor-2.4.2.jar --type css --charset utf-8 ./zeybu/css/zeybux.css -o ./zeybu/css/zeybux-min.css');
		echo $output;
		/******************************************* Generation zeybux-jquery.js *************************************/
		$fp = fopen("./zeybu/js/zeybux-jquery.js", 'w');
		$filename = "../js/jquery/jquery-1.4.2.min.js";
		fwrite($fp,file_get_contents($filename));
		//$filename = "./jquery/jquery-ui-1.8.custom.min.js";
		$filename = "../js/jquery/jquery-ui-1.8.15.custom.min.js";
		fwrite($fp,file_get_contents($filename));
		fclose($fp);
		
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
				   			$fp = fopen("./zeybu/js/zeybux-jquery.js", 'a');
						    fwrite($fp,file_get_contents($filename));
						    fclose($fp);
				   		}
				   }
				}
				$d->close();
			} else {
				$fp = fopen("./zeybu/js/zeybux-jquery.js", 'a');
			    fwrite($fp,file_get_contents($pPath));
			    fclose($fp);
			}
		}
		
		$Path = '../js/jquery';
		parcourirDossierJquery($Path);
		
		$fp = fopen("./zeybu/js/zeybux-jquery-min.js", 'w');
		fclose($fp);
		$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/'. $lSource . '/outilsDev/ && java -jar yuicompressor-2.4.2.jar --type js --charset utf-8 ./zeybu/js/zeybux-jquery.js -o ./zeybu/js/zeybux-jquery-min.js');
		echo $output;
		/******************************************* Fin Generation zeybux-jquery.js *************************************/
	
		/******************************************* Generation zeybux-core.js *************************************/		
		$fp = fopen("./zeybu/js/zeybux-core.js", 'w');
		$filename = "../js/template/CommunTemplate.js";
		fwrite($fp,file_get_contents($filename));
		$filename = "../js/vues/CommunVue.js";
		fwrite($fp,file_get_contents($filename));
		$filename = "../js/template/IdentificationTemplate.js";
		fwrite($fp,file_get_contents($filename));		
		fclose($fp);

		function parcourirDossierCore($pPath) {
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
			   			parcourirDossierCore($d->path.'/'.$entry);
			   		} else {
			   			$filename = $d->path.'/'.$entry;
			   			$fp = fopen("./zeybu/js/zeybux-core.js", 'a');
					    fwrite($fp,file_get_contents($filename));
					    fclose($fp);
			   		}
			   }
			}
			$d->close();
		}
		$Path = '../js';
		parcourirDossierCore($Path);
				
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
				   			$lLigne = file_get_contents($filename);
				   			if($entry == "AccueilVue.js") {			   				
				   				$lLigne = preg_replace("/.\/js\/zeybux-configuration.php/","./js/zeybux-configuration-min.js",$lLigne);
				   			}
				   			if($entry == "IdentificationTemplate.js") {
				   				$lLigne = preg_replace('/value=\\"(Z|zeybu)\\"/',"",$lLigne);	
				   			}
				   			if($entry == 'IdentificationVue.js') {
					   			$lLigne = preg_replace('/".php"/','"-min.js"',$lLigne);		
				   			}
						    $fp = fopen("./zeybu/js/zeybux-core.js", 'a');
						    fwrite($fp,$lLigne);
						    fclose($fp);
				   			
				   			
				   			
				   			/*$filename = $d->path.'/'.$entry;
					   		$lLigne = file_get_contents($filename);
				   			if($entry == "AccueilVue.js") {			
				   				$lLigne = preg_replace("#.php#","-min.js",$lLigne);
				   			}
				   			if($entry == "IdentificationTemplate.js") {
				   				$lLigne = preg_replace('#value=\\\"(Z|zeybu)\\\"#',"",$lLigne);	
				   			}
					   		if($entry = 'IdentificationVue.js') {
					   			$lLigne = preg_replace('#.php#',".js",$lLigne);		
				   			}
						   	$fp = fopen("./zeybu/js/zeybux-core.js", 'a');
						    fwrite($fp,file_get_contents($filename));
						    fclose($fp);*/
				   		}
				   }
				}
				$d->close();
			}
		}
		$Path = '../js/vues/Identification';
		parcourirDossierIdentification($Path);
		
		$fp = fopen("./zeybu/js/zeybux-core-min.js", 'w');
		fclose($fp);
		$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/'. $lSource . '/outilsDev/ && java -jar yuicompressor-2.4.2.jar --type js --charset utf-8 ./zeybu/js/zeybux-core.js -o ./zeybu/js/zeybux-core-min.js');
		echo $output;
		/******************************************* Fin Generation zeybux-core.js *************************************/

		/******************************************* Generation zeybux-configuration.js *************************************/
		// Création de zeybux-configuration
		$fp = fopen("./zeybu/js/zeybux-configuration.js", 'w');
		fclose($fp);
		
		$filename = "/home/julien/Informatique/Dev/zeybu/www/". $lSource . "/js/classes/utils/MessagesErreurs.js";
		$fp = fopen("./zeybu/js/zeybux-configuration.js", 'a');
	    fwrite($fp,file_get_contents($filename));
	    fclose($fp);
	    
	    $filename = "/home/julien/Informatique/Dev/zeybu/www/". $lSource . "/js/Commun/Configuration.js";
		$fp = fopen("./zeybu/js/zeybux-configuration.js", 'a');
	    fwrite($fp,file_get_contents($filename));
	    fclose($fp);
		
		$fp = fopen("./zeybu/js/zeybux-configuration-min.js", 'w');
		fclose($fp);
		$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/'. $lSource . '/outilsDev/ && java -jar yuicompressor-2.4.2.jar --type js --charset utf-8 ./zeybu/js/zeybux-configuration.js -o ./zeybu/js/zeybux-configuration-min.js');
		echo $output;
		/******************************************* Fin Generation zeybux-configuration.js *************************************/

		/******************************************* Generation zeybux- Modules .js *************************************/
		$lListeModule = array();
		function parcourirDossierVues($pPath,$pListeModule) {
			if(is_dir($pPath)) {
				$d = dir($pPath);
				while (false !== ($entry = $d->read())) {
				   if(	$entry != '.' 
				   		&& $entry != '..' 
				   		&& $entry != '.svn' 
				   		&& $entry != '.project'
				   		&& $entry != '.htaccess'	
				   		&& $entry != 'Identification'
				   		&& $entry != 'CommunVues.js'   		
				   		) {
				   		if(is_dir($d->path.'/'.$entry)) {
				   			array_push($pListeModule,$entry);
				   		}
				   }
				}
				$d->close();
			}
		}
		$Path = '../js/vues';
		parcourirDossierVues($Path,&$lListeModule);
		
		
		function parcourirDossierModule($pPath,$pModule) {
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
				   			parcourirDossierModule($d->path.'/'.$entry,$pModule);
				   		} else {
						    $filename = $d->path.'/'.$entry;
						   	$fp = fopen("./zeybu/js/package-full/zeybux-".$pModule.".js", 'a');
						    fwrite($fp,file_get_contents($filename));
						    fclose($fp);
				   		}
				   }
				}
				$d->close();
			} else {
				$fp = fopen("./zeybu/js/package-full/zeybux-".$pModule.".js", 'a');
			    fwrite($fp,file_get_contents($pPath));
			    fclose($fp);
			}
		}
		
		foreach($lListeModule as $lModule) {
			$fp = fopen("./zeybu/js/package-full/zeybux-".$lModule.".js", 'w');
			$filename = "../js/template/".$lModule."Template.js";
			fwrite($fp,file_get_contents($filename));	
			fclose($fp);

			$Path = '../js/vues/'.$lModule;
			parcourirDossierModule($Path,$lModule);
			
			$fp = fopen("./zeybu/js/package/zeybux-".$lModule."-min.js", 'w');
			fclose($fp);
			$output = shell_exec('cd /home/julien/Informatique/Dev/zeybu/www/'. $lSource . '/outilsDev/ && java -jar yuicompressor-2.4.2.jar --type js --charset utf-8 ./zeybu/js/package-full/zeybux-'.$lModule.'.js -o ./zeybu/js/package/zeybux-'.$lModule.'-min.js');
			echo $output;
		}
		
		/******************************************* Fin Generation zeybux- Modules .js *************************************/
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*function parcourirDossier($pPath) {
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
			   		&& $entry != 'MessagesErreurs.js'
			   		&& $entry != 'Configuration.js'
			   		&& $entry != 'zeybux-configuration.php'
			   		) {
			   		if(is_dir($d->path.'/'.$entry)) {
			   			parcourirDossier($d->path.'/'.$entry);
			   		} else {
			   			$filename = $d->path.'/'.$entry;
						/*$handle = fopen($filename, "r");
			   		 	while (!feof($handle)) {
					     	$fp = fopen("./zeybu/js/jsDev.js", 'a');
				   			fwrite($fp,fgets($handle));
				   			fclose($fp);
					    }*/
			   		/*	$lLigne = file_get_contents($filename);
			   			if($entry == "AccueilVue.js") {			   				
			   				$lLigne = preg_replace("/.\/js\/zeybux-configuration.php/","./js/zeybux-configuration-min.js",$lLigne);
			   			}
			   			if($entry == "IdentificationTemplate.js") {
			   				$lLigne = preg_replace('#value=\\\"(Z|zeybu)\\\"#',"",$lLigne);	
			   			}
					    $fp = fopen("./zeybu/js/jsDev.js", 'a');
					    fwrite($fp,$lLigne);
					    fclose($fp);				    
						//fclose($handle);
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
		echo $output;*/
		
		
		
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
		mkdir($lPath . '/js/package');
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
		parcourirDossierCopie('../vues',$lPath . '/vues');
				
		copy('../index.php' , $lPath.'/index.php'); // Copie de l'index
		copy('./zeybu/js/zeybux-core-min.js' , $lPath.'/js/zeybux-core-min.js'); // Copie du js
		copy('./zeybu/js/zeybux-jquery-min.js' , $lPath.'/js/zeybux-jquery-min.js'); // Copie du js
		copy('./zeybu/js/zeybux-configuration-min.js' , $lPath.'/js/zeybux-configuration-min.js'); // Copie du js
		parcourirDossierCopie('./zeybu/js/package',$lPath . '/js/package');
		copy('./zeybu/css/zeybux-min.css' , $lPath.'/css/zeybux-min.css'); // Copie du css
		copy('../css/Commun/Entete.css' , $lPath.'/css/Commun/Entete.css'); // Copie du css
		
		// Écrase le fichier d'entête pour passer en version statique des fichiers css et js.
		copy('./zeybu/html/Commun/Entete.html' , $lPath.'/html/Commun/Entete.html'); 
		copy('./zeybu/html/index.html' , $lPath.'/html/index.html'); 

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