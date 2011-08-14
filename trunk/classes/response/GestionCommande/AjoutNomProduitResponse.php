<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/11/2010
// Fichier : AjoutNomProduitResponse.php
//
// Description : Classe AjoutNomProduitResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AjoutNomProduitResponse
 * @author Julien PIERRE
 * @since 07/11/2010
 * @desc Classe représentant une AjoutNomProduitResponse
 */
class AjoutNomProduitResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var integer
	 * @desc L'Id du nom du produit
	 */
	protected $mId;
	
	/**
	 * @var varchar(50)
	 * @desc Le nom du produit
	 */
	protected $mNom;
	
	/**
	* @name AjoutNomProduitResponse()
	* @desc Le constructeur
	*/
	public function AjoutNomProduitResponse() {
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
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le Nom
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le Nom par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}
}
?>