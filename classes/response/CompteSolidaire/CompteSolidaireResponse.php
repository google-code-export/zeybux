<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/07/2011
// Fichier : CompteSolidaireResponse.php
//
// Description : Classe CompteSolidaireResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteSolidaireResponse
 * @author Julien PIERRE
 * @since 02/07/2011
 * @desc Classe représentant une CompteSolidaireResponse
 */
class CompteSolidaireResponse extends DataTemplate
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
	 * @var decimal(10,2)
	 * @desc Le solde
	 */
	protected $mSolde;

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
	
	/**
	* @name getSolde()
	* @return decimal(10,2)
	* @desc Renvoie le Solde
	*/
	public function getSolde() {
		return $this->mSolde;
	}

	/**
	* @name setSolde($pSolde)
	* @param decimal(10,2)
	* @desc Remplace le Solde par $pSolde
	*/
	public function setSolde($pSolde) {
		$this->mSolde = $pSolde;
	}
}
?>