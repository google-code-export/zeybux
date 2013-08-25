<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 16/08/2013
// Fichier : FactureValid.php
//
// Description : Classe FactureValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/FactureVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/RechercheListeFactureVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/ListeProduitFermeVR.php" );
//include_once(CHEMIN_CLASSES_MANAGERS . "FactureManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "FactureService.php");
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ChampComplementaireValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "ProduitDetailFactureValid.php");

/**
 * @name FactureVR
 * @author Julien PIERRE
 * @since 16/08/2013
 * @desc Classe représentant une FactureValid
 */
class FactureValid
{
	/**
	* @name validAjout($pData)
	* @return FactureVR
	* @desc Test la validite de l'élément
	*/
	public static function validEnregistrer($pData) {
		$lVr = new FactureVR();
		//Tests Techniques
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getOperation()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperation()->addErreur($lErreur);	
		}
		if(!isset($pData['operationProducteur'])) {
			$lVr->setValid(false);
			$lVr->getOperationProducteur()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperationProducteur()->addErreur($lErreur);	
		}
		if(!isset($pData['operationZeybu'])) {
			$lVr->setValid(false);
			$lVr->getOperationZeybu()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperationZeybu()->addErreur($lErreur);	
		}
		if(!isset($pData['produits'])) {
			$lVr->setValid(false);
			$lVr->getProduits()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getProduits()->addErreur($lErreur);	
		}
		if(!isset($pData['operationProducteur']['idCompte'])) {
			$lVr->setValid(false);
			$lVr->getOperationProducteur()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperationProducteur()->addErreur($lErreur);
		}
		if(!isset($pData['operationProducteur']['montant'])) {
			$lVr->setValid(false);
			$lVr->getMontant()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMontant()->addErreur($lErreur);
		}
		if(!isset($pData['operationProducteur']['typePaiement'])) {
			$lVr->setValid(false);
			$lVr->getTypePaiement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getTypePaiement()->addErreur($lErreur);
		}		
		if(!isset($pData['operationProducteur']['champComplementaire'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			
			// Dans le cas d'une modification
			if($pData['id']['id'] != '' && !TestFonction::checkLength($pData['id']['id'],0, 11)) {
				$lVr->setValid(false);
				$lVr->getOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_CODE);
				$lVr->getOperation()->addErreur($lErreur);
			}
			if($pData['id']['id'] != '' && !is_int((int)$pData['id']['id'])) {
				$lVr->setValid(false);
				$lVr->getOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getOperation()->addErreur($lErreur);
			}
			
			// Pour création ou modification
			if(!TestFonction::checkLength($pData['operationProducteur']['idCompte'],0, 11)) {
				$lVr->setValid(false);
				$lVr->getOperationProducteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getOperationProducteur()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['operationProducteur']['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getOperationProducteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getOperationProducteur()->addErreur($lErreur);
			}
			if(!TestFonction::checkLength($pData['operationProducteur']['montant'],0,12)) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
			if(!is_float((float)$pData['operationProducteur']['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
			if(!TestFonction::checkLength($pData['operationProducteur']['typePaiement'],0,11)) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);
			}
			if(!is_int((int)$pData['operationProducteur']['typePaiement'])) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);
			}
			if(!is_array($pData['operationProducteur']['champComplementaire'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
			if(!is_array($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getProduits()->addErreur($lErreur);
			}
			
			//Tests Fonctionnels
			if(empty($pData['operationProducteur']['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getOperationProducteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getOperationProducteur()->addErreur($lErreur);
			}
			if(empty($pData['operationProducteur']['typePaiement']) && $pData['operationProducteur']['typePaiement'] != 0) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);
			}
			if($pData['operationProducteur']['typePaiement'] < 0) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_236_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_236_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);
			}
			if(empty($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getProduits()->addErreur($lErreur);
			}
			
			if(isset($pData['id']['champComplementaire'][1])) { // Si Marché
				$lVrChampComplementaire = ChampComplementaireValid::validUpdate($pData['id']['champComplementaire'][1], 0);
				if(!$lVrChampComplementaire->getValid()) {
					$lVr->setValid(false);
				}
				$lVr->setChampComplementaire(array(1 => $lVrChampComplementaire));
			}
			
			if($pData['id']['id'] != '') { // Modification
				// La facture doit exister
				$lOperationService = new OperationService();
				$lOperationId = $lOperationService->get($pData['id']['id']);
				if($lOperationId->getId() != $pData['id']['id']) {
					$lVr->setValid(false);
					$lVr->getOperation()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getOperation()->addErreur($lErreur);
				}
			}

			if(empty($pData['operationProducteur']['montant']) && $pData['operationProducteur']['montant'] != 0) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
			if($pData['operationProducteur']['montant'] < 0) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
			// Il est autorisé d'enregistrer un facture (réception de produit) sans payer.
			if(($pData['operationProducteur']['montant'] == 0 && $pData['operationProducteur']['typePaiement'] != 0)
					|| ($pData['operationProducteur']['montant'] != 0 && $pData['operationProducteur']['typePaiement'] == 0) ) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getMontant()->addErreur($lErreur);
				$lVr->getTypePaiement()->addErreur($lErreur);
			}
			
			$lFerme = FermeManager::selectByIdCompte($pData['operationProducteur']['idCompte']);
			if($lFerme[0]->getIdCompte() != $pData['operationProducteur']['idCompte']) {
				$lVr->setValid(false);
				$lVr->getOperationProducteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getOperationProducteur()->addErreur($lErreur);
			}
			
			$lTypePaiementService = new TypePaiementService();
			$lTypePaiement = $lTypePaiementService->selectDetail($pData['operationProducteur']['typePaiement']);
			// Il est autorisé d'enregistrer un facture (réception de produit) sans payer.
			if($lTypePaiement->getId() != $pData['operationProducteur']['typePaiement'] && $pData['operationProducteur']['typePaiement'] != 0) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);
			} else {
			
				$lChampComplementaire = array();
				foreach($pData['operationProducteur']['champComplementaire'] as $lChamp) {
					if(!is_null($lChamp)) {
						$lObligatoire = NULL;
						foreach($lTypePaiement->getChampComplementaire() as $lChampTypePaiement) {
							if($lChampTypePaiement->getId() == $lChamp['id']) {
								$lObligatoire = $lChampTypePaiement->getObligatoire();
							};
						}
						$lVrChampComplementaire = ChampComplementaireValid::validUpdate($lChamp, $lObligatoire);
						if(!$lVrChampComplementaire->getValid()) {
							$lVr->setValid(false);
						}
						$lChampComplementaire[$lChamp['id']] = $lVrChampComplementaire;
					}
				}
				$lVr->setChampComplementaire($lChampComplementaire);
			}
			
			if(is_array($pData['produits'])) {
				$lValidProduit = new ProduitDetailFactureValid();
				//$i = 0;
				//while(isset($pData['produits'][$i])) {
				foreach($pData['produits'] as $lIndice => $lProduit) {		
					if(!is_null($pData['produits'][$lIndice])) {				
						$lVrProduit = $lValidProduit->validAjout($pData['produits'][$lIndice], $lFerme[0]->getId());
						if(!$lVrProduit->getValid()){$lVr->setValid(false);}
						$lVr->addProduits($lVrProduit);
					}
				//	$i++;
				}
			}
		}
		return $lVr;
	}
	
	/**
	 * @name validDelete($pData)
	 * @return FactureVR
	 * @desc Test la validite de l'élément
	 */
	public static function validDelete($pData) {
		$lVr = new FactureVR();
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
				
			// La ferme doit exister
			$lFactureService = new FactureService();
			$lFacture = $lFactureService->get($pData['id']);
			if($lFacture->getId()->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			if($lVr->getValid()) {
				$lVr->setData(array("facture" => $lFacture));
			}
		}
		return $lVr;
	}
	
	/**
	 * @name validRechercheListeFacture($pData)
	 * @return FactureVR
	 * @desc Test la validite de l'élément
	 */
	public static function validRechercheListeFacture($pData) {
		$lVr = new RechercheListeFactureVR();
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
	 * @name validListeProduitFerme($pData)
	 * @return ListeProduitFermeVR
	 * @desc Test la validite de l'élément
	 */
	public static function validListeProduitFerme($pData) {
		$lVr = new ListeProduitFermeVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);
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
			if(!TestFonction::checkLength($pData['idMarche'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			if($pData['idMarche'] != '' && !is_int((int)$pData['idMarche'])) {
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
				
			// La ferme doit exister
			$lFerme = FermeManager::select($pData['id']);
			if($lFerme->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			
			// Si il y a un marche il doit exister
			if($pData['idMarche'] != '') {
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
			
			if($lVr->getValid()) {
				$lVr->setData(array('ferme' => $lFerme));
			}
		}
		return $lVr;
	}
}
?>