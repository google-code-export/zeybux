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
include("./DbUtils.php");

if(isset($_POST['nom']) && $_POST['nom'] != "" && isset($_POST['module']) && isset($_POST['cste_module']) && isset($_POST['label'])) {
	
	
	$lDossier = dir("../vues/");
	$i = 0;
	while (false !== ($lEntree = $lDossier->read())) {
		if($i == $_POST['module']) {
			$lNomModule = $lEntree;
		}
		$i++;
	}
	
	$lNomVueFichier = $_POST['nom'] . "Vue.php";
	$lNomVue = $_POST['nom'];
	
	$lCsteModule = $_POST['cste_module'];
	
	// Création des fichiers

	// Fichier css
	if(!file_exists("../css/" . $lNomModule . "/" . $lNomVue . ".css")) {
		$fp = fopen("../css/" . $lNomModule . "/" . $lNomVue . ".css", 'w');
		fwrite($fp,"@CHARSET \"UTF-8\";\n");
		fclose($fp);
		echo "Création du fichier : ../css/" . $lNomModule . "/" . $lNomVue . ".css" . "<br/>";
	}
	
	// Fichier html
	if(!file_exists("../html/" . $lNomModule . "/" . $lNomVue . ".html") ) {
		$fp = fopen("../html/" . $lNomModule . "/" . $lNomVue . ".html", 'w');	
		fwrite($fp,"{ENTETE}\n");
		fwrite($fp,"\t<div id=\"menu_ext\">{MENU}</div>\n");
		fwrite($fp,"\t<div id=\"" . strtolower($lNomVue) . "\">\n");
		fwrite($fp,"\t</div>\n");
		fwrite($fp,"{PIED_PAGE}\n");	
		fclose($fp);
		echo "Création du fichier : ../html/" . $lNomModule . "/" . $lNomVue . ".html" . "<br/>";
	}
	
	// Fichier Vue
	if(!file_exists("../vues/" . $lNomModule . "/" . $lNomVueFichier) ) {
		$fp = fopen("../vues/" . $lNomModule . "/" . $lNomVueFichier, 'w');
	
		fwrite($fp,"<?php\n");
		fwrite($fp,"//****************************************************************\n");
		fwrite($fp,"//\n");
		fwrite($fp,"// Createur : Julien PIERRE\n");
		fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");
		fwrite($fp,"// Fichier : " . $lNomVueFichier . "\n");
		fwrite($fp,"//\n");
		fwrite($fp,"// Description : À REMPLIR\n");
		fwrite($fp,"//\n");
		fwrite($fp,"//****************************************************************\n\n");
		
		fwrite($fp,"// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion\n");
		fwrite($fp,"if( isset(\$_SESSION[DROIT_ID]) && ( isset(\$_SESSION[" . $lCsteModule . "]) || isset(\$_SESSION[DROIT_SUPER_ZEYBU]) ) ) {\n\n");
				
		fwrite($fp,"\t// Inclusion des classes\n");
		fwrite($fp,"\tinclude_once(CHEMIN_CLASSES_UTILS . \"Template.php\");\n");
		fwrite($fp,"\tinclude_once(CHEMIN_CLASSES_UTILS . \"MenuUtils.php\");\n");
		fwrite($fp,"\tinclude_once(CHEMIN_CLASSES_UTILS . \"StringUtils.php\");\n");
		fwrite($fp,"\tinclude_once(CHEMIN_CLASSES_PO . " . $lCsteModule . " . \"/" . $lNomVue . "PO.php\");\n");
		fwrite($fp,"\tinclude_once(CHEMIN_CLASSES_CONTROLEURS . " . $lCsteModule . " . \"/" . $lNomVue . "Controleur.php\");\n\n");
		
		fwrite($fp,"\t// Définition des constantes\n\n");
		
		fwrite($fp,"\t// Constante de titre de la page\n");
		fwrite($fp,"\tdefine(\"TITRE\", ZEYBUX_TITRE_DEBUT . \"LE TITRE DE LA VUE\" . ZEYBUX_TITRE_FIN);\n\n");
		
		fwrite($fp,"\t// Constantes css\n");
		fwrite($fp,"\tdefine(\"MENU_CSS\", CHEMIN_CSS . COMMUN_CSS . \"Menu.css\");\n");
		fwrite($fp,"\tdefine(\"" . strtoupper($lNomVue) . "_CSS\", CHEMIN_CSS . " . $lCsteModule . " . \"/" . $lNomVue . ".css\");\n\n");
	
		fwrite($fp,"\t/****************** RÉCUPÉRATION DES DONNÉES ********************/\n\n");
		
		fwrite($fp,"\t// Préparation de l'affichage\n");
		fwrite($fp,"\t\$lTemplate = new Template(CHEMIN_TEMPLATE);\n\n");
		
		fwrite($fp,"\t// Entete\n");
		fwrite($fp,"\t\$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );\n");
		fwrite($fp,"\t\$lTemplate->assign_vars( array( 'TITRE' => TITRE) );\n\n");
		
		fwrite($fp,"\t// Css\n");
		fwrite($fp,"\t\$lTemplate->assign_block_vars('css', array('LIEN_CSS' => '\"' . MENU_CSS . '\"' ));\n");
		fwrite($fp,"\t\$lTemplate->assign_block_vars('css', array('LIEN_CSS' => '\"' . " . strtoupper($lNomVue) . "_CSS . '\"' ));\n\n");
	
		fwrite($fp,"\t\$lTemplate->assign_var_from_handle('ENTETE', 'entete');\n\n");
		
		fwrite($fp,"\t// Body\n");
		fwrite($fp,"\t\$lTemplate->set_filenames( array('body' => " . $lCsteModule . " . '/' . '" . $lNomVue . ".html') );\n\n");
		
		fwrite($fp,"\t// Menu\n");
		fwrite($fp,"\tMenuUtils::afficherMenu(&\$lTemplate);\n");
		fwrite($fp,"\t\$lTemplate->assign_var_from_handle('MENU', 'menu');\n\n");
	
		fwrite($fp,"\t/****************** PRÉPARATION DE L'AFFICHAGE DES DONNÉES ********************/\n\n");
		
		fwrite($fp,"\t// Pied de Page\n");
		fwrite($fp,"\t\$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );\n");
		fwrite($fp,"\t\$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');\n\n");
		
		fwrite($fp,"\t// Affichage\n");
		fwrite($fp,"\t\$lTemplate->pparse('body');\n\n");
		
		fwrite($fp,"\t\$lLogger->log(\"Affichage de la vue " . $lNomVue . " par le compte de l'Adhérent : \" . \$_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs\n\n");	
				
		fwrite($fp,"} else {\n");
		fwrite($fp,"\t\$lLogger->log(\"Demande d'accés sans autorisation à " . $lNomVue . "\",PEAR_LOG_INFO);	// Maj des logs\n");
		fwrite($fp,"\theader('location:./index.php');\n");
		fwrite($fp,"}\n");
		fwrite($fp,"?>\n");	
		fclose($fp);
		echo "Création du dossier : ../vues/" . $lNomModule . "/" . $lNomVueFichier . "<br/>";
	}
	
	// Fichier Controleur
	if(!file_exists("../classes/controleurs/" . $lNomModule . "/" . $lNomVue . "Controleur.php") ) {
		$fp = fopen("../classes/controleurs/" . $lNomModule . "/" . $lNomVue . "Controleur.php", 'w');
	
		fwrite($fp,"<?php\n");	
		fwrite($fp,"//****************************************************************\n");	
		fwrite($fp,"//\n");	
		fwrite($fp,"// Createur : Julien PIERRE\n");	
		fwrite($fp,"// Date de creation : " . date("d/m/Y") . "\n");	
		fwrite($fp,"// Fichier : " . $lNomVue . "Controleur.php\n");	
		fwrite($fp,"//\n");	
		fwrite($fp,"// Description : Classe " . $lNomVue . "Controleur\n");	
		fwrite($fp,"//\n");	
		fwrite($fp,"//****************************************************************\n\n");
			
		fwrite($fp,"// Inclusion des classes\n");	
		fwrite($fp,"include_once(CHEMIN_CLASSES_UTILS . \"StringUtils.php\" );\n");
		fwrite($fp,"include_once(CHEMIN_CLASSES_PO . " . $lCsteModule . " . \"/" . $lNomVue . "PO.php\");\n\n");	
		
		fwrite($fp,"/**\n");
		fwrite($fp," * @name " . $lNomVue . "Controleur\n");	
		fwrite($fp," * @author Julien PIERRE\n");
		fwrite($fp," * @since " . date("d/m/Y") . "\n");
		fwrite($fp," * @desc Classe controleur d'une " . $lNomVue . "\n");
		fwrite($fp," */\n");
		fwrite($fp,"class " . $lNomVue . "Controleur\n");
		fwrite($fp,"{\n");
		
		fwrite($fp,"\t/**\n");
		fwrite($fp,"\t * @var " . $lNomVue . "PO\n");
		fwrite($fp,"\t * @desc La " . $lNomVue . "PO du controleur\n");
		fwrite($fp,"\t */\n");
		fwrite($fp,"\tprivate \$m" . $lNomVue . ";\n\n");
	
		fwrite($fp,"\t/**\n");
		fwrite($fp,"\t* @name get" . $lNomVue . "()\n");
		fwrite($fp,"\t* @return " . $lNomVue . "PO\n");
		fwrite($fp,"\t* @desc Renvoie la " . $lNomVue . " du controleur\n");
		fwrite($fp,"\t*/\n");
		fwrite($fp,"\tpublic function get" . $lNomVue . "() {\n");
		fwrite($fp,"\t\treturn \$this->m" . $lNomVue . ";\n");
		fwrite($fp,"\t}\n\n");
		
		fwrite($fp,"\t/**\n");
		fwrite($fp,"\t* @name set" . $lNomVue . "(\$p" . $lNomVue . ")\n");
		fwrite($fp,"\t* @param " . $lNomVue . "PO\n");
		fwrite($fp,"\t* @desc Remplace la " . $lNomVue . " du controleur par \$p" . $lNomVue . "\n");
		fwrite($fp,"\t*/\n");
		fwrite($fp,"\tpublic function set" . $lNomVue . "(\$p" . $lNomVue . ") {\n");
		fwrite($fp,"\t\t\$this->m" . $lNomVue . " = \$p" . $lNomVue . ";\n");
		fwrite($fp,"\t}\n\n");
		
		fwrite($fp,"\t/**\n");
		fwrite($fp,"\t* @name genererPO()\n");
		fwrite($fp,"\t* @return " . $lNomVue . "PO\n");
		fwrite($fp,"\t* @desc Traite les données pour générer le PO de la vue.\n");
		fwrite($fp,"\t*/\n");
		fwrite($fp,"\tpublic function genererPO() {\n\n");
			
		fwrite($fp,"\t}\n");
			
		fwrite($fp,"}\n");
		fwrite($fp,"?>\n");
		fclose($fp);
		echo "Création du dossier : ../classes/controleurs/" . $lNomModule . "/" . $lNomVue . "Controleur.php" . "<br/>";
	}

	if($_POST['label'] != "") {
		$lRequete = "SELECT * FROM `mod_module` WHERE mod_nom = '" . $lNomModule ."'";
		$lSql = Dbutils::executerRequete($lRequete);
		$lModule = mysql_fetch_assoc($lSql);
		
		if( $lModule["mod_id"] != "") {
			$lRequete = "SELECT * FROM `vue_vues` WHERE `vue_id_module` = ".$lModule["mod_id"]." ORDER BY vue_ordre DESC";
			$lSql = Dbutils::executerRequete($lRequete);
			$lLigne = mysql_fetch_assoc($lSql);
			$lOrdre = $lLigne["vue_ordre"];
			$lOrdre++;
			
			$lRequete = 	"INSERT INTO `vue_vues` 
					(vue_id,vue_id_module,vue_nom,vue_label,vue_ordre) 
					VALUES (NULL, '" . $lModule["mod_id"] . "', '" . $lNomVue . "', '" . $_POST['label'] . "', '" . $lOrdre . "')";
			Dbutils::executerRequete($lRequete);
		} else {
			echo "<br/><div style=\"color:red\">Le module n'appartient pas au menu !</div>";
		}		
	}	
	?>
		<h3>Traitements Terminés !!</h3>
	<?php
} else {
	?>
	<form action="./VueGenerator.php" method="post" >
		<span>Nom de la Vue : </span>
		<input type="text" name="nom" /><br/>
	
		<span>Module de la Vue : </span>
		<select name="module">
		<?php 
		$lDossier = dir("../vues/");
		$i = 0;
		while (false !== ($lEntree = $lDossier->read())) {
			if($lEntree != ".htaccess" && $lEntree != "." && $lEntree != ".." && $lEntree != ".svn") {
				echo "\t<option value=\"" . $i . "\">" . $lEntree . "</option>\n";
			}
			$i++;
		}		
		?>			
		</select><br/>
		<span>Nom de la constante du module : </span>
		<input type="text" name="cste_module" /><br/>
	
		<span>Label de la Vue (Uniquement si la vue doit faire partie du menu (sinon laisser vide) ) : </span>
		<input type="text" name="label" /><br/>
		<input type="submit" />
	</form>
	
	<?php 	
}

?>
</body>
</html>