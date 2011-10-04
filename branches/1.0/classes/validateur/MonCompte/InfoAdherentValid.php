<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : InfoAdherentValid.php
//
// Description : Classe InfoAdherentValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_MON_COMPTE . "/InfoAdherentVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_MON_COMPTE . "/AdherentVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");

/**
 * @name InfoAdherentVR
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe représentant une InfoAdherentValid
 */
class InfoAdherentValid
{
	/**
	* @name validAjout($pData)
	* @return InfoAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new InfoAdherentVR();
		//Tests Techniques
		if(!is_int((int)$pData['id_adherent'])) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['id_adherent'],0,11)) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['motPasse'],0,100)) {
			$lVr->setValid(false);
			$lVr->getMotPasse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getMotPasse()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['motPasseNouveau'],0,100)) {
			$lVr->setValid(false);
			$lVr->getMotPasseNouveau()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getMotPasseNouveau()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['motPasseConfirm'],0,100)) {
			$lVr->setValid(false);
			$lVr->getMotPasseConfirm()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getMotPasseConfirm()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['id_adherent'])) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);	
		}
		if(empty($pData['motPasse'])) {
			$lVr->setValid(false);
			$lVr->getMotPasse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPasse()->addErreur($lErreur);	
		}
		if(empty($pData['motPasseNouveau'])) {
			$lVr->setValid(false);
			$lVr->getMotPasseNouveau()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPasseNouveau()->addErreur($lErreur);	
		}
		if(empty($pData['motPasseConfirm'])) {
			$lVr->setValid(false);
			$lVr->getMotPasseConfirm()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMotPasseConfirm()->addErreur($lErreur);	
		}
		
		// L'adhérent existe	
		$lAdherent = AdherentManager::select($pData['id_adherent']);
		if($lAdherent->getId() != $pData['id_adherent']) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);
		
		}
		
		$lIdentification = IdentificationManager::selectByIdType($pData['id_adherent'],1);
		$lIdentification = $lIdentification[0];
		// L'adhérent existe	
		if($lIdentification->getIdLogin() != $pData['id_adherent']) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);
		
		}
		
		// L'ancien mot de passe n'est pas conforme
		if($lIdentification->getPass() != md5( $pData['motPasse'] )) {
			$lVr->setValid(false);
			$lVr->getMotPasse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_235_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_235_MSG);
			$lVr->getMotPasse()->addErreur($lErreur);		
		}
		
		// Les mots de passe ne sont pas identique
		if($pData['motPasseNouveau'] !== $pData['motPasseConfirm']) {
			$lVr->setValid(false);
			$lVr->getMotPasseNouveau()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_223_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_223_MSG);
			$lVr->getMotPasseNouveau()->addErreur($lErreur);
		}		
		
		return $lVr;
	}
	
	/**
	* @name validAjout($pData)
	* @return AdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdateInformation($pData) {
		$lVr = new AdherentVR();
		//Tests Techniques
		if(!TestFonction::checkLength($pData['nom'],0,50)) {
			$lVr->setValid(false);
			$lVr->getNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getNom()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['prenom'],0,50)) {
			$lVr->setValid(false);
			$lVr->getPrenom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getPrenom()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['courrielPrincipal'],0,100)) {
			$lVr->setValid(false);
			$lVr->getCourrielPrincipal()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getCourrielPrincipal()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['courrielSecondaire'],0,100)) {
			$lVr->setValid(false);
			$lVr->getCourrielSecondaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getCourrielSecondaire()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['telephonePrincipal'],0,20)) {
			$lVr->setValid(false);
			$lVr->getTelephonePrincipal()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getTelephonePrincipal()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['telephoneSecondaire'],0,20)) {
			$lVr->setValid(false);
			$lVr->getTelephoneSecondaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getTelephoneSecondaire()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['adresse'],0,300)) {
			$lVr->setValid(false);
			$lVr->getAdresse()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getAdresse()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['codePostal'],0,10)) {
			$lVr->setValid(false);
			$lVr->getCodePostal()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getCodePostal()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['ville'],0,100)) {
			$lVr->setValid(false);
			$lVr->getVille()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getVille()->addErreur($lErreur);	
		}
		if($pData['dateNaissance']	!= '' && !TestFonction::checkDate($pData['dateNaissance'],'db')) {
			$lVr->setValid(false);
			$lVr->getDateNaissance()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
			$lVr->getDateNaissance()->addErreur($lErreur);	
		}
		if($pData['dateNaissance']	!= '' && !TestFonction::checkDateExist($pData['dateNaissance'],'db')) {
			$lVr->setValid(false);
			$lVr->getDateNaissance()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_105_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);
			$lVr->getDateNaissance()->addErreur($lErreur);	
		}
		if(!TestFonction::checkLength($pData['commentaire'],0,500)) {
			$lVr->setValid(false);
			$lVr->getCommentaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
			$lVr->getCommentaire()->addErreur($lErreur);	
		}

		//Tests Fonctionnels
		if(empty($pData['nom'])) {
			$lVr->setValid(false);
			$lVr->getNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getNom()->addErreur($lErreur);	
		}
		if(empty($pData['prenom'])) {
			$lVr->setValid(false);
			$lVr->getPrenom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPrenom()->addErreur($lErreur);	
		}
		if(empty($pData['dateAdhesion'])) {
			$lVr->setValid(false);
			$lVr->getDateAdhesion()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getDateAdhesion()->addErreur($lErreur);	
		}
	
		$lAdherent = AdherentManager::select( $pData['id_adherent'] );
		if($lAdherent->getId() != $pData['id_adherent']) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);
		}

		// Les mails sont au bon format
		if($pData['courrielPrincipal']	!= '' && !TestFonction::checkCourriel($pData['courrielPrincipal'])) {
			$lVr->setValid(false);
			$lVr->getCourrielPrincipal()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_224_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_224_MSG);
			$lVr->getCourrielPrincipal()->addErreur($lErreur);
		}
		if($pData['courrielSecondaire']	!= '' && !TestFonction::checkCourriel($pData['courrielSecondaire'])) {
			$lVr->setValid(false);
			$lVr->getCourrielSecondaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_224_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_224_MSG);
			$lVr->getCourrielSecondaire()->addErreur($lErreur);
		}
		
		// Date Naissance <= Date Adhésion <= Date Actuelle		
		if($pData['dateNaissance'] != '' && !TestFonction::dateEstPLusGrandeEgale($lAdherent->getDateAdhesion(),$pData['dateNaissance'],'db')) {
			$lVr->setValid(false);
			$lVr->getDateNaissance()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_225_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_225_MSG);
			$lVr->getDateNaissance()->addErreur($lErreur);
		}
		if($pData['dateNaissance'] != '' && !TestFonction::dateEstPLusGrandeEgale(StringUtils::dateAujourdhuiDb(),$pData['dateNaissance'],'db')) {
			$lVr->setValid(false);
			$lVr->getDateNaissance()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_230_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_230_MSG);
			$lVr->getDateNaissance()->addErreur($lErreur);
		}		
		return $lVr;
	}
}