<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2013
// Fichier : AchatValid.php
//
// Description : Classe AchatValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/RechercheListeAchatVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/AchatVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/InfoAchatMarcheVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_CAISSE . "/OperationDetailValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_CAISSE . "/ProduitDetailAchatValid.php" );

/**
 * @name AchatVR
 * @author Julien PIERRE
 * @since 08/09/2013
 * @desc Classe représentant une AchatValid
 */
class AchatValid
{
	/**
	 * @name RechercheListeAchatVR($pData)
	 * @return AchatVR
	 * @desc Test la validite de l'élément
	 */
	public static function validRechercheListeAchat($pData) {
		$lVr = new RechercheListeAchatVR();
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
	
	/**
	 * @name validDelete($pData)
	 * @return AchatVR
	 * @desc Test la validite de l'élément
	 */
	public static function validDelete($pData) {
		$lVr = new AchatVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['id'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
				
			//Tests Fonctionnels
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
				
			// L'operation d'achat doit exister
			$lOperationService = new OperationService();
			$lOperationAchat = $lOperationService->get($pData['id']);
			if($lOperationAchat->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
	
	/**
	 * @name validInfoAchatMarche($pData)
	 * @return AchatVR
	 * @desc Test la validite de l'élément
	 */
	public static function validInfoAchatMarche($pData) {
		$lVr = new InfoAchatMarcheVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);
		}
		if(!isset($pData['id_adherent'])) {
			$lVr->setValid(false);
			$lVr->getIdAdherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdAdherent()->addErreur($lErreur);
		}
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getIdMarche()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdMarche()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['id'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			if(!TestFonction::checkLength($pData['id_adherent'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);
			}
			if(!is_int((int)$pData['id_adherent'])) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);
			}
			if(!TestFonction::checkLength($pData['id_commande'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);
			}
			if(!is_int((int)$pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);
			}
	
			//Tests Fonctionnels
		/*	if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}*/
			if(!empty($pData['id'])) {
				// L'operation d'achat doit exister
				$lOperationService = new OperationService();
				$lOperationAchat = $lOperationService->get($pData['id']);
				if($lOperationAchat->getId() != $pData['id']) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getId()->addErreur($lErreur);
				}
			} else { // Si pas d'achat il faut le marché à minima
				if(empty($pData['id_commande'])) {
					$lVr->setValid(false);
					$lVr->getIdMarche()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdMarche()->addErreur($lErreur);					
				}
			}
			
			// Si c'est un adhérent
			if(!empty($pData['id_adherent']) && $pData['id_adherent'] != -3) {
				$lAdherentService = new AdherentService();
				$lAdherent = $lAdherentService->get($pData['id_adherent']);
				if($lAdherent->getAdhId() != $pData['id_adherent']) {
					$lVr->setValid(false);
					$lVr->getIdAdherent()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdAdherent()->addErreur($lErreur);
				}

				if($lVr->getValid()) {
					$lVr->setData(array('adherent' => $lAdherent));
				}
			}
		}
		return $lVr;
	}
	
	/**
	 * @name validEnregistrer($pData)
	 * @return AchatVR
	 * @desc Test la validite de l'élément
	 */
	public static function validEnregistrer($pData) {
		$lVr = new AchatVR();
		//Tests inputs
		if(!isset($pData['operationAchat'])) {
			$lVr->setValid(false);
			$lVr->getOperationAchat()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperationAchat()->addErreur($lErreur);
		}
		if(!isset($pData['operationAchatSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getOperationAchatSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperationAchatSolidaire()->addErreur($lErreur);
		}
		if(!isset($pData['produits'])) {
			$lVr->setValid(false);
			$lVr->getProduits()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getProduits()->addErreur($lErreur);
		}
		if(!isset($pData['rechargement'])) {
			$lVr->setValid(false);
			$lVr->getRechargement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getRechargement()->addErreur($lErreur);
		}
	
		if($lVr->getValid()) {
			//Tests Techniques
			$lIdCompte = 0;
		if(!is_null($pData['operationAchat']) && !empty($pData['operationAchat'])) {
				
				if($pData['operationAchat']['montant'] == 0) {
					$lVr->setOperationAchat(OperationDetailValid::validDelete($pData['operationAchat']));
				} else {
					$lVr->setOperationAchat(OperationDetailValid::validAjout($pData['operationAchat'], array("negatif" => true)));
				
					if(!$lVr->getOperationAchat()->getValid()) {
						$lVr->setValid(false);
					} else if(isset($pData['operationAchat']['champComplementaire'][1]['valeur'])) {
						$lIdCompte = $pData['operationAchat']['idCompte'];
						// Le marche doit être ouvert
						$lOpeAchatChampComp = $lVr->getOperationAchat()->getChampComplementaire();
						$lInfoMarche = $lOpeAchatChampComp[1]->getData();
						if($lInfoMarche['marche']->getArchive() != 0) {
							$lVr->setValid(false);
							$lVr->getLog()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_239_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_239_MSG);
							$lVr->getLog()->addErreur($lErreur);
						}
					}
				}
				
			}
			if(!is_null($pData['operationAchatSolidaire']) && !empty($pData['operationAchatSolidaire'])) {
				if($pData['operationAchatSolidaire']['montant'] == 0) {
					$lVr->setOperationAchat(OperationDetailValid::validDelete($pData['operationAchatSolidaire']));
				} else {
					$lVr->setOperationAchatSolidaire(OperationDetailValid::validAjout($pData['operationAchatSolidaire'], array("negatif" => true)));
				
					if(!$lVr->getOperationAchatSolidaire()->getValid()) {
						$lVr->setValid(false);
					} else if(isset($pData['operationAchatSolidaire']['champComplementaire'][1]['valeur'])) { 
						$lIdCompte = $pData['operationAchatSolidaire']['idCompte'];
						// Le marche doit être ouvert
						$lOpeAchatChampComp = $lVr->getOperationAchatSolidaire()->getChampComplementaire();
						$lInfoMarche = $lOpeAchatChampComp[1]->getData();
						if($lInfoMarche['marche']->getArchive() != 0) {
							$lVr->setValid(false);
							$lVr->getLog()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_239_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_239_MSG);
							$lVr->getLog()->addErreur($lErreur);
						}
					}
				}
			}
	
			$lTotal = 0;
			$lTotalSolidaire = 0;
			if(!is_array($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getLog()->addErreur($lErreur);
			} else {
				foreach($pData['produits'] as $lIndice => $lProduit) {
					if(!is_null($pData['produits'][$lIndice])) {
						$lVrDetail = ProduitDetailAchatValid::validAjout($lProduit);
						if(!$lVrDetail->getValid()){
							$lVr->setValid(false);
						} else {
							if(is_float((float)$lProduit['montant']) && !empty($lProduit['montant'])) {
								$lTotal += $lProduit['montant'];
							}
							if(is_float((float)$lProduit['montantSolidaire']) && !empty($lProduit['montantSolidaire'])) {
								$lTotalSolidaire += $lProduit['montantSolidaire'];
							}
						}
						$lVr->addProduits($lVrDetail);
					}
				}
			}
							
			// L'opération doit exister si il y a un total (Normal ou Solidaire)
			if(	//($lTotal == 0 && (!is_null($pData['operationAchat']) && !empty($pData['operationAchat']))) 
					//||
			 ($lTotal != 0 && (is_null($pData['operationAchat']) || empty($pData['operationAchat']) || bccomp($lTotal, (float)$pData['operationAchat']["montant"]) != 0))
			//		|| ($lTotalSolidaire == 0 && (!is_null($pData['operationAchatSolidaire']) && !empty($pData['operationAchatSolidaire'])     ))
					|| ($lTotalSolidaire != 0 && (is_null($pData['operationAchatSolidaire']) || empty($pData['operationAchatSolidaire']) || bccomp($lTotalSolidaire, (float)$pData['operationAchatSolidaire']["montant"]) != 0))
			) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_266_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_266_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
	
			$lRechargement = 0;
			if(!empty($pData['rechargement']['montant']) && $pData['rechargement']['montant'] != 0) {
				$lVr->setRechargement(OperationDetailValid::validAjout($pData['rechargement']));
				if(!$lVr->getRechargement()->getValid()) {
					$lVr->setValid(false);
				} else {
					$lRechargement = $pData['rechargement']['montant'];
				}
			} else if($lIdCompte != -3 && ($lTotal + $lTotalSolidaire) == 0) { // Si compte adherent et pas de rechargement il faut un produit
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
				
			if($lIdCompte == -3 ) {
				if(($lTotal + $lTotalSolidaire) == 0) { // Si compte invité il faut un produit
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
					$lVr->getLog()->addErreur($lErreur);
				}
				if((bcadd(bcadd($lTotal, $lTotalSolidaire, 2), $lRechargement, 2)) != 0 ) { // Compte invite reste à 0
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_244_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_244_MSG);
					$lVr->getLog()->addErreur($lErreur);
				}
			}
		}
		return $lVr;
	}
}
?>