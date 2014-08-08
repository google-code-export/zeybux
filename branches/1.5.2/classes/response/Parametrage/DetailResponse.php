<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/01/2013
// Fichier : DetailResponse.php
//
// Description : Classe DetailResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailResponse
 * @author Julien PIERRE
 * @since 13/01/2013
 * @desc Classe représentant une DetailResponse
 */
class DetailResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var Object
	* @desc Le compte de l'adherent de la DetailResponse
	*/
	protected $mDetail;
		
	/**
	* @name DetailResponse()
	* @desc Le constructeur de DetailResponse
	*/	
	public function DetailResponse() {
		$this->mValid = true;
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
	* @name getDetail()
	* @return Object
	* @desc Renvoie le Detail de l'élément
	*/
	public function getDetail() {
		return $this->mDetail;
	}

	/**
	* @name setDetail($pDetail)
	* @param Object
	* @desc Remplace le Detail de l'élément par $pDetail
	*/
	public function setDetail($pDetail) {
		$this->mDetail = $pDetail;
	}
}
?>