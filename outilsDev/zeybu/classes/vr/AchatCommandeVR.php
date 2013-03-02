<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : AchatCommandeVR.php
//
// Description : Classe AchatCommandeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name AchatCommandeVR
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une AchatCommandeVR
 */
class AchatCommandeVR
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	private $mValid;

	/**
	 * @var VRelement
	 * @desc Le Log de l'objet
	 */
	private $mLog;

	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	private $mId;

	/**
	 * @var VRelement
	 * @desc IdCompte de la AchatCommandeVR
	 */
	private $mIdCompte;

	/**
	 * @var array(VRelement)
	 * @desc Produits de la AchatCommandeVR
	 */
	private $mProduits;

	/**
	 * @var VRelement
	 * @desc Rechargement de la AchatCommandeVR
	 */
	private $mRechargement;

	/**
	* @name AchatCommandeVR()
	* @return bool
	* @desc Constructeur
	*/
	function AchatCommandeVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdCompte = new VRelement();
		$this->mProduits = array();
		$this->mRechargement = new VRelement();
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
	* @name getIdCompte()
	* @return VRelement
	* @desc Renvoie le VRelement mIdCompte
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param VRelement
	* @desc Remplace le mIdCompte par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
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

	/**
	* @name getRechargement()
	* @return VRelement
	* @desc Renvoie le VRelement mRechargement
	*/
	public function getRechargement() {
		return $this->mRechargement;
	}

	/**
	* @name setRechargement($pRechargement)
	* @param VRelement
	* @desc Remplace le mRechargement par $pRechargement
	*/
	public function setRechargement($pRechargement) {
		$this->mRechargement = $pRechargement;
	}

	/**
	* @name export()
	* @return json
	* @desc Retourne la valeur des membres en les renommant au format tableau
	*/
	public function export() {
		$lMembres = get_object_vars($this);
		$lMembresJs = array();
		foreach($lMembres as $lCle => $lValeur) {
			$lCle = substr($lCle,1);
			$lCle[0] = strtolower($lCle[0]);
			if(is_object($lValeur)) {
				$lMembresJs[$lCle] = $lValeur->export();
			} else if(is_array($lValeur)) {
				$lMembresJs[$lCle] = $this->exportArray($lValeur);
			} else {
				$lMembresJs[$lCle] = $lValeur;
			}
		}
		return $lMembresJs;
	}

	/**
	* @name exportToJson()
	* @return json
	* @desc Retourne la valeur des membres en les renommant au format javascript
	*/
	public function exportToJson() {
		return json_encode($this->export());
	}

	/**
	* @name exportArray($pArray)
	* @return array()
	* @desc Retourne la valeur des membres en les renommant au format tableau
	*/
	public function exportArray($pArray) {
		if(is_array($pArray)) {
			$lMembresJs = array();
			foreach($pArray as $lCle => $lValeur) {
				if(is_object($lValeur)) {
					$lMembresJs[$lCle] = $lValeur->export();
				} else if(is_array($lValeur)) {
					$lMembresJs[$lCle] = $this->exportArray($lValeur);
				} else {
					$lMembresJs[$lCle] = $lValeur;
				}
			}
			return $lMembresJs;
		}
		return NULL;
	}

}
?>