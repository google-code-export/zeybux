<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/06/2014
// Fichier : RemiseChequeResponse.php
//
// Description : Classe RemiseChequeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name RemiseChequeResponse
 * @author Julien PIERRE
 * @since 09/06/2014
 * @desc Classe représentant une RemiseChequeResponse
 */
class RemiseChequeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	 * @var RemiseChequeVO
	 * @desc La RemiseCheque
	 */
	protected $mRemiseCheque;
	
	/**
	 * @name RemiseChequeResponse()
	 * @return bool
	 * @desc Constructeur
	 */
	function RemiseChequeResponse($pRemiseCheque = null) {
		$this->mValid = true;
		if(!is_null($pRemiseCheque)) { $this->mRemiseCheque = $pRemiseCheque;}
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
	* @name getRemiseCheque()
	* @return RemiseChequeVO
	* @desc Renvoie le RemiseCheque
	*/
	public function getRemiseCheque() {
		return $this->mRemiseCheque;
	}

	/**
	* @name setRemiseCheque($pRemiseCheque)
	* @param RemiseChequeVO
	* @desc Remplace le RemiseCheque par $pRemiseCheque
	*/
	public function setRemiseCheque($pRemiseCheque) {
		$this->mRemiseCheque = $pRemiseCheque;
	}
}
?>