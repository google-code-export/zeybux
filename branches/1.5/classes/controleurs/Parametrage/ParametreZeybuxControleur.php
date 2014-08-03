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
include_once(CHEMIN_CONFIGURATION . "Mail.php"); // Les Constantes de mail
include_once(CHEMIN_CONFIGURATION . "SOAP.php");

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
			fwrite($fp,"define(\"MAIL_SUPPORT\", \"" . $pParametreZeybux["mailSupport"] . "\");\n");
			fwrite($fp,"define(\"MAIL_MAILING_LISTE\", \"" . $pParametreZeybux["mailMailingListe"] . "\");\n");
			fwrite($fp,"define(\"MAIL_MAILING_LISTE_DOMAIN\", \"" . $pParametreZeybux["mailMailingListeDomaine"] . "\");\n");
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
			fwrite($fp,"define(\"ADRESSE_WSDL\", \"" . $pParametreZeybux["adresseWSDL"] . "\");\n");
			fwrite($fp,"define(\"SOAP_LOGIN\", \"" . $pParametreZeybux["sOAPLogin"] . "\");\n");
			fwrite($fp,"define(\"SOAP_PASS\", \"" . $pParametreZeybux["sOAPPass"] . "\");\n");
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
			fwrite($fp,"define(\"PROP_NOM\", \"" . $pParametreZeybux["propNom"] . "\");\n");
			fwrite($fp,"define(\"PROP_ADRESSE\", \"" . $pParametreZeybux["propAdresse"] . "\");\n");
			fwrite($fp,"define(\"PROP_CODE_POSTAL\", \"" . $pParametreZeybux["propCP"] . "\");\n");
			fwrite($fp,"define(\"PROP_VILLE\", \"" . $pParametreZeybux["propVille"] . "\");\n");
			fwrite($fp,"define(\"PROP_TEL\", \"" . $pParametreZeybux["propTel"] . "\");\n");
			fwrite($fp,"define(\"PROP_MEL\", \"" . $pParametreZeybux["propMail"] . "\");\n");
			fwrite($fp,"define(\"PROP_RESP_MARCHE_NOM\", \"" . $pParametreZeybux["propRespMarcheNom"] . "\");\n");
			fwrite($fp,"define(\"PROP_RESP_MARCHE_PRENOM\", \"" . $pParametreZeybux["propRespMarchePrenom"] . "\");\n");
			fwrite($fp,"define(\"PROP_RESP_MARCHE_POSTE\", \"" . $pParametreZeybux["propRespMarchePoste"] . "\");\n");
			fwrite($fp,"define(\"PROP_RESP_MARCHE_TEL\", \"" . $pParametreZeybux["propRespMarcheTel"] . "\");\n");
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
			fwrite($fp,"define(\"ZEYBUX_TITRE_SITE\", \"" . $pParametreZeybux["zeybuxTitre"] . "\");\n");
			fwrite($fp,"define(\"ZEYBUX_ADRESSE_SITE\", \"" . $pParametreZeybux["zeybuxAdresse"] . "\");\n");
			fwrite($fp,"?>\n");
			fclose($fp);
				
			return new AjoutResponse();
		}
		return $lVr;
	}
}
?>