<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/10/2011
// Fichier : CatalogueFermeControleur.php
//
// Description : Classe CatalogueFermeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitProducteurManager.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CaracteristiqueProduitManager.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "ModeleLotManager.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR ."/AfficheCatalogueResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR ."/AutorisationSupprimerCategorieResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR ."/DetailCategorieResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR ."/DetailProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR ."/ListeCategorieResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR ."/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR ."/InfoFormulaireProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR ."/InfoFormulaireModifierProduitResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUCTEUR . "/CategorieProduitValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUCTEUR . "/NomProduitCatalogueValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUCTEUR . "/FermeValid.php");
include_once(CHEMIN_CLASSES_TOVO . "CategorieProduitToVO.php" );
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeNomProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProducteurViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeCaracteristiqueViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeCategorieProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CategorieProduitViewManager.php");  
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CaracteristiqueProduitViewManager.php");  
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");  
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "NomProduitProducteurViewManager.php");  
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "NomProduitViewManager.php");  
include_once(CHEMIN_CLASSES_VO . "NomProduitCatalogueVO.php" );

/**
 * @name CatalogueFermeControleur
 * @author Julien PIERRE
 * @since 31/10/2011
 * @desc Classe controleur d'une CatalogueFermeControleur
 */
class CatalogueFermeControleur
{		
	/**
	* @name getListeCategorie()
	* @return ListeCategorieResponse
	* @desc Retourne la liste des categories
	*/
	public function getListeCategorie() {
		$lResponse = new ListeCategorieResponse();
		$lResponse->setListeCategorie( ListeCategorieProduitViewManager::selectAll() );
		return $lResponse;
	}
	
	/**
	* @name getListeProduit($pParam)
	* @return ListeProduitResponse
	* @desc Retourne la liste des produits
	*/
	public function getListeProduit($pParam) {
		$lVr = FermeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lResponse = new ListeProduitResponse();
			$lResponse->setListeProduit( ListeNomProduitViewManager::select( $pParam['id'] ) );
			return $lResponse;
		}		
		return $lVr;
	}
	
	/**
	* @name afficher()
	* @return ListeCategorieResponse
	* @desc Retourne la liste des categories et des produits
	*/
	public function afficher($pParam) {
		$lVr = FermeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lResponse = new AfficheCatalogueResponse();
			$lResponse->setListeCategorie( ListeCategorieProduitViewManager::selectAll() );
			$lResponse->setListeProduit( ListeNomProduitViewManager::select( $pParam['id'] ) );
			return $lResponse;
		}		
		return $lVr;
	}
	
	/**
	* @name getDetailCategorie($pParam)
	* @return DetailCategorieResponse
	* @desc Retourne le détail d'une catégorie
	*/
	public function getDetailCategorie($pParam) {
		$lVr = CategorieProduitValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lCategorie = CategorieProduitViewManager::select($pParam["id"]);
			$lResponse = new DetailCategorieResponse();
			$lResponse->setCategorie( $lCategorie[0] );
			return $lResponse;
		}		
		return $lVr;
	}
	
	/**
	* @name ajouterCategorie($pParam)
	* @return CategorieProduitVR
	* @desc Ajoute une categorie et retourne son nom et ID
	*/
	public function ajouterCategorie($pParam) {	
		$lVr = CategorieProduitValid::validAjout($pParam);
		
		if($lVr->getValid()) {
			$lCategorieProduitVO = CategorieProduitToVO::convertFromArray( $pParam['categorieProduit']);
			CategorieProduitManager::insert($lCategorieProduitVO);
		}		
		return $lVr;
	}
	
	/**
	* @name modifierCategorie($pParam)
	* @return CategorieProduitVR
	* @desc Modifie une categorie et retourne son nom et ID
	*/
	public function modifierCategorie($pParam) {	
		$lVr = CategorieProduitValid::validUpdate($pParam);		
		if($lVr->getValid()) {
			$lCategorieProduitVO = CategorieProduitToVO::convertFromArray( $pParam['categorieProduit']);
			CategorieProduitManager::update($lCategorieProduitVO);
		}		
		return $lVr;
	}
	
	/**
	* @name supprimerCategorie($pParam)
	* @return CategorieProduitVR
	* @desc Supprime une categorie
	*/
	public function supprimerCategorie($pParam) {	
		$lVr = CategorieProduitValid::validDelete($pParam);		
		if($lVr->getValid()) {
			$lAutorisation = CatalogueFermeControleur::autorisationSupprimerCategorie($pParam);			
			if($lAutorisation->getValid() && $lAutorisation->getAutorisation()) {		
				$lCategorie = CategorieProduitManager::select($pParam['id']);
				$lCategorie->setEtat(1);
				CategorieProduitManager::update($lCategorie);
			}
			return $lAutorisation;
		}		
		return $lVr;
	}
	
	/**
	* @name autorisationSupprimerCategorie($pParam)
	* @return CategorieProduitVR
	* @desc Retourne l'autorisation de supprimer une categorie ainsi que le nombre de produit associé à la catégorie
	*/
	public function autorisationSupprimerCategorie($pParam) {	
		$lVr = CategorieProduitValid::validDelete($pParam);		
		if($lVr->getValid()) {
			$lReponse = new AutorisationSupprimerCategorieResponse();
			$lProduits = CatalogueFermeControleur::listeProduitCategorie($pParam['id']);		
			$lId = $lProduits[0]->getId();
			if(count($lProduits) == 1 && empty($lId) ) { // Le manager retourne un tableau avec un objet vide -> Pas de produit
				$lReponse->setNbProduit(0);
				$lReponse->setAutorisation(true);
			} else {				
				$lReponse->setNbProduit(count($lProduits));
				$lReponse->setAutorisation(false);
			}
			return $lReponse;
		}		
		return $lVr;
	}
	
	/**
	* @name listeProduitCategorie($pId)
	* @return array(NomProduitVO)
	* @desc Retourne la liste des produits liés à la catégorie
	*/
	private function listeProduitCategorie($pId) {
		return NomProduitManager::selectByIdCategorie($pId);
	}
	
	/**
	* @name exportProduitCategorie($pParam)
	* @return CSV
	* @desc Retourne la liste des produits liés à la catégorie
	*/	
	public function exportProduitCategorie($pParam) {
		$lVr = CategorieProduitValid::validDelete($pParam);		
		if($lVr->getValid()) {
			$lCategorie = CategorieProduitManager::select($pParam['id']);
			$lProduits = CatalogueFermeControleur::listeProduitCategorie($pParam['id']);
			
			$lCSV = new CSV();
			$lCSV->setNom($lCategorie->getNom() . '_:_Liste_des_produits.csv'); // Le Nom
	
			// L'entete
			$lEntete = array("Nom du Produit");
			$lCSV->setEntete($lEntete);
			
			$lContenuTableau = array();
			foreach($lProduits as $lProduit) {
				array_push($lContenuTableau,array($lProduit->getNom()));
			}
			
			$lCSV->setData($lContenuTableau);
			
			// Export en CSV
			$lCSV->output();
		}		
		return $lVr;
	}
	
	/**
	* @name infoFomulaireProduit($pParam)
	* @return InfoFormulaireProduitResponse
	* @desc Retourne la liste des producteurs de la ferme et des caractéristiques
	*/	
	public function infoFomulaireProduit($pParam) {
		$lVr = FermeValid::validDelete($pParam);	
		if($lVr->getValid()) {
			// Lancement de la recherche
			$lResponse = new InfoFormulaireProduitResponse();
			$lResponse->setListeProducteur(ListeProducteurViewManager::select($pParam["id"]));
			$lResponse->setListeCaracteristique( ListeCaracteristiqueViewManager::selectAll() );
			return $lResponse;
		}
		return $lVr;		
	}	
	
	/**
	* @name infoFomulaireModifierProduit($pParam)
	* @return InfoFormulaireModifierProduitResponse
	* @desc Retourne la liste des produits liés à la catégorie
	*/	
	public function infoFomulaireModifierProduit($pParam) {
		$lVr = NomProduitCatalogueValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lId = $pParam['idNomProduit'];
			
			$lNomProduit = NomProduitViewManager::select($lId);
			$lNomProduit = $lNomProduit[0];
			$lNomProduitCatalagueVO = new NomProduitCatalogueVO();
			$lNomProduitCatalagueVO->setId($lNomProduit->getNProIdFerme());
			$lNomProduitCatalagueVO->setIdNomProduit($lNomProduit->getNProId());
			$lNomProduitCatalagueVO->setIdCategorie($lNomProduit->getCproId());
			$lNomProduitCatalagueVO->setCproNom($lNomProduit->getCproNom());
			$lNomProduitCatalagueVO->setNom($lNomProduit->getNProNom());
			$lNomProduitCatalagueVO->setDescription($lNomProduit->getNProDescription());
			
			$lProducteurs = NomProduitProducteurViewManager::select($lId);
			$lNomProduitCatalagueVO->setProducteurs($lProducteurs);
			
			$lCaracteristiques = CaracteristiqueProduitViewManager::select($lId);
			$lNomProduitCatalagueVO->setCaracteristiques($lCaracteristiques);
			
			$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lId);
			$lNomProduitCatalagueVO->setModelesLot($lModelesLot);
			
			$lResponse = new InfoFormulaireModifierProduitResponse();
			$lResponse->setListeProducteur(ListeProducteurViewManager::select($lNomProduitCatalagueVO->getId()));
			$lResponse->setListeCaracteristique( ListeCaracteristiqueViewManager::selectAll() );
			$lResponse->setProduit( $lNomProduitCatalagueVO );
			return $lResponse;
		}
		return $lVr;		
	}
	
	/**
	* @name ajouterProduit($pParam)
	* @return NomProduitCatalogueVR
	* @desc Ajoute un produit et retourne son nom et ID
	*/
	public function ajouterProduit($pParam) {	
		$lVr = NomProduitCatalogueValid::validAjout($pParam);
		if($lVr->getValid()) {
		
			$lNomProduitVO = new NomProduitVO();
			$lNomProduitVO->setNom($pParam['nom']);
			$lNomProduitVO->setDescription($pParam['description']);
			$lNomProduitVO->setIdCategorie($pParam['idCategorie']);
			$lNomProduitVO->setIdFerme($pParam['id']);
			$lNomProduitVO->setEtat(0);
			$lId = NomProduitManager::insert($lNomProduitVO);
		
			foreach($pParam['producteurs'] as $lProducteur) {
				$lNomProduitProducteurVO = new NomProduitProducteurVO();
				$lNomProduitProducteurVO->setIdNomProduit($lId);
				$lNomProduitProducteurVO->setIdProducteur($lProducteur);
				$lNomProduitProducteurVO->setEtat(0);
				NomProduitProducteurManager::insert($lNomProduitProducteurVO);
			}
			
			foreach($pParam['caracteristiques'] as $lCaracteristique) {
				$lCaracteristiqueProduitVO = new CaracteristiqueProduitVO();
				$lCaracteristiqueProduitVO->setIdNomProduit($lId);
				$lCaracteristiqueProduitVO->setIdCaracteristique($lCaracteristique);
				$lCaracteristiqueProduitVO->setEtat(0);			
				CaracteristiqueProduitManager::insert($lCaracteristiqueProduitVO);
			}
		
			foreach($pParam['modelesLot'] as $lModeleLot) {
				$lModeleLotVO = new ModeleLotVO();
				$lModeleLotVO->setIdNomProduit($lId);
				$lModeleLotVO->setQuantite($lModeleLot["quantite"]);
				$lModeleLotVO->setUnite($lModeleLot["unite"]);
				$lModeleLotVO->setPrix($lModeleLot["prix"]);
				$lModeleLotVO->setEtat(0);
				ModeleLotManager::insert($lModeleLotVO);
			}
		
		}
		return $lVr;
	}
	
	/**
	* @name modifierProduit($pParam)
	* @return NomProduitCatalogueVR
	* @desc Met à jour un produit
	*/
	public function modifierProduit($pParam) {	
		$lVr = NomProduitCatalogueValid::validUpdate($pParam);
		if($lVr->getValid()) {
		
			$lId = $pParam['idNomProduit'];
			$lNomProduitVO = NomProduitManager::select($lId);
			$lNomProduitVO->setNom($pParam['nom']);
			$lNomProduitVO->setDescription($pParam['description']);
			$lNomProduitVO->setIdCategorie($pParam['idCategorie']);
			$lNomProduitVO->setIdFerme($pParam['id']);
			$lNomProduitVO->setEtat(0);
			NomProduitManager::update($lNomProduitVO);
		
			/** Producteurs **/			
			$lProducteurs = NomProduitProducteurViewManager::select($lId);
			$lIdProducteurs = array();
			$lProducteursDelete = array();
			foreach($lProducteurs as $lProducteur) {
				array_push($lIdProducteurs,$lProducteur->getPrdtId());
				if(!in_array($lProducteur->getPrdtId(),$pParam['producteurs'])) {
					array_push($lProducteursDelete,$lProducteur->getNPrdtId());
				}
			}
			if(!empty($lProducteursDelete)) {
				NomProduitProducteurManager::deleteByArray($lProducteursDelete);
			}
			
			$lProducteursInsert = array();
			foreach($pParam['producteurs'] as $lProducteur) {
				if(!in_array($lProducteur,$lIdProducteurs)) {
					$lNomProduitProducteurVO = new NomProduitProducteurVO();
					$lNomProduitProducteurVO->setIdNomProduit($lId);
					$lNomProduitProducteurVO->setIdProducteur($lProducteur);
					$lNomProduitProducteurVO->setEtat(0);
					array_push($lProducteursInsert,$lNomProduitProducteurVO);
				}
			}
			if(!empty($lProducteursInsert)) {
				NomProduitProducteurManager::insertByArray($lProducteursInsert);
			}
			
			/** Caracteristiques **/	
			$lCaracteristiques = CaracteristiqueProduitViewManager::select($lId);
			$lIdCaracteristiques = array();
			$lCaracteristiquesDelete = array();
			foreach($lCaracteristiques as $lCaracteristique) {
				array_push($lIdCaracteristiques,$lCaracteristique->getCarId());
				if(!in_array($lCaracteristique->getCarId(),$pParam['caracteristiques'])) {
					array_push($lCaracteristiquesDelete,$lCaracteristique->getCarProId());
				}
			}
			if(!empty($lCaracteristiquesDelete)) {
				CaracteristiqueProduitManager::deleteByArray($lCaracteristiquesDelete);
			}			
			
			$lCaracteristiquesInsert = array();
			foreach($pParam['caracteristiques'] as $lCaracteristique) {
				if(!in_array($lCaracteristique,$lIdCaracteristiques)) {
					$lCaracteristiqueProduitVO = new CaracteristiqueProduitVO();
					$lCaracteristiqueProduitVO->setIdNomProduit($lId);
					$lCaracteristiqueProduitVO->setIdCaracteristique($lCaracteristique);
					$lCaracteristiqueProduitVO->setEtat(0);			
					array_push($lCaracteristiquesInsert,$lCaracteristiqueProduitVO);
				}
			}
			if(!empty($lCaracteristiquesInsert)) {
				CaracteristiqueProduitManager::insertByArray($lCaracteristiquesInsert);
			}
		
			/** Modeles Lot **/	
			$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lId);
			$lModelesLotDelete = array();
			foreach($lModelesLot as $lModeleLot) {
				$lUpdate = false;
				foreach($pParam['modelesLot'] as $lNvModeleLot) {
					if($lModeleLot->getMLotId() == $lNvModeleLot["id"]) {
						$lUpdate = true;
						$lModeleLotVO = new ModeleLotVO();
						$lModeleLotVO->setId($lNvModeleLot["id"]);
						$lModeleLotVO->setIdNomProduit($lId);
						$lModeleLotVO->setQuantite($lNvModeleLot["quantite"]);
						$lModeleLotVO->setUnite($lNvModeleLot["unite"]);
						$lModeleLotVO->setPrix($lNvModeleLot["prix"]);
						$lModeleLotVO->setEtat(0);
						ModeleLotManager::update($lModeleLotVO);
					}
				}
				if(!$lUpdate) {
					array_push($lModelesLotDelete,$lModeleLot->getMLotId());					
				}
			}
			if(!empty($lModelesLotDelete)) {
				ModeleLotManager::deleteByArray($lModelesLotDelete);
			}
			
			$lModelesLotInsert = array();
			foreach($pParam['modelesLot'] as $lModeleLot) {
				if(empty($lModeleLot['id'])) {
					$lModeleLotVO = new ModeleLotVO();
					$lModeleLotVO->setIdNomProduit($lId);
					$lModeleLotVO->setQuantite($lModeleLot["quantite"]);
					$lModeleLotVO->setUnite($lModeleLot["unite"]);
					$lModeleLotVO->setPrix($lModeleLot["prix"]);
					$lModeleLotVO->setEtat(0);
					array_push($lModelesLotInsert,$lModeleLotVO);
				}
			}
			if(!empty($lModelesLotInsert)) {
				ModeleLotManager::insertByArray($lModelesLotInsert);
			}
		}
		return $lVr;
	}
	
	/**
	* @name supprimerProduit($pParam)
	* @return NomProduitCatalogueVR
	* @desc Supprime un produit
	*/
	public function supprimerProduit($pParam) {	
		$lVr = NomProduitCatalogueValid::validDelete($pParam);		
		if($lVr->getValid()) {	
			$lId = $pParam['idNomProduit'];
			NomProduitManager::delete($lId);			
			NomProduitProducteurManager::deleteByIdNomProduit($lId);
			CaracteristiqueProduitManager::deleteByIdNomProduit($lId);
			ModeleLotManager::deleteByIdNomProduit($lId);
		}		
		return $lVr;
	}
	
	/**
	* @name getDetailProduit($pParam)
	* @return DetailProduitResponse
	* @desc Retourne le détail d'un produit
	*/
	public function getDetailProduit($pParam) {
		$lVr = NomProduitCatalogueValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lId = $pParam['idNomProduit'];
			
			$lNomProduit = NomProduitViewManager::select($lId);	
			//var_dump($lNomProduit);
			$lNomProduit = $lNomProduit[0];
			$lNomProduitCatalagueVO = new NomProduitCatalogueVO();
			$lNomProduitCatalagueVO->setId($lNomProduit->getNProIdFerme());
			$lNomProduitCatalagueVO->setIdNomProduit($lNomProduit->getNProId());
			$lNomProduitCatalagueVO->setIdCategorie($lNomProduit->getCproId());
			$lNomProduitCatalagueVO->setCproNom($lNomProduit->getCproNom());
			$lNomProduitCatalagueVO->setNom($lNomProduit->getNProNom());
			$lNomProduitCatalagueVO->setDescription($lNomProduit->getNProDescription());
			
			$lProducteurs = NomProduitProducteurViewManager::select($lId);
			$lNomProduitCatalagueVO->setProducteurs($lProducteurs);
			
			$lCaracteristiques = CaracteristiqueProduitViewManager::select($lId);
			$lNomProduitCatalagueVO->setCaracteristiques($lCaracteristiques);
			
			$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lId);
			$lNomProduitCatalagueVO->setModelesLot($lModelesLot);
			
			$lResponse = new DetailProduitResponse();
			$lResponse->setProduit( $lNomProduitCatalagueVO );
			return $lResponse;
		}		
		return $lVr;
	}
}
?>