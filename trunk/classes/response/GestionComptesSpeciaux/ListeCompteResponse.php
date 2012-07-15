<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2012
// Fichier : ListeCompteResponse.php
//
// Description : Classe ListeCompteResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeCompteResponse
 * @author Julien PIERRE
 * @since 25/01/2012
 * @desc Classe représentant une ListeCompteResponse
 */
class ListeCompteResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var array(IdentificationVO)
	 * @desc Les comptes Administrateur
	 */
	protected $mAdministrateur;
	
	/**
	 * @var array(IdentificationVO)
	 * @desc Les comptes caisse
	 */
	protected $mCaisse;
	
	/**
	 * @var array(IdentificationVO)
	 * @desc Les comptes Solidaire
	 */
	protected $mSolidaire;
	
	/**
	* @name ListeCompteResponse()
	* @desc Le constructeur de ListeCompteResponse
	*/	
	public function ListeCompteResponse() {
		$this->mValid = true;
		$this->mAdministrateur = array();
		$this->mCaisse = array();
		$this->mSolidaire = array();
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
	* @name getAdministrateur()
	* @return array(IdentificationVO)
	* @desc Renvoie le Administrateur
	*/
	public function getAdministrateur() {
		return $this->mAdministrateur;
	}

	/**
	* @name setAdministrateur($pAdministrateur)
	* @param array(IdentificationVO)
	* @desc Remplace le Administrateur par $pAdministrateur
	*/
	public function setAdministrateur($pAdministrateur) {
		$this->mAdministrateur = $pAdministrateur;
	}
	
	/**
	* @name addAdministrateur($pAchat)
	* @param IdentificationVO
	* @desc Ajoute Administrateur à $pAdministrateur
	*/
	public function addAdministrateur($pAdministrateur) {
		array_push($this->mAdministrateur,$pAdministrateur);
	}
	
	/**
	* @name getCaisse()
	* @return array(IdentificationVO)
	* @desc Renvoie le Caisse
	*/
	public function getCaisse() {
		return $this->mCaisse;
	}

	/**
	* @name setCaisse($pCaisse)
	* @param array(IdentificationVO)
	* @desc Remplace le Caisse par $pCaisse
	*/
	public function setCaisse($pCaisse) {
		$this->mCaisse = $pCaisse;
	}
	
	/**
	* @name addCaisse($pAchat)
	* @param IdentificationVO
	* @desc Ajoute Caisse à $pCaisse
	*/
	public function addCaisse($pCaisse) {
		array_push($this->mCaisse,$pCaisse);
	}
	
	/**
	* @name getSolidaire()
	* @return array(IdentificationVO)
	* @desc Renvoie le Solidaire
	*/
	public function getSolidaire() {
		return $this->mSolidaire;
	}

	/**
	* @name setSolidaire($pSolidaire)
	* @param array(IdentificationVO)
	* @desc Remplace le Solidaire par $pSolidaire
	*/
	public function setSolidaire($pSolidaire) {
		$this->mSolidaire = $pSolidaire;
	}
	
	/**
	* @name addSolidaire($pAchat)
	* @param IdentificationVO
	* @desc Ajoute Solidaire à $pSolidaire
	*/
	public function addSolidaire($pSolidaire) {
		array_push($this->mSolidaire,$pSolidaire);
	}
}
?>