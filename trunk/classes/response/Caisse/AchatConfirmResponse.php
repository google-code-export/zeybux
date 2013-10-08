<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/10/2013
// Fichier : AchatConfirmResponse.php
//
// Description : Classe AchatConfirmResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AchatConfirmResponse
 * @author Julien PIERRE
 * @since 08/10/2013
 * @desc Classe représentant une AchatConfirmResponse
 */
class AchatConfirmResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var Integer
	 * @desc L'id d'une operation de l'achat
	 */
	protected $mIdAchat;
		
	/**
	* @name AchatConfirmResponse()
	* @desc Le constructeur de AchatConfirmResponse
	*/	
	public function AchatConfirmResponse($pIdAchat = null) {
		$this->mValid = true;
		if(!is_null($pIdAchat)) {$this->mIdAchat = $pIdAchat;}
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
	* @name getIdAchat()
	* @return Integer
	* @desc Renvoie mIdAchat
	*/
	public function getIdAchat() {
		return $this->mIdAchat;
	}

	/**
	* @name setIdAchat($pIdAchat)
	* @param Integer
	* @desc Remplace mIdAchat de l'élément par $pIdAchat
	*/
	public function setIdAchat($pIdAchat) {
		$this->mIdAchat = $pIdAchat;
	}
}
?>