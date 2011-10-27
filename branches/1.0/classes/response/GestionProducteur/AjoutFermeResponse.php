<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2011
// Fichier : AjoutFermeResponse.php
//
// Description : Classe AjoutFermeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AjoutFermeResponse
 * @author Julien PIERRE
 * @since 27/10/2011
 * @desc Classe représentant une AjoutFermeResponse
 */
class AjoutFermeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var integer
	* @desc Id de la AjoutFermeResponse
	*/
	protected $mId;
	
	/**
	* @name AjoutFermeResponse()
	* @desc Le constructeur de AjoutFermeResponse
	*/	
	public function AjoutFermeResponse() {
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
	* @name getId()
	* @return interger
	* @desc Renvoie le membre Id de la AjoutFermeResponse
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param interger
	* @desc Remplace le membre Id de la AjoutFermeResponse par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
}