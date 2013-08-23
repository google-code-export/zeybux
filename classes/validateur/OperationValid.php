<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : OperationValid.php
//
// Description : Classe OperationValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "MontantValid.php" );
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "TypePaiementValid.php");

/**
 * @name OperationValid
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une OperationValid
 */
class OperationValid
{	
	/**
	* @name estOperation($pOperation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estOperation($pOperation) {
		return is_object($pOperation) && (get_class($pOperation) == "OperationDetailVO");
	}
	
	/**
	* @name id($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function id($pId) {
		$lIdValid = new IdValid();
		return !empty($pId) && $lIdValid->estId($pId);
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
	* @name libelle($pLibelle)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function libelle($pLibelle) {
		return is_string($pLibelle) && TestFonction::checkLength($pLibelle,0,100);
	}
		
	/**
	* @name date($pDate)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function date($pDate) {
		return TestFonction::checkDateTimeExist($pDate);
	}
	
	/**
	* @name typePaiement($pTypePaiement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function typePaiement($pTypePaiement) {
		$lTypePaiementValid = new TypePaiementValid();
		return $lTypePaiementValid->id($pTypePaiement);
	}
		
	/**
	* @name type($pType)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function type($pType) {
		return $pType = 0 || $pType = 1;
	}
		
	/**
	 * @name champComplementaire($pChampComplementaire, $pType)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function champComplementaire($pChampComplementaire, $pType) {
		return is_array($pChampComplementaire) && $this->champComplementaireDetailOperation($pChampComplementaire, $pType);
	}
	
	/**
	 * @name champComplementaireDetailOperation($pChampComplementaire, $pType)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function champComplementaireDetailOperation($pChampComplementaire, $pType) {
		$lIdValid = new IdValid();
		$lRetour = true;
		foreach($pChampComplementaire as $lChamp) {
			$lChcpId = $lChamp->getChcpId();		
			$lRetour &= !empty($lChcpId)
					&& $lIdValid->estId($lChcpId)
					&& TestFonction::checkLength($lChamp->getValeur(),0,50);			
			if($pType == 'update') {
				$lRetour &= $lIdValid->estId($lChamp->getOpeId());
			}			
		}
		return $lRetour;
	}
	
	
	/**
	* @name insert($pOperation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pOperation) {
		if($this->estOperation($pOperation)) {
			$lIdValid = new IdValid();
			$lId = $pOperation->getId();
			return $lIdValid->estId($lId)
				&& empty($lId)
				&& $this->compte($pOperation->getIdCompte())
				&& $this->montant($pOperation->getMontant())
				&& $this->libelle($pOperation->getLibelle())
				&& $this->typePaiement($pOperation->getTypePaiement())
				&& $this->type($pOperation->getType())
				&& $this->champComplementaire($pOperation->getChampComplementaire(),'insert');
				
		} else {
			return false;
		}
	}
	
	/**
	* @name update($pOperation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function update($pOperation) {
		if($this->estOperation($pOperation)) {			
			$lIdValid = new IdValid();
			return $this->id($pOperation->getId())
				&& $this->compte($pOperation->getIdCompte())
				&& $this->montant($pOperation->getMontant())
				&& $this->libelle($pOperation->getLibelle())
				&& $this->typePaiement($pOperation->getTypePaiement())
				&& $this->type($pOperation->getType())
				&& $this->champComplementaire($pOperation->getChampComplementaire(),'update');
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