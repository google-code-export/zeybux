<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/10/2011
// Fichier : AutorisationSupprimerCategorieResponse.php
//
// Description : Classe AutorisationSupprimerCategorieResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AutorisationSupprimerCategorieResponse
 * @author Julien PIERRE
 * @since 21/10/2011
 * @desc Classe représentant une AutorisationSupprimerCategorieResponse
 */
class AutorisationSupprimerCategorieResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var bool
	* @desc Autorisation de la AutorisationSupprimerCategorieResponse
	*/
	protected $mAutorisation = false;
	
	/**
	*  @var integer
	* @desc NbProduit de la AutorisationSupprimerCategorieResponse
	*/
	protected $mNbProduit;
	
	/**
	* @name AutorisationSupprimerCategorieResponse()
	* @desc Le constructeur
	*/
	public function AutorisationSupprimerCategorieResponse() {
		$this->mValid = true;
		$this->mAutorisation = false;
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
	* @name getAutorisation()
	* @return bool
	* @desc Renvoie le membre Autorisation de la AutorisationSupprimerCategorieResponse
	*/
	public function getAutorisation(){
		return $this->mAutorisation;
	}

	/**
	* @name setAutorisation($pAutorisation)
	* @param bool
	* @desc Remplace le membre Autorisation de la AutorisationSupprimerCategorieResponse par $pAutorisation
	*/
	public function setAutorisation($pAutorisation) {
		$this->mAutorisation = $pAutorisation;
	}
	
	/**
	* @name getNbProduit()
	* @return integer
	* @desc Renvoie le membre NbProduit de la AutorisationSupprimerCategorieResponse
	*/
	public function getNbProduit(){
		return $this->mNbProduit;
	}

	/**
	* @name setNbProduit($pNbProduit)
	* @param integer
	* @desc Remplace le membre NbProduit de la AutorisationSupprimerCategorieResponse par $pNbProduit
	*/
	public function setNbProduit($pNbProduit) {
		$this->mNbProduit = $pNbProduit;
	}
}
?>