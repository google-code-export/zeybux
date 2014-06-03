<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/05/2014
// Fichier : ParametreZeybuxControleur.php
//
// Description : Classe ParametreZeybuxControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ParametreZeybuxVO.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_PARAMETRAGE . "/ListeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_PARAMETRAGE . "/AjoutResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_PARAMETRAGE . "/ParametreZeybuxValid.php" );

/**
 * @name ParametreZeybuxControleur
 * @author Julien PIERRE
 * @since 30/05/2014
 * @desc Classe controleur de la gestion du paramétrage des ParametreZeybux
 */
class ParametreZeybuxControleur
{	
	/**
	* @name getParametreZeybux()
	* @return ListeResponse
	* @desc Recherche la liste des ParametreZeybux
	*/
	public function getParametreZeybux() {
		$lResponse = new ListeResponse();
		$lResponse->setListe(new ParametreZeybuxVO(
				MAIL_SUPPORT, MAIL_MAILING_LISTE, MAIL_MAILING_LISTE_DOMAIN,
				ADRESSE_WSDL, SOAP_LOGIN, SOAP_PASS,
				ZEYBUX_TITRE_SITE, ZEYBUX_ADRESSE_SITE,
				PROP_NOM, PROP_ADRESSE, PROP_CODE_POSTAL, PROP_VILLE, PROP_TEL, PROP_MEL,
				PROP_RESP_MARCHE_NOM, PROP_RESP_MARCHE_PRENOM, PROP_RESP_MARCHE_POSTE, PROP_RESP_MARCHE_TEL	));
		return $lResponse;
	}
		
	/**
	 * @name modifierParametreZeybux($pParametreZeybux)
	 * @return AjoutResponse
	 * @desc Met à jour une ParametreZeybux
	 */
	public function modifierParametreZeybux($pParametreZeybux) {
		$lVr = ParametreZeybuxValid::validUpdate($pParametreZeybux);
		if($lVr->getValid()) {
			// Ajout du fichier de config des Mails
			$fp = fopen('./configuration/Mail.php', 'w');
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
			$fp = fopen('./configuration/SOAP.php', 'w');
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
								
			// Ajout du fichier de config du proprietaire
			$fp = fopen('./configuration/Proprietaire.php', 'w');
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
			$fp = fopen('./configuration/Titre.php', 'w');
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
				
			return new AjoutResponse();
		}
		return $lVr;
	}
}
?>