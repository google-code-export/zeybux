<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/08/2013
// Fichier : ProduitFactureValid.php
//
// Description : Classe ProduitFactureValid
//
//****************************************************************

namespace NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE;

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");


/**
 * @name ProduitFactureValid
 * @author Julien PIERRE
 * @since 04/08/2013
 * @desc Classe représentant une ProduitFactureValid
 */
class ProduitFactureValid
{
	/**
	 * @name estProduit($pProduit)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function estProduit($pProduit) {
		return is_object($pProduit) && get_class($pProduit) == "ProduitDetailFactureVO";
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
			&& $this->montant($pProduit->getMontant())
			&& $this->quantite($pProduit->getQuantite())
			&& $this->quantite($pProduit->getQuantiteSolidaire());
		}
		return false;
	}
}