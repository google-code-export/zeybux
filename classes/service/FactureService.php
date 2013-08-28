<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/08/2013
// Fichier : FactureService.php
//
// Description : Classe FactureService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_SERVICE . "/FactureValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "DetailOperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteurManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailFactureManager.php");

/**
 * @name FactureService
 * @author Julien PIERRE
 * @since 04/08/2013
 * @desc Classe Service de Facture
 */
class FactureService
{	
	/**
	* @name set($pFacture)
	* @param FactureVO
	* @return integer
	* @desc Ajoute ou modifie une Facture
	*/
	public function set($pFacture) {
		$lFactureValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\FactureValid();
		if($lFactureValid->input($pFacture)) {
			if($lFactureValid->insert($pFacture)) {
				return $this->insert($pFacture);			
			} else if($lFactureValid->update($pFacture)) {
				return $this->update($pFacture);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name insert($pFacture)
	* @param FactureVO
	* @return integer
	* @desc Ajoute une FactureVO
	*/
	private function insert($pFacture) {
		// Le numéro de facture
		$lNumeroFacture = $this->numFactureSuivante();
		
		$lIdCompteFerme = $pFacture->getOperationProducteur()->getIdCompte();
		$lOperationService = new OperationService();

		if($pFacture->getOperationProducteur()->getMontant() == 0) {
			$pFacture->getOperationProducteur()->setTypePaiement(21);
		}
		
		// Si liaison avec un marche
		$lChampComplementaire = $pFacture->getId()->getChampComplementaire();
		if(isset($lChampComplementaire[1])) {
			$lChampComplementaireProducteur = $pFacture->getOperationProducteur()->getChampComplementaire();
			$lChampComplementaireProducteur[1] = $lChampComplementaire[1];
			$pFacture->getOperationProducteur()->setChampComplementaire($lChampComplementaireProducteur);
		}
		
		// Ajout opération de crédit sur le compte du producteur
		$pFacture->getOperationProducteur()->setLibelle('Livraison Facture n°' . $lNumeroFacture);
		$lIdOperationPrdt = $lOperationService->set($pFacture->getOperationProducteur());

		// Ajout Opération de débit sur le compte du zeybu		
		$pFacture->setOperationZeybu( $pFacture->getOperationProducteur());		
		$pFacture->getOperationZeybu()->setId('');
		$lMontant = $pFacture->getOperationZeybu()->getMontant();
		$pFacture->getOperationZeybu()->setMontant(-1 * $lMontant);
		$pFacture->getOperationZeybu()->setIdCompte(-1);
		//$pFacture->getOperationZeybu()->setMontant($pFacture->getOperationProducteur()->getMontant());
		$lIdOperationZeybu = $lOperationService->set($pFacture->getOperationZeybu());
			
		// L'operation de Facture
		$pFacture->getId()->setIdCompte($lIdCompteFerme);
		$pFacture->getId()->setMontant($lMontant);
		$pFacture->getId()->setLibelle('Facture n°' . $lNumeroFacture);
		$pFacture->getId()->setTypePaiement(6);		
		$lChampComplementaire[9] = new OperationChampComplementaireVO(null, 9, $lIdOperationPrdt);
		$lChampComplementaire[10] = new OperationChampComplementaireVO(null, 10, $lIdOperationZeybu);
		$lChampComplementaire[11] = new OperationChampComplementaireVO(null, 11, $lNumeroFacture);
		$pFacture->getId()->setChampComplementaire($lChampComplementaire);
		$lIdOperation = $lOperationService->set($pFacture->getId());
		
		// Ajout des produits
		$lDetailOperationService = new DetailOperationService();
		$lStockService = new StockService();
		foreach($pFacture->getProduits() as $lProduit) {			
			// Stock
			$lIdStock = 0;
			$lIdDetailOperation = 0;
			if($lProduit->getQuantite() > 0) {
				$lIdStock = $lStockService->set( new StockVO(
						null, 
						null, 
						$lProduit->getQuantite(),
						4, 
						$lIdCompteFerme, 
						null, 
						null, 
						$lIdOperation,
						$lProduit->getIdNomProduit(),
						$lProduit->getUnite()) );
							
				// Prix
				$lIdDetailOperation = $lDetailOperationService->set(new DetailOperationVO(
						null, 
						$lIdOperation, 
						$lIdCompteFerme, 
						$lProduit->getMontant(), 
						'Facture', 
						null, 
						6, 
						null, 
						null, 
						$lProduit->getIdNomProduit(), 
						null) );
			}
			

			// Stock Solidaire
			$lIdStockSolidaire = 0;
			if($lProduit->getQuantiteSolidaire() > 0) {
				$lIdStockSolidaire = $lStockService->set( new StockVO(
					null,
					null,
					$lProduit->getQuantiteSolidaire(),
					2,
					$lIdCompteFerme,
					null,
					null,
					$lIdOperation,
					$lProduit->getIdNomProduit(),
					$lProduit->getUnite()));
			}
			

			if($lProduit->getQuantiteSolidaire() > 0 || $lProduit->getQuantite() > 0) { // Pas d'ajout de ligne vide
				DetailFactureManager::insert(new DetailFactureVO($lIdOperation, $lProduit->getIdNomProduit(), $lIdStock, $lIdDetailOperation, $lIdStockSolidaire));
			}
		}
		
		return $lIdOperation;
	}
	
	/**
	 * @name update($pFacture)
	 * @param FactureVO
	 * @return integer
	 * @desc Met à jour une FactureVO
	 */
	private function update($pFacture) {
		// Récupération de la facture actuelle
		$lIdOperation = $pFacture->getId()->getId();
		$lFactureInitiale = $this->select($lIdOperation);
		$lIdCompteFerme = $lFactureInitiale->getOperationProducteur()->getIdCompte();
		
		$lOperationService = new OperationService();
		
		// Montant pour l'id
		/*$lFactureInitiale->getId()->setMontant($pFacture->getOperationProducteur()->getMontant());
		$lOperationService->set($lFactureInitiale->getId());*/
		
		// Gestion si pas de paiement
		if($pFacture->getOperationProducteur()->getMontant() == 0) {
			$pFacture->getOperationProducteur()->setTypePaiement(21);
			//$pFacture->getOperationZeybu()->setTypePaiement(21);
		}
		// Montant / Typepaiement / Champ Complementaire pour le producteur		
		$lFactureInitiale->getOperationProducteur()->setMontant($pFacture->getOperationProducteur()->getMontant());
		$lFactureInitiale->getOperationProducteur()->setTypePaiement($pFacture->getOperationProducteur()->getTypePaiement());
		$lFactureInitiale->getOperationProducteur()->setChampComplementaire($pFacture->getOperationProducteur()->getChampComplementaire());
		$lOperationService->set($lFactureInitiale->getOperationProducteur());
		
		// Montant / Typepaiement / Champ Complementaire pour le zeybu
		/*$lFactureInitiale->getOperationZeybu()->setMontant(-1 * $pFacture->getOperationProducteur()->getMontant());
		$lFactureInitiale->getOperationZeybu()->setTypePaiement($pFacture->getOperationProducteur()->getTypePaiement());
		$lFactureInitiale->getOperationZeybu()->setChampComplementaire($pFacture->getOperationProducteur()->getChampComplementaire());
		$lOperationService->set($lFactureInitiale->getOperationZeybu());*/
		
		// Suppression de l'ensemble des lignes de facture qui seront à nouveau insérée
		DetailFactureManager::delete($lIdOperation);
		
		$lDetailOperationService = new DetailOperationService();
		$lStockService = new StockService();
		foreach($lFactureInitiale->getProduits() as $lProduitInital ) {
			$lMaj = false;
			foreach($pFacture->getProduits() as $lProduitMaj) {				
				if($lProduitInital->getIdStock() == $lProduitMaj->getIdStock()
						&& $lProduitInital->getIdDetailOperation() == $lProduitMaj->getIdDetailOperation()
						&& $lProduitInital->getIdStockSolidaire() == $lProduitMaj->getIdStockSolidaire()	) { // Modification
					$lMaj = true;
					
					// Stock
					$lIdStock = 0;
					$lIdDetailOperation = 0;
					
					if($lProduitInital->getIdStock() == 0 && $lProduitMaj->getQuantite() > 0) { // Ajout
						$lIdStock = $lStockService->set( new StockVO(
								null,
								null,
								$lProduitMaj->getQuantite(),
								4,
								$lIdCompteFerme,
								null,
								null,
								$lIdOperation,
								$lProduitMaj->getIdNomProduit(),
								$lProduitMaj->getUnite()) );
						
						// Prix
						$lIdDetailOperation = $lDetailOperationService->set(new DetailOperationVO(
								null,
								$lIdOperation,
								$lIdCompteFerme,
								$lProduitMaj->getMontant(),
								'Facture',
								null,
								6,
								null,
								null,
								$lProduitMaj->getIdNomProduit(),
								null) );
					} else if($lProduitInital->getIdStock() != 0 && $lProduitMaj->getQuantite() > 0) { // Modification
						$lStockInitial = $lStockService->get($lProduitInital->getIdStock());
						$lIdStock = $lStockInitial->getId();
						$lStockInitial->setQuantite($lProduitMaj->getQuantite());						
						$lStockService->set( $lStockInitial );
							
						// Prix
						$lDetailOperationInitial = $lDetailOperationService->get($lProduitInital->getIdDetailOperation());
						$lIdDetailOperation = $lDetailOperationInitial->getId();
						$lDetailOperationInitial->setMontant($lProduitMaj->getMontant());
						$lDetailOperationService->set($lDetailOperationInitial);
					} else { // Suppression
						$lStockService->delete( $lProduitInital->getIdStock() );
						$lDetailOperationService->delete($lProduitInital->getIdDetailOperation());
					}

					// Stock Solidaire
					$lIdStockSolidaire = 0;
					if($lProduitInital->getIdStockSolidaire() == 0 && $lProduitMaj->getQuantiteSolidaire() > 0) { // Ajout
						$lIdStockSolidaire = $lStockService->set( new StockVO(
								null,
								null,
								$lProduitMaj->getQuantiteSolidaire(),
								2,
								$lIdCompteFerme,
								null,
								null,
								$lIdOperation,
								$lProduitMaj->getIdNomProduit(),
								$lProduitMaj->getUnite()));
					} else if($lProduitInital->getIdStockSolidaire() != 0 && $lProduitMaj->getQuantiteSolidaire() > 0) {// Modification
						$lStockSolidaireInitial = $lStockService->get($lProduitInital->getIdStockSolidaire());
						$lIdStockSolidaire = $lStockSolidaireInitial->getId();
						$lStockSolidaireInitial->setQuantite($lProduitMaj->getQuantiteSolidaire());
						$lStockService->set( $lStockSolidaireInitial );
					} else { // Suppression
						$lStockService->delete( $lProduitInital->getIdStockSolidaire() );
					}
					
					if($lProduitMaj->getQuantiteSolidaire() > 0 || $lProduitMaj->getQuantite() > 0) { // Pas d'ajout de ligne vide
						DetailFactureManager::insert(new DetailFactureVO($lIdOperation, $lProduitInital->getIdNomProduit(), $lIdStock, $lIdDetailOperation, $lIdStockSolidaire));
					}
				}
			}
			if(!$lMaj) { // Suppression
				$lStockService->delete( $lProduitInital->getIdStock() );
				$lDetailOperationService->delete($lProduitInital->getIdDetailOperation());
				$lStockService->delete( $lProduitInital->getIdStockSolidaire() );				
			}
		}
		
		foreach($pFacture->getProduits() as $lProduitMaj) {
			$lMaj = false;
			foreach($lFactureInitiale->getProduits() as $lProduitInital ) {
				if($lProduitInital->getIdStock() == $lProduitMaj->getIdStock()
						&& $lProduitInital->getIdDetailOperation() == $lProduitMaj->getIdDetailOperation()
						&& $lProduitInital->getIdStockSolidaire() == $lProduitMaj->getIdStockSolidaire()) { // Modification
					$lMaj = true;
				}
			}
			if(!$lMaj) { // Ajout		
				// Stock
				$lIdStock = 0;
				$lIdDetailOperation = 0;
				if($lProduitMaj->getQuantite() > 0) {
					$lIdStock = $lStockService->set( new StockVO(
							null, 
							null, 
							$lProduitMaj->getQuantite(),
							4, 
							$lIdCompteFerme, 
							null, 
							null, 
							$lIdOperation,
							$lProduitMaj->getIdNomProduit(),
							$lProduitMaj->getUnite()) );
								
					// Prix
					$lIdDetailOperation = $lDetailOperationService->set(new DetailOperationVO(
							null, 
							$lIdOperation, 
							$lIdCompteFerme, 
							$lProduitMaj->getMontant(), 
							'Facture', 
							null, 
							6, 
							null, 
							null, 
							$lProduitMaj->getIdNomProduit(), 
							null) );
				}
				
	
				// Stock Solidaire
				$lIdStockSolidaire = 0;
				if($lProduitMaj->getQuantiteSolidaire() > 0) {
					$lIdStockSolidaire = $lStockService->set( new StockVO(
						null,
						null,
						$lProduitMaj->getQuantiteSolidaire(),
						2,
						$lIdCompteFerme,
						null,
						null,
						$lIdOperation,
						$lProduitMaj->getIdNomProduit(),
						$lProduitMaj->getUnite()));
				}
				if($lProduitMaj->getQuantiteSolidaire() > 0 || $lProduitMaj->getQuantite() > 0) { // Pas d'ajout de ligne vide
					DetailFactureManager::insert(new DetailFactureVO($lIdOperation, $lProduitMaj->getIdNomProduit(), $lIdStock, $lIdDetailOperation, $lIdStockSolidaire));
				}
			}
		}
		
		return $lIdOperation;
	}
	
	/**
	 * @name numFactureSuivante()
	 * @return integer
	 * @desc Retourne un numéro pour une nouvelle facture et incrémente le compte
	 */
	private function numFactureSuivante() {
		$lCompteur = compteurManager::select(1);
		$lNumero = $lCompteur->getValeur();
		$lNumeroSuivant = $lNumero + 1;
		$lCompteur->setValeur($lNumeroSuivant);
		compteurManager::update($lCompteur);
		return $lNumero;
	}

	/**
	 * @name getNouveauNumeroFacture()
	 * @return integer
	 * @desc Retourne un numéro pour une nouvelle facture
	 */
	public function getNouveauNumeroFacture() {
		$lCompteur = compteurManager::select(1);
		return $lCompteur->getValeur();
	}
	
	/**
	 * @name get($pId)
	 * @param integer id de l'operation de facture
	 * @param integer id Marché
	 * @return array(FactureVO) ou FactureVO
	 * @desc Retourne une liste de Facture
	 */
	public function get($pId = null) {
		if($pId != null) {
			return $this->select($pId);
		} else {
			return $this->selectAll();
		}
	}
		
	/**
	 * @name select($pId)
	 * @param integer
	 * @return FactureVO
	 * @desc Retourne une Facture
	 */
	private function select($pId) {
		$lFacture = new FactureVO();
		$lOperationService = new OperationService();
		
		$lFacture->setId( $lOperationService->getDetail($pId) );

		$lIdOperationProducteur = $lFacture->getId()->getChampComplementaire()[9]->getValeur();
		$lFacture->setOperationProducteur( $lOperationService->getDetail($lIdOperationProducteur) );
		
		$lIdOperationZeybu = $lFacture->getId()->getChampComplementaire()[10]->getValeur();
		$lFacture->setOperationZeybu( $lOperationService->getDetail($lIdOperationZeybu) );
		
		$lFacture->setProduits(DetailFactureManager::selectProduitsDetailFacture($pId));

		return $lFacture;
	}
	
	/**
	 * @name selectAll()
	 * @return array(FactureVO)
	 * @desc Retourne une liste de Facture
	 */
	private function selectAll() {
		return OperationManager::rechercheListeFacture(
				array(''),
				array(''),
				array(''),
				array(''),
				array(''));
	}
	
	/**
	 * @name getProduitCommandeNonFacture($pIdMarche, $pIdCompteFerme)
	 * @param integer Id Marche
	 * @param integer Id Compte Ferme
	 * @return array(ProduitDetailFactureAfficheVO)
	 * @desc Retourne la liste des produits commandés mais non facturés
	 */
	public function getProduitCommandeNonFacture($pIdMarche, $pIdCompteFerme) {
		return OperationManager::produitCommandeNonFacture($pIdMarche, $pIdCompteFerme);
	}
	
	/**
	 * @name rechercheListeFacture()
	 * @return array(FactureVO)
	 * @desc Retourne une liste de Facture
	 */
	public function rechercheListeFacture($pDateDebut = null, $pDateFin = null, $pIdMarche = null) {
		$lTypeRecherche = array();
		$lTypeCritere = array();
		$lCritereRecherche = array();
		
		if(!is_null($pDateDebut)) {
			array_push($lTypeRecherche,OperationManager::CHAMP_OPERATION_DATE);
			array_push($lTypeCritere,'>=');
			array_push($lCritereRecherche, $pDateDebut);
		}
		if(!is_null($pDateFin)) {
			array_push($lTypeRecherche,OperationManager::CHAMP_OPERATION_DATE);
			array_push($lTypeCritere,'<=');
			array_push($lCritereRecherche, $pDateFin);
		}
		if(!is_null($pIdMarche)) {
			array_push($lTypeRecherche,'marche.' . OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR);
			array_push($lTypeCritere,'=');
			if($pIdMarche == -1) { // Pour les factures hors marché
				array_push($lCritereRecherche, NULL);
			} else {
				array_push($lCritereRecherche, $pIdMarche);
			}
		}
		
		return OperationManager::rechercheListeFacture(
				$lTypeRecherche,
				$lTypeCritere,
				$lCritereRecherche,
				array(''),
				array(''));
	}
	
	/**
	 * @name delete($pIdFacture)
	 * @param integer
	 * @desc Supprime une facture
	 */
	public function delete($pIdFacture) {
		$lFactureValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\FactureValid();
		if($lFactureValid->delete($pIdFacture)) {
			$lFacture = $this->select($pIdFacture);
			
			$lOperationService = new OperationService();
			
			// Suppression des opérations
		//	$lOperationService->delete($pIdFacture);
			$lOperationService->delete($lFacture->getOperationProducteur()->getId());
		//	$lOperationService->delete($lFacture->getOperationZeybu()->getId());
			
			// Suppression du détail de facture
			DetailFactureManager::delete($pIdFacture);

			$lDetailOperationService = new DetailOperationService();
			$lStockService = new StockService();
			foreach($lFacture->getProduits() as $lProduit ) {
				$lStockService->delete( $lProduit->getIdStock() );
				$lDetailOperationService->delete($lProduit->getIdDetailOperation());
				$lStockService->delete( $lProduit->getIdStockSolidaire() );
			}
		}
	}
}
?>