<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : ModifierProducteurResponse.php
//
// Description : Classe ModifierProducteurResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ModifierProducteurResponse
 * @author Julien PIERRE
 * @since 24/12/2010
 * @desc Classe représentant une ModifierProducteurResponse
 */
class ModifierProducteurResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	 * @var integer
	 * @desc Le numero du Producteur
	 */
	protected $mNumero;
	
	/**
	* @name ModifierProducteurResponse()
	* @desc Le constructeur
	*/
	public function ModifierProducteurResponse() {
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