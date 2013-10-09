<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/10/2013
// Fichier : CompteZeybuValid.php
//
// Description : Classe CompteZeybuValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ZEYBU . "/RechercheListeVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name CompteZeybuValid
 * @author Julien PIERRE
 * @since 08/10/2013
 * @desc Classe représentant une CompteZeybuValid
 */
class CompteZeybuValid
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
		if(!isset($pData['idMarche'])) {
			$lVr->setValid(false);
			$lVr->getIdMarche()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdMarche()->addErreur($lErreur);
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
			if($pData['idMarche'] != '' && !TestFonction::checkLength($pData['idMarche'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);
			}
			if($pData['idMarche'] != '' && !is_int((int)$pData['idMarche'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);
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

			if($pData['idMarche'] != '' && $pData['idMarche'] != -1 && $pData['idMarche'] != 0) {				
				$lCommande = CommandeManager::select($pData['idMarche']);
				if($lCommande->getId() != $pData['idMarche']) {
					$lVr->setValid(false);
					$lVr->getIdMarche()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getIdMarche()->addErreur($lErreur);
				}
			}
			
		}
		return $lVr;
	}
}
?>