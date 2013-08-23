<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : DetailOperationValid.php
//
// Description : Classe DetailOperationValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "MontantValid.php" );
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "TypePaiementValid.php");
//include_once(CHEMIN_CLASSES_VR . "DetailOperationVR.php" );

/**
 * @name DetailOperationValid
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe représentant une DetailOperationValid
 */
class DetailOperationValid
{	
	/**
	* @name estDetailOperation($pDetailOperation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estDetailOperation($pDetailOperation) {
		if(is_object($pDetailOperation)) {
			return (get_class($pDetailOperation) == "DetailOperationVO");
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
		return !empty($pId) && $lIdValid->estId($pId);
	}
	
	/**
	* @name idOperation($pIdOperation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function idOperation($pIdOperation) {
		$lIdValid = new IdValid();
		return !empty($pIdOperation) && $lIdValid->estId($pIdOperation);
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
		if(is_string($pLibelle)) {
			return TestFonction::checkLength($pLibelle,0,100);
		} else {
			return false;
		}
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
	* @name typePaiementChampComplementaire($pTypePaiementChampComplementaire)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	/*public function typePaiementChampComplementaire($pTypePaiementChampComplementaire) {
		if(is_string((string)$pTypePaiementChampComplementaire)) {
			return TestFonction::checkLength($pTypePaiementChampComplementaire,0,50);
		} else {
			return false;
		}
	}*/
		
	/**
	* @name idDetailCommande($pIdDetailCommande)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function idDetailCommande($pIdDetailCommande) {
		$lIdValid = new IdValid();
		return $lIdValid->estId($pIdDetailCommande);
	}
	
	/**
	* @name insert($pDetailOperation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pDetailOperation) {
		if($this->estDetailOperation($pDetailOperation)) {
			$lIdValid = new IdValid();
			$lId = $pDetailOperation->getId();		

			return $lIdValid->estId($lId)
				&& empty($lId)
				&& $this->idOperation($pDetailOperation->getIdOperation())
				&& $this->compte($pDetailOperation->getIdCompte())
				&& $this->montant($pDetailOperation->getMontant())
				&& $this->libelle($pDetailOperation->getLibelle())
				&& $this->typePaiement($pDetailOperation->getTypePaiement())
				&& $this->idDetailCommande($pDetailOperation->getIdDetailCommande());
				
		} else {
			return false;
		}
	}
	
	/**
	* @name update($pDetailOperation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function update($pDetailOperation) {
		if($this->estDetailOperation($pDetailOperation)) {
			return $this->id($pDetailOperation->getId())
				&& $this->idOperation($pDetailOperation->getIdOperation())
				&& $this->compte($pDetailOperation->getIdCompte())
				&& $this->montant($pDetailOperation->getMontant())
				&& $this->libelle($pDetailOperation->getLibelle())
				&& $this->typePaiement($pDetailOperation->getTypePaiement())
				&& $this->idDetailCommande($pDetailOperation->getIdDetailCommande());
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