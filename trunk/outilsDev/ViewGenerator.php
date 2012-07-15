<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Zeybux - View Generator</title>
</head>
<body>
<div><a href="./index.php">Retour</a></div>
<?php
if(isset($_POST['nom']) && isset($_POST['nomBDD'])) {
	$lNom = $_POST['nom'];
	$lNomBDD = $_POST['nomBDD'];
	
	$lNomVariable = array();	
	$lTypeVariable = array();	
	$lTable = array();
	$lConstanteNom = array();
	
	if(isset($_POST["nomVariable"])) {
		$lNomVariable = $_POST["nomVariable"];
	}
	if(isset($_POST["nomVariableNv"]) && $_POST["nomVariableNv"] != "") {
		array_push($lNomVariable,$_POST["nomVariableNv"]);
	}
	
	if(isset($_POST["typeVariable"])) {
		$lTypeVariable = $_POST["typeVariable"];
	}
	if(isset($_POST["typeVariableNv"]) && $_POST["typeVariableNv"] != "") {
		array_push($lTypeVariable,$_POST["typeVariableNv"]);
	}
	
	if(isset($_POST["table"])) {
		$lTableBrut = $_POST["table"];
		foreach($lTableBrut as $lVal) {
			$lVal[0] = strtoupper($lVal[0]);
			array_push($lTable,$lVal);
		}
	}
	if(isset($_POST["tableNv"]) && $_POST["tableNv"] != "") {
		$lTableBrut = $_POST["tableNv"];
		$lTableBrut[0] = strtoupper($lTableBrut[0]);
		array_push($lTable,$lTableBrut);
	}
	
	if(isset($_POST["constanteNom"])) {
		$lConstanteNom = $_POST["constanteNom"];
	}
	if(isset($_POST["constanteNomNv"]) && $_POST["constanteNomNv"] != "") {
		array_push($lConstanteNom,$_POST["constanteNomNv"]);
	}
		
	$lTaille = count($lNomVariable);
	
	?>
	<form action="./ViewGenerator.php" method="post">
	<span>Nom </span><input type="text" name="nom" value="<?php echo $lNom; ?>"/><br/>
	<span>Nom BDD</span><input type="text" name="nomBDD" value="<?php echo $lNomBDD; ?>"/><br/>
	<span>----------------------------------------------------------------------------------------------------</span><br/>
	<span>Nom </span><input type="text" name="nomVariableNv" />
	<span>Type </span><input type="text" name="typeVariableNv" />
	<span>Manager </span><input type="text" name="tableNv" />
	<span>Constante Nom </span><input type="text" name="constanteNomNv" /><br/>
	<span>----------------------------------------------------------------------------------------------------</span><br/>
	<?php 
		
	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			?>
				<span>Nom </span><input type="text" name="nomVariable[]" value="<?php if(isset($lNomVariable[$i])) echo $lNomVariable[$i];?>"/>
				<span>Type </span><input type="text" name="typeVariable[]" value="<?php if(isset($lTypeVariable[$i])) echo $lTypeVariable[$i];?>"/>
				<span>Manager </span><input type="text" name="table[]" value="<?php if(isset($lTable[$i])) echo $lTable[$i];?>"/>
				<span>Constante Nom </span><input type="text" name="constanteNom[]" value="<?php if(isset($lConstanteNom[$i])) echo $lConstanteNom[$i];?>"/><br/>
			<?php
			
			$i++;
		}		
	}
	?>
	<span>----------------------------------------------------------------------------------------------------</span><br/>
	<input type="submit" value="Générer"/>
	</form>
	<?php	
	
	// Le nom du fichier de la vue
	// Le nom de la vue en BDD
	// nom du membre
	// nom de la table source et de la constante du membre
	if(isset($lTable[0]) && isset( $lConstanteNom[0])){
				$fp = fopen("./zeybu/classes/viewVO/" . $lNom . 'ViewVO.php', 'w');
	        	
				fwrite($fp,"<?php\n");
				
				fwrite($fp,"//****************************************************************\n");
				fwrite($fp,"//\n");
				fwrite($fp,"// Createur : Julien PIERRE\n");
				fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");
				fwrite($fp,"// Fichier : " . $lNom . "ViewVO.php\n");
				fwrite($fp,"//\n");
				fwrite($fp,"// Description : Classe " . $lNom . "ViewVO\n");
				fwrite($fp,"//\n");
				fwrite($fp,"//****************************************************************\n");
				fwrite($fp,"include_once(CHEMIN_CLASSES . \"DataTemplate.php\");\n\n");
				
				fwrite($fp,"/**\n");
				fwrite($fp," * @name " . $lNom . "ViewVO\n");
				fwrite($fp," * @author Julien PIERRE\n");
				fwrite($fp," * @since " . date("d/m/Y") . "\n");
				fwrite($fp," * @desc Classe représentant une " . $lNom . "ViewVO\n");
				fwrite($fp," */\n");
				
				fwrite($fp, "class " . $lNom . "ViewVO  extends DataTemplate	\n");
				fwrite($fp, "{\n");			
	        	
	        	
	        	// Ecriture des membres
	        	$j = 0;
	        	foreach($lNomVariable as $lNomAttribut){
	        		fwrite($fp,"\t/**\n");
		 			fwrite($fp,"\t* @var " . $lTypeVariable[$j] . "\n"); 
		 			fwrite($fp,"\t* @desc " . $lNomAttribut . " de la " . $lNom . "ViewVO\n");
		 			fwrite($fp,"\t*/\n");
	        		fwrite($fp,  "\tprotected \$m" . $lNomAttribut . ";\n\n");
	        		$j++;
	        	}
	        	
	        	// Ecriture des accesseurs
	        	$j = 0;
	        	foreach($lNomVariable as $lNomAttribut){
	        		// le get
	        		fwrite($fp, "\t/**\n");
					fwrite($fp, "\t* @name get" . $lNomAttribut . "()\n");
					fwrite($fp, "\t* @return " . $lTypeVariable[$j] . "\n");
					fwrite($fp, "\t* @desc Renvoie le membre " . $lNomAttribut . " de la " . $lNom . "ViewVO\n");
					fwrite($fp, "\t*/\n");
	        		fwrite($fp, "\tpublic function get" . $lNomAttribut . "() {\n");
	        		fwrite($fp, "\t\treturn \$this->m" . $lNomAttribut . ";\n");
					fwrite($fp, "\t}\n\n");
					
					
					// le set
					fwrite($fp, "\t/**\n");
					fwrite($fp, "\t* @name set" . $lNomAttribut . "(\$p" . $lNomAttribut . ")\n");
					fwrite($fp, "\t* @param " . $lTypeVariable[$j] . "\n");
					fwrite($fp, "\t* @desc Remplace le membre " . $lNomAttribut . " de la " . $lNom . "ViewVO par \$p" . $lNomAttribut . "\n");
					fwrite($fp, "\t*/\n");
	        		fwrite($fp, "\tpublic function set" . $lNomAttribut . "(\$p" . $lNomAttribut . ") {\n");
					fwrite($fp, "\t\t\$this->m" . $lNomAttribut . " = \$p" . $lNomAttribut . ";\n");
					fwrite($fp, "\t}\n\n");				
					$j++;
	        	}     
	        	
	    /*    	fwrite($fp,"\t/**\n");
				fwrite($fp,"\t* @name export()\n");
				fwrite($fp,"\t* @return json\n");
				fwrite($fp,"\t* @desc Retourne la valeur des membres en les renommant au format tableau\n");
				fwrite($fp,"\t*//*\n");
				fwrite($fp,"\tpublic function export() {\n");
				fwrite($fp,"\t\t\$lMembres = get_object_vars(\$this);\n");
				fwrite($fp,"\t\t\$lMembresJs = array();\n");
				fwrite($fp,"\t\tforeach(\$lMembres as \$lCle => \$lValeur) {\n");
				fwrite($fp,"\t\t\t\$lCle = substr(\$lCle,1);\n");
				fwrite($fp,"\t\t\t\$lCle[0] = strtolower(\$lCle[0]);\n");
				fwrite($fp,"\t\t\tif(is_object(\$lValeur)) {\n");
				fwrite($fp,"\t\t\t\t\$lMembresJs[\$lCle] = \$lValeur->export();\n");
				fwrite($fp,"\t\t\t} else if(is_array(\$lValeur)) {\n");
				fwrite($fp,"\t\t\t\t\$lMembresJs[\$lCle] = \$this->exportArray(\$lValeur);\n");
				fwrite($fp,"\t\t\t} else {\n");
				fwrite($fp,"\t\t\t\t\$lMembresJs[\$lCle] = \$lValeur;\n");
				fwrite($fp,"\t\t\t}\n");
				fwrite($fp,"\t\t}\n");
				fwrite($fp,"\t\treturn \$lMembresJs;\n");
				fwrite($fp,"\t}\n\n");
				
		/*		fwrite($fp,"\t/**\n");
				fwrite($fp,"\t* @name exportToJson()\n");
				fwrite($fp,"\t* @return json\n");
				fwrite($fp,"\t* @desc Retourne la valeur des membres en les renommant au format javascript\n");
				fwrite($fp,"\t*//*\n");
				fwrite($fp,"\tpublic function exportToJson() {\n");
				fwrite($fp,"\t\treturn json_encode(\$this->export());\n");
				fwrite($fp,"\t}\n\n");
				
		/*		fwrite($fp,"\t/**\n");
				fwrite($fp,"\t* @name exportArray(\$pArray)\n");
				fwrite($fp,"\t* @return array()\n");
				fwrite($fp,"\t* @desc Retourne la valeur des membres en les renommant au format tableau\n");
				fwrite($fp,"\t*//*\n");
				fwrite($fp,"\tpublic function exportArray(\$pArray) {\n");
				fwrite($fp,"\t\tif(is_array(\$pArray)) {\n");
				fwrite($fp,"\t\t\t\$lMembresJs = array();\n");
				fwrite($fp,"\t\t\tforeach(\$pArray as \$lCle => \$lValeur) {\n");
				fwrite($fp,"\t\t\t\tif(is_object(\$lValeur)) {\n");
				fwrite($fp,"\t\t\t\t\t\$lMembresJs[\$lCle] = \$lValeur->export();\n");
				fwrite($fp,"\t\t\t\t} else if(is_array(\$lValeur)) {\n");
				fwrite($fp,"\t\t\t\t\t\$lMembresJs[\$lCle] = \$this->exportArray(\$lValeur);\n");
				fwrite($fp,"\t\t\t\t} else {\n");
				fwrite($fp,"\t\t\t\t\t\$lMembresJs[\$lCle] = \$lValeur;\n");
				fwrite($fp,"\t\t\t\t}\n");
				fwrite($fp,"\t\t\t}\n");
				fwrite($fp,"\t\t\treturn \$lMembresJs;\n");
				fwrite($fp,"\t\t}\n");
				fwrite($fp,"\t\treturn NULL;\n");
				fwrite($fp,"\t}\n\n");*/
	
				fwrite($fp,"}\n");
				fwrite($fp,"?>");
	        	fclose($fp);
	        	
	        	/********************************************************************
	         	 *						Création du fichier Manager					*
	         	 ********************************************************************/
	        	$fp = fopen("./zeybu/classes/viewManager/" . $lNom . 'ViewManager.php', 'w');
	        	
	        	// Entete
				fwrite($fp,"<?php\n");
				fwrite($fp,"//****************************************************************\n");
				fwrite($fp,"//\n");
				fwrite($fp,"// Createur : Julien PIERRE\n");
				fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");
				fwrite($fp,"// Fichier : " . $lNom . "ViewManager.php\n");
				fwrite($fp,"//\n");
				fwrite($fp,"// Description : Classe de gestion des " . $lNom . "\n");
				fwrite($fp,"//\n");
				fwrite($fp,"//****************************************************************\n");
				
				fwrite($fp,"// Inclusion des classes\n");
				fwrite($fp,"include_once(CHEMIN_CLASSES_UTILS . \"DbUtils.php\");\n");
				fwrite($fp,"include_once(CHEMIN_CLASSES_UTILS . \"StringUtils.php\");\n");
				fwrite($fp,"include_once(CHEMIN_CLASSES_VIEW_VO . \"" . $lNom . "ViewVO.php\");");
		
				$lListeManager = array();
				
				foreach($lTable as $lLigne) {
					$lOk = true;
					foreach($lListeManager as $lManager) {
						if($lLigne == $lManager) $lOk = false;
					}	
					if($lOk) {
						array_push($lListeManager,$lLigne);
					}				
				}
				foreach($lListeManager as $lManager) {
					fwrite($fp,"\ninclude_once(CHEMIN_CLASSES_MANAGERS . \"" . $lManager . ".php\");");
				}

				fwrite($fp,"\n\n");
				
				// Les constantes    
				fwrite($fp,"define(\"VUE_" . strtoupper($lNom) . "\", MYSQL_DB_PREFIXE . \"" . $lNomBDD . "\");\n");

				fwrite($fp,"/**\n");
				fwrite($fp," * @name " . $lNom . "ViewManager\n");
				fwrite($fp," * @author Julien PIERRE\n");
				fwrite($fp," * @since " . date("d/m/Y") . "\n");
				fwrite($fp," * \n");
				fwrite($fp," * @desc Classe permettant l'accès aux données des " . $lNom . "\n");
				fwrite($fp," */\n");
				fwrite($fp,"class " . $lNom . "ViewManager\n");
				fwrite($fp,"{\n");   	
	        	
				// Les constantes
				fwrite($fp,"\tconst VUE_" . strtoupper($lNom) . " = VUE_" . strtoupper($lNom) . ";\n");	   
				
	        	//Le select
	        	
	        	fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name select(\$pId)\n");
				fwrite($fp,"\t* @param integer\n");
				fwrite($fp,"\t* @return " . $lNom . "ViewVO\n");
				fwrite($fp,"\t* @desc Récupère la ligne correspondant à l'id en paramètre, créé une " .$lNom . "ViewVO contenant les informations et la renvoie\n");
				fwrite($fp,"\t*/\n");
				
				fwrite($fp,"\tpublic static function select(\$pId) {\n");
				fwrite($fp,"\t\t// Initialisation du Logger\n");
				fwrite($fp,"\t\t\$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);\n");
				fwrite($fp,"\t\t\$lLogger->setMask(Log::MAX(LOG_LEVEL));\n\n");
			
				// La requete
				fwrite($fp,"\t\t\$lRequete =\n\t\t\t\"SELECT \"\n");
				$j = 0;
	        	foreach($lNomVariable as $lNomAttribut){
	        		if($j == 0)
	        			fwrite($fp,"\t\t\t    . " . $lTable[$j] . "::" . $lConstanteNom[$j] . " . ");
	        		else
					 	fwrite($fp,"\n\t\t\t\",\" . " . $lTable[$j] . "::" . $lConstanteNom[$j] . " . ");
					$j++;
	        	}
	        	fwrite($fp,"\"\n");			
				fwrite($fp,"\t\t\tFROM \" . " . $lNom . "ViewManager::VUE_" . strtoupper($lNom) . " . \" \n");
				fwrite($fp,"\t\t\tWHERE \" . " . $lTable[0] . "::" . $lConstanteNom[0] . " . \" = '\" . StringUtils::securiser(\$pId) . \"'\";\n\n");
			
				
				fwrite($fp,"\t\t\$lLogger->log(\"Execution de la requete : \" . \$lRequete,PEAR_LOG_DEBUG); // Maj des logs\n");
				fwrite($fp,"\t\t\$lSql = Dbutils::executerRequete(\$lRequete);\n\n");
			
				fwrite($fp,"\t\t\$lListe" . $lNom . " = array();\n");
				fwrite($fp,"\t\tif( mysql_num_rows(\$lSql) > 0 ) {\n");
				fwrite($fp,"\t\t\twhile (\$lLigne = mysql_fetch_assoc(\$lSql)) {\n");
				fwrite($fp,"\t\t\t\tarray_push(\$lListe" . $lNom . ",\n");
				
				
				fwrite($fp,"\t\t\t\t\t" . $lNom . "ViewManager::remplir(");
				$j = 0;
	        	foreach($lNomVariable as $lNomAttribut){
	        		if($j == 0)
	        			fwrite($fp,"\n\t\t\t\t\t\$lLigne[" . $lTable[$j] . "::" . $lConstanteNom[$j] . "]");
	        		else
	        			fwrite($fp,",\n\t\t\t\t\t\$lLigne[" . $lTable[$j] . "::" . $lConstanteNom[$j] . "]");
	        		$j++;
	        	}
				fwrite($fp,"));\n");
	
				fwrite($fp,"\t\t\t}\n");
				fwrite($fp,"\t\t} else {\n");
				fwrite($fp,"\t\t\t\$lListe" . $lNom . "[0] = new " . $lNom . "ViewVO();\n");
				fwrite($fp,"\t\t}\n");
				fwrite($fp,"\t\treturn \$lListe" . $lNom . ";\n");
				fwrite($fp,"\t}\n");
		
				
	        	// Le selectAll
	
	        	fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name selectAll()\n");
				fwrite($fp,"\t* @return array(" . $lNom . "ViewVO)\n");
				fwrite($fp,"\t* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de " . $lNom . "ViewVO\n");
				fwrite($fp,"\t*/\n");
	
				fwrite($fp,"\tpublic static function selectAll() {\n");
				fwrite($fp,"\t\t// Initialisation du Logger\n");
				fwrite($fp,"\t\t\$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);\n");
				fwrite($fp,"\t\t\$lLogger->setMask(Log::MAX(LOG_LEVEL));\n");
			
				// La requete
				fwrite($fp,"\t\t\$lRequete =\n\t\t\t\"SELECT \"\n");
				$j = 0;
	        	foreach($lNomVariable as $lNomAttribut){
	        		if($j == 0)
	        			fwrite($fp,"\t\t\t    . " .  $lTable[$j] . "::" . $lConstanteNom[$j] . " . ");
	        		else
					 	fwrite($fp,"\n\t\t\t\",\" . " . $lTable[$j] . "::" . $lConstanteNom[$j] . " . ");
					$j++;
	        	}
	        	fwrite($fp,"\"\n");			
				fwrite($fp,"\t\t\tFROM \" . " . $lNom . "ViewManager::VUE_" . strtoupper($lNom) . ";\n\n");
			
				fwrite($fp,"\t\t\$lLogger->log(\"Execution de la requete : \" . \$lRequete,PEAR_LOG_DEBUG); // Maj des logs\n");	
				fwrite($fp,"\t\t\$lSql = Dbutils::executerRequete(\$lRequete);\n\n");	
			
				fwrite($fp,"\t\t\$lListe" . $lNom . " = array();\n");
				fwrite($fp,"\t\tif( mysql_num_rows(\$lSql) > 0 ) {\n");
				fwrite($fp,"\t\t\twhile (\$lLigne = mysql_fetch_assoc(\$lSql)) {\n");
				fwrite($fp,"\t\t\t\tarray_push(\$lListe" . $lNom . ",\n");
				
				
				fwrite($fp,"\t\t\t\t\t" . $lNom . "ViewManager::remplir(");
				$j = 0;
	        	foreach($lNomVariable as $lNomAttribut){
	        		if($j == 0)
	        			fwrite($fp,"\n\t\t\t\t\t\$lLigne[" . $lTable[$j] . "::" . $lConstanteNom[$j] . "]");
	        		else
	        			fwrite($fp,",\n\t\t\t\t\t\$lLigne[" . $lTable[$j] . "::" . $lConstanteNom[$j] . "]");
	        		$j++;
	        	}
				fwrite($fp,"));\n");
	
				fwrite($fp,"\t\t\t}\n");
				fwrite($fp,"\t\t} else {\n");
				fwrite($fp,"\t\t\t\$lListe" . $lNom . "[0] = new " . $lNom . "ViewVO();\n");
				fwrite($fp,"\t\t}\n");
				fwrite($fp,"\t\treturn \$lListe" . $lNom . ";\n");
				fwrite($fp,"\t}\n");
	        	
				// Le recherche
				
		        fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name recherche( \$pTypeRecherche, \$pTypeCritere, \$pCritereRecherche, \$pTypeTri, \$pCritereTri )\n");
				fwrite($fp,"\t* @param string nom de la table\n");
				fwrite($fp,"\t* @param string Le type de critère de recherche\n");
				fwrite($fp,"\t* @param array(string) champs à récupérer dans la table\n");
				fwrite($fp,"\t* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre\n");
				fwrite($fp,"\t* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer\n");
				fwrite($fp,"\t* @return array(" . $lNom . "ViewVO)\n");
				fwrite($fp,"\t* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de " . $lNom . "ViewVO\n");
				fwrite($fp,"\t*/\n");
				fwrite($fp,"\tpublic static function recherche( \$pTypeRecherche, \$pTypeCritere, \$pCritereRecherche, \$pTypeTri, \$pCritereTri ) {\n");
				fwrite($fp,"\t\t// Initialisation du Logger\n");
				fwrite($fp,"\t\t\$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);\n");
				fwrite($fp,"\t\t\$lLogger->setMask(Log::MAX(LOG_LEVEL));\n\n");
			
				fwrite($fp,"\t\t// Préparation de la requète\n");
				fwrite($fp,"\t\t\$lChamps = array( \n");
							
		        $j = 0;
		        foreach($lNomVariable as $lNomAttribut){
		        	if($j == 0)
		        		fwrite($fp,"\t\t\t    " .  $lTable[$j] . "::" . $lConstanteNom[$j]);
		        	else
					 	fwrite($fp," .\n\t\t\t\",\" . " .  $lTable[$j] . "::" . $lConstanteNom[$j]);
					$j++;
		        }
				fwrite($fp,"\t\t);\n\n");

				fwrite($fp,"\t\t// Préparation de la requète de recherche\n");
				fwrite($fp,"\t\t\$lRequete = DbUtils::prepareRequeteRecherche(" . $lNom . "ViewManager::VUE_" . strtoupper($lNom) . ", \$lChamps, \$pTypeRecherche, \$pTypeCritere, \$pCritereRecherche, \$pTypeTri, \$pCritereTri);\n\n");
	
				fwrite($fp,"\t\t\$lListe" . $lNom . " = array();\n\n");

				fwrite($fp,"\t\tif(\$lRequete !== false) {\n\n");
	
				fwrite($fp,"\t\t\t\$lLogger->log(\"Execution de la requete : \" . \$lRequete,PEAR_LOG_DEBUG); // Maj des logs\n");
				fwrite($fp,"\t\t\t\$lSql = Dbutils::executerRequete(\$lRequete);\n\n");
			
				fwrite($fp,"\t\t\tif( mysql_num_rows(\$lSql) > 0 ) {\n\n");
		
				fwrite($fp,"\t\t\t\twhile ( \$lLigne = mysql_fetch_assoc(\$lSql) ) {\n\n");
		
				fwrite($fp,"\t\t\t\t\tarray_push(\$lListe" . $lNom . ",\n");								
				fwrite($fp,"\t\t\t\t\t\t" . $lNom . "ViewManager::remplir(");
				$j = 0;
	        	foreach($lNomVariable as $lNomAttribut){
	        		if($j == 0)
	        			fwrite($fp,"\n\t\t\t\t\t\t\$lLigne[" . $lTable[$j] . "::" . $lConstanteNom[$j] . "]");
	        		else
	        			fwrite($fp,",\n\t\t\t\t\t\t\$lLigne[" . $lTable[$j] . "::" . $lConstanteNom[$j] . "]");
	        		$j++;
	        	}
				fwrite($fp,"));\n");
					
				fwrite($fp,"\t\t\t\t}\n");		
				fwrite($fp,"\t\t\t} else {\n");
				fwrite($fp,"\t\t\t\t\$lListe" . $lNom . "[0] = new " . $lNom . "ViewVO();\n");
				fwrite($fp,"\t\t\t}\n\n");
			
				fwrite($fp,"\t\t\treturn \$lListe" . $lNom . ";\n");
				fwrite($fp,"\t\t}\n\n");
				
				fwrite($fp,"\t\t\$lListe" . $lNom . "[0] = new " . $lNom . "ViewVO();\n");
				fwrite($fp,"\t\treturn \$lListe" . $lNom . ";\n");				
				fwrite($fp,"\t}\n");
				
	        	// Le remplirVO
	        	
	        	fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name remplir(");
				$j = 0;
	        	foreach($lNomVariable as $lNomAttribut){
	        		if($j == 0)
	        			fwrite($fp,"\$p" . $lNomAttribut);
					else
	        			fwrite($fp,", \$p" . $lNomAttribut);
	        		$j++;
	        	}	
				fwrite($fp,")\n");
		
				foreach($lTypeVariable as $lTypeAttribut){
					fwrite($fp,"\t* @param " . $lTypeAttribut . "\n");
				}	
		
				fwrite($fp,"\t* @return " . $lNom . "ViewVO\n");
				fwrite($fp,"\t* @desc Retourne une " . $lNom . "ViewVO remplie\n");
				fwrite($fp,"\t*/\n");
				
				fwrite($fp,"\tprivate static function remplir(");
	        	$j = 0;
	        	foreach($lNomVariable as $lNomAttribut){
	        		if($j == 0)
	        			fwrite($fp,"\$p" . $lNomAttribut);
					else
	        			fwrite($fp,", \$p" . $lNomAttribut);
	        		$j++;
	        	}
				fwrite($fp,") {\n");
				
				fwrite($fp,"\t\t\$l" . $lNom . " = new " . $lNom . "ViewVO();\n");
	
				foreach($lNomVariable as $lNomAttribut){
					fwrite($fp,"\t\t\$l" . $lNom . "->set" . $lNomAttribut . "(\$p" . $lNomAttribut . ");\n");
				}
			
				fwrite($fp,"\t\treturn \$l" . $lNom . ";\n");
				fwrite($fp,"\t}\n");
				
				fwrite($fp,"}\n");
				fwrite($fp,"?>");
	        	fclose($fp);	
		}
	
	} else {?>
	<form action="./ViewGenerator.php" method="post">
	<span>Nom </span><input type="text" name="nom" /><br/>
	<span>Nom BDD</span><input type="text" name="nomBDD" /><br/>
	<input type="submit" value="Générer"/>
	</form>
<?php } ?>
</body>
</html>