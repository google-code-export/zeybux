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
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CommandeCompleteEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitInitiauxViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "ModifierCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "CommandeCompleteValid.php" );
include_once(CHEMIN_CLASSES_TOVO . "CommandeCompleteToVO.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeCompleteManager.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "NomProduitValid.php" );
include_once(CHEMIN_CLASSES_TOVO . "NomProduitToVO.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "AjoutNomProduitResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");


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
		$lIdCommande = $pParam["id_commande"];		

		if(is_int((int)$lIdCommande)) {			
			$lCommande = CommandeCompleteEnCoursViewManager::select($lIdCommande);
			
			if($lCommande[0]->getComId() == $lIdCommande) {			
				$lResponse = new ModifierCommandeResponse();
				
				$lStockInitiaux = StockProduitInitiauxViewManager::selectByIdCommande($lIdCommande);
				
				$lResponse->setCommande($lCommande);
				$lResponse->setStockInitiaux($lStockInitiaux);
				$lResponse->setProduits(NomProduitManager::selectAll());
				$lResponse->setProducteurs(ProducteurViewManager::selectAll());
				
				return $lResponse;
			} else {
				$lVr = new TemplateVR();
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getLog()->addErreur($lErreur);	
				return $lVr;
			}				
		} else {
			$lVr = new TemplateVR();
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
			$lVr->getLog()->addErreur($lErreur);	
			return $lVr;
		}
	}
	
	/**
	* @name ModifierCommande($pParam)
	* @return VR
	* @desc Modifie une commande
	*/
	public function ModifierCommande($pParam) {		
			
		$lCommande = $pParam["commande"];
		$lVr = CommandeCompleteValid::validUpdate($lCommande);
		
		if($lVr->getValid()) {			
			$lCommandeVO = CommandeCompleteToVO::convertFromArray($lCommande);	
			$lIdCommande = CommandeCompleteManager::update($lCommandeVO);
			
			if($lIdCommande != $lCommandeVO->getId()) {	
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