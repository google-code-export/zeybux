<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/01/2012
// Fichier : MotDePasseControleur.php
//
// Description : Classe MotDePasseControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );

include_once(CHEMIN_CLASSES_UTILS . "MotDePasseUtils.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_IDENTIFICATION . "/IdentificationValid.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");

/**
 * @name MotDePasseControleur
 * @author Julien PIERRE
 * @since 22/01/2012
 * @desc Classe controleur du Mot de Passe
 */
class MotDePasseControleur
{
	/**
	* @name reinitier($pParam)
	* @return VR
	* @desc Met un nouveau mot de passe sur le compte et le retourne par mail
	*/
	public function reinitier($pParam) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lValid = new IdentificationValid();
		$lVr = $lValid->validReInitMdp($pParam);				
		if($lVr->getValid()) {			
			include_once(CHEMIN_CONFIGURATION . "Mail.php"); // Les Constantes de mail
			
			$lAdherent = AdherentManager::selectByNumero( $pParam['numero'] );	
			$lAdherent = $lAdherent[0];
			$lIdAdherent = $lAdherent->getId();
			
			// Mise à jour avec un nouveau mot de passe
			$lMdp = MotDePasseUtils::generer();			
			$lIdentification = IdentificationManager::selectByIdType($lIdAdherent,1);
			$lIdentification = $lIdentification[0];
			$lIdentification->setPass( md5( $lMdp ) );
			IdentificationManager::update( $lIdentification );
			
			// Envoi du mail de confirmation	
			$lTo = $pParam['mail'];
			
			// Envoi du mail de confirmation		
			/*if($lAdherent->getCourrielPrincipal() != "") {
				$lTo = $lAdherent->getCourrielPrincipal();
			} else if($lAdherent->getCourrielSecondaire() != "") {
				$lTo = $lAdherent->getCourrielSecondaire();			
			} else { // Pas de mail sur le compte : Envoi au gestionnaire
				$lTo = MAIL_SUPPORT;				
			}*/
			
			$lFrom  = MAIL_SUPPORT;  

			$jour  = date("d-m-Y");
			$heure = date("H:i");			
			$lSujet = "Réinitialisation de votre mot de passe zeybux - $jour $heure";

			$lContenu = file_get_contents(CHEMIN_TEMPLATE . MOD_IDENTIFICATION . "/" . "MailReInitMdp.html");
			$lContenu = str_replace(array("{LOGIN}", "{MOT_PASSE}", "{ZEYBUX_ADRESSE_SITE}"), array($pParam['numero'], $lMdp, ZEYBUX_ADRESSE_SITE), $lContenu);
			
			$lHeaders = file_get_contents(CHEMIN_TEMPLATE . COMMUN_TEMPLATE . "/" . "EnteteMail.html");
			$lHeaders = str_replace("{FROM}", $lFrom, $lHeaders);
			/*
			$contenu = "";
			$contenu .= "<html> \n";
			$contenu .= "<head> \n";
			$contenu .= "<title> Réinitialisation de votre mot de passe zeybux </title> \n";
			$contenu .= "</head> \n";
			$contenu .= "<body> \n";
			$contenu .= "Bonjour,<br/> \n";
			$contenu .= "Votre nouveau mot de passe zeybux est : " . $lMdp . "<br/> \n";
			$contenu .= "Vous pourrez le modifier lors de votre prochaine connexion.<br/> \n";
			$contenu .= "Cordialement,<br/> \n";
			$contenu .= "L'équipe du zeybux.<br/> \n";
			$contenu .= "</body> \n";
			$contenu .= "</HTML> \n";
			
			$headers  = "MIME-Version: 1.0 \n";
			$headers .= "Content-Transfer-Encoding: 8bit \n";
			$headers .= "Content-type: text/html; charset=utf-8 \n";
			$headers .= "From: $from  \n";
			// $headers .= "Disposition-Notification-To: $from  \n"; // accuse de reception*/
			
			$VerifEnvoiMail = TRUE;			
			$VerifEnvoiMail = @mail ($lTo, $lSujet, $lContenu, $lHeaders);
		
			if ($VerifEnvoiMail === FALSE) {	
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_118_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_118_MSG);
				$lVr->getLog()->addErreur($lErreur);				
				$lLogger->log("Erreur d'envoi du mail de réinitialisation du mot de passe de l'adhérent " . $pParam['numero'] . ".",PEAR_LOG_INFO);	// Maj des logs
			} else {
				$lLogger->log("Envoi du mail de réinitialisation du mot de passe de l'adhérent " . $pParam['numero'] . ".",PEAR_LOG_INFO);	// Maj des logs
			}
		}
		return $lVr;
	}
}
?>