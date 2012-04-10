<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/02/2012
// Fichier :AbonnementService.php
//
// Description : Classe AbonnementService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueSuspensionAbonnementManager.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "AbonnementValid.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProduitAbonnementViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "DetailCompteAbonnementViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "DetailProduitAbonnementViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProduitsNonAbonneViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProduitsAbonneViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAbonnesProduitViewManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");

/**
 * @name AbonnementService
 * @author Julien PIERRE
 * @since 12/02/2012
 * @desc Classe Service d'Abonnement
 */
class AbonnementService
{	
	/**
	* @name setProduit($pProduitAbonnement)
	* @param ProduitAbonnementVO
	* @return integer
	* @desc Ajoute ou modifie un ProduitAbonnement
	*/
	public function setProduit($pProduitAbonnement) {
		$lAbonnementValid = new AbonnementValid();
		if($lAbonnementValid->inputProduit($pProduitAbonnement)) {
			if($lAbonnementValid->insertProduit($pProduitAbonnement)) {
				return $this->insertProduit($pProduitAbonnement);			
			} else if($lAbonnementValid->updateProduit($pProduitAbonnement)) {
				return $this->updateProduit($pProduitAbonnement);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name insertProduit($pProduitAbonnement)
	* @param ProduitAbonnementVO
	* @return integer
	* @desc Ajoute un ProduitAbonnementVO
	*/
	private function insertProduit($pProduitAbonnement) {		
		return ProduitAbonnementManager::insert($pProduitAbonnement);
	}
	
	/**
	* @name updateProduit($pProduitAbonnement)
	* @param ProduitAbonnementVO
	* @return integer
	* @desc Met à jour un ProduitAbonnementVO
	*/
	private function updateProduit($pProduitAbonnement) {		
		return ProduitAbonnementManager::update($pProduitAbonnement);
	}
	
	/**
	* @name deleteProduit($pId)
	* @param integer
	* @desc Supprime un ProduitAbonnementVO
	*/
	public function deleteProduit($pId) {
		$lAbonnementValid = new AbonnementValid();
		if($lAbonnementValid->deleteProduit($pId)){	
			$lProduitAbonnementVO = $this->getProduit($pId);
			$lProduitAbonnementVO->setEtat(1);
			$this->updateProduit($lProduitAbonnementVO);
		} else {
			return false;
		}
	}
				
	/**
	* @name getProduit($pId)
	* @param integer
	* @return array(ProduitAbonnementVO) ou ProduitAbonnementVO
	* @desc Retourne une liste de ProduitAbonnementVO
	*/
	public function getProduit($pId = null) {
		if($pId != null) {
			return $this->selectProduit($pId);
		} else {
			return $this->selectAllProduit();
		}
	}
	
	/**
	* @name selectProduit($pId)
	* @param integer
	* @return ProduitAbonnementVO
	* @desc Retourne un ProduitAbonnementVO
	*/
	public function selectProduit($pId) {
		return ProduitAbonnementManager::select($pId);
	}
	
	/**
	* @name getDetailProduit($pId)
	* @param integer
	* @return ProduitAbonnementVO
	* @desc Retourne un ProduitAbonnementVO
	*/
	public function getDetailProduit($pId) {
		return DetailProduitAbonnementViewManager::select($pId);
	}
		
	/**
	* @name selectAllProduit()
	* @return array(ProduitAbonnementVO)
	* @desc Retourne une liste de ProduitAbonnementVO
	*/
	public function selectAllProduit() {		
		return ListeProduitAbonnementViewManager::selectAll();
	}
	
	/**
	* @name getProduitByIdNom($pId)
	* @param integer
	* @return ProduitAbonnementVO
	* @desc Retourne un ProduitAbonnementVO
	*/
	public function getProduitByIdNom($pId) {
		return ProduitAbonnementManager::selectByIdNom($pId);
	}
	
	/**
	* @name setAbonnement($pCompteAbonnement)
	* @param CompteAbonnementVO
	* @return integer
	* @desc Ajoute ou modifie un CompteAbonnement
	*/
	public function setAbonnement($pCompteAbonnement) {
		$lAbonnementValid = new AbonnementValid();
		if($lAbonnementValid->inputAbonnement($pCompteAbonnement)) {
			if($lAbonnementValid->insertAbonnement($pCompteAbonnement)) {
				return $this->insertAbonnement($pCompteAbonnement);			
			} else if($lAbonnementValid->updateAbonnement($pCompteAbonnement)) {
				return $this->updateAbonnement($pCompteAbonnement);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name insertAbonnement($pCompteAbonnement)
	* @param CompteAbonnementVO
	* @return integer
	* @desc Ajoute un Abonnement
	*/
	private function insertAbonnement($pCompteAbonnement) {		
		return CompteAbonnementManager::insert($pCompteAbonnement);
	}
	
	/**
	* @name updateAbonnement($pCompteAbonnement)
	* @param CompteAbonnementVO
	* @return integer
	* @desc Met à jour un Abonnement
	*/
	private function updateAbonnement($pCompteAbonnement) {		
		return CompteAbonnementManager::update($pCompteAbonnement);
	}
	
	/**
	* @name deleteAbonnement($pId)
	* @param integer
	* @desc Supprime un Abonnement
	*/
	public function deleteAbonnement($pId) {
		$lAbonnementValid = new AbonnementValid();
		if($lAbonnementValid->deleteAbonnement($pId)){			
			$lCompteAbonnementVO = CompteAbonnementManager::select($pId);
			$lCompteAbonnementVO->setEtat(1);			
			$this->updateAbonnement($lCompteAbonnementVO);
		} else {
			return false;
		}
	}
				
	/**
	* @name getAbonnement($pId)
	* @param integer
	* @return array(CompteAbonnementVO) ou CompteAbonnementVO
	* @desc Retourne une liste de CompteAbonnementVO
	*/
	public function getAbonnement($pId = null) {
		if($pId != null) {
			return $this->selectAbonnement($pId);
		} else {
			return $this->selectAllAbonnement();
		}
	}
	
	/**
	* @name selectAbonnement($pId)
	* @param integer
	* @return CompteAbonnementVO
	* @desc Retourne un CompteAbonnementVO
	*/
	public function selectAbonnement($pId) {
		$lDetail = DetailCompteAbonnementViewManager::select($pId);
		return $lDetail[0];
	}
		
	/**
	* @name selectAll()
	* @return array(CompteAbonnementVO)
	* @desc Retourne une liste de CompteAbonnementVO
	*/
	public function selectAllAbonnement() {		
		return CompteAbonnementManager::selectAll();
	}
	
	/**
	* @name getAbonnesProduit($pIdProduitAbonnement)
	* @return array(ListeAbonnesProduitViewVO)
	* @desc Retourne une liste de ListeAbonnesProduitViewVO
	*/
	public function getAbonnesProduit($pIdProduitAbonnement) {
		return ListeAbonnesProduitViewManager::select($pIdProduitAbonnement);
	}
	
	/**
	* @name getAbonnesByIdNomProduit($pIdNomProduit)
	* @return array(ListeAbonnesProduitViewVO)
	* @desc Retourne une liste de ListeAbonnesProduitViewVO
	*/
	public function getAbonnesByIdNomProduit($pIdNomProduit) {
		return ListeAbonnesProduitViewManager::selectByIdNomProduit($pIdNomProduit);
	}

	/**
	* @name getProduitsAbonne($pIdCompte)
	* @return array(ListeProduitsAbonneViewVO)
	* @desc Retourne une liste de ListeProduitsAbonneViewVO
	*/
	public function getProduitsAbonne($pIdCompte) {
		return ListeProduitsAbonneViewManager::select($pIdCompte);
	}

	/**
	* @name getProduitsNonAbonne($pIdCompte,$pIdFerme)
	* @return array(ListeProduitsNonAbonneViewVO)
	* @desc Retourne une liste de ListeProduitsNonAbonneViewVO
	*/
	public function getProduitsNonAbonne($pIdCompte,$pIdFerme) {
		return ListeProduitsNonAbonneViewManager::select($pIdCompte,$pIdFerme);
	}
	
	/**
	* @name produitExiste($pIdProduitAbonnement)
	* @param integer
	* @return bool
	* @desc Vérifie si le produit Abonnement existe
	*/
	public function produitExiste($pIdProduitAbonnement) {
		$lProduitAbonnement = $this->getProduit($pIdProduitAbonnement);
		if($lProduitAbonnement->getId() == $pIdProduitAbonnement) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	* @name abonnementExiste($pIdCompteAbonnement)
	* @param integer
	* @return bool
	* @desc Vérifie si l'abonnement existe
	*/
	public function abonnementExiste($pIdCompteAbonnement) {
		$lAbonnement = $this->getAbonnement($pIdCompteAbonnement);
		if($lAbonnement->getCptAboId() == $pIdCompteAbonnement) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	* @name suspendreAbonnement($pCompteAbonnement)
	* @param CompteAbonnementVO
	* @return bool
	* @desc Suspen les abonnements d'un compte
	*/
	public function suspendreAbonnement($pCompteAbonnement) {
		$lAbonnementValid = new AbonnementValid();
		if($lAbonnementValid->inputAbonnement($pCompteAbonnement)) {
			CompteAbonnementManager::suspendreCompte($pCompteAbonnement);			
			$lHistoriqueSuspensionAbonnement = new HistoriqueSuspensionAbonnementVO();
			$lHistoriqueSuspensionAbonnement->setDateDebutSuspension($pCompteAbonnement->getDateDebutSuspension());
			$lHistoriqueSuspensionAbonnement->setDateFinSuspension($pCompteAbonnement->getDateFinSuspension());
			$lHistoriqueSuspensionAbonnement->setIdProduitAbonnement(0);
			$lHistoriqueSuspensionAbonnement->setIdCompte($pCompteAbonnement->getIdCompte());
			$lHistoriqueSuspensionAbonnement->setDate(StringUtils::dateTimeAujourdhuiDb());
			$lHistoriqueSuspensionAbonnement->setIdConnexion($_SESSION[ID_CONNEXION]);
			HistoriqueSuspensionAbonnementManager::insert($lHistoriqueSuspensionAbonnement); 
		} else {
			return false;
		}
	}
	
	/**
	* @name ajoutReservation($pIdCompte,$pIdMarche)
	* @param integer
	* @param integer
	* @return bool
	* @desc Positionne les réservations pour les abonnements du compte sur le maché
	*/
	public function ajoutReservation($pIdCompte,$pIdMarche) {
		$lProduits = $this->getProduitsAbonne($pIdCompte);
		$lMarcheService = new MarcheService();
		$lMarche = $lMarcheService->get($pIdMarche);
		
		$lReservationAbonnement = array("idCompte" => $pIdCompte, "produits" => array());
		foreach($lMarche->getProduits() as $lNouveauProduit) {
			// Ajout des réservations pour abonnement
			if($lNouveauProduit->getType() == 2) {
				
				$lIdNomProduit = $lNouveauProduit->getIdNom();
				foreach($lProduits as $lProduit) {
					if($lIdNomProduit == $lProduit->getNproId() ) {
						// Pas de suspension de l'abonnement et stock dispo pour positionner cette réservation (ou pas de limite de stock)
						if(	(!	(TestFonction::dateTimeEstPLusGrandeEgale($lMarche->getDateMarcheDebut(),$lProduit->getCptAboDateDebutSuspension(),'db')
								 && TestFonction::dateTimeEstPLusGrandeEgale($lProduit->getCptAboDateFinSuspension(),$lMarche->getDateMarcheDebut(),'db') )
							) && (
							 !	(TestFonction::dateTimeEstPLusGrandeEgale($lMarche->getDateMarcheFin(),$lProduit->getCptAboDateDebutSuspension(),'db')
								 && TestFonction::dateTimeEstPLusGrandeEgale($lProduit->getCptAboDateFinSuspension(),$lMarche->getDateMarcheFin(),'db') )
							) && (
									$lNouveauProduit->getStockReservation() >= $lProduit->getCptAboQuantite()
								||
									$lNouveauProduit->getStockInitial() == -1
							)
						 ) {
						 	foreach($lNouveauProduit->getLots() as $lLot) {
						 		$lDcomId = $lLot->getId();
						 	}
							$lReservationAbonnement["produits"][$lIdNomProduit] = array("id" => $lIdNomProduit, "idLot" => $lDcomId, "quantite" => $lProduit->getCptAboQuantite());
						}
					}
				}
			}
		}
		
		// Positionnement des réservations			
		$lReservationService = new ReservationService();
		$lReservationVO = new ReservationVO();
		$lReservationVO->getId()->setIdCompte( $pIdCompte );
		$lReservationVO->getId()->setIdCommande( $pIdMarche );
		
		$lEnregistrer = false;
		foreach($lReservationAbonnement["produits"] as $lDetail){
			$lDetailCommande = DetailCommandeManager::select($lDetail["idLot"]);				
			$lPrix = $lDetail["quantite"] / $lDetailCommande->getTaille() * $lDetailCommande->getPrix();

			$lDetailReservation = new DetailReservationVO();					
			$lDetailReservation->setIdDetailCommande($lDetail["idLot"]);
			$lDetailReservation->setQuantite($lDetail["quantite"] * -1);
			$lDetailReservation->setMontant($lPrix * -1);
			
			$lReservationVO->addDetailReservation($lDetailReservation);
			$lEnregistrer = true;
		}
		if($lEnregistrer) {	
			$lReservationService->set($lReservationVO);
		}
	}
}
?>