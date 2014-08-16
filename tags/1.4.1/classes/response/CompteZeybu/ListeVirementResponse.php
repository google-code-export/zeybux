<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/08/2011
// Fichier : ListeVirementResponse.php
//
// Description : Classe ListeVirementResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeVirementResponse
 * @author Julien PIERRE
 * @since 10/08/2011
 * @desc Classe représentant une ListeVirementResponse
 */
class ListeVirementResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	 * @var array(OperationVO)
	 * @desc Les opérations
	 */
	protected $mOperation;
	
	/**
	* @name getValid()
	* @return bool
	* @desc Renvoie la validite de l'élément
	*/
	public function getValid() {
		return $this->mValid;
	}

	/**
	* @name setValid($pValid)
	* @param bool
	* @desc Remplace la validite de l'élément par $pValid
	*/
	public function setValid($pValid) {
		$this->mValid = $pValid;
	}
	
	/**
	* @name getOperation()
	* @return array(OperationVO)
	* @desc Renvoie le Operation
	*/
	public function getOperation() {
		return $this->mOperation;
	}

	/**
	* @name setOperation($pOperation)
	* @param array(OperationVO)
	* @desc Remplace le Operation par $pOperation
	*/
	public function setOperation($pOperation) {
		$this->mOperation = $pOperation;
	}
}
?>