<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : VirementValid.php
//
// Description : Classe VirementValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");
include_once(CHEMIN_CLASSES_VO . "VirementVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdVirementValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "MontantValid.php" );

/**
 * @name VirementValid
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une VirementValid
 */
class VirementValid
{
	/**
	* @name estVirement($pVirement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estVirement($pVirement) {
		if(is_object($pVirement)) {
			return (get_class($pVirement) == "VirementVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name compte($pIdCompte)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function compte($pIdCompte) {
		$lIdValid = new IdValid();
		return !empty($pIdCompte) && $lIdValid->estId($pIdCompte);
	}
	
	/**
	* @name montant($pMontant)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function montant($pMontant) {
		$lMontantValid = new MontantValid();
		return $lMontantValid->valeur($pMontant);
	}
	
	/**
	* @name typeVirement($pType)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function type($pType) {
		return $pType == 1 || $pType == 2; // 1 Virement, 2 Virement solidaire
	}
	
	/**
	* @name insert($pVirement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pVirement) {
		if($this->estVirement($pVirement)) {
			$lIdVirementValid = new IdVirementValid();
			$lIdValid = $lIdVirementValid->estVide($pVirement->getId());
			if(!is_null($lIdValid) && $lIdValid) {
				return $this->compte($pVirement->getCptDebit())
				&& $this->compte($pVirement->getCptCredit())
				&& $this->montant($pVirement->getMontant())
				&& $this->type($pVirement->getType());
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name update($pVirement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function update($pVirement) {
		if($this->estVirement($pVirement)) {
			$lIdVirementValid = new IdVirementValid();
			$lIdValid = $lIdVirementValid->estVide($pVirement->getId());
			if(!is_null($lIdValid) && !$lIdValid) {
				return $this->montant($pVirement->getMontant());
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name delete($pIdVirement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function delete($pIdVirement) {
		$lIdVirementValid = new IdVirementValid();
		$lIdValid = $lIdVirementValid->estValide($pIdVirement);
		if($lIdValid != NULL) {
			return $lIdValid;
		} else {
			return false;
		}
	}
}
?>