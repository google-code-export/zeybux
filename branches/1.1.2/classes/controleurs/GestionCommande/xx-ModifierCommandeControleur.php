<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/11/2010
// Fichier : ModifierCommandeControleur.php
//
// Description : Classe ModifierCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/NomProduitValid.php" );
include_once(CHEMIN_CLASSES_TOVO . "NomProduitToVO.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AjoutNomProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ModifierCommandeResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ModifierMarcheValid.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");
include_once(CHEMIN_CLASSES_TOVO . "CommandeCompleteToVO.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/BonDeCommandeValid.php" );


/**
 * @name ModifierCommandeControleur
 * @author Julien PIERRE
 * @since 04/11/2010
 * @desc Classe controleur d'une ModifierCommande
 */
class ModifierCommandeControleur
{	
	/**
	* @name getInfoCommande($pParam)
	* @return AfficheModifierCommandeResponse
	* @desc Retourne les infos de la commande la liste des produits
	*/
	public function getInfoCommande($pParam) {
		$lVr = BonDeCommandeValid::validGetInfoCommande($pParam);
		if($lVr->getValid()) {
			$lIdMarche = $pParam["id_commande"];		
	
			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->get($lIdMarche);
			
			$lResponse = new ModifierCommandeResponse();
			
			$lResponse->setMarche($lMarche);
			$lResponse->setProduits(NomProduitManager::selectAll());
			$lResponse->setProducteurs(ProducteurViewManager::selectAll());
	
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name ModifierCommande($pParam)
	* @return VR
	* @desc Modifie une commande
	*/
	public function ModifierCommande($pParam) {		
			
		$lMarche = $pParam["commande"];
		$lVr = ModifierMarcheValid::validUpdate($lMarche);
		
		if($lVr->getValid()) {			
			$lCommandeVO = CommandeCompleteToVO::convertFromArray($lMarche);	
			$lMarcheService = new MarcheService();
			$lId = $lMarcheService->update($lCommandeVO);
		}		
		return $lVr;
	}
	
	/**
	* @name AjouterProduit($lParam)
	* @return NomProduitResponse
	* @desc Ajoute le produit et retourne son nom et ID
	*/
	public function AjouterProduit($lParam) {
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
	}
}
?>