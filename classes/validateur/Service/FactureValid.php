<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/08/2013
// Fichier : FactureValid.php
//
// Description : Classe FactureValid
//
//****************************************************************

namespace NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE;

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "OperationValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR  . MOD_SERVICE . "/ProduitFactureValid.php");

/**
 * @name FactureValid
 * @author Julien PIERRE
 * @since 04/08/2013
 * @desc Classe représentant une FactureValid
 */
class FactureValid
{
	/**
	* @name estFacture($pFacture)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estFacture($pFacture) {
		return is_object($pFacture) && get_class($pFacture) == "FactureVO";
	}
	
	/**
	 * @name produits($pProduits)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function produits($pProduits) {		
		if(is_array($pProduits) && count($pProduits) > 0) {
			$lValid = true;
			$lProduitFactureValid = new ProduitFactureValid();
			foreach($pProduits as $lProduit) {
				$lValid &= $lProduitFactureValid->produit($lProduit);
			}
			return $lValid;
		}
		return false;
	}
	
	/**
	 * @name input($pFacture)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function input($pFacture) {
		if($this->estFacture($pFacture)) {			
			$lId = $pFacture->getId();
			$lOperationProducteur = $pFacture->getOperationProducteur();
			$lOperationZeybu = $pFacture->getOperationZeybu();
			
			$lOperationValid = new \OperationValid();
			return( is_null($lId->getId()) ||$lId->getId() == '' || $lOperationValid->delete($lId->getId()) ) &&
					( !is_null($lOperationProducteur->getIdCompte()) || $lOperationValid->insert($lOperationProducteur) ) &&
					( !is_null($lOperationProducteur->getId()) || $lOperationValid->update($lOperationProducteur) ) &&
					( is_null($lOperationZeybu->getId()) ||  $lOperationValid->update($lOperationZeybu) ) &&
					$this->produits($pFacture->getProduits());			
		} else {
			return false;
		}
	}	
	
	/**
	* @name insert($pFacture)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pFacture) {
			$lId = $pFacture->getId()->getId();
			$lOperationProducteur = $pFacture->getOperationProducteur()->getId();
			$lOperationProducteurCompte = $pFacture->getOperationProducteur()->getIdCompte();
			$lOperationZeybu = $pFacture->getOperationZeybu()->getId();
						
			return 	(is_null($lId) || empty($lId)) 
					&& (is_null($lOperationProducteur) || empty($lOperationProducteur) )
					&& (!is_null($lOperationProducteurCompte) && !empty($lOperationProducteurCompte)) 
					&& (is_null($lOperationZeybu) || empty($lOperationZeybu));
	}
	
	/**
	 * @name update($pFacture)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function update($pFacture) {
		$lId = $pFacture->getId()->getId();
		$lOperationProducteur = $pFacture->getOperationProducteur()->getId();
		$lOperationProducteurCompte = $pFacture->getOperationProducteur()->getIdCompte();
		$lOperationZeybu = $pFacture->getOperationZeybu()->getId();
		
		return (!is_null($lId)  && !empty($lId)) 
				&& (is_null($lOperationProducteur) || empty($lOperationProducteur) )
				&& (!is_null($lOperationProducteurCompte) && !empty($lOperationProducteurCompte)) 
				&& (is_null($lOperationZeybu) || empty($lOperationZeybu));
	}
	
	/**
	* @name delete($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function delete($pId) {	
		$lOperationValid = new \OperationValid();
		return $lOperationValid->delete($pId);
	}	
}
?>