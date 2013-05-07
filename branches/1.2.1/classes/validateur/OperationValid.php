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
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "MontantValid.php" );
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php");
//include_once(CHEMIN_CLASSES_VR . "OperationVR.php" );

/**
 * @name OperationValid
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une OperationValid
 */
class OperationValid
{
	/**
	* @var int(11)
	* @desc Vr de la OperationValid
	*/
	/*protected $mVr;
	
	/**
	* @name getVr()
	* @return int(11)
	* @desc Renvoie le membre Vr de la OperationValid
	*/
	/*public function getVr() {
		return $this->mVr;
	}

	/**
	* @name setVr($pVr)
	* @param int(11)
	* @desc Remplace le membre Vr de la OperationValid par $pVr
	*/
	/*public function setVr($pVr) {
		$this->mVr = $pVr;
	}*/
	
	/**
	* @name estOperation($pOperation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estOperation($pOperation) {
		if(is_object($pOperation)) {
			return (get_class($pOperation) == "OperationVO");
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
	* @name compte($pIdCompte)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function compte($pIdCompte) {
		$lCompteService = new CompteService();
		return $lCompteService->existe($pIdCompte);
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
		$lTypePaiementService = new TypePaiementService();
		return $lTypePaiementService->existe($pTypePaiement);
	}
	
	/**
	* @name typePaiementChampComplementaire($pTypePaiementChampComplementaire)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function typePaiementChampComplementaire($pTypePaiementChampComplementaire) {
		if(is_string((string)$pTypePaiementChampComplementaire)) {
			return TestFonction::checkLength($pTypePaiementChampComplementaire,0,50);
		} else if(is_null($pTypePaiementChampComplementaire)) {
			return true;
		}
		return false;
	}
	
	/**
	* @name type($pType)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function type($pType) {
		return $pType >= 0 && $pType <= 7;
	}
	
	/**
	* @name idCommande($pIdCommande)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function idCommande($pIdCommande) {
		$lIdValid = new IdValid();
		return $lIdValid->estId($pIdCommande);
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
				&& $this->typePaiementChampComplementaire($pOperation->getTypePaiementChampComplementaire())
				&& $this->type($pOperation->getType())
				&& $this->idCommande($pOperation->getIdCommande());
				
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
				&& $this->typePaiementChampComplementaire($pOperation->getTypePaiementChampComplementaire())
				&& $this->type($pOperation->getType())
				&& $this->idCommande($pOperation->getIdCommande());
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