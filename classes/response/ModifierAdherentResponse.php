<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/11/2010
// Fichier : ModifierAdherentResponse.php
//
// Description : Classe ModifierAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AjoutCommandeResponse
 * @author Julien PIERRE
 * @since 11/11/2010
 * @desc Classe représentant une ModifierAdherentResponse
 */
class ModifierAdherentResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	 * @var integer
	 * @desc Le numero de l'adhérent
	 */
	protected $mNumero;
	
	/**
	* @name ModifierAdherentResponse()
	* @desc Le constructeur
	*/
	public function ModifierAdherentResponse() {
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