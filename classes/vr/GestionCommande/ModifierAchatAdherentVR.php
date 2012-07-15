<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/08/2011
// Fichier : ModifierAchatAdherentVR.php
//
// Description : Classe ModifierAchatAdherentVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ModifierAchatAdherentVR
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une ModifierAchatAdherentVR
 */
class ModifierAchatAdherentVR extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;

	/**
	 * @var VRelement
	 * @desc Le Log de l'objet
	 */
	protected $mLog;

	/**
	 * @var VRelement
	 * @desc L'IdAchat de l'objet
	 */
	protected $mIdAchat;
	
	/**
	 * @var VRelement
	 * @desc L'IdMarche de l'objet
	 */
	protected $mIdMarche;
	
	/**
	 * @var VRelement
	 * @desc L'IdCompte de l'objet
	 */
	protected $mIdCompte;

	/**
	 * @var VRelement
	 * @desc IdCompte de la ModifierAchatAdherentVR
	 */
	protected $mTotal;

	/**
	 * @var array(VRelement)
	 * @desc Produits de la ModifierAchatAdherentVR
	 */
	protected $mProduits;

	/**
	* @name ModifierAchatAdherentVR()
	* @return bool
	* @desc Constructeur
	*/
	function ModifierAchatAdherentVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mIdAchat = new VRelement();
		$this->mIdMarche = new VRelement();
		$this->mIdCompte = new VRelement();
		$this->mTotal = new VRelement();
		$this->mProduits = array();
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
	* @name getLog()
	* @return VRelement
	* @desc Renvoie le VRelement Log
	*/
	public function getLog() {
		return $this->mLog;
	}

	/**
	* @name setLog($pLog)
	* @param VRelement
	* @desc Remplace le VRelement Log par $pLog
	*/
	public function setLog($pLog) {
		$this->mLog = $pLog;
	}

	/**
	* @name getIdAchat()
	* @return VRelement
	* @desc Renvoie le VRelement IdAchat
	*/
	public function getIdAchat() {
		return $this->mIdAchat;
	}

	/**
	* @name setIdAchat($pIdAchat)
	* @param VRelement
	* @desc Remplace le VRelement IdAchat par $pIdAchat
	*/
	public function setIdAchat($pIdAchat) {
		$this->mIdAchat = $pIdAchat;
	}
	
	/**
	* @name getIdMarche()
	* @return VRelement
	* @desc Renvoie le VRelement IdMarche
	*/
	public function getIdMarche() {
		return $this->mIdMarche;
	}

	/**
	* @name setIdMarche($pIdMarche)
	* @param VRelement
	* @desc Remplace le VRelement IdMarche par $pIdMarche
	*/
	public function setIdMarche($pIdMarche) {
		$this->mIdMarche = $pIdMarche;
	}
	
	/**
	* @name getIdCompte()
	* @return VRelement
	* @desc Renvoie le VRelement IdCompte
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param VRelement
	* @desc Remplace le VRelement IdCompte par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getTotal()
	* @return VRelement
	* @desc Renvoie le VRelement mTotal
	*/
	public function getTotal() {
		return $this->mTotal;
	}

	/**
	* @name setTotal($pTotal)
	* @param VRelement
	* @desc Remplace le mTotal par $pTotal
	*/
	public function setTotal($pTotal) {
		$this->mTotal = $pTotal;
	}

	/**
	* @name getProduits()
	* @return VRelement
	* @desc Renvoie le VRelement mProduits
	*/
	public function getProduits() {
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduits)
	* @param VRelement
	* @desc Remplace le mProduits par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}

	/**
	* @name addProduits($pProduits)
	* @param VRelement
	* @desc Ajoute le $pProduits à mProduits
	*/
	public function addProduits($pProduits) {
		array_push($this->mProduits,$pProduits);
	}
}
?>