<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : CompteValid.php
//
// Description : Classe CompteValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "MontantValid.php" );
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");

/**
 * @name CompteValid
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une CompteValid
 */
class CompteValid
{
	/**
	* @name estCompte($pCompte)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estCompte($pCompte) {
		if(is_object($pCompte)) {
			return (get_class($pCompte) == "CompteVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name id($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function id($pId) {
		$lIdValid = new IdValid();
		if(!empty($pId)){
			return $lIdValid->estId($pId);
		} else {
			return false;
		}
	}
	
	/**
	* @name label($pLabel)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function label($pLabel) {
		if(is_string($pLabel)) {
			return TestFonction::checkLength($pLabel,0,30);
		} else {
			return false;
		}
	}
	
	/**
	* @name solde($pSolde)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function solde($pSolde) {
		$lMontantValid = new MontantValid();
		return $lMontantValid->valeur($pSolde);
	}
	
	/**
	* @name insert($pCompte)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pCompte) {
		if($this->estCompte($pCompte)) {
			$lIdValid = new IdValid();
			$lId = $pCompte->getId();
						
			return $lIdValid->estId($lId)
			&& empty($lId)
			&& $this->label($pCompte->getLabel())
			&& $this->solde($pCompte->getSolde());
		} else {
			return false;
		}
	}
	
	/**
	* @name update($pCompte)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function update($pCompte) {
		if($this->estCompte($pCompte)) {
			return $this->id($pCompte->getId())
			&& $this->label($pCompte->getLabel())
			&& $this->solde($pCompte->getSolde());
		} else {
			return false;
		}
	}
	
	/**
	* @name delete($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function delete($pId) {
		return $this->id($pId);
	}
}
?>