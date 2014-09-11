<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : AdhesionResponse.php
//
// Description : Classe AdhesionResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AdhesionResponse
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une AdhesionResponse
 */
class AdhesionResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var integer
	 * @desc L'Adhesion de l'adhérent
	 */
	protected $mAdhesion;
	
	/**
	* @name AdhesionResponse()
	* @desc Le constructeur
	*/
	public function AdhesionResponse($pAdhesion = null) {
		$this->mValid = true;
		if(!is_null($pAdhesion)) { $this->mAdhesion = $pAdhesion; }
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
	* @name getAdhesion()
	* @return integer
	* @desc Renvoie le Adhesion
	*/
	public function getAdhesion() {
		return $this->mAdhesion;
	}

	/**
	* @name setAdhesion($pAdhesion)
	* @param integer
	* @desc Remplace le Adhesion par $pAdhesion
	*/
	public function setAdhesion($pAdhesion) {
		$this->mAdhesion = $pAdhesion;
	}
}
?>