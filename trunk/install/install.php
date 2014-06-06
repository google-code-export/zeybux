<?php $lEntete = "
<html>
	<head>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>
		<title>Zeybux - Installation</title>
		
		<style type=\"text/css\">
/*
* jQuery UI CSS Framework
* Copyright (c) 2010 AUTHORS.txt (http://jqueryui.com/about)
* Dual licensed under the MIT (MIT-LICENSE.txt) and GPL (GPL-LICENSE.txt) licenses.
* To view and modify this theme, visit http://jqueryui.com/themeroller/?ffDefault=Lucida%20Grande,%20Lucida%20Sans,%20Arial,%20sans-serif&fwDefault=normal&fsDefault=1.1em&cornerRadius=10px&bgColorHeader=3a8104&bgTextureHeader=03_highlight_soft.png&bgImgOpacityHeader=33&borderColorHeader=3f7506&fcHeader=ffffff&iconColorHeader=ffffff&bgColorContent=285c00&bgTextureContent=05_inset_soft.png&bgImgOpacityContent=10&borderColorContent=72b42d&fcContent=ffffff&iconColorContent=72b42d&bgColorDefault=4ca20b&bgTextureDefault=03_highlight_soft.png&bgImgOpacityDefault=60&borderColorDefault=45930b&fcDefault=ffffff&iconColorDefault=ffffff&bgColorHover=4eb305&bgTextureHover=03_highlight_soft.png&bgImgOpacityHover=50&borderColorHover=8bd83b&fcHover=ffffff&iconColorHover=ffffff&bgColorActive=285c00&bgTextureActive=04_highlight_hard.png&bgImgOpacityActive=30&borderColorActive=72b42d&fcActive=ffffff&iconColorActive=ffffff&bgColorHighlight=fbf5d0&bgTextureHighlight=02_glass.png&bgImgOpacityHighlight=55&borderColorHighlight=f9dd34&fcHighlight=363636&iconColorHighlight=4eb305&bgColorError=ffdc2e&bgTextureError=08_diagonals_thick.png&bgImgOpacityError=95&borderColorError=fad000&fcError=2b2b2b&iconColorError=cd0a0a&bgColorOverlay=444444&bgTextureOverlay=08_diagonals_thick.png&bgImgOpacityOverlay=15&opacityOverlay=30&bgColorShadow=aaaaaa&bgTextureShadow=07_diagonals_small.png&bgImgOpacityShadow=0&opacityShadow=30&thicknessShadow=0px&offsetTopShadow=4px&offsetLeftShadow=4px&cornerRadiusShadow=4px
*/


/* Component containers
----------------------------------*/
.ui-widget { font-family: 'Ubuntu',Lucida Grande, Lucida Sans, Arial, sans-serif; font-size: 1.1em; }
.ui-widget .ui-widget { font-size: 1em; }
.ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button { font-family: 'Ubuntu',Lucida Grande, Lucida Sans, Arial, sans-serif; font-size: 1em; }
.ui-widget-content { border: 1px solid #72b42d; background: #285c00 url(images/ui-bg_inset-soft_10_285c00_1x100.png) 50% bottom repeat-x; color: #ffffff; }
.ui-widget-content a { color: #ffffff; }
.ui-widget-header { border: 1px solid #3f7506; background: #3a8104 url(images/ui-bg_highlight-soft_33_3a8104_1x100.png) 50% 50% repeat-x; color: #ffffff; font-weight: bold; }
.ui-widget-header a { color: #ffffff; }

/* Interaction Cues
----------------------------------*/
.ui-state-highlight, .ui-widget-content .ui-state-highlight {border: 1px solid #f9dd34; background: #fbf5d0 url(images/ui-bg_glass_55_fbf5d0_1x400.png) 50% 50% repeat-x; color: #363636; }
.ui-state-highlight a, .ui-widget-content .ui-state-highlight a { color: #363636; }
.ui-state-error, .ui-widget-content .ui-state-error {border: 1px solid #fad000; background: #ffdc2e url(images/ui-bg_diagonals-thick_95_ffdc2e_40x40.png) 50% 50% repeat; color: #2b2b2b; }
.ui-state-error a, .ui-widget-content .ui-state-error a { color: #2b2b2b; }
.ui-state-error-text, .ui-widget-content .ui-state-error-text { color: #2b2b2b; }
.ui-priority-primary, .ui-widget-content .ui-priority-primary { font-weight: bold; }
.ui-priority-secondary, .ui-widget-content .ui-priority-secondary { opacity: .7; filter:Alpha(Opacity=70); font-weight: normal; }
.ui-state-disabled, .ui-widget-content .ui-state-disabled { opacity: .35; filter:Alpha(Opacity=35); background-image: none; }

.ui-corner-all { -moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius: 10px; }

/* Button
----------------------------------*/

.ui-button { display: inline-block; position: relative; padding: 0; margin-right: .1em; text-decoration: none !important; cursor: pointer; text-align: center; zoom: 1; overflow: visible; } /* the overflow property removes extra width in IE */

/*button text element */
.ui-button .ui-button-text { display: block; line-height: 1.4;  }
.ui-button-text-only .ui-button-text { padding: .4em 1em; }
.ui-button-icon-only .ui-button-text, .ui-button-icons-only .ui-button-text { padding: .4em; text-indent: -9999999px; }
.ui-button-text-icon .ui-button-text, .ui-button-text-icons .ui-button-text { padding: .4em 1em .4em 2.1em; }
.ui-button-text-icons .ui-button-text { padding-left: 2.1em; padding-right: 2.1em; }
/* no icon support for input elements, provide padding by default */
input.ui-button { padding: .4em 1em; }



body {
	background-color:#BBFF55; 
	font-family: 'Ubuntu',Lucida Grande, Lucida Sans, Arial, sans-serif;
}

#site {
	position:absolute;
	width:1000px;
	top:0;
	left:50%;
	margin-left:-500px;
	background-color:#79c42d; 
	background-repeat:no-repeat;
	min-height:600px;
	padding-bottom:30px;
	border:7px solid #b5f256;
}

h2 {
	font-style:italic;
	margin:0;
	padding-bottom:20px;
	padding-top:10px;	
	text-align:center;
	color:#285c00;
	background:rgba(121,196,145,0.2);
	border-bottom:1px solid green;
}

#formulaire, #formulaire-bdd, #formulaire-caisse {
    margin-left: 320px;
    margin-top: 150px;
    padding-bottom: 5px;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 5px;
    width: 360px;
}

#formulaire-bdd, #formulaire-caisse {
    margin-left: 260px;
    width: 420px;
}

#formulaire-caisse {
	margin-top: 15px;
}

.center {
text-align:center;
}

.ui-widget-header {
padding:2px;
text-align:center;
margin:5px;
}

.ui-state-highlight {
padding:3px;
margin:10px;
}
	
table {
color:#FFFFFF;
}		
		</style>
	</head>
	<body>
		<div id=\"site\" class=\"ui-corner-all\">\n";

	if(!isset($_GET["page"])) {
		echo $lEntete;
?>
		<h2>Étape 1 : Répertoire d'installation</h2>
		<div id="formulaire" class="ui-widget ui-widget-content ui-corner-all">
			<div class="ui-widget ui-widget-header ui-corner-all">Répertoire d'installation</div>
			<div class="ui-state-highlight">Laisser vide pour le répertoire courrant</div>		
			<form action="./install.php?page=2" method="post">
				<input type="text" name="rep" id="rep"/>
				<input type="submit" value="Valider" class="ui-button" />
			</form>
		</div>
<?php 
	} else if($_GET["page"] == 2) {
		if(isset($_POST['rep'])) {			
			define("ADRESSE_DEPOT_ZEYBUX", "depot-zeybux.lesamisduzeybu.fr");
			define("CANAL", "install");
		
			// Récupération de la dernière version du zeybux
			$lResponse = file_get_contents("http://" . ADRESSE_DEPOT_ZEYBUX . "/index.php");
			$lNouvelleVersion = json_decode($lResponse,true);
			$lPhar = $lNouvelleVersion[CANAL]["phar"];
			
			// Supprime l'archive
			@unlink("./" . $lNouvelleVersion[CANAL]["phar"]);
			
			// Téléchargement de la version
			copy("http://" . ADRESSE_DEPOT_ZEYBUX . "/" . CANAL . "/" . $lNouvelleVersion[CANAL]["phar"], "./" . $lNouvelleVersion[CANAL]["phar"]);
			
			$p = new Phar("./" . $lNouvelleVersion[CANAL]["phar"]);
									
			if(empty($_POST['rep'])) {
				$p_path = "./";
			} else {
				$p_path = $_POST['rep'];
			}
			//$p_remove_path = '';
			//$p_mode = '';
		
			// Création du répertoire
			if(!is_dir($p_path)) {
				mkdir($p_path,0755,true);
			}
						
			// Extraction et installation des fichiers
			//$lExtract =  PclTarExtract($p_tarname, $p_path, $p_remove_path, $p_mode);
			
			// Extraction et installation des fichiers
			$p->extractTo($p_path);
			
			// Supprime l'archive
			@unlink("./" . $lNouvelleVersion[CANAL]["phar"]); 
		} else if(!isset($_GET['rep'])) { // Retour à la Page 1
			header('location:./install.php');
		}
		
		echo $lEntete;	
		
		if(isset($_GET['rep'])) {
			$p_path = $_GET['rep'];
?>

<div class="ui-state-highlight">Echec de la connexion à la Base</div>

<?php 
		}
?>
		<h2>Étape 2 : Base de données</h2>
		<div id="formulaire-bdd" class="ui-widget ui-widget-content ui-corner-all">
		<div class="ui-widget ui-widget-header ui-corner-all">La base de données</div>
			<form action="./install.php?page=3" method="post">
				<table>
					<tr>
						<td>Adresse du server SQL</td>
						<td><input type="text" name="server" id="server"/></td>						
					</tr>
					<tr>
						<td>Login</td>
						<td><input type="text" name="login" id="login"/></td>						
					</tr>
					<tr>
						<td>Mot de passe</td>
						<td><input type="password" name="pass" id="pass"/></td>						
					</tr>
					<tr>
						<td>Nom de la base</td>
						<td><input type="text" name="base" id="base"/></td>						
					</tr>
					<tr>
						<td>Préfixe de la base zeybux</td>
						<td><input type="text" name="prefixe" id="prefixe"/></td>						
					</tr>	
					<tr>
						<td colspan="2" class="center">
							<input type="hidden" name="rep" id="rep" value="<?php echo $p_path; ?>"/>
							<input type="submit" value="Valider" class="ui-button" />
						</td>				
					</tr>			
				</table>
			</form>
		</div>
<?php 
	} else if($_GET["page"] == 3) {
		
		if(isset($_POST["rep"]) && isset($_POST["server"]) && isset($_POST["login"]) && isset($_POST["pass"]) && isset($_POST["base"]) && isset($_POST["prefixe"])) {
			// Test de l'accès à la BDD		
			$lAcces = true;
			$mMysqlHost = $_POST["server"]; // le serveur
			$mMysqlLogin = $_POST["login"]; // le login
			$mMysqlPass = $_POST["pass"]; // mot de passe
			$mMysqlDbnom = $_POST["base"]; // nom de la base de donnee
						
			$lDb = @mysql_connect($mMysqlHost,$mMysqlLogin,$mMysqlPass);
			if(!$lDb) {		
				$lAcces = false;
			} else {
				if (!@mysql_select_db($mMysqlDbnom,$lDb)) {
					$lAcces = false;
				} else {
					$lRs = @mysql_query("SET NAMES UTF8"); // Permet d'initer une connexion en UTF-8 avec la BDD
					if (!$lRs) {
						$lAcces = false;
				    }
				}	
			}
				
			if(!$lAcces) { // Connexion KO
				header('location:./install.php?page=2&rep=' . $_POST["rep"]);
			}
			
			if(!@mysql_close($lDb)) {					
				die(mysql_error());
			}
				
			
			// Ajout du fichier de config d'accès à la BDD
			$fp = fopen($_POST["rep"] . '/configuration/DB.php', 'w');
			fwrite($fp,"<?php\n");
			fwrite($fp,"//****************************************************************\n");
			fwrite($fp,"//\n");
			fwrite($fp,"// Createur : Julien PIERRE\n");
			fwrite($fp,"// Date de creation : 25/01/2010\n");
			fwrite($fp,"// Fichier : DB.php\n");
			fwrite($fp,"//\n");
			fwrite($fp,"// Description : Informations de configuration pour la connexion à la base de données\n");
			fwrite($fp,"//\n");
			fwrite($fp,"//****************************************************************\n");
			fwrite($fp,"define(\"MYSQL_DB_PREFIXE\", \"" . $_POST["prefixe"] . "\");\n");
			fwrite($fp,"define(\"MYSQL_HOST\", \"" . $_POST["server"] . "\");\n");
			fwrite($fp,"define(\"MYSQL_LOGIN\", \"" . $_POST["login"] . "\");\n");
			fwrite($fp,"define(\"MYSQL_PASS\", \"" . $_POST["pass"] . "\");\n");
			fwrite($fp,"define(\"MYSQL_DBNOM\", \"" . $_POST["base"] . "\");\n");
			fwrite($fp,"?>\n");			
			fclose($fp);
			
			// Ajout du fichier de config d'accès à la BDD
			$fp = fopen($_POST["rep"] . '/Maintenance/conf/DB.php', 'w');
			fwrite($fp,"<?php\n");
			fwrite($fp,"//****************************************************************\n");
			fwrite($fp,"//\n");
			fwrite($fp,"// Createur : Julien PIERRE\n");
			fwrite($fp,"// Date de creation : 25/01/2010\n");
			fwrite($fp,"// Fichier : DB.php\n");
			fwrite($fp,"//\n");
			fwrite($fp,"// Description : Informations de configuration pour la connexion à la base de données\n");
			fwrite($fp,"//\n");
			fwrite($fp,"//****************************************************************\n");
			fwrite($fp,"define(\"MYSQL_DB_PREFIXE\", \"" . $_POST["prefixe"] . "\");\n");
			fwrite($fp,"define(\"MYSQL_HOST\", \"" . $_POST["server"] . "\");\n");
			fwrite($fp,"define(\"MYSQL_LOGIN\", \"" . $_POST["login"] . "\");\n");
			fwrite($fp,"define(\"MYSQL_PASS\", \"" . $_POST["pass"] . "\");\n");
			fwrite($fp,"define(\"MYSQL_DBNOM\", \"" . $_POST["base"] . "\");\n");
			fwrite($fp,"?>\n");			
			fclose($fp);

			// Installation de la BDD
			$connexion = mysql_connect($_POST["server"], $_POST["login"], $_POST["pass"]);
			mysql_select_db($_POST["base"], $connexion);
			$lRequete = file_get_contents($_POST["rep"] . "/install.sql");
			
			// Ajout du préfixe
			$lRequete=str_replace('{PREFIXE}', $_POST["prefixe"], $lRequete);
			
			$lRequetes = explode(";\n", $lRequete);	
			$lNbErreur = 0;
			mysql_query("SET NAMES UTF8"); // Permet d'initer une connexion en UTF-8 avec la BDD
			
			foreach( $lRequetes as $lReq ) {
				if(!mysql_query($lReq, $connexion)) {
					$lNbErreur++;
				}
			}
			mysql_close($connexion);	
			$p_prefixe = $_POST["prefixe"];
			$p_path = $_POST["rep"];
			
			unlink($_POST["rep"] . "/install.sql"); // Supprime install.sql
		} else if(!isset($_GET['rep']) || !isset($_GET['prefixe'])){ // Retour à la Page 2
			header('location:./install.php?page=2');
		}	
		
		echo $lEntete;	
		
		if(isset($_GET['rep']) && isset($_GET['prefixe'])) {
			$p_path = $_GET["rep"];
			$p_prefixe = $_GET["prefixe"];
			
			if(isset($_GET['mdp'])) {
?>
<div class="ui-state-highlight">Erreur de mot de passe sur le compte : <?php echo $_GET['mdp']; ?></div>
<?php 			
			} else {
?>
<div class="ui-state-highlight">Remplir l'ensemble des comptes</div>
<?php 
			}
		}
?>

		<h2>Étape 3 : Comptes</h2>
		<div id="formulaire-caisse" class="ui-widget ui-widget-content ui-corner-all">
			<div class="ui-widget ui-widget-header ui-corner-all">Les comptes</div>
			<form action="./install.php?page=4" method="post">
				<table>
					<tr>
						<td colspan="2" class="ui-widget-header">Administrateur</td>		
					</tr>
					<tr>
						<td>Login</td>
						<td><input type="text" name="admin-login" id="admin-login"/></td>						
					</tr>
					<tr>
						<td>Mot de passe</td>
						<td><input type="password" name="admin-pass" id="admin-pass"/></td>						
					</tr>
					<tr>
						<td>Resaisir le mot de passe</td>
						<td><input type="password" name="admin-confirm-pass" id="admin-confirm-pass"/></td>						
					</tr>
					<tr>
						<td colspan="2" class="ui-widget-header">Maintenance</td>		
					</tr>
					<tr>
						<td>Login</td>
						<td><input type="text" name="maintenance-login" id="maintenance-login"/></td>						
					</tr>
					<tr>
						<td>Mot de passe</td>
						<td><input type="password" name="maintenance-pass" id="maintenance-pass"/></td>						
					</tr>
					<tr>
						<td>Resaisir le mot de passe</td>
						<td><input type="password" name="maintenance-confirm-pass" id="maintenance-confirm-pass"/></td>						
					</tr>
					<tr>
						<td colspan="2" class="ui-widget-header">Mail</td>		
					</tr>
					<tr>
						<td>Adresse mail du support</td>
						<td><input type="text" name="mailSupport" id="mailSupport"/></td>						
					</tr>
					<tr>
						<td>Mailing liste</td>
						<td><input type="text" name="mailingListe" id="mailingListe"/></td>						
					</tr>
					<tr>
						<td>Domaine des mailing liste</td>
						<td><input type="text" name="mailingListeDomain" id="mailingListeDomain"/></td>						
					</tr>
					<tr>
						<td colspan="2" class="ui-widget-header">Compte OVH : Accès WebServices</td>		
					</tr>
					<tr>
						<td>Adresse du WebService</td>
						<td><input type="text" name="adresseWSDL" id="adresseWSDL"/></td>						
					</tr>
					<tr>
						<td>Login</td>
						<td><input type="text" name="soapLogin" id="soapLogin"/></td>						
					</tr>
					<tr>
						<td>Mot de passe</td>
						<td><input type="text" name="soapPass" id="soapPass"/></td>						
					</tr>
					
					<tr>
						<td colspan="2" class="ui-widget-header">Site Zeybux</td>		
					</tr>
					<tr>
						<td>Nom du site</td>
						<td><input type="text" name="zeybuxTitre" id="zeybuxTitre"/></td>						
					</tr>
					<tr>
						<td>Adresse du site</td>
						<td><input type="text" name="zeybuxAdresse" id="zeybuxAdresse"/></td>						
					</tr>
					<tr>
						<td colspan="2" class="ui-widget-header">Proprietaire Zeybux</td>		
					</tr>
					<tr>
						<td>Nom</td>
						<td><input type="text" name="propNom" id="propNom"/></td>						
					</tr>
					<tr>
						<td>Adresse</td>
						<td><input type="text" name="propAdresse" id="propAdresse"/></td>						
					</tr>
					<tr>
						<td>Code Postal</td>
						<td><input type="text" name="propCP" id="propCP"/></td>						
					</tr>
					<tr>
						<td>Ville</td>
						<td><input type="text" name="propVille" id="propVille"/></td>						
					</tr>
					<tr>
						<td>Téléphone</td>
						<td><input type="text" name="propTel" id="propTel"/></td>						
					</tr>
					<tr>
						<td>Courriel</td>
						<td><input type="text" name="propMail" id="propMail"/></td>						
					</tr>
					<tr>
						<td colspan="2" class="ui-widget-header">Responsable Marché</td>		
					</tr>
					<tr>
						<td>Titre du poste de responsable marché</td>
						<td><input type="text" name="propRespMarchePoste" id="propRespMarchePoste"/></td>						
					</tr>
					<tr>
						<td>Prénom</td>
						<td><input type="text" name="propRespMarchePrenom" id="propRespMarchePrenom"/></td>						
					</tr>
					<tr>
						<td>Nom</td>
						<td><input type="text" name="propRespMarcheNom" id="propRespMarcheNom"/></td>						
					</tr>
					<tr>
						<td>Téléphone</td>
						<td><input type="text" name="propRespMarcheTel" id="propRespMarcheTel"/></td>						
					</tr>		
					<tr>
						<td colspan="2" class="center">
							<input type="hidden" name="rep" id="rep" value="<?php echo $p_path; ?>"/>
							<input type="hidden" name="prefixe" id="prefixe" value="<?php echo $p_prefixe; ?>"/>
							<input type="submit" value="Valider" class="ui-button" />
						</td>				
					</tr>			
				</table>
			</form>
		</div>
<?php 
	} else if($_GET["page"] == 4) {
		if(	isset($_POST['admin-login']) && isset($_POST['admin-pass']) && isset($_POST['admin-confirm-pass'])
			&& isset($_POST['maintenance-login']) && isset($_POST['maintenance-pass']) && isset($_POST['maintenance-confirm-pass'])
			&& isset($_POST['mailSupport']) && isset($_POST['mailingListe']) && isset($_POST['mailingListeDomain'])
			&& isset($_POST['adresseWSDL']) && isset($_POST['soapLogin']) && isset($_POST['soapPass'])
			&& isset($_POST['zeybuxTitre']) && isset($_POST["zeybuxAdresse"])
			&& isset($_POST["propRespMarcheNom"]) && isset( $_POST["propRespMarchePrenom"]) && isset( $_POST["propRespMarchePoste"] ) && isset($_POST["propRespMarcheTel"] ) 
			&& isset($_POST['propNom']) && isset($_POST['propAdresse']) && isset($_POST['propCP'])
			&& isset($_POST['propVille']) && isset($_POST['propTel']) && isset($_POST['propMail'])

			&& isset($_POST['rep']) && isset($_POST['prefixe'])) {
		
			if(empty($_POST["zeybuxAdresse"]) || empty($_POST['admin-login']) || empty($_POST['admin-pass']) || empty($_POST['admin-confirm-pass']) 
				|| empty($_POST['maintenance-login']) || empty($_POST['maintenance-pass']) || empty($_POST['maintenance-confirm-pass'])
				|| empty($_POST['mailSupport']) || empty($_POST['mailingListe']) || empty($_POST['mailingListeDomain'])		
				|| empty($_POST['adresseWSDL'])|| empty($_POST['soapLogin'])|| empty($_POST['soapPass'])	
			) {	
				header('location:./install.php?page=3&rep=' . $_POST['rep'] . '&prefixe=' . $_POST["prefixe"]);
			} else {
				
				if( $_POST['admin-pass'] !== $_POST['admin-confirm-pass'] ||  $_POST['maintenance-pass'] !== $_POST['maintenance-confirm-pass']) {
						header('location:./install.php?page=3&mdp=admin&rep=' . $_POST['rep'] . '&prefixe=' . $_POST["prefixe"]);
				} else {				
					require_once($_POST["rep"] . '/configuration/DB.php');
					
					$connexion = mysql_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS);
					mysql_select_db(MYSQL_DBNOM, $connexion);
				  	mysql_query("SET NAMES UTF8"); // Permet d'initer une connexion en UTF-8 avec la BDD
					// Création de l'admin
					$lRequete =
					"INSERT INTO " . $_POST['prefixe'] . "ide_identification
						(ide_id
						,ide_id_login
						,ide_login
						,ide_pass
						,ide_type
						,ide_autorise)
					VALUES (NULL
						,'0'
						,'" . $_POST['admin-login'] . "'
						,'" . md5($_POST['admin-pass']) . "'
						,'2'
						,'1')";
					mysql_query($lRequete, $connexion);					
					mysql_close($connexion);
					
					// Ajout du fichier de config des Mails
					$fp = fopen($_POST["rep"] . '/configuration/Mail.php', 'w');
					fwrite($fp,"<?php\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Createur : Julien PIERRE\n");
					fwrite($fp,"// Date de creation : 23/01/2012\n");
					fwrite($fp,"// Fichier : Mail.php\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Description : Les constantes de mail\n");
					fwrite($fp,"//\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"define(\"MAIL_SUPPORT\", \"" . $_POST["mailSupport"] . "\");\n");
					fwrite($fp,"define(\"MAIL_MAILING_LISTE\", \"" . $_POST["mailingListe"] . "\");\n");
					fwrite($fp,"define(\"MAIL_MAILING_LISTE_DOMAIN\", \"" . $_POST["mailingListeDomain"] . "\");\n");
					fwrite($fp,"?>\n");
					fclose($fp);
					
					// Ajout du fichier de config des WebServices
					$fp = fopen($_POST["rep"] . '/configuration/SOAP.php', 'w');
					fwrite($fp,"<?php\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Createur : Julien PIERRE\n");
					fwrite($fp,"// Date de creation : 23/01/2012\n");
					fwrite($fp,"// Fichier : SOAP.php\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Description : Les constantes de WebServices\n");
					fwrite($fp,"//\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"define(\"ADRESSE_WSDL\", \"" . $_POST["adresseWSDL"] . "\");\n");
					fwrite($fp,"define(\"SOAP_LOGIN\", \"" . $_POST["soapLogin"] . "\");\n");
					fwrite($fp,"define(\"SOAP_PASS\", \"" . $_POST["soapPass"] . "\");\n");
					fwrite($fp,"?>\n");
					fclose($fp);
					
					// Ajout du fichier de config du niveau de Log
					$fp = fopen($_POST["rep"] . '/configuration/LogLevel.php', 'w');
					fwrite($fp,"<?php\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Createur : Julien PIERRE\n");
					fwrite($fp,"// Date de creation : 22/04/2012\n");
					fwrite($fp,"// Fichier : LogLevel.php\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Description : Le niveau de debug du site\n");
					fwrite($fp,"//\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"// Définition du level de log\n");
					fwrite($fp,"define(\"LOG_LEVEL\",PEAR_LOG_INFO);\n");
					fwrite($fp,"?>\n");
					fclose($fp);
					
					// Le zeybux est ouvert => Fichier de conf de l'ouverture du zeybux
					$fp = fopen($_POST["rep"] . '/configuration/Maintenance.php', 'w');
					fwrite($fp,"<?php\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Createur : Julien PIERRE\n");
					fwrite($fp,"// Date de creation : 02/06/2011\n");
					fwrite($fp,"// Fichier : Maintenance.php\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Description : Informations sur l'état de maintenance du site\n");
					fwrite($fp,"//\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"define(\"MAINTENANCE\", 1);\n");
					fwrite($fp,"?>\n");
					fclose($fp);

					// Ajout du fichier de config du proprietaire
					$fp = fopen($_POST["rep"] . '/configuration/Proprietaire.php', 'w');
					fwrite($fp,"<?php\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Createur : Julien PIERRE\n");
					fwrite($fp,"// Date de creation : 27/04/2013\n");
					fwrite($fp,"// Fichier : Proprietaire.php\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Description : Les informations sur le proprietaire du zeybux\n");
					fwrite($fp,"//\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"define(\"PROP_NOM\", \"" . $_POST["propNom"] . "\");\n");
					fwrite($fp,"define(\"PROP_ADRESSE\", \"" . $_POST["propAdresse"] . "\");\n");
					fwrite($fp,"define(\"PROP_CODE_POSTAL\", \"" . $_POST["propCP"] . "\");\n");
					fwrite($fp,"define(\"PROP_VILLE\", \"" . $_POST["propVille"] . "\");\n");
					fwrite($fp,"define(\"PROP_TEL\", \"" . $_POST["propTel"] . "\");\n");
					fwrite($fp,"define(\"PROP_MEL\", \"" . $_POST["propMail"] . "\");\n");
					fwrite($fp,"define(\"PROP_RESP_MARCHE_NOM\", \"" . $_POST["propRespMarcheNom"] . "\");\n");
					fwrite($fp,"define(\"PROP_RESP_MARCHE_PRENOM\", \"" . $_POST["propRespMarchePrenom"] . "\");\n");
					fwrite($fp,"define(\"PROP_RESP_MARCHE_POSTE\", \"" . $_POST["propRespMarchePoste"] . "\");\n");
					fwrite($fp,"define(\"PROP_RESP_MARCHE_TEL\", \"" . $_POST["propRespMarcheTel"] . "\");\n");
					fwrite($fp,"?>\n");
					fclose($fp);
					
					// Ajout du fichier de config du Titre
					$fp = fopen($_POST["rep"] . '/configuration/Titre.php', 'w');
					fwrite($fp,"<?php\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Createur : Julien PIERRE\n");
					fwrite($fp,"// Date de creation : 25/06/2011\n");
					fwrite($fp,"// Fichier : Titre.php\n");
					fwrite($fp,"//\n");
					fwrite($fp,"// Description : Informations sur le Titre du site\n");
					fwrite($fp,"//\n");
					fwrite($fp,"//****************************************************************\n");
					fwrite($fp,"define(\"ZEYBUX_TITRE_DEBUT\",\"\");\n");
					fwrite($fp,"define(\"ZEYBUX_TITRE_FIN\",\"Zeybux \" . ZEYBUX_VERSION . \" - Outil de gestion\");\n");
					fwrite($fp,"define(\"ZEYBUX_TITRE_SITE\", \"" . $_POST["zeybuxTitre"] . "\");\n");
					fwrite($fp,"define(\"ZEYBUX_ADRESSE_SITE\", \"" . $_POST["zeybuxAdresse"] . "\");\n");
					fwrite($fp,"?>\n");
					fclose($fp);

					// Ajout du fichier de config de l'accès Maintenance
					file_put_contents($_POST["rep"] . '/Maintenance/conf/identifiant.json',json_encode(array("login" => $_POST['maintenance-login'], "pass" => md5($_POST['maintenance-pass']))));
					// Le canal de mise à jour
					file_put_contents($_POST["rep"] . '/Maintenance/conf/maintenance.json',json_encode(array("canal" => "stable")));
				}
			}				
		} else { // Retour à la Page 1
			header('location:./install.php?page=3');
		}
		echo $lEntete;	
?>	
		<h2>Installation terminée</h2>
		<div id="formulaire" class="ui-widget ui-widget-content ui-corner-all">
			<div class="ui-widget ui-widget-header ui-corner-all">Installation terminée</div>
			<div class="center">
				<a href="<?php echo $_POST["rep"]."/index.php"; ?>">Accéder au zeybux</a>
			</div>
		</div>
<?php 
	}
	echo "</div>";
?>		
	</body>
</html>