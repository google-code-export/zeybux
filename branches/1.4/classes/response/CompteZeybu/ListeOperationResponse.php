<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/10/2013
// Fichier : ListeOperationResponse.php
//
// Description : Classe ListeOperationResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeOperationResponse
 * @author Julien PIERRE
 * @since 08/10/2013
 * @desc Classe représentant une ListeOperationResponse
 */
class ListeOperationResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(OperationPasseeViewVO)
	* @desc Operation de la ListeOperationResponse
	*/
	protected $mOperation;
	
	/**
	* @name ListeOperationResponse()
	* @desc Le constructeur de ListeOperationResponse
	*/	
	public function ListeOperationResponse($pOperation = null) {
		$this->mValid = true;		
		if(!is_null($pOperation)) {$this->mOperation = $pOperation;} else {$this->mOperation = array();}
	}
	
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
	* @return array(OperationPasseeViewVO)
	* @desc Renvoie le membre Operation de la ListeOperationResponse
	*/
	public function getOperation(){
		return $this->mOperation;
	}

	/**
	* @name setOperation($pOperation)
	* @param array(OperationPasseeViewVO)
	* @desc Remplace le membre Operation de la ListeOperationResponse par $pOperation
	*/
	public function setOperation($pOperation) {
		$this->mOperation = $pOperation;
	}
	
	/**
	* @name addOperation($pOperation)
	* @param OperationPasseeViewVO
	* @desc Ajoute $pOperation à Operation
	*/
	public function addOperation($pOperation){
		array_push($this->mOperation,$pOperation);
	}
}
?>