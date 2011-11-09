<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/03/2010
// Fichier : AjoutCommandeControleur.php
//
// Description : Classe AjoutCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/NomProduitValid.php" );
include_once(CHEMIN_CLASSES_TOVO . "NomProduitToVO.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AfficheAjoutCommandeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AjoutNomProduitResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");


include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeFermeViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeNomProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");  
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/ModelesLotResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AjoutCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/FermeValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/NomProduitCatalogueValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/CommandeCompleteValid.php" );
include_once(CHEMIN_CLASSES_TOVO . "CommandeCompleteToVO.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php" );

/**
 * @name AjoutCommandeControleur
 * @author Julien PIERRE
 * @since 31/03/2010
 * @desc Classe controleur d'une AjoutCommande
 */
class AjoutCommandeControleur
{	
	/**
	* @name getInfoAjoutCommande()
	* @return AfficheAjoutCommandeResponse
	* @desc Retourne la liste des produits
	*/
	/*public function getInfoAjoutCommande() {		
		$lResponse = new AfficheAjoutCommandeResponse();
		$lResponse->setProduits(NomProduitManager::selectAll());
		$lResponse->setProducteurs(ProducteurViewManager::selectAll());
		return $lResponse;
	}*/
	
	/**
	* @name getListeFerme()
	* @return ListeFermeResponse
	* @desc Recherche la liste des Fermes
	*/
	public function getListeFerme() {		
		// Lancement de la recherche
		$lResponse = new ListeFermeResponse();
		$lResponse->setListeFerme(ListeFermeViewManager::selectAll());
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
	* @name getModeleLot($pParam)
	* @return DetailProduitResponse
	* @desc Retourne les Modèles de lot d'un produit
	*/
	public function getModeleLot($pParam) {
		$lVr = NomProduitCatalogueValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lId = $pParam['idNomProduit'];			
			$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lId);
			
			$lResponse = new ModelesLotResponse();
			$lResponse->setModelesLot( $lModelesLot );
			return $lResponse;
		}		
		return $lVr;
	}

	/**
	* @name AjouterProduit($lParam)
	* @return NomProduitResponse
	* @desc Ajoute le produit et retourne son nom et ID
	*/
	/*public function AjouterProduit($lParam) {	
		
		$lNomProduit = $lParam['nomProduit'];	
		$lNomProduit['idCategorie']	= 1; // TODO Pour le moment pas de gestion des catégories
		
		$lVr = NomProduitValid::validAjout($lNomProduit);
		
		if($lVr->getValid()) {
			$lNomProduitVO = NomProduitToVO::convertFromArray($lNomProduit);
			$lId = NomProduitManager::insert($lNomProduitVO);
			
			$lResponse = new AjoutNomProduitResponse();
			$lResponse->setId($lId);
			$lResponse->setNom($lNomProduitVO->getNom());
			return $lResponse;		
		}		
		return $lVr;
	}*/
	
	/**
	* @name ajouterMarche($lParam)
	* @return AjoutCommandeResponse
	* @desc Ajoute la commande
	*/
	public function ajouterMarche($lParam) {
		$lCommande = $lParam;
		$lVr = CommandeCompleteValid::validAjout($lCommande);
		
		if($lVr->getValid()) {			
			$lCommandeVO = CommandeCompleteToVO::convertFromArray($lCommande);
			$lMarcheService = new MarcheService();
			$lId = $lMarcheService->insert($lCommandeVO);
			
			if($lId != null) {
				$lResponse = new AjoutCommandeResponse();
				$lResponse->setValid(true);
				$lResponse->setId($lId);				
				$lResponse->setNumero($lId);		
				return $lResponse;
			} else {
				$lVr = new TemplateVR();
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_113_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_113_MSG);
				$lVr->getLog()->addErreur($lErreur);	
				return $lVr;
			}
		}		
		return $lVr;
	}
}
?>
