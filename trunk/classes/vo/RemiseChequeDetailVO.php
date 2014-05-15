<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/05/2014
// Fichier : RemiseChequeDetailVO.php
//
// Description : Classe RemiseChequeDetailVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "RemiseChequeVO.php");

/**
 * @name RemiseChequeDetailVO
 * @author Julien PIERRE
 * @since 04/05/2014
 * @desc Classe représentant une RemiseChequeDetailVO
 */
class RemiseChequeDetailVO extends RemiseChequeVO
{
	/**
	 * @var array(OperationDetailVO)
	 * @desc Types d'adhésion de la RemiseChequeDetailVO
	 */
	protected $mOperations;
	
	/**
	* @name RemiseChequeDetailVO()
	* @desc Le constructeur
	*/
	public function RemiseChequeDetailVO($pId = null, $pNumero = null, $pDateCreation = null, $pDateModification = null, $pEtat = null, $pOperations = null)  {
		parent::__construct($pId, $pNumero, $pDateCreation, $pDateModification, $pEtat) ;
		if(!is_null($pOperations)) { $this->mOperations = $pOperations; } else { $this->mOperations = array(); }
	}
		
	/**
	* @name getOperations()
	* @return array(OperationDetailVO)
	* @desc Renvoie le membre Operations de la RemiseChequeDetailVO
	*/
	public function getOperations(){
		return $this->mOperations;
	}

	/**
	* @name setOperations($pProduit)
	* @param array(OperationDetailVO)
	* @desc Remplace le membre Operations de la RemiseChequeDetailVO par $pOperations
	*/
	public function setOperations($pOperations) {
		$this->mOperations = $pOperations;
	}
	
	/**
	* @name addOperations($pOperations)
	* @param OperationDetailVO
	* @desc Ajoute $pProduit à Operations
	*/
	public function addOperations($pOperations){
		array_push($this->mOperations,$pOperations);
	}
}
?>