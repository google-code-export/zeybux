<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/02/2014
// Fichier : CompteAssociationValid.php
//
// Description : Classe CompteAssociationValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ASSOCIATION . "/RechercheListeVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ASSOCIATION . "/CompteAssociationAjoutVirementVR.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMPTE_ASSOCIATION . "/OperationDetailValid.php");

/**
 * @name CompteAssociationValid
 * @author Julien PIERRE
 * @since 09/02/2014
 * @desc Classe représentant une CompteAssociationValid
 */
class CompteAssociationValid
{
	/**
	 * @name validRecherche($pData)
	 * @return RechercheListeVR
	 * @desc Test la validite de l'élément
	 */
	public static function validRecherche($pData) {
		$lVr = new RechercheListeVR();
		//Tests inputs
		if(!isset($pData['dateDebut'])) {
			$lVr->setValid(false);
			$lVr->getDateDebut()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getDateDebut()->addErreur($lErreur);
		}
		if(!isset($pData['dateFin'])) {
			$lVr->setValid(false);
			$lVr->getDateFin()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getDateFin()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Techniques	
			if($pData['dateDebut'] != '' && !TestFonction::checkDate($pData['dateDebut'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateDebut()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
				$lVr->getDateDebut()->addErreur($lErreur);
			}
			if($pData['dateDebut'] != '' && !TestFonction::checkDateExist($pData['dateDebut'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateDebut()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_105_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);
				$lVr->getDateDebut()->addErreur($lErreur);
			}
			if($pData['dateFin'] != '' && !TestFonction::checkDate($pData['dateFin'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateFin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
				$lVr->getDateFin()->addErreur($lErreur);
			}
			if($pData['dateFin'] != '' && !TestFonction::checkDateExist($pData['dateFin'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateFin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_105_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);
				$lVr->getDateFin()->addErreur($lErreur);
			}
			
			//Tests Fonctionnels
			// Date début avant celle de fin
			if($pData['dateDebut'] != '' && $pData['dateFin'] != '' && !TestFonction::dateEstPLusGrandeEgale($pData['dateFin'],$pData['dateDebut'],"db")) {
				$lVr->setValid(false);
				$lVr->getDateDebut()->setValid(false);
				$lVr->getDateFin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_202_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_202_MSG);
				$lVr->getDateDebut()->addErreur($lErreur);
				$lVr->getDateFin()->addErreur($lErreur);
			}
			
			// Si date de début alors date de fin
			if($pData['dateDebut'] != '' && $pData['dateFin'] == '') {
				$lVr->setValid(false);
				$lVr->getDateFin()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDateFin()->addErreur($lErreur);
			}
			
			// Si date de fin alors date de début
			if($pData['dateDebut'] == '' && $pData['dateFin'] != '') {
				$lVr->setValid(false);
				$lVr->getDateDebut()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDateDebut()->addErreur($lErreur);
			}			
		}
		return $lVr;
	}
	
	/**
	 * @name validAjoutOperation($pData)
	 * @return OperationDetailVR
	 * @desc Test la validite de l'élément
	 */
	public static function validAjoutOperation($pData) {
		return OperationDetailValid::validAjout($pData,array("reel" => true, "negatif" => true));
	}
	
	/**
	 * @name validAjoutVirement($pData)
	 * @return CompteAssociationAjoutVirementVR
	 * @desc Test la validite de l'élément
	 */
	public static function validAjoutVirement($pData) {
		$lVr = new CompteAssociationAjoutVirementVR();
		//Tests inputs
		if(!isset($pData['montant'])) {
			$lVr->setValid(false);
			$lVr->getMontant()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMontant()->addErreur($lErreur);
		}
	
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['montant'],0,12) || $pData['montant'] > 999999999.99) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
			if(!is_float((float)$pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
	
			//Tests Fonctionnels
			if(empty($pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
				
			// Montant positif
			if($pData['montant'] <= 0) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}				
		}
		return $lVr;
	}
}
?>