<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/07/2011
// Fichier : MarcheService.php
//
// Description : Classe MarcheService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_VO . "MarcheVO.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "DetailMarcheViewManager.php");

/**
 * @name MarcheService
 * @author Julien PIERRE
 * @since 13/07/2011
 * @desc Classe Service d'un Marche
 */
class MarcheService
{		
	/**
	* @name getNonReserveeParCompte($pIdCompte)
	* @param integer
	* @return array(CommandeVO)
	* @desc Récupères les commandes en cours non réservées par l'adhérent
	*/
	public static function getNonReserveeParCompte($pIdCompte) {		// TODO les tests	
		return CommandeManager::selectNonReserveeParCompte($pIdCompte);
	}
	
	/**
	* @name get($pId)
	* @param integer
	* @return array(CommandeVO) ou CommandeVO
	* @desc Retourne une liste de Commande
	*/
	public function get($pId = null) {
		if($pId != null) {
			if(is_int((int)$pId)) {
				return $this->select($pId);
			} else {
				return false;
			}
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	* @name select($pId)
	* @param integer
	* @return CommandeVO
	* @desc Retourne une Commande
	*/
	public function select($pId) {		
		$lDetailMarche = DetailMarcheViewManager::select($pId);
		
		$lMarche = new MarcheVO();
		
		// Information du marche
		$lMarche->setId($lDetailMarche[0]->getComId());
		$lMarche->setNumero($lDetailMarche[0]->getComNumero());
		$lMarche->setNom($lDetailMarche[0]->getComNom());
		$lMarche->setDescription($lDetailMarche[0]->getComDescription());
		$lMarche->setDateMarcheDebut($lDetailMarche[0]->getComDateMarcheDebut());
		$lMarche->setDateMarcheFin($lDetailMarche[0]->getComDateMarcheFin());
		$lMarche->setDateFinReservation($lDetailMarche[0]->getComDateFinReservation());
		$lMarche->setArchive($lDetailMarche[0]->getComArchive());

		foreach($lDetailMarche as $lDetail) {
			if($lDetail->getProId() != '') {
				// Le Produit
				$lProduits = $lMarche->getProduits();
				if(!isset($lProduits[$lDetail->getProId()])) {				
					$lProduit = new ProduitMarcheVO();
					$lProduit->setId($lDetail->getProId());
					$lProduit->setIdProducteur($lDetail->getProIdProducteur());
					$lProduit->setIdNom($lDetail->getNproId());
					$lProduit->setNom($lDetail->getNproNom());
					$lProduit->setDescription($lDetail->getNproDescription());
					$lProduit->setIdCategorie($lDetail->getNproIdCategorie());
					$lProduit->setUnite($lDetail->getProUniteMesure());
					$lProduit->setQteMaxCommande($lDetail->getProMaxProduitCommande());
					$lProduit->setStockReservation($lDetail->getProStockReservation());
					
					$lProduits[$lDetail->getProId()] = $lProduit;
				}
				
				// Le Lot
				$lLot = new DetailMarcheVO();
				$lLot->setId($lDetail->getDcomId());
				$lLot->setTaille($lDetail->getDcomTaille());
				$lLot->setPrix($lDetail->getDcomPrix());
				$lLots = $lProduits[$lDetail->getProId()]->getLots();
				$lLots[$lDetail->getDcomId()] = $lLot;
				$lProduits[$lDetail->getProId()]->setLots($lLots);
				
				$lMarche->setProduits($lProduits);
			}
		}
				
		return $lMarche;
	}
		
	/**
	* @name selectAll()
	* @return array(CommandeVO)
	* @desc Retourne une liste de Commande
	*/
	public function selectAll() {
		return CommandeManager::selectAll();
	}
}
?>