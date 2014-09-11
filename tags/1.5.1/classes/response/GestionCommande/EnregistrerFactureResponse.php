<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/08/2013
// Fichier : EnregistrerFactureResponse.php
//
// Description : Classe EnregistrerFactureResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name EnregistrerFactureResponse
 * @author Julien PIERRE
 * @since 21/08/2013
 * @desc Classe représentant une EnregistrerFactureResponse
 */
class EnregistrerFactureResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var int(11)
	* @desc L'Id de la EnregistrerFactureResponse
	*/
	protected $mId;
		
	/**
	* @name EnregistrerFactureResponse()
	* @desc Le constructeur
	*/
	public function EnregistrerFactureResponse($pId = null) {
		$this->mValid = true;
		if(!is_null($pId)) {$this->mId = $pId; }
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
	* @return IdVO
	* @desc Renvoie le membre Id de la EnregistrerFactureResponse
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param IdVO
	* @desc Remplace le membre Id de la EnregistrerFactureResponse par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
}
?>