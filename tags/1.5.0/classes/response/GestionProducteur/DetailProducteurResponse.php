<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : DetailProducteurResponse.php
//
// Description : Classe DetailProducteurResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailProducteurResponse
 * @author Julien PIERRE
 * @since 23/12/2010
 * @desc Classe représentant une DetailProducteurResponse
 */
class DetailProducteurResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var ProducteurViewVO
	* @desc Le compte du producteur de la DetailProducteurResponse
	*/
	protected $mProducteur;
	
	/**
	* @name DetailProducteurResponse()
	* @desc Le constructeur de DetailProducteurResponse
	*/	
	public function DetailProducteurResponse() {
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
	* @name getProducteur()
	* @return ProducteurViewVO
	* @desc Renvoie l'Adherent de l'élément
	*/
	public function getProducteur() {
		return $this->mProducteur;
	}

	/**
	* @name setProducteur($pProducteur)
	* @param ProducteurViewVO
	* @desc Remplace le Producteur de l'élément par $pProducteur
	*/
	public function setProducteur($pProducteur) {
		$this->mProducteur = $pProducteur;
	}
}
?>