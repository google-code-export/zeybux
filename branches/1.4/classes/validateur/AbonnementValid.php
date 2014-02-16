<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/02/2012
// Fichier : AbonnementValid.php
//
// Description : Classe AbonnementValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");

/**
 * @name AbonnementValid
 * @author Julien PIERRE
 * @since 14/02/2012
 * @desc Classe représentant une AbonnementValid
 */
class AbonnementValid
{
	/**
	* @name inputProduit($pProduitAbonnement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function inputProduit($pProduitAbonnement) {
		if(is_object($pProduitAbonnement)) {
			$lInput = true;
			$lInput &= get_class($pProduitAbonnement) == "ProduitAbonnementVO";
			$lIdValid = new IdValid();
			if($pProduitAbonnement->getId() != "") {
				$lInput &= $lIdValid->estId($pProduitAbonnement->getId());
			}
			$lInput &= $lIdValid->estId($pProduitAbonnement->getIdNomProduit());
			$lInput &= $lIdValid->estId($pProduitAbonnement->getId());			
			$lInput &= TestFonction::checkLength($pProduitAbonnement->getStockInitial(),0,12);
			$lInput &= is_float((float)$pProduitAbonnement->getStockInitial());
			$lInput &= TestFonction::checkLength($pProduitAbonnement->getMax(),0,12);
			$lInput &= is_float((float)$pProduitAbonnement->getMax());
			$lInput &= TestFonction::checkLength($pProduitAbonnement->getFrequence(),0,200);	
			$lInput &= TestFonction::checkLength($pProduitAbonnement->getUnite(),0,20);			
			$lInput &= TestFonction::checkLength($pProduitAbonnement->getEtat(),0,1);
			$lInput &= is_int((int)$pProduitAbonnement->getEtat());
			$lInput &= is_array($pProduitAbonnement->getLots());
			return $lInput;
		} else {
			return false;
		}
	}
		
	/**
	* @name insertProduit($pProduitAbonnement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insertProduit($pProduitAbonnement) {
		return $pProduitAbonnement->getId() == NULL
		&& $pProduitAbonnement->getIdNomProduit() != ""
		&& $pProduitAbonnement->getUnite() != ""
		&& $pProduitAbonnement->getStockInitial() != ""
		&& $pProduitAbonnement->getMax() != ""
		&& $pProduitAbonnement->getFrequence() != ""
		&& (string)$pProduitAbonnement->getEtat() != "";
	}
	
	/**
	* @name updateProduit($pProduitAbonnement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function updateProduit($pProduitAbonnement) {
		return $pProduitAbonnement->getId() != ""
		&& $pProduitAbonnement->getIdNomProduit() != ""
		&& $pProduitAbonnement->getUnite() != ""
		&& $pProduitAbonnement->getStockInitial() != ""
		&& $pProduitAbonnement->getMax() != ""
		&& $pProduitAbonnement->getFrequence() != ""
		&& (string)$pProduitAbonnement->getEtat() != "";
	}
	
	/**
	* @name deleteProduit($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function deleteProduit($pId) {
		$lIdValid = new IdValid();
		if(!empty($pId)){
			return $lIdValid->estId($pId);
		} else {
			return false;
		}
	}
	
	/**
	* @name inputAbonnement($pCompteAbonnement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function inputAbonnement($pCompteAbonnement) {
		if(is_object($pCompteAbonnement)) {
			$lInput = true;
			$lInput &= get_class($pCompteAbonnement) == "CompteAbonnementVO";
			$lIdValid = new IdValid();
			if($pCompteAbonnement->getId() != "") {
				$lInput &= $lIdValid->estId($pCompteAbonnement->getId());
			}
			$lInput &= $lIdValid->estId($pCompteAbonnement->getIdCompte());	
			$lInput &= $lIdValid->estId($pCompteAbonnement->getIdProduitAbonnement());	
			$lInput &= $lIdValid->estId($pCompteAbonnement->getIdLotAbonnement());	
			$lInput &= TestFonction::checkLength($pCompteAbonnement->getQuantite(),0,12);
			$lInput &= is_float((float)$pCompteAbonnement->getQuantite());
			if($pCompteAbonnement->getDateDebutSuspension() != '')	 {
				$lInput &= TestFonction::checkDateTime($pCompteAbonnement->getDateDebutSuspension(),'db') || StringUtils::dateTimeEstNulle($pCompteAbonnement->getDateDebutSuspension());
			}
			if($pCompteAbonnement->getDateFinSuspension() != '')	 {
				$lInput &= TestFonction::checkDateTime($pCompteAbonnement->getDateFinSuspension(),'db') || StringUtils::dateTimeEstNulle($pCompteAbonnement->getDateFinSuspension());
			}
			$lInput &= TestFonction::checkLength($pCompteAbonnement->getEtat(),0,1);
			$lInput &= is_int((int)$pCompteAbonnement->getEtat());
			return $lInput;
		} else {
			return false;
		}
	}

	/**
	* @name insertAbonnement($pCompteAbonnement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insertAbonnement($pCompteAbonnement) {
		return $pCompteAbonnement->getId() == ""
		&& $pCompteAbonnement->getIdCompte() != ""
		&& $pCompteAbonnement->getIdProduitAbonnement() != ""
		&& $pCompteAbonnement->getIdLotAbonnement() != ""
		&& $pCompteAbonnement->getQuantite() != ""
		&& (string)$pCompteAbonnement->getEtat() != "";
	}
	
	/**
	* @name updateAbonnement($pCompteAbonnement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function updateAbonnement($pCompteAbonnement) {
		return $pCompteAbonnement->getId() != ""
		&& $pCompteAbonnement->getIdCompte() != ""
		&& $pCompteAbonnement->getIdProduitAbonnement() != ""
		&& $pCompteAbonnement->getIdLotAbonnement() != ""
		&& $pCompteAbonnement->getQuantite() != ""
		&& (string)$pCompteAbonnement->getEtat() != "";
	}
	
	/**
	* @name deleteAbonnement($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function deleteAbonnement($pId) {
		$lIdValid = new IdValid();
		if(!empty($pId)){
			return $lIdValid->estId($pId);
		} else {
			return false;
		}
	}
}
?>