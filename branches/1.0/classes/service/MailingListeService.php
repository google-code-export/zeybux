<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/01/2011
// Fichier : MailingListeService.php
//
// Description : Classe MailingListeService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CONFIGURATION . "Mail.php"); // Les Constantes de mail
include_once(CHEMIN_CLASSES_VALIDATEUR . "MailingListeValid.php");
include_once(CHEMIN_CONFIGURATION . "SOAP.php"); // Les Constantes de mail

/**
 * @name MailingListeService
 * @author Julien PIERRE
 * @since 23/01/2011
 * @desc Classe Service d'une MailingListe
 */
class MailingListeService
{	
	/**
	* @name insert($pMail)
	* @param String
	* @return VR
	* @desc Ajoute un mail à la mailing liste
	*/
	public function insert($pMail) {
		$lMailingListeValid = new MailingListeValid();
		$lVr = $lMailingListeValid->validAjout($pMail);
		if ($lVr->getValid()) {
			// Initialisation du Logger
			$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
			$lLogger->setMask(Log::MAX(LOG_LEVEL));
			
			try {
				$lSoap = new SoapClient(ADRESSE_WSDL);
				$lSession = $lSoap->login(SOAP_LOGIN, SOAP_PASS,"fr", false);
				$lSoap->mailingListSubscriberAdd($lSession, MAIL_MAILING_LISTE_DOMAIN, MAIL_MAILING_LISTE, $pMail);
				$lSoap->logout($lSession);
				return true;
			} catch(SoapFault $pFault) {
				$lLogger->log("Echec d'ajout à la mailing liste : " . $pFault . ".",PEAR_LOG_INFO);	// Maj des logs
				return false;
			}
		}
		return $lVr;
	}
		
	/**
	* @name delete($pMail)
	* @param String
	* @return VR
	* @desc Supprime un mail de la mailing liste
	*/
	public function delete($pMail) {		
		$lMailingListeValid = new MailingListeValid();
		$lVr = $lMailingListeValid->validAjout($pMail);
		if ($lVr->getValid()) {
			// Initialisation du Logger
			$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
			$lLogger->setMask(Log::MAX(LOG_LEVEL));
			
			try {
				$lSoap = new SoapClient(ADRESSE_WSDL);
				$lSession = $lSoap->login(SOAP_LOGIN, SOAP_PASS,"fr", false);
				$lSoap->mailingListSubscriberDel($lSession, MAIL_MAILING_LISTE_DOMAIN, MAIL_MAILING_LISTE, $pMail);
				$lSoap->logout($lSession);
				return true;
			} catch(SoapFault $pFault) {
				$lLogger->log("Echec de suppression de la mailing liste : " . $pFault . ".",PEAR_LOG_INFO);	// Maj des logs
				return false;
			}
		}
		return $lVr;
	}
}
?>