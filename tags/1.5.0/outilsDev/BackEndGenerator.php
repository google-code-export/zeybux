<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Zeybux - BackEnd Generator</title>
</head>
<body>
<div>
	<a href="./index.php">Retour</a><br/>
	<a href="./BackEndGenerator.php">Recommencer</a><br/><br/>
</div>
<?php
// TODO Détecter l'identifiant si celui-ci n'est pas la première ligne et le placer dans le tableau à la première ligne

// Définition de la zone horaire
date_default_timezone_set("Europe/Paris");

define("CHEMIN_CLASSES","./zeybu/classes/");
define("FICHIER_SQL","zeybuStructure.sql");
define("CHEMIN_FICHIER_SQL","./");

function nomSqlToVo($pNom) {
	$lNom = str_replace('`','',$pNom);
	
	// Suppression de l'entete
	sscanf($lNom,"%[a-z]_%s",$lEntete,$lNom);
	
	// Mise en majuscule des noms
	$i = 0;
	while(isset($lNom[$i])) {
		if($lNom[$i] == '_') {
			$lNom[$i + 1] = strtoupper($lNom[$i + 1]);
		}		
		$i++;
	}
	
	// Suppression des _
	$lNom = str_replace('_','',$lNom);
	
	// Première lettre en majuscule
	$lNom[0] = strtoupper($lNom[0]);
	
	return $lNom;
}

// Téléchargement du fichier sql
if( isset($_FILES["zeybusql"]) ) {
	if($_FILES["zeybusql"]["error"] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["zeybusql"]["tmp_name"];
        $name = $_FILES["zeybusql"]["name"];
        move_uploaded_file($tmp_name, CHEMIN_FICHIER_SQL . FICHIER_SQL);		
	}
}

if(file_exists(CHEMIN_FICHIER_SQL . FICHIER_SQL) && isset($_POST["auteur"]) && $_POST["auteur"] != "" ) {
	define("AUTEUR", $_POST["auteur"]);
	
	$handle = @fopen(CHEMIN_FICHIER_SQL . FICHIER_SQL, "r");
	if ($handle) {
		echo "<h3>Traitements Terminés !!</h3>";
	    while (!feof($handle)) {
	        $buffer = fgets($handle);
	        
	        /********************************************************************
	         *						Découverte d'un table						*
	         ********************************************************************/
	        if($buffer != "" && substr_compare( substr($buffer,0,27) , "CREATE TABLE IF NOT EXISTS ",0 ) == 0){
	        	
	        	// Nom de la table
	        	sscanf($buffer,"CREATE  TABLE IF NOT EXISTS `%s`  (",$lTable);
	
	        	$lNomTable[0] = str_replace('`','',$lTable);
	        	$lNomTable[1] = nomSqlToVo($lNomTable[0]);
	
	        	// Noms des atributs
	        	unset($lListeNomAttribut);
	        	unset($lListeTypeAttribut);
	        	$lListeNomAttribut = array(array(),array());
	        	$lListeTypeAttribut = array();
	        	
	        	do {
	        		$buffer = fgets($handle);
	        		  
					unset($nomAttribut);
					sscanf($buffer," `%s`",$nomAttribut);
					
	        		if($nomAttribut != '') {
	        			array_push($lListeNomAttribut[0],str_replace('`','',$nomAttribut));
	        		 	array_push($lListeNomAttribut[1],nomSqlToVo($nomAttribut));           		 	
	        		}
	        		 	
	        		$i = 0;
	        		$accentgrave = 0;
	        		$TypeAttribut = " ";
	        		$fin = false;
	        		while($i < strlen($buffer) && !$fin ) {
	        			if($buffer[$i] == '`') {
	        				$accentgrave++;
	        			}
	        			if($accentgrave == 2) {
	        				$i += 2;
	        				while( isset($buffer[$i]) && $buffer[$i] != ' ' && $i < strlen($buffer)) {
	        					$TypeAttribut[$i] = $buffer[$i];
	        					$i++;
	        				}
	        				$fin = true;
	        			}
	        			$i++;
	        		}
	        		$TypeAttribut = trim($TypeAttribut);
	        		
	        		if($nomAttribut != '') 
	        		 	array_push($lListeTypeAttribut,$TypeAttribut);
	        		
	        	} while(substr_count($buffer,';') == 0);
	
	        	/********************************************************************
	         	 *						Creation du fichier VO						*
	        	 ********************************************************************/
	        	// Préparation de l'affichage
			/*	$lTemplate = new Template("./Template");
				
				$lTemplate->set_filenames( array('VO' =>  'VO.tpl') );
				
				$lTemplate->assign_vars( array( 'AUTEUR' => MON_COMPTE_TITRE) );
				$lTemplate->assign_vars( array( 'DATE' => MON_COMPTE_TITRE) );
				$lTemplate->assign_vars( array( 'NOM_TABLE' => MON_COMPTE_TITRE) );
	
	        	// Ecriture des membres
	        	$j = 0;
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		$lTemplate->assign_block_vars('membres', array('TYPE_MEMBRE' =>  $lListeTypeAttribut[$j] ));
	        		$lTemplate->assign_block_vars('membres', array('NOM_MEMBRE' =>  $lNomAttribut ));
	        		$j++;
	        	}
	        	
	        	$j = 0;
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		$lTemplate->assign_block_vars('accesseurs', array('TYPE_MEMBRE' =>  $lListeTypeAttribut[$j] ));
	        		$lTemplate->assign_block_vars('accesseurs', array('NOM_MEMBRE' =>  $lNomAttribut ));
	        		$j++;
	        	}
	        	
	        	// Création du fichier
	        	$fp = fopen(CHEMIN_CLASSES . "VO/" . $lNomTable[1] . 'VO.php', 'w');
	        	fwrite($fp, $lTemplate->pparse('VO') );*/
	        	
	        	echo "Génération du fichier : " . CHEMIN_CLASSES . "VO/" . $lNomTable[1] . "VO.php<br/>";
	        	$fp = fopen(CHEMIN_CLASSES . "VO/" . $lNomTable[1] . 'VO.php', 'w');
	        	
				fwrite($fp,"<?php\n");
				
				fwrite($fp,"//****************************************************************\n");
				fwrite($fp,"//\n");
				fwrite($fp,"// Createur : " . AUTEUR . "\n");
				fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");
				fwrite($fp,"// Fichier : " . $lNomTable[1] . "VO.php\n");
				fwrite($fp,"//\n");
				fwrite($fp,"// Description : Classe " . $lNomTable[1] . "VO\n");
				fwrite($fp,"//\n");
				fwrite($fp,"//****************************************************************\n");
				fwrite($fp,"include_once(CHEMIN_CLASSES . \"DataTemplate.php\");\n\n");
				
				fwrite($fp,"/**\n");
				fwrite($fp," * @name " . $lNomTable[1] . "VO\n");
				fwrite($fp," * @author " . AUTEUR . "\n");
				fwrite($fp," * @since " . date("d/m/Y") . "\n");
				fwrite($fp," * @desc Classe représentant une " . $lNomTable[1] . "VO\n");
				fwrite($fp," */\n");
				
				fwrite($fp, "class " . $lNomTable[1] . "VO  extends DataTemplate\n");
				fwrite($fp, "{\n");			
	        	
	        	
	        	// Ecriture des membres
	        	$j = 0;
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		fwrite($fp,"\t/**\n");
		 			fwrite($fp,"\t* @var " . $lListeTypeAttribut[$j] . "\n"); 
		 			fwrite($fp,"\t* @desc " . $lNomAttribut . " de la " . $lNomTable[1] . "VO\n");
		 			fwrite($fp,"\t*/\n");
	        		fwrite($fp,  "\tprotected \$m" . $lNomAttribut . ";\n\n");
	        		$j++;
	        	}
	        	
	        	// Ecriture du constructeur
	        	fwrite($fp,"\t/**\n");
	        	fwrite($fp,"\t * @name " . $lNomTable[1] . "VO()\n");
	        	fwrite($fp,"\t * @return bool\n");
	        	fwrite($fp,"\t * @desc Constructeur\n");
	        	fwrite($fp,"\t */\n");
	        	fwrite($fp,"\tfunction " . $lNomTable[1] . "VO(");
	        	$j = 0;
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		if($j == 0) {
	        			fwrite($fp, "\$p" . $lNomAttribut . " = null");
	        		} else {
	        			fwrite($fp, ", \$p" . $lNomAttribut . " = null");
	        		}
	        		$j++;
	        	}
	        	fwrite($fp,") {\n");	        	
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		fwrite($fp,"\t\tif(!is_null(\$p" . $lNomAttribut . ")) { \$this->m" . $lNomAttribut . " = \$p" . $lNomAttribut . "; }\n");
	        	}
	        	fwrite($fp, "\t}\n\n");
	        	
	        	// Ecriture des accesseurs
	        	$j = 0;
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		// le get
	        		fwrite($fp, "\t/**\n");
					fwrite($fp, "\t* @name get" . $lNomAttribut . "()\n");
					fwrite($fp, "\t* @return " . $lListeTypeAttribut[$j] . "\n");
					fwrite($fp, "\t* @desc Renvoie le membre " . $lNomAttribut . " de la " . $lNomTable[1] . "VO\n");
					fwrite($fp, "\t*/\n");
	        		fwrite($fp, "\tpublic function get" . $lNomAttribut . "() {\n");
	        		fwrite($fp, "\t\treturn \$this->m" . $lNomAttribut . ";\n");
					fwrite($fp, "\t}\n\n");
					
					
					// le set
					fwrite($fp, "\t/**\n");
					fwrite($fp, "\t* @name set" . $lNomAttribut . "(\$p" . $lNomAttribut . ")\n");
					fwrite($fp, "\t* @param " . $lListeTypeAttribut[$j] . "\n");
					fwrite($fp, "\t* @desc Remplace le membre " . $lNomAttribut . " de la " . $lNomTable[1] . "VO par \$p" . $lNomAttribut . "\n");
					fwrite($fp, "\t*/\n");
	        		fwrite($fp, "\tpublic function set" . $lNomAttribut . "(\$p" . $lNomAttribut . ") {\n");
					fwrite($fp, "\t\t\$this->m" . $lNomAttribut . " = \$p" . $lNomAttribut . ";\n");
					fwrite($fp, "\t}\n\n");				
					$j++;
	        	}     
	        	
				fwrite($fp,"}\n");
				fwrite($fp,"?>");
	        	fclose($fp);

	        	// Donne les droits d'accès
	        	shell_exec('cd ' . CHEMIN_CLASSES . 'VO && chmod 777 ' . $lNomTable[1] . 'VO.php');
	        	
	        	/********************************************************************
	         	 *						Création du fichier Manager					*
	         	 ********************************************************************/
	        	echo "Génération du fichier : " . CHEMIN_CLASSES . "Manager/" . $lNomTable[1] . "Manager.php<br/>";
	        	
	        	$fp = fopen(CHEMIN_CLASSES . "Manager/" . $lNomTable[1] . 'Manager.php', 'w');
	        	
	        	// Entete
				fwrite($fp,"<?php\n");
				fwrite($fp,"//****************************************************************\n");
				fwrite($fp,"//\n");
				fwrite($fp,"// Createur : " . AUTEUR . "\n");
				fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");
				fwrite($fp,"// Fichier : " . $lNomTable[1] . "Manager.php\n");
				fwrite($fp,"//\n");
				fwrite($fp,"// Description : Classe de gestion des " . $lNomTable[1] . "\n");
				fwrite($fp,"//\n");
				fwrite($fp,"//****************************************************************\n");
				fwrite($fp,"// Inclusion des classes\n");
				fwrite($fp,"include_once(CHEMIN_CLASSES_UTILS . \"DbUtils.php\");\n");
				fwrite($fp,"include_once(CHEMIN_CLASSES_UTILS . \"StringUtils.php\");\n");
				fwrite($fp,"include_once(CHEMIN_CLASSES_VO . \"" . $lNomTable[1] . "VO.php\");\n\n");
				
				fwrite($fp,"define(\"TABLE_" . strtoupper($lNomTable[1]) . "\", MYSQL_DB_PREFIXE .\"" . $lNomTable[0] . "\");\n");
				fwrite($fp,"/**\n");
				fwrite($fp," * @name " . $lNomTable[1] . "Manager\n");
				fwrite($fp," * @author " . AUTEUR . "\n");
				fwrite($fp," * @since " . date("d/m/Y") . "\n");
				fwrite($fp," * \n");
				fwrite($fp," * @desc Classe permettant l'accès aux données des " . $lNomTable[1] . "\n");
				fwrite($fp," */\n");
				fwrite($fp,"class " . $lNomTable[1] . "Manager\n");
				fwrite($fp,"{\n");
	
				// Les constantes
				
				fwrite($fp,"\tconst TABLE_" . strtoupper($lNomTable[1]) . " = TABLE_" . strtoupper($lNomTable[1]) . ";\n");
				//fwrite($fp,"\tconst TABLE_" . strtoupper($lNomTable[1]) . " = MYSQL_DB_PREFIXE . \"" . $lNomTable[0] . "\";\n");
	        	foreach($lListeNomAttribut[0] as $lNomAttribut){
	        		sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
					fwrite($fp,"\tconst CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " = \"" . $lNomAttribut . "\";\n");
	        	}
	        	
	        	
	        	//Le select
	        	
	        	fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name select(\$pId)\n");
				fwrite($fp,"\t* @param integer\n");
				fwrite($fp,"\t* @return " . $lNomTable[1] . "VO\n");
				fwrite($fp,"\t* @desc Récupère la ligne correspondant à l'id en paramètre, créé une " . $lNomTable[1] . "VO contenant les informations et la renvoie\n");
				fwrite($fp,"\t*/\n");
				
				fwrite($fp,"\tpublic static function select(\$pId) {\n");
				fwrite($fp,"\t\t// Initialisation du Logger\n");
				fwrite($fp,"\t\t\$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);\n");
				fwrite($fp,"\t\t\$lLogger->setMask(Log::MAX(LOG_LEVEL));\n\n");
			
				// La requete
				fwrite($fp,"\t\t\$lRequete =\n\t\t\t\"SELECT \"\n");
				$j = 0;
	        	foreach($lListeNomAttribut[0] as $lNomAttribut){
	        		sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
	        		if($j == 0)
	        			fwrite($fp,"\t\t\t    . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . ");
	        		else
					 	fwrite($fp,"\n\t\t\t\",\" . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . ");
					$j++;
	        	}
	        	fwrite($fp,"\"\n");			
				fwrite($fp,"\t\t\tFROM \" . " . $lNomTable[1] . "Manager::TABLE_" . strtoupper($lNomTable[1]) . " . \" \n");
				
				sscanf($lListeNomAttribut[0][0],"%[a-z]_%s",$lEntete,$lNomAttribut2);
				fwrite($fp,"\t\t\tWHERE \" . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . \" = '\" . StringUtils::securiser(\$pId) . \"'\";\n\n");
			
				
				fwrite($fp,"\t\t\$lLogger->log(\"Execution de la requete : \" . \$lRequete,PEAR_LOG_DEBUG); // Maj des logs\n");
				fwrite($fp,"\t\t\$lSql = Dbutils::executerRequete(\$lRequete);\n\n");
			
				fwrite($fp,"\t\tif( mysql_num_rows(\$lSql) > 0 ) {\n");
				fwrite($fp,"\t\t\t\$lLigne = mysql_fetch_assoc(\$lSql);\n");
				fwrite($fp,"\t\t\treturn " . $lNomTable[1] . "Manager::remplir" . $lNomTable[1] . "(\n");
				fwrite($fp,"\t\t\t\t\$pId");
				
				$j = 0;
	        	foreach($lListeNomAttribut[0] as $lNomAttribut){
	        		sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
	        		if($j != 0)
						fwrite($fp,",\n\t\t\t\t\$lLigne[" . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . "]");
	        		$j++;
	        	}
				fwrite($fp,");\n");
				
				
				fwrite($fp,"\t\t} else {\n");
				fwrite($fp,"\t\t\treturn new " . $lNomTable[1] . "VO();\n");
				fwrite($fp,"\t\t}\n");
				fwrite($fp,"\t}\n");
		
				
	        	// Le selectAll
	
	        	fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name selectAll()\n");
				fwrite($fp,"\t* @return array(" . $lNomTable[1] . "VO)\n");
				fwrite($fp,"\t* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de " . $lNomTable[1] . "VO\n");
				fwrite($fp,"\t*/\n");
	
				fwrite($fp,"\tpublic static function selectAll() {\n");
				fwrite($fp,"\t\t// Initialisation du Logger\n");
				fwrite($fp,"\t\t\$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);\n");
				fwrite($fp,"\t\t\$lLogger->setMask(Log::MAX(LOG_LEVEL));\n");
			
				// La requete
				fwrite($fp,"\t\t\$lRequete =\n\t\t\t\"SELECT \"\n");
				$j = 0;
	        	foreach($lListeNomAttribut[0] as $lNomAttribut){
	        		sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
	        		if($j == 0)
	        			fwrite($fp,"\t\t\t    . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . ");
	        		else
					 	fwrite($fp,"\n\t\t\t\",\" . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . ");
					$j++;
	        	}
	        	fwrite($fp,"\"\n");			
				fwrite($fp,"\t\t\tFROM \" . " . $lNomTable[1] . "Manager::TABLE_" . strtoupper($lNomTable[1]) . ";\n\n");
			
				fwrite($fp,"\t\t\$lLogger->log(\"Execution de la requete : \" . \$lRequete,PEAR_LOG_DEBUG); // Maj des logs\n");	
				fwrite($fp,"\t\t\$lSql = Dbutils::executerRequete(\$lRequete);\n\n");	
			
				fwrite($fp,"\t\t\$lListe" . $lNomTable[1] . " = array();\n");
				fwrite($fp,"\t\tif( mysql_num_rows(\$lSql) > 0 ) {\n");
				fwrite($fp,"\t\t\twhile (\$lLigne = mysql_fetch_assoc(\$lSql)) {\n");
				fwrite($fp,"\t\t\t\tarray_push(\$lListe" . $lNomTable[1] . ",\n");
				
				
				fwrite($fp,"\t\t\t\t\t" . $lNomTable[1] . "Manager::remplir" . $lNomTable[1] . "(");
				$j = 0;
	        	foreach($lListeNomAttribut[0] as $lNomAttribut){
	        		sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
	        		if($j == 0)
	        			fwrite($fp,"\n\t\t\t\t\t\$lLigne[" . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . "]");
	        		else
	        			fwrite($fp,",\n\t\t\t\t\t\$lLigne[" . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . "]");
	        		$j++;
	        	}
				fwrite($fp,"));\n");
	
				fwrite($fp,"\t\t\t}\n");
				fwrite($fp,"\t\t} else {\n");
				fwrite($fp,"\t\t\t\$lListe" . $lNomTable[1] . "[0] = new " . $lNomTable[1] . "VO();\n");
				fwrite($fp,"\t\t}\n");
				fwrite($fp,"\t\treturn \$lListe" . $lNomTable[1] . ";\n");
				fwrite($fp,"\t}\n");
	        	
				// Le recherche
				
		        fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name recherche( \$pTypeRecherche, \$pTypeCritere, \$pCritereRecherche, \$pTypeTri, \$pCritereTri )\n");
				fwrite($fp,"\t* @param string nom de la table\n");
				fwrite($fp,"\t* @param string Le type de critère de recherche\n");
				fwrite($fp,"\t* @param array(string) champs à récupérer dans la table\n");
				fwrite($fp,"\t* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre\n");
				fwrite($fp,"\t* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer\n");
				fwrite($fp,"\t* @return array(" . $lNomTable[1] . "VO)\n");
				fwrite($fp,"\t* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de " . $lNomTable[1] . "VO\n");
				fwrite($fp,"\t*/\n");
				fwrite($fp,"\tpublic static function recherche( \$pTypeRecherche, \$pTypeCritere, \$pCritereRecherche, \$pTypeTri, \$pCritereTri ) {\n");
				fwrite($fp,"\t\t// Initialisation du Logger\n");
				fwrite($fp,"\t\t\$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);\n");
				fwrite($fp,"\t\t\$lLogger->setMask(Log::MAX(LOG_LEVEL));\n\n");
			
				fwrite($fp,"\t\t// Préparation de la requète\n");
				fwrite($fp,"\t\t\$lChamps = array( \n");
							
		        $j = 0;
		        foreach($lListeNomAttribut[0] as $lNomAttribut){
		        	sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
		        	if($j == 0)
		        		fwrite($fp,"\t\t\t    " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2));
		        	else
					 	fwrite($fp," .\n\t\t\t\",\" . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2));
					$j++;
		        }
				fwrite($fp,"\t\t);\n\n");
				
				fwrite($fp,"\t\t// Préparation de la requète de recherche\n");
				fwrite($fp,"\t\t\$lRequete = DbUtils::prepareRequeteRecherche(" . $lNomTable[1] . "Manager::TABLE_" . strtoupper($lNomTable[1]) . ", \$lChamps, \$pTypeRecherche, \$pTypeCritere, \$pCritereRecherche, \$pTypeTri, \$pCritereTri);\n\n");

				fwrite($fp,"\t\t\$lListe" . $lNomTable[1] . " = array();\n\n");

				fwrite($fp,"\t\tif(\$lRequete !== false) {\n\n");
				
				fwrite($fp,"\t\t\t\$lLogger->log(\"Execution de la requete : \" . \$lRequete,PEAR_LOG_DEBUG); // Maj des logs\n");
				fwrite($fp,"\t\t\t\$lSql = Dbutils::executerRequete(\$lRequete);\n\n");
			
				fwrite($fp,"\t\t\tif( mysql_num_rows(\$lSql) > 0 ) {\n\n");
		
				fwrite($fp,"\t\t\t\twhile ( \$lLigne = mysql_fetch_assoc(\$lSql) ) {\n\n");
		
				fwrite($fp,"\t\t\t\t\tarray_push(\$lListe" . $lNomTable[1] . ",\n");								
				fwrite($fp,"\t\t\t\t\t\t" . $lNomTable[1] . "Manager::remplir" . $lNomTable[1] . "(");
				$j = 0;
	        	foreach($lListeNomAttribut[0] as $lNomAttribut){
	        		sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
	        		if($j == 0)
	        			fwrite($fp,"\n\t\t\t\t\t\t\$lLigne[" . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . "]");
	        		else
	        			fwrite($fp,",\n\t\t\t\t\t\t\$lLigne[" . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . "]");
	        		$j++;
	        	}
				fwrite($fp,"));\n");
					
				fwrite($fp,"\t\t\t\t}\n");		
				fwrite($fp,"\t\t\t} else {\n");
				fwrite($fp,"\t\t\t\t\$lListe" . $lNomTable[1] . "[0] = new " . $lNomTable[1] . "VO();\n");
				fwrite($fp,"\t\t\t}\n\n");
			
				fwrite($fp,"\t\t\treturn \$lListe" . $lNomTable[1] . ";\n");
				fwrite($fp,"\t\t}\n\n");
				
				fwrite($fp,"\t\t\$lListe" . $lNomTable[1] . "[0] = new " . $lNomTable[1] . "VO();\n");
				fwrite($fp,"\t\treturn \$lListe" . $lNomTable[1] . ";\n");				
				fwrite($fp,"\t}\n");
				
	        	// Le remplirVO
	        	
	        	fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name remplir" . $lNomTable[1] . "(");
				$j = 0;
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
	        		if($j == 0)
	        			fwrite($fp,"\$p" . $lNomAttribut);
					else
	        			fwrite($fp,", \$p" . $lNomAttribut);
	        		$j++;
	        	}	
				fwrite($fp,")\n");
		
				foreach($lListeTypeAttribut as $lTypeAttribut){
					fwrite($fp,"\t* @param " . $lTypeAttribut . "\n");
				}	
		
				fwrite($fp,"\t* @return " . $lNomTable[1] . "VO\n");
				fwrite($fp,"\t* @desc Retourne une " . $lNomTable[1] . "VO remplie\n");
				fwrite($fp,"\t*/\n");
				
				fwrite($fp,"\tprivate static function remplir" . $lNomTable[1] . "(");
	        	$j = 0;
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
	        		if($j == 0)
	        			fwrite($fp,"\$p" . $lNomAttribut);
					else
	        			fwrite($fp,", \$p" . $lNomAttribut);
	        		$j++;
	        	}
				fwrite($fp,") {\n");
				
				fwrite($fp,"\t\t\$l" . $lNomTable[1] . " = new " . $lNomTable[1] . "VO();\n");
	
				foreach($lListeNomAttribut[1] as $lNomAttribut){
					fwrite($fp,"\t\t\$l" . $lNomTable[1] . "->set" . $lNomAttribut . "(\$p" . $lNomAttribut . ");\n");
				}
			
				fwrite($fp,"\t\treturn \$l" . $lNomTable[1] . ";\n");
				fwrite($fp,"\t}\n");
	        	
				
				// Le insert
				
	        	fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name insert(\$pVo)\n");
				fwrite($fp,"\t* @param " . $lNomTable[1] . "VO\n");
				fwrite($fp,"\t* @return integer\n");
				fwrite($fp,"\t* @desc Insère une nouvelle ligne dans la table, à partir des informations de la " . $lNomTable[1] . "VO en paramètre (l'id sera automatiquement calculé par la BDD)\n");
				fwrite($fp,"\t*/\n");
		
				fwrite($fp,"\tpublic static function insert(\$pVo) {\n");
				fwrite($fp,"\t\t// Initialisation du Logger\n");
				fwrite($fp,"\t\t\$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);\n");
				fwrite($fp,"\t\t\$lLogger->setMask(Log::MAX(LOG_LEVEL));\n\n");
			
				// La requete
				fwrite($fp,"\t\t\$lRequete =\n\t\t\t\"INSERT INTO \" . " . $lNomTable[1] . "Manager::TABLE_" . strtoupper($lNomTable[1]) . " . \"\n");
				
				$j = 0;
	        	foreach($lListeNomAttribut[0] as $lNomAttribut){
	        		sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
	        		if($j == 0)
	        			fwrite($fp,"\t\t\t\t(\" . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . \"");
	        		else
					 	fwrite($fp,"\n\t\t\t\t,\" . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . \"");
					 	$j++;
	        	}
	        	fwrite($fp,")\n");		
	
	        	fwrite($fp,"\t\t\tVALUES \";\n\n");
	        	
		       	fwrite($fp,"\t\tif(is_array(\$pVo)) {\n");
				fwrite($fp,"\t\t\t\$lNbVO = count(\$pVo);\n");
				fwrite($fp,"\t\t\t\$lI = 1;\n");
				fwrite($fp,"\t\t\tforeach(\$pVo as \$lVo) {\n");
				fwrite($fp,"\t\t\t\t\$lRequete .= \"(NULL");						
				$j = 0;
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		if($j != 0) {
	        			fwrite($fp,"\n\t\t\t\t,'\" . StringUtils::securiser( \$lVo->get" . $lNomAttribut . "() ) . \"'");
	        		}
	        		$j++;
				}	
				fwrite($fp,")\";\n");	
				fwrite($fp,"\n\t\t\t\tif(\$lNbVO == \$lI) {\n");
				fwrite($fp,"\t\t\t\t\t\$lRequete .= \";\";\n");
				fwrite($fp,"\t\t\t\t} else {\n");
				fwrite($fp,"\t\t\t\t\t\$lRequete .= \",\";\n");
				fwrite($fp,"\t\t\t\t}\n");
				fwrite($fp,"\t\t\t\t\$lI++;\n");
				fwrite($fp,"\t\t\t}\n");
				fwrite($fp,"\t\t} else{\n");				
				fwrite($fp,"\t\t\t\$lRequete .= \"(NULL");
				$j = 0;
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		if($j != 0) {
	        			fwrite($fp,"\n\t\t\t\t,'\" . StringUtils::securiser( \$pVo->get" . $lNomAttribut . "() ) . \"'");
	        		}
	        		$j++;
				}
	        	fwrite($fp,");\";\n");	
				fwrite($fp,"\t\t}\n\n");
	        	
	        	
	        	/*$j = 0;
	        	foreach($lListeNomAttribut[1] as $lNomAttribut){
	        		if($j != 0) {
	        			fwrite($fp,"\n\t\t\t\t,'\" . StringUtils::securiser( \$pVo->get" . $lNomAttribut . "() ) . \"'");
	        		}
	        		$j++;
				}
	        	fwrite($fp,")\";\n\n");		*/
			
				fwrite($fp,"\t\t\$lLogger->log(\"Execution de la requete : \" . \$lRequete,PEAR_LOG_DEBUG); // Maj des logs\n");
				fwrite($fp,"\t\treturn Dbutils::executerRequeteInsertRetourId(\$lRequete);\n");
				fwrite($fp,"\t}\n");
	        	
				
	        	// Le update
	        	
	        	fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name update(\$pVo)\n");
				fwrite($fp,"\t* @param " . $lNomTable[1] . "VO\n");
				fwrite($fp,"\t* @desc Met à jour la ligne de la table, correspondant à l'id du " . $lNomTable[1] . "VO, avec les informations du " . $lNomTable[1] . "VO\n");
				fwrite($fp,"\t*/\n");
		
				fwrite($fp,"\tpublic static function update(\$pVo) {\n");
				fwrite($fp,"\t\t// Initialisation du Logger\n");
				fwrite($fp,"\t\t\$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);\n");
				fwrite($fp,"\t\t\$lLogger->setMask(Log::MAX(LOG_LEVEL));\n\n");
			
				fwrite($fp,"\t\t\$lRequete = \n");
				fwrite($fp,"\t\t\t\"UPDATE \" . " . $lNomTable[1] . "Manager::TABLE_" . strtoupper($lNomTable[1]) . " . \"\n"); 
				fwrite($fp,"\t\t\t SET\n");
				
				$j = 0;
	        	foreach($lListeNomAttribut[0] as $lNomAttribut){
	        		sscanf($lNomAttribut,"%[a-z]_%s",$lEntete,$lNomAttribut2);
	        		if($j == 1)        			
						fwrite($fp,"\t\t\t\t \" . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . \" = '\" . StringUtils::securiser( \$pVo->get" . $lListeNomAttribut[1][$j] . "() ) . \"'"); 
	        		else if($j != 0)
						fwrite($fp,"\n\t\t\t\t,\" . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . \" = '\" . StringUtils::securiser( \$pVo->get" . $lListeNomAttribut[1][$j] . "() ) . \"'");
					$j++;
	        	}
	        	fwrite($fp,"\n");
	        	sscanf($lListeNomAttribut[0][0],"%[a-z]_%s",$lEntete,$lNomAttribut2);
				fwrite($fp,"\t\t\t WHERE \" . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . \" = '\" . StringUtils::securiser( \$pVo->get" . $lListeNomAttribut[1][0] . "() ) . \"'\";\n\n");
			
				fwrite($fp,"\t\t\$lLogger->log(\"Execution de la requete : \" . \$lRequete,PEAR_LOG_DEBUG); // Maj des logs\n");
				fwrite($fp,"\t\treturn Dbutils::executerRequete(\$lRequete);\n");
				fwrite($fp,"\t}\n");
	        	
	        	
				// Le delete
				
	        	fwrite($fp,"\n\t/**\n");
				fwrite($fp,"\t* @name delete(\$pId)\n");
				fwrite($fp,"\t* @param integer\n");
				fwrite($fp,"\t* @desc Supprime la ligne de la table correspondant à l'id en paramètre\n");
				fwrite($fp,"\t*/\n");
		
				fwrite($fp,"\tpublic static function delete(\$pId) {\n");
				fwrite($fp,"\t\t// Initialisation du Logger\n");
				fwrite($fp,"\t\t\$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);\n");		
				fwrite($fp,"\t\t\$lLogger->setMask(Log::MAX(LOG_LEVEL));\n\n");
			
				fwrite($fp,"\t\t\$lRequete = \"DELETE FROM \" . " . $lNomTable[1] . "Manager::TABLE_" . strtoupper($lNomTable[1]) . " . \"\n");
				sscanf($lListeNomAttribut[0][0],"%[a-z]_%s",$lEntete,$lNomAttribut2);
				fwrite($fp,"\t\t\tWHERE \" . " . $lNomTable[1] . "Manager::CHAMP_" . strtoupper($lNomTable[1]) . "_" . strtoupper($lNomAttribut2) . " . \" = '\" . StringUtils::securiser(\$pId) . \"'\";\n\n");
			
				fwrite($fp,"\t\t\$lLogger->log(\"Execution de la requete : \" . \$lRequete,PEAR_LOG_DEBUG); // Maj des logs\n");
				fwrite($fp,"\t\treturn Dbutils::executerRequete(\$lRequete);\n");
				fwrite($fp,"\t}\n");
	
	        	fwrite($fp,"}\n");
				fwrite($fp,"?>");
	        	fclose($fp);

	        	// Donne les droits d'accès au fichier
	        	shell_exec('cd ' . CHEMIN_CLASSES . 'Manager && chmod 777 ' . $lNomTable[1] . 'Manager.php');
	        }
	
	    }
	   
	    fclose($handle);
	}
	// Suppression du fichier
	unlink(CHEMIN_FICHIER_SQL . FICHIER_SQL);
} else {
	?>
	<form method="post" action="./BackEndGenerator.php" enctype="multipart/form-data">
		<span>Le fichier Sql de la BDD : </span>
		<input type="file" name="zeybusql"/><br/>
		<span>Auteur du fichier</span>
		<input type="text" name="auteur" value="Julien PIERRE"/><br/>
		<input type=submit value="Générer">
	</form>
	
	<?php
}
?>	
</body>
</html>