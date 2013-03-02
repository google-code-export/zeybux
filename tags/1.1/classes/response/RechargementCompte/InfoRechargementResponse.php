<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/06/2011
// Fichier : InfoRechargementResponse.php
//
// Description : Classe InfoRechargementResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoRechargementResponse
 * @author Julien PIERRE
 * @since 12/06/2011
 * @desc Classe représentant une InfoRechargementResponse
 */
class InfoRechargementResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;
	
	/**
	 * @var String
	 * @desc Numéro de l'adhérent
	 */
	protected $mNumero;
	
	
	/**
	 * @var String
	 * @desc Compte de l'adhérent
	 */
	protected $mIdCompte;
	
	/**
	 * @var String
	 * @desc Compte de l'adhérent
	 */
	protected $mCompte;
	
	/**
	 * @var String
	 * @desc Prénom de l'adhérent
	 */
	protected $mPrenom;
	
	/**
	 * @var String
	 * @desc Nom de l'adhérent
	 */
	protected $mNom;
	
	/**
	 * @var String
	 * @desc Solde de l'adhérent
	 */
	protected $mSolde;
	
	/**
	 * @var array(BanqueVO)
	 * @desc Les Banques
	 */
	protected $mBanques;
	
	/**
	* @name InfoRechargementResponse()
	* @desc Le constructeur
	*/
	public function InfoRechargementResponse() {
		$this->mValid = true;
		$this->mBanques = array();
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
	* @return String
	* @desc Renvoie le Numero
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param String
	* @desc Remplace le Numero par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}
	
	/**
	* @name getIdCompte()
	* @return String
	* @desc Renvoie le IdCompte
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param String
	* @desc Remplace le IdCompte par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}
	
	/**
	* @name getCompte()
	* @return String
	* @desc Renvoie le Compte
	*/
	public function getCompte() {
		return $this->mCompte;
	}

	/**
	* @name setCompte($pCompte)
	* @param String
	* @desc Remplace le Compte par $pCompte
	*/
	public function setCompte($pCompte) {
		$this->mCompte = $pCompte;
	}
	
	/**
	* @name getPrenom()
	* @return String
	* @desc Renvoie le Prenom
	*/
	public function getPrenom() {
		return $this->mPrenom;
	}

	/**
	* @name setPrenom($pPrenom)
	* @param String
	* @desc Remplace le Prenom par $pPrenom
	*/
	public function setPrenom($pPrenom) {
		$this->mPrenom = $pPrenom;
	}
	
	/**
	* @name getNom()
	* @return String
	* @desc Renvoie le Nom
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param String
	* @desc Remplace le Nom par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}
	
	/**
	* @name getSolde()
	* @return String
	* @desc Renvoie le Solde
	*/
	public function getSolde() {
		return $this->mSolde;
	}

	/**
	* @name setSolde($pSolde)
	* @param String
	* @desc Remplace le Solde par $pSolde
	*/
	public function setSolde($pSolde) {
		$this->mSolde = $pSolde;
	}
	
	/**
	* @name getBanques()
	* @return array(BanqueVO)
	* @desc Renvoie les Banques
	*/
	public function getBanques() {
		return $this->mBanques;
	}

	/**
	* @name setBanques($pBanques)
	* @param array(BanqueVO)
	* @desc Remplace les Banques par $pBanques
	*/
	public function setBanques($pBanques) {
		$this->mBanques = $pBanques;
	}
	
	/**
	 * @name addBanques($pBanque)
	 * @param BanqueVO
	 * @desc Ajoute la Banque à Banques
	 */
	public function addBanques($pBanque) {
		array_push($this->mBanques,$pBanque);
	}
}
?>