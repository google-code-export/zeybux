<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/08/2010
// Fichier : AjoutCommandeResponse.php
//
// Description : Classe AjoutCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AjoutCommandeResponse
 * @author Julien PIERRE
 * @since 30/08/2010
 * @desc Classe représentant une AjoutCommandeResponse
 */
class AjoutCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;

	/**
	 * @var integer
	 * @desc L'Id de la commande
	 */
	protected $mId;
	
	/**
	 * @var integer
	 * @desc Le numero de la commande
	 */
	protected $mNumero;

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
	
	/**
	* @name getNumero()
	* @return integer
	* @desc Renvoie le Numero
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param integer
	* @desc Remplace le Numero par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}
}
?>