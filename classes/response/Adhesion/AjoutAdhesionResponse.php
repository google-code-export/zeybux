<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : AjoutAdhesionResponse.php
//
// Description : Classe AjoutAdhesionResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AjoutAdhesionResponse
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une AjoutAdhesionResponse
 */
class AjoutAdhesionResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var integer
	 * @desc L'Id de l'adhérent
	 */
	protected $mId;
	
	/**
	* @name AjoutAdhesionResponse()
	* @desc Le constructeur
	*/
	public function AjoutAdhesionResponse($pId = null) {
		$this->mValid = true;
		if(!is_null($pId)) { $this->mId = $pId; }
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
	* @name getId()
	* @return integer
	* @desc Renvoie le Id
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param integer
	* @desc Remplace le Id par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
}
?>