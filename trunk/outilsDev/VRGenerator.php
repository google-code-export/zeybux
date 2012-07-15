<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Zeybux - VR Generator</title>
</head>
<body>
<div><a href="./index.php">Retour</a></div>
<?php
if(isset($_POST['nom'])) {
	$lNom = $_POST['nom'];
	
	$lNomVariable = array();	
	$lLongueurVariable = array();
	$lObligatoireVariableInsert = array();
	$lObligatoireVariableUpdate = array();
	$lTypeVariable = array();
	
	if(isset($_POST["nomVariable"])) {
		$lNomVariable = $_POST["nomVariable"];
	}
	if(isset($_POST["nomVariableNv"]) && $_POST["nomVariableNv"] != "") {
		array_push($lNomVariable,$_POST["nomVariableNv"]);
	}
	$lTaille = count($lNomVariable);
	
	$lNomVariablePhp = array();
	foreach($lNomVariable as $lNomVar){
		// Première lettre en majuscule
		$lNomVar[0] = strtoupper($lNomVar[0]);
		array_push($lNomVariablePhp,$lNomVar);
	}
	
	if(isset($_POST["longueurVariable"])) {
		$lLongueurVariable = $_POST["longueurVariable"];
	}
	if(isset($_POST["longueurVariableNv"]) && $_POST["longueurVariableNv"] != "") {
		array_push($lLongueurVariable,$_POST["longueurVariableNv"]);
	}
	
	if(isset($_POST["obligatoireVariableInsert"])) {
		$lObligatoireVariableInsert = $_POST["obligatoireVariableInsert"];
	}
	if(isset($_POST["obligatoireVariableInsertNv"]) && $_POST["obligatoireVariableInsertNv"] != "" && $_POST["nomVariableNv"] != "") {
		$lObligatoireVariableInsert[$lTaille-1] = $_POST["obligatoireVariableInsertNv"];
	}
	
	if(isset($_POST["obligatoireVariableUpdate"])) {
		$lObligatoireVariableUpdate = $_POST["obligatoireVariableUpdate"];
	}
	if(isset($_POST["obligatoireVariableUpdateNv"]) && $_POST["obligatoireVariableUpdateNv"] != "" && $_POST["nomVariableNv"] != "") {
		$lObligatoireVariableUpdate[$lTaille-1] = $_POST["obligatoireVariableUpdateNv"];
	}
	
	if(isset($_POST["typeVariable"])) {
		$lTypeVariable = $_POST["typeVariable"];
	}
	if(isset($_POST["typeVariableNv"]) && $_POST["typeVariableNv"] != "") {
		array_push($lTypeVariable,$_POST["typeVariableNv"]);
	}
	
	?>
	<form action="./VRGenerator.php" method="post">
	<span>Nom </span><input type="text" name="nom" value="<?php echo $lNom; ?>"/><br/>
	<span>----------------------------------------------------------------------------------------------------</span><br/>
	<span>Nom de la variable </span><input type="text" name="nomVariableNv" />
	<span>Longueur </span><input type="text" name="longueurVariableNv" />
	<span>Type de champ</span>
		<select name="typeVariableNv">
			<option value="string">String</option>
			<option value="entier">Entier</option>
			<option value="float">Float</option>
			<option value="courriel">Courriel</option>
			<option value="datetime">DateTime</option>
			<option value="date">Date</option>
			<option value="time">Time</option>
			<option value="array">Tableau</option>
			<option value="objet">Objet</option>
		</select>
	<span>Champ Obligatoire : </span>	Insert <input type="checkbox" name="obligatoireVariableInsertNv" value="1" checked="checked"/>|| Update <input type="checkbox" name="obligatoireVariableUpdateNv" value="1" checked="checked"/><br/>
	<span>----------------------------------------------------------------------------------------------------</span><br/>
	<?php 
		
	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			?>
				<span>Nom de la variable </span><input type="text" name="nomVariable[]" value="<?php echo $lNomVariable[$i];?>"/>
				<span>Longueur </span><input type="text" name="longueurVariable[]" value="<?php if(isset($lLongueurVariable[$i])) echo $lLongueurVariable[$i];?>"/>
				<span>Type de champ</span>
				<select name="typeVariable[]">
					<option value="string" <?php if($lTypeVariable[$i] == "string") echo "selected=\"selected\"";?> >String</option>
					<option value="entier" <?php if($lTypeVariable[$i] == "entier") echo "selected=\"selected\"";?> >Entier</option>
					<option value="float" <?php if($lTypeVariable[$i] == "float") echo "selected=\"selected\"";?>>float</option>
					<option value="courriel" <?php if($lTypeVariable[$i] == "courriel") echo "selected=\"selected\"";?>>Courriel</option>
					<option value="datetime" <?php if($lTypeVariable[$i] == "datetime") echo "selected=\"selected\"";?>>DateTime</option>
					<option value="date" <?php if($lTypeVariable[$i] == "date") echo "selected=\"selected\"";?>>Date</option>
					<option value="time" <?php if($lTypeVariable[$i] == "time") echo "selected=\"selected\"";?>>Time</option>
					<option value="array" <?php if($lTypeVariable[$i] == "array") echo "selected=\"selected\"";?>>Tableau</option>
					<option value="objet" <?php if($lTypeVariable[$i] == "objet") echo "selected=\"selected\"";?>>Objet</option>
				</select>
				<span>Champ Obligatoire : </span>	
						Insert <input type="checkbox" name="obligatoireVariableInsert[<?php echo $i;?>]" value="1" <?php if($lObligatoireVariableInsert[$i] == 1) {echo "checked=\"checked\"";} ?> />
					|| Update <input type="checkbox" name="obligatoireVariableUpdate[<?php echo $i;?>]" value="1" <?php if($lObligatoireVariableUpdate[$i] == 1) {echo "checked=\"checked\"";} ?> />
					<br/>
			<?php
			
			$i++;
		}		
	}
	?>
	<span>----------------------------------------------------------------------------------------------------</span><br/>
	<input type="submit" value="Générer"/>
	</form>
	<?php	
	
	
	// VR php
	$lNomFichier = $lNom . "VR.php";
		
	// Création du fichier
	$fp = fopen("./zeybu/classes/vr/" . $lNomFichier, 'w');	
	fwrite($fp,"<?php\n");
	fwrite($fp,"//****************************************************************\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Createur : Julien PIERRE\n");
	fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");
	fwrite($fp,"// Fichier : " . $lNomFichier ."\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Description : Classe " . $lNom . "VR\n");
	fwrite($fp,"//\n");
	fwrite($fp,"//****************************************************************\n");
	fwrite($fp,"// Inclusion des classes\n");
	fwrite($fp,"include_once(CHEMIN_CLASSES_VR . \"VRelement.php\" );\n");	
	fwrite($fp,"include_once(CHEMIN_CLASSES_UTILS . \"MessagesErreurs.php\" );\n");
	fwrite($fp,"include_once(CHEMIN_CLASSES . \"DataTemplate.php\");\n\n");	
	fwrite($fp,"/**\n");
	fwrite($fp," * @name " . $lNom . "VR\n");
	fwrite($fp," * @author Julien PIERRE\n");
	fwrite($fp," * @since " . date("d/m/Y") . "\n");
	fwrite($fp," * @desc Classe représentant une " . $lNom . "VR\n");
	fwrite($fp," */\n");
	fwrite($fp,"class " . $lNom . "VR extends DataTemplate\n");
	fwrite($fp,"{");
	fwrite($fp,"\n\t/**\n");
	fwrite($fp,"\t * @var bool\n");
	fwrite($fp,"\t * @desc Donne la validité de l'objet\n");
	fwrite($fp,"\t */\n");
	fwrite($fp,"\tprotected \$mValid;\n");	
	
	fwrite($fp,"\n\t/**\n");
	fwrite($fp,"\t * @var VRelement\n");
	fwrite($fp,"\t * @desc Le Log de l'objet\n");
	fwrite($fp,"\t */\n");
	fwrite($fp,"\tprotected \$mLog;\n");
	
	fwrite($fp,"\n\t/**\n");
	fwrite($fp,"\t * @var VRelement\n");
	fwrite($fp,"\t * @desc L'Id de l'objet\n");
	fwrite($fp,"\t */\n");
	fwrite($fp,"\tprotected \$mId;\n\n");

	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			fwrite($fp,"\t/**\n");
			if($lTypeVariable[$i] == "array") {
				fwrite($fp,"\t * @var array(VRelement)\n");
			} else {
				fwrite($fp,"\t * @var VRelement\n");
			}
			fwrite($fp,"\t * @desc " . $lNomVariablePhp[$i] . " de la " . $lNom . "VR\n");
			fwrite($fp,"\t */\n");
			if($lTypeVariable[$i] == "array") {
				fwrite($fp,"\tprotected \$m" . $lNomVariablePhp[$i] . ";\n\n");
			} else {
				fwrite($fp,"\tprotected \$m" . $lNomVariablePhp[$i] . ";\n\n");
			}
			$i++;
		}		
	}
	
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name " . $lNom . "VR()\n");
	fwrite($fp,"\t* @return bool\n");
	fwrite($fp,"\t* @desc Constructeur\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tfunction " . $lNom . "VR() {\n");
		fwrite($fp,"\t\t\$this->mValid = true;\n");
		fwrite($fp,"\t\t\$this->mLog = new VRelement();\n");
		fwrite($fp,"\t\t\$this->mId = new VRelement();\n");
		
		if($lTaille != 0) {
			$i = 0;
			while($i < $lTaille) {
				if($lTypeVariable[$i] == "array") {
					fwrite($fp,"\t\t\$this->m" . $lNomVariablePhp[$i] . " = array();\n");
				} else {
					fwrite($fp,"\t\t\$this->m" . $lNomVariablePhp[$i] . " = new VRelement();\n");
				}
				$i++;
			}		
		}
		
	fwrite($fp,"\t}\n\n");
	
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name getValid()\n");
	fwrite($fp,"\t* @return bool\n");
	fwrite($fp,"\t* @desc Renvoie la validite de l'élément\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic function getValid() {\n");
	fwrite($fp,"\t\treturn \$this->mValid;\n");
	fwrite($fp,"\t}\n\n");
	
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name setValid(\$pValid)\n");
	fwrite($fp,"\t* @param bool\n");
	fwrite($fp,"\t* @desc Remplace la validite de l'élément par \$pValid\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic function setValid(\$pValid) {\n");
	fwrite($fp,"\t\t\$this->mValid = \$pValid;\n");
	fwrite($fp,"\t}\n\n");	
	
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name getLog()\n");
	fwrite($fp,"\t* @return VRelement\n");
	fwrite($fp,"\t* @desc Renvoie le VRelement Log\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic function getLog() {\n");
	fwrite($fp,"\t\treturn \$this->mLog;\n");
	fwrite($fp,"\t}\n\n");
	
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name setLog(\$pLog)\n");
	fwrite($fp,"\t* @param VRelement\n");
	fwrite($fp,"\t* @desc Remplace le VRelement Log par \$pLog\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic function setLog(\$pLog) {\n");
	fwrite($fp,"\t\t\$this->mLog = \$pLog;\n");
	fwrite($fp,"\t}\n\n");
	
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name getId()\n");
	fwrite($fp,"\t* @return VRelement\n");
	fwrite($fp,"\t* @desc Renvoie le VRelement Id\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic function getId() {\n");
	fwrite($fp,"\t\treturn \$this->mId;\n");
	fwrite($fp,"\t}\n\n");
	
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name setId(\$pId)\n");
	fwrite($fp,"\t* @param VRelement\n");
	fwrite($fp,"\t* @desc Remplace le VRelement Id par \$pId\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic function setId(\$pId) {\n");
	fwrite($fp,"\t\t\$this->mId = \$pId;\n");
	fwrite($fp,"\t}\n\n");	
	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			fwrite($fp,"\t/**\n");
			fwrite($fp,"\t* @name get" . $lNomVariablePhp[$i] . "()\n");
			fwrite($fp,"\t* @return VRelement\n");
			fwrite($fp,"\t* @desc Renvoie le VRelement m" . $lNomVariablePhp[$i] . "\n");
			fwrite($fp,"\t*/\n");
			fwrite($fp,"\tpublic function get" . $lNomVariablePhp[$i] . "() {\n");
			fwrite($fp,"\t\treturn \$this->m" . $lNomVariablePhp[$i] . ";\n");
			fwrite($fp,"\t}\n\n");
			
			fwrite($fp,"\t/**\n");
			fwrite($fp,"\t* @name set" . $lNomVariablePhp[$i] . "(\$p" . $lNomVariablePhp[$i] . ")\n");
			fwrite($fp,"\t* @param VRelement\n");
			fwrite($fp,"\t* @desc Remplace le m" . $lNomVariablePhp[$i] . " par \$p" . $lNomVariablePhp[$i] . "\n");
			fwrite($fp,"\t*/\n");
			fwrite($fp,"\tpublic function set" . $lNomVariablePhp[$i] . "(\$p" . $lNomVariablePhp[$i] . ") {\n");
			fwrite($fp,"\t\t\$this->m" . $lNomVariablePhp[$i] . " = \$p" . $lNomVariablePhp[$i] . ";\n");
			fwrite($fp,"\t}\n\n");	
			
			if($lTypeVariable[$i] == "array") {
				fwrite($fp,"\t/**\n");
				fwrite($fp,"\t* @name add" . $lNomVariablePhp[$i] . "(\$p" . $lNomVariablePhp[$i] . ")\n");
				fwrite($fp,"\t* @param VRelement\n");
				fwrite($fp,"\t* @desc Ajoute le \$p" . $lNomVariablePhp[$i] . " à m" . $lNomVariablePhp[$i] . "\n");
				fwrite($fp,"\t*/\n");
				fwrite($fp,"\tpublic function add" . $lNomVariablePhp[$i] . "(\$p" . $lNomVariablePhp[$i] . ") {\n");
				fwrite($fp,"\t\tarray_push(\$this->m" . $lNomVariablePhp[$i] . ",\$p" . $lNomVariablePhp[$i] . ");\n");
				fwrite($fp,"\t}\n\n");	
			}
			
			$i++;
		}		
	}
			
	fwrite($fp,"}\n");
	fwrite($fp,"?>");
	fclose($fp); 

	//toVO
	$lNomFichier = $lNom . "ToVO.php";
	$fp = fopen("./zeybu/classes/toVO/" . $lNomFichier, 'w');		
	fwrite($fp,"<?php\n");
	fwrite($fp,"//****************************************************************\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Createur : Julien PIERRE\n");
	fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");
	fwrite($fp,"// Fichier : " . $lNomFichier ."\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Description : Classe " . $lNom . "ToVO\n");
	fwrite($fp,"//\n");
	fwrite($fp,"//****************************************************************\n");
	fwrite($fp,"// Inclusion des classes\n");
	fwrite($fp,"include_once(CHEMIN_CLASSES_VO . \"" . $lNom . "VO.php\" );\n\n");
	fwrite($fp,"/**\n");
	fwrite($fp," * @name " . $lNom . "ToVO\n");
	fwrite($fp," * @author Julien PIERRE\n");
	fwrite($fp," * @since " . date("d/m/Y") . "\n");
	fwrite($fp," * @desc Classe représentant une " . $lNom . "ToVO\n");
	fwrite($fp," */\n");
	fwrite($fp,"class " . $lNom . "ToVO\n");
	fwrite($fp,"{\n");
	
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name convertFromJson(\$pJson)\n");
	fwrite($fp,"\t* @param json\n");
	fwrite($fp,"\t* @desc Convertit le json en objet " . $lNom . "VO\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic static function convertFromJson(\$pJson) {\n");
	fwrite($fp,"\t\t\$lJson = json_decode(\$pJson);\n\n");		
	fwrite($fp,"\t\t\$lValid = isset(\$lJson->id)");	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			fwrite($fp,"\n\t\t\t&& isset(\$lJson->" . $lNomVariable[$i] . ")");
			$i++;
		}		
	}
	fwrite($fp,";\n\n");
		
	fwrite($fp,"\t\tif(\$lValid) {\n");
	fwrite($fp,"\t\t\t\$lVo = new " . $lNom . "VO();\n");
	fwrite($fp,"\t\t\t\$lVo->setId(\$lJson->id);\n");	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			fwrite($fp,"\t\t\t\$lVo->set" . $lNomVariablePhp[$i] . "(\$lJson->" . $lNomVariable[$i] . ");\n");
			$i++;
		}		
	}
	fwrite($fp,"\t\t\treturn \$lVo;\n");
	fwrite($fp,"\t\t}\n");
	fwrite($fp,"\t\treturn NULL;\n");
	fwrite($fp,"\t}\n\n");
	
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name convertFromArray(\$pArray)\n");
	fwrite($fp,"\t* @param array()\n");
	fwrite($fp,"\t* @desc Convertit le array en objet " . $lNom . "VO\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic static function convertFromArray(\$pArray) {\n");
	fwrite($fp,"\t\t\$lValid = isset(\$pArray['id'])");	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			fwrite($fp,"\n\t\t\t&& isset(\$pArray['" . $lNomVariable[$i] . "'])");
			$i++;
		}		
	}
	fwrite($fp,";\n\n");
		
	fwrite($fp,"\t\tif(\$lValid) {\n");
	fwrite($fp,"\t\t\t\$lVo = new " . $lNom . "VO();\n");
	fwrite($fp,"\t\t\t\$lVo->setId(\$pArray['id']);\n");	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			fwrite($fp,"\t\t\t\$lVo->set" . $lNomVariablePhp[$i] . "(\$pArray['" . $lNomVariable[$i] . "']);\n");
			$i++;
		}		
	}
	fwrite($fp,"\t\t\treturn \$lVo;\n");
	fwrite($fp,"\t\t}\n");
	fwrite($fp,"\t\treturn NULL;\n");
	fwrite($fp,"\t}\n");	
	fwrite($fp,"}\n");
	fwrite($fp,"?>");
	fclose($fp); 
	
	// Validateur php
	$lNomFichier = $lNom . "Valid.php";
	$fp = fopen("./zeybu/classes/validateur/" . $lNomFichier, 'w');		
	fwrite($fp,"<?php\n");
	fwrite($fp,"//****************************************************************\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Createur : Julien PIERRE\n");
	fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");
	fwrite($fp,"// Fichier : " . $lNomFichier ."\n");
	fwrite($fp,"//\n");
	fwrite($fp,"// Description : Classe " . $lNom . "Valid\n");
	fwrite($fp,"//\n");
	fwrite($fp,"//****************************************************************\n");
	fwrite($fp,"// Inclusion des classes\n");
	fwrite($fp,"include_once(CHEMIN_CLASSES_UTILS . \"TestFonction.php\" );\n");
	fwrite($fp,"include_once(CHEMIN_CLASSES_VR . \"VRerreur.php\" );\n");	
	fwrite($fp,"include_once(CHEMIN_CLASSES_VR . \"" . $lNom . "VR.php\" );\n\n");	
	fwrite($fp,"/**\n");
	fwrite($fp," * @name " . $lNom . "VR\n");
	fwrite($fp," * @author Julien PIERRE\n");
	fwrite($fp," * @since " . date("d/m/Y") . "\n");
	fwrite($fp," * @desc Classe représentant une " . $lNom . "Valid\n");
	fwrite($fp," */\n");
	fwrite($fp,"class " . $lNom . "Valid\n");
	fwrite($fp,"{\n");
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name validAjout(\$pData)\n");
	fwrite($fp,"\t* @return " . $lNom ."VR\n");
	fwrite($fp,"\t* @desc Test la validite de l'élément\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic static function validAjout(\$pData) {\n");
	fwrite($fp,"\t\t\$lVr = new " . $lNom ."VR();\n");
	
	//Tests inputs
	fwrite($fp,"\t\t//Tests inputs\n");
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			fwrite($fp,"\t\tif(!isset(\$pData['". $lNomVariable[$i] . "'])) {\n");
				fwrite($fp,"\t\t\t\$lVr->setValid(false);\n");
				fwrite($fp,"\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
				fwrite($fp,"\t\t\t\$lErreur = new VRerreur();\n");
				fwrite($fp,"\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_201_CODE);\n");
				fwrite($fp,"\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);\n");
				fwrite($fp,"\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
			fwrite($fp,"\t\t}\n");
			$i++;
		}
	}	
	fwrite($fp,"\n\t\tif(\$lVr->getValid()) {\n");
	
	//Tests Techniques
	fwrite($fp,"\t\t\t//Tests Techniques\n");
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			if($lTypeVariable[$i] != 'objet' && $lTypeVariable[$i] != 'date' && $lTypeVariable[$i] != 'time' && isset($lLongueurVariable[$i]) && $lLongueurVariable[$i] != '') {
				fwrite($fp,"\t\t\tif(!TestFonction::checkLength(\$pData['". $lNomVariable[$i] . "'],0," . $lLongueurVariable[$i] . ")) {\n");
					fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
					fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
					fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
					fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_101_CODE);\n");
					fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);\n");
					fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
				fwrite($fp,"\t\t\t}\n");
			}
			
			switch($lTypeVariable[$i]) {				
				case "courriel":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkCourriel(\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_102_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_102_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
				break;
				
				case "datetime":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkDateTime(\$pData['". $lNomVariable[$i] . "'],'db')) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_103_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
					
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkDateTimeExist(\$pData['". $lNomVariable[$i] . "'],'db')) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_105_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
				break;
			
				case "date":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkDate(\$pData['". $lNomVariable[$i] . "'],'db')) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_103_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
					
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkDateExist(\$pData['". $lNomVariable[$i] . "'],'db')) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_105_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
				break;
				
				case "time":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkTime(\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_106_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_106_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
					
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkTimeExist(\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_107_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_107_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
				break;
				
				case "entier":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!is_int((int)\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_108_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
				break;
				
				case "float":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!is_float((float)\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_109_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
				break;		

				case "array":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!is_array(\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_110_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
				break;
			}
			$i++;
		}
	}
	// Tests Fonctionnels
	fwrite($fp,"\n\t\t\t//Tests Fonctionnels\n");
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			if(isset($lObligatoireVariableInsert[$i]) && $lObligatoireVariableInsert[$i] == 1 && $lTypeVariable[$i] != 'objet') {
				fwrite($fp,"\t\t\tif(empty(\$pData['". $lNomVariable[$i] . "'])) {\n");
					fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
					fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
					fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
					fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_201_CODE);\n");
					fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);\n");
					fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
				fwrite($fp,"\t\t\t}\n");
			}
			$i++;
		}		
	}
	
	
	fwrite($fp,"\t\t}\n");
	fwrite($fp,"\t\treturn \$lVr;\n");
	fwrite($fp,"\t}\n\n");

	// Valid Delete
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name validDelete(\$pData)\n");
	fwrite($fp,"\t* @return " . $lNom ."VR\n");
	fwrite($fp,"\t* @desc Test la validite de l'élément\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic static function validDelete(\$pData) {\n");
	fwrite($fp,"\t\t\$lVr = new " . $lNom ."VR();\n");

	fwrite($fp,"\t\t//Tests inputs\n");
	fwrite($fp,"\t\tif(!isset(\$pData['id'])) {\n");
		fwrite($fp,"\t\t\t\$lVr->setValid(false);\n");
		fwrite($fp,"\t\t\t\$lVr->getId()->setValid(false);\n");
		fwrite($fp,"\t\t\t\$lErreur = new VRerreur();\n");
		fwrite($fp,"\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_201_CODE);\n");
		fwrite($fp,"\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);\n");
		fwrite($fp,"\t\t\t\$lVr->getId()->addErreur(\$lErreur);\n");	
	fwrite($fp,"\t\t}\n");		
	
	fwrite($fp,"\t\tif(\$lVr->getValid()) {\n");	
		fwrite($fp,"\t\t\tif(!is_int((int)\$pData['id'])) {\n");
			fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
			fwrite($fp,"\t\t\t\t\$lVr->getId()->setValid(false);\n");
			fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
			fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_104_CODE);\n");
			fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);\n");
			fwrite($fp,"\t\t\t\t\$lVr->getId()->addErreur(\$lErreur);	\n");				
		fwrite($fp,"\t\t\t}\n");
	fwrite($fp,"\t\t}\n");
	
	fwrite($fp,"\t\treturn \$lVr;\n");
	fwrite($fp,"\t}\n\n");
	
	// Valid Update
	fwrite($fp,"\t/**\n");
	fwrite($fp,"\t* @name validUpdate(\$pData)\n");
	fwrite($fp,"\t* @return " . $lNom ."VR\n");
	fwrite($fp,"\t* @desc Test la validite de l'élément\n");
	fwrite($fp,"\t*/\n");
	fwrite($fp,"\tpublic static function validUpdate(\$pData) {\n");
	

	fwrite($fp,"\t\t\$lTestId = " . $lNom . "Valid::validDelete(\$pData);\n");	
	fwrite($fp,"\t\tif(\$lTestId->getValid()) {\n");	
		fwrite($fp,"\t\t\t\$lVr = new " . $lNom ."VR();\n");
		//Tests inputs
		fwrite($fp,"\t\t\t//Tests inputs\n");
		if($lTaille != 0) {
			$i = 0;
			while($i < $lTaille) {
				fwrite($fp,"\t\t\tif(!isset(\$pData['". $lNomVariable[$i] . "'])) {\n");
					fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
					fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
					fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
					fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_201_CODE);\n");
					fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);\n");
					fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
				fwrite($fp,"\t\t\t}\n");
				$i++;
			}
		}	
		fwrite($fp,"\n\t\t\tif(\$lVr->getValid()) {\n");
	
		// Tests techniques
		fwrite($fp,"\t\t\t//Tests Techniques\n");	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			if($lTypeVariable[$i] != 'objet' && $lTypeVariable[$i] != 'date' && $lTypeVariable[$i] != 'time' && isset($lLongueurVariable[$i]) && $lLongueurVariable[$i] != '') {
				fwrite($fp,"\t\t\t\tif(!TestFonction::checkLength(\$pData['". $lNomVariable[$i] . "'],0," . $lLongueurVariable[$i] . ")) {\n");
					fwrite($fp,"\t\t\t\t\t\$lVr->setValid(false);\n");
					fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
					fwrite($fp,"\t\t\t\t\t\$lErreur = new VRerreur();\n");
					fwrite($fp,"\t\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_101_CODE);\n");
					fwrite($fp,"\t\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);\n");
					fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
				fwrite($fp,"\t\t\t\t}\n");
			}
			switch($lTypeVariable[$i]) {				
				case "courriel":
					fwrite($fp,"\t\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkCourriel(\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_102_CODE);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_102_MSG);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t\t}\n");
				break;
				case "datetime":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkDateTime(\$pData['". $lNomVariable[$i] . "'],'db')) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_103_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
					
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkDateTimeExist(\$pData['". $lNomVariable[$i] . "'],'db')) {\n");
						fwrite($fp,"\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_105_CODE);\n");
						fwrite($fp,"\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);\n");
						fwrite($fp,"\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t}\n");
				break;
				case "date":
					fwrite($fp,"\t\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkDate(\$pData['". $lNomVariable[$i] . "'],'db')) {\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_103_CODE);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t\t}\n");
					
					fwrite($fp,"\t\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkDateExist(\$pData['". $lNomVariable[$i] . "'],'db')) {\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_105_CODE);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t\t}\n");
				break;
				
				case "time":
					fwrite($fp,"\t\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkTime(\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_106_CODE);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_106_MSG);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t\t}\n");
					
					fwrite($fp,"\t\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!TestFonction::checkTimeExist(\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_107_CODE);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_107_MSG);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t\t}\n");
				break;
				
				case "entier":
					fwrite($fp,"\t\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!is_int((int)\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_108_CODE);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t\t}\n");
				break;
				
				case "float":
					fwrite($fp,"\t\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!is_float((float)\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_109_CODE);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t\t}\n");
				break;
				
				case "array":
					fwrite($fp,"\t\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"\$pData['". $lNomVariable[$i] . "']	!= '' && ");
					}
					    fwrite($fp,"!is_array(\$pData['". $lNomVariable[$i] . "'])) {\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur = new VRerreur();\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_110_CODE);\n");
						fwrite($fp,"\t\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);\n");
						fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
					fwrite($fp,"\t\t\t\t}\n");
				break;
			}	
			$i++;		
		}		
	}
	// Tests Fonctionnels
	fwrite($fp,"\n\t\t\t\t//Tests Fonctionnels\n");
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			if(isset($lObligatoireVariableUpdate[$i]) && $lObligatoireVariableUpdate[$i] == 1 && $lTypeVariable[$i] != 'objet') {
				fwrite($fp,"\t\t\t\tif(empty(\$pData['". $lNomVariable[$i] . "'])) {\n");
					fwrite($fp,"\t\t\t\t\t\$lVr->setValid(false);\n");
					fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->setValid(false);\n");
					fwrite($fp,"\t\t\t\t\t\$lErreur = new VRerreur();\n");
					fwrite($fp,"\t\t\t\t\t\$lErreur->setCode(MessagesErreurs::ERR_201_CODE);\n");
					fwrite($fp,"\t\t\t\t\t\$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);\n");
					fwrite($fp,"\t\t\t\t\t\$lVr->get". $lNomVariablePhp[$i] . "()->addErreur(\$lErreur);	\n");				
				fwrite($fp,"\t\t\t\t}\n");
			}
			$i++;
		}		
	}

	fwrite($fp,"\t\t\t}\n");	
	fwrite($fp,"\t\t\treturn \$lVr;\n");

	fwrite($fp,"\t\t}\n");	
	fwrite($fp,"\t\treturn \$lTestId;\n");
	fwrite($fp,"\t}\n\n");	
	
	fwrite($fp,"}");
	fwrite($fp,"?>");
	fclose($fp);
	
	
	
	
	// Javascript
	
	// VR Javascript
	$lNomFichier = $lNom . "VR.js";
	$fp = fopen("./zeybu/js/vr/" . $lNomFichier, 'w');	
	fwrite($fp,"function " . $lNom . "VR() {\n");
	fwrite($fp,"\tthis.valid = true;\n");
	fwrite($fp,"\tthis.log = new VRelement();\n");
	fwrite($fp,"\tthis.id = new VRelement();\n");
	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			switch($lTypeVariable[$i]) {
				case 'array':
					fwrite($fp,"\tthis." . $lNomVariable[$i] . " = new Array();\n");
					break;
				default:
					fwrite($fp,"\tthis." . $lNomVariable[$i] . " = new VRelement();\n");
			}			
			$i++;
		}		
	}
	
	fwrite($fp,"}\n");
	fclose($fp); 
	
	// VO Javascript
	$lNomFichier = $lNom . "VO.js";
	$fp = fopen("./zeybu/js/vo/" . $lNomFichier, 'w');	
	fwrite($fp,"function " . $lNom . "VO() {\n");
	fwrite($fp,"\tthis.id = '';\n");
	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			switch($lTypeVariable[$i]) {
				case 'array':
					fwrite($fp,"\tthis." . $lNomVariable[$i] . " = new Array();\n");
					break;
				default:
					fwrite($fp,"\tthis." . $lNomVariable[$i] . " = '';\n");
			}			
			$i++;
		}		
	}
	
	fwrite($fp,"}\n");
	fclose($fp); 
	
	// Validateur javascript
	$lNomFichier = $lNom . "Valid.js";
	$fp = fopen("./zeybu/js/validateur/" . $lNomFichier, 'w');		
	fwrite($fp,"function " . $lNom . "Valid() { \n");
	fwrite($fp,"\tthis.validAjout = function(pData) { \n");		
	fwrite($fp,"\t\tvar lVR = new " . $lNom ."VR();\n");
	// Tests techniques
	fwrite($fp,"\t\t//Tests Techniques\n");
	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			if($lTypeVariable[$i] != 'objet' && $lTypeVariable[$i] != 'date' && $lTypeVariable[$i] != 'time' && isset($lLongueurVariable[$i]) && $lLongueurVariable[$i] != '') {
				fwrite($fp,"\t\tif(!pData.". $lNomVariable[$i] . ".checkLength(0," . $lLongueurVariable[$i] . ")) {");
				fwrite($fp,"lVR.valid = false;");
				fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
				fwrite($fp,"var erreur = new VRerreur();");
				fwrite($fp,"erreur.code = ERR_101_CODE;");
				fwrite($fp,"erreur.message = ERR_101_MSG;");				
				fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
				fwrite($fp,"}\n");
			}
			
			switch($lTypeVariable[$i]) {				
				case "courriel":
					fwrite($fp,"\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".checkCourriel()) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_102_CODE;");
					fwrite($fp,"erreur.message = ERR_102_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
				break;
				
				case "date":
					fwrite($fp,"\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".checkDate('db')) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_103_CODE;");
					fwrite($fp,"erreur.message = ERR_103_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
					
					fwrite($fp,"\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".checkDateExist('db')) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_105_CODE;");
					fwrite($fp,"erreur.message = ERR_105_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
				break;
				
				case "time":
					fwrite($fp,"\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".checkTime()) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_106_CODE;");
					fwrite($fp,"erreur.message = ERR_106_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
					
					fwrite($fp,"\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".checkTimeExist()) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_107_CODE;");
					fwrite($fp,"erreur.message = ERR_107_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
				break;
								
				case "entier":
					fwrite($fp,"\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".isInt()) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_108_CODE;");
					fwrite($fp,"erreur.message = ERR_108_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
				break;
				
				case "float":
					fwrite($fp,"\t\tif(");
					if(!isset($lObligatoireVariableInsert[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".isFloat()) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_109_CODE;");
					fwrite($fp,"erreur.message = ERR_109_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
				break;
			}			
			$i++;
		}		
	}
	
	// Tests Fonctionnels
	fwrite($fp,"\n\t\t//Tests Fonctionnels\n");
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			if(isset($lObligatoireVariableInsert[$i]) && $lObligatoireVariableInsert[$i] == 1 && $lTypeVariable[$i] != 'objet') {
				fwrite($fp,"\t\tif(pData.". $lNomVariable[$i] . ".isEmpty()) {");
				fwrite($fp,"lVR.valid = false;");
				fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
				fwrite($fp,"var erreur = new VRerreur();");
				fwrite($fp,"erreur.code = ERR_201_CODE;");
				fwrite($fp,"erreur.message = ERR_201_MSG;");
				fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
				fwrite($fp,"}\n");
			}
			$i++;
		}		
	}
	
	fwrite($fp,"\n\t\treturn lVR;\n");	
	fwrite($fp,"\t}\n\n");	 
	
	fwrite($fp,"\tthis.validDelete = function(pData) {\n");
	fwrite($fp,"\t\tvar lVR = new " . $lNom . "VR();\n");
	fwrite($fp,"\t\tif(isNaN(parseInt(pData.id))) {");
	fwrite($fp,"lVR.valid = false;");
	fwrite($fp,"lVR.id.valid = false;");
	fwrite($fp,"var erreur = new VRerreur();");
	fwrite($fp,"erreur.code = ERR_104_CODE;");
	fwrite($fp,"erreur.message = ERR_104_MSG;");
	fwrite($fp,"lVR.id.erreurs.push(erreur);");
	fwrite($fp,"}\n");		
	fwrite($fp,"\t\treturn lVR;\n");
	fwrite($fp,"\t}\n\n");
	
	fwrite($fp,"\tthis.validUpdate = function(pData) {\n");
	
	fwrite($fp,"\t\tvar lTestId = this.validDelete(pData);\n");
	fwrite($fp,"\t\tif(lTestId.valid) {\n");		
	fwrite($fp,"\t\t\tvar lVR = new " . $lNom ."VR();\n");
	// Tests techniques
	fwrite($fp,"\t\t\t//Tests Techniques\n");
	
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			if($lTypeVariable[$i] != 'objet' && $lTypeVariable[$i] != 'date' && $lTypeVariable[$i] != 'time' && isset($lLongueurVariable[$i]) && $lLongueurVariable[$i] != '') {
				fwrite($fp,"\t\t\tif(!pData.". $lNomVariable[$i] . ".checkLength(0," . $lLongueurVariable[$i] . ")) {");
				fwrite($fp,"lVR.valid = false;");
				fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
				fwrite($fp,"var erreur = new VRerreur();");
				fwrite($fp,"erreur.code = ERR_101_CODE;");
				fwrite($fp,"erreur.message = ERR_101_MSG;");				
				fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
				fwrite($fp,"}\n");
			}
			
			switch($lTypeVariable[$i]) {				
				case "courriel":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".checkCourriel()) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_102_CODE;");
					fwrite($fp,"erreur.message = ERR_102_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
				break;
				
				case "date":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".checkDate('db')) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_103_CODE;");
					fwrite($fp,"erreur.message = ERR_103_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
					
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".checkDateExist('db')) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_105_CODE;");
					fwrite($fp,"erreur.message = ERR_105_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
				break;
				
				case "time":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".checkTime()) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_106_CODE;");
					fwrite($fp,"erreur.message = ERR_106_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
					
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".checkTimeExist()) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_107_CODE;");
					fwrite($fp,"erreur.message = ERR_107_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
				break;
				
				case "entier":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".isInt()) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_108_CODE;");
					fwrite($fp,"erreur.message = ERR_108_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
				break;
				
				case "float":
					fwrite($fp,"\t\t\tif(");
					if(!isset($lObligatoireVariableUpdate[$i])) {
						fwrite($fp,"pData.". $lNomVariable[$i] . " != '' && ");
					}
					fwrite($fp,"!pData.". $lNomVariable[$i] . ".isFloat()) {");
					fwrite($fp,"lVR.valid = false;");
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
					fwrite($fp,"var erreur = new VRerreur();");
					fwrite($fp,"erreur.code = ERR_109_CODE;");
					fwrite($fp,"erreur.message = ERR_109_MSG;");				
					fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
					fwrite($fp,"}\n");
				break;
			}			
			$i++;
		}		
	}
	
	// Tests Fonctionnels
	fwrite($fp,"\n\t\t\t//Tests Fonctionnels\n");
	if($lTaille != 0) {
		$i = 0;
		while($i < $lTaille) {
			if(isset($lObligatoireVariableUpdate[$i]) && $lObligatoireVariableUpdate[$i] == 1 && $lTypeVariable[$i] != 'objet') {
				fwrite($fp,"\t\t\tif(pData.". $lNomVariable[$i] . ".isEmpty()) {");
				fwrite($fp,"lVR.valid = false;");
				fwrite($fp,"lVR.". $lNomVariable[$i] . ".valid = false;");
				fwrite($fp,"var erreur = new VRerreur();");
				fwrite($fp,"erreur.code = ERR_201_CODE;");
				fwrite($fp,"erreur.message = ERR_201_MSG;");
				fwrite($fp,"lVR.". $lNomVariable[$i] . ".erreurs.push(erreur);");
				fwrite($fp,"}\n");
			}
			$i++;
		}		
	}
	
	fwrite($fp,"\n\t\t\treturn lVR;\n");	
	
	
	
	
	
	fwrite($fp,"\t\t}\n");	
	fwrite($fp,"\t\treturn lTestId;\n");
	fwrite($fp,"\t}\n\n");	
	
	fwrite($fp,"}");
	fclose($fp);	
		
} else {?>
	<form action="./VRGenerator.php" method="post">
	<span>Nom </span><input type="text" name="nom" /><br/>
	<input type="submit" value="Générer"/>
	</form>
<?php } ?>
</body>
</html>