<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/08/2010
// Fichier : DetailCommandeVR.php
//
// Description : Classe DetailCommandeVR
//
//****************************************************************

/**
 * @name DetailCommandeVR
 * @author Julien PIERRE
 * @since 19/08/2010
 * @desc Classe représentant une DetailCommandeVR
 */
class DetailCommandeVR
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	private $mValid;

	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	private $mId;

	/**
	 * @var VRelement
	 * @desc IdProduit de la DetailCommandeVR
	 */
	private $mIdProduit;


	/**
	 * @var VRelement
	 * @desc Taille de la DetailCommandeVR
	 */
	private $mTaille;


	/**
	 * @var VRelement
	 * @desc Prix de la DetailCommandeVR
	 */
	private $mPrix;

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
	* @return VRelement
	* @desc Renvoie le VRelement Id
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le VRelement Id par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdProduit()
	* @return VRelement
	* @desc Renvoie le VRelement mIdProduit
	*/
	public function getIdProduit() {
		return $this->mIdProduit;
	}

	/**
	* @name setIdProduit($pIdProduit)
	* @param VRelement
	* @desc Remplace le mIdProduit par $pIdProduit
	*/
	public function setIdProduit($pIdProduit) {
		$this->mIdProduit = $pIdProduit;
	}

	/**
	* @name getTaille()
	* @return VRelement
	* @desc Renvoie le VRelement mTaille
	*/
	public function getTaille() {
		return $this->mTaille;
	}

	/**
	* @name setTaille($pTaille)
	* @param VRelement
	* @desc Remplace le mTaille par $pTaille
	*/
	public function setTaille($pTaille) {
		$this->mTaille = $pTaille;
	}

	/**
	* @name getPrix()
	* @return VRelement
	* @desc Renvoie le VRelement mPrix
	*/
	public function getPrix() {
		return $this->mPrix;
	}

	/**
	* @name setPrix($pPrix)
	* @param VRelement
	* @desc Remplace le mPrix par $pPrix
	*/
	public function setPrix($pPrix) {
		$this->mPrix = $pPrix;
	}

}
?>
