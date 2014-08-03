<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/09/2013
// Fichier : ProduitAchatValid.php
//
// Description : Classe ProduitAchatValid
//
//****************************************************************

namespace NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE;

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");


/**
 * @name ProduitAchatValid
 * @author Julien PIERRE
 * @since 05/09/2013
 * @desc Classe représentant une ProduitAchatValid
 */
class ProduitAchatValid
{
	/**
	 * @name estProduit($pProduit)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function estProduit($pProduit) {
		return is_object($pProduit) && get_class($pProduit) == "ProduitDetailAchatVO";
	}
	
	/**
	 * @name montant($pMontant)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function montant($pMontant) {
		$lMontantValid = new \MontantValid();
		return $lMontantValid->valeur($pMontant);
	}
	
	/**
	 * @name quantite($pQuantite)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function quantite($pQuantite) {
		$lQuantiteValid = new \MontantValid();
		return $lQuantiteValid->valeur($pQuantite);
	}
	
	/**
	* @name produit($pProduit)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function produit($pProduit) {
		if($this->estProduit($pProduit)) {
			$lIdValid = new \IdValid();
			$lId = $pProduit->getIdNomProduit();
						
			return $lIdValid->estId($lId)
			&& !empty($lId)
			&& $lIdValid->estId($pProduit->getIdStock())
			&& $lIdValid->estId($pProduit->getIdDetailOperation())
			&& $lIdValid->estId($pProduit->getIdStockSolidaire())
			&& $lIdValid->estId($pProduit->getIdDetailOperationSolidaire())
			&& $lIdValid->estId($pProduit->getIdDetailCommande())
			&& $lIdValid->estId($pProduit->getIdModeleLot())
			&& $lIdValid->estId($pProduit->getIdDetailCommandeSolidaire())
			&& $lIdValid->estId($pProduit->getIdModeleLotSolidaire())
			&& $this->montant($pProduit->getMontant())
			&& $this->montant($pProduit->getMontantSolidaire())
			&& $this->quantite($pProduit->getQuantite())
			&& $this->quantite($pProduit->getQuantiteSolidaire());
		}
		return false;
	}
}