<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/06/2011
// Fichier : EtatCaisseResponse.php
//
// Description : Classe EtatCaisseResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name EtatCaisseResponse
 * @author Julien PIERRE
 * @since 21/06/2011
 * @desc Classe représentant une EtatCaisseResponse
 */
class EtatCaisseResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var integer
	 * @desc L'état
	 */
	protected $mEtat;
	
	/**
	* @name EtatCaisseResponse()
	* @desc Le constructeur
	*/
	public function EtatCaisseResponse() {
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
	* @name getEtat()
	* @return integer
	* @desc Renvoie le Etat
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param integer
	* @desc Remplace le Etat par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}
}
?>