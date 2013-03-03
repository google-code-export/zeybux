<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : RechargementCompteVR.php
//
// Description : Classe RechargementCompteVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name RechargementCompteVR
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une RechargementCompteVR
 */
class RechargementCompteVR
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
	 * @desc Montant de la RechargementCompteVR
	 */
	private $mMontant;

	/**
	 * @var VRelement
	 * @desc TypePaiement de la RechargementCompteVR
	 */
	private $mTypePaiement;

	/**
	 * @var VRelement
	 * @desc ChampComplementaireObligatoire de la RechargementCompteVR
	 */
	private $mChampComplementaireObligatoire;

	/**
	 * @var VRelement
	 * @desc ChampComplementaire de la RechargementCompteVR
	 */
	private $mChampComplementaire;

	/**
	* @name RechargementCompteVR()
	* @return bool
	* @desc Constructeur
	*/
	function RechargementCompteVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mMontant = new VRelement();
		$this->mTypePaiement = new VRelement();
		$this->mChampComplementaireObligatoire = new VRelement();
		$this->mChampComplementaire = new VRelement();
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
	* @name getMontant()
	* @return VRelement
	* @desc Renvoie le VRelement mMontant
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param VRelement
	* @desc Remplace le mMontant par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getTypePaiement()
	* @return VRelement
	* @desc Renvoie le VRelement mTypePaiement
	*/
	public function getTypePaiement() {
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param VRelement
	* @desc Remplace le mTypePaiement par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}

	/**
	* @name getChampComplementaireObligatoire()
	* @return VRelement
	* @desc Renvoie le VRelement mChampComplementaireObligatoire
	*/
	public function getChampComplementaireObligatoire() {
		return $this->mChampComplementaireObligatoire;
	}

	/**
	* @name setChampComplementaireObligatoire($pChampComplementaireObligatoire)
	* @param VRelement
	* @desc Remplace le mChampComplementaireObligatoire par $pChampComplementaireObligatoire
	*/
	public function setChampComplementaireObligatoire($pChampComplementaireObligatoire) {
		$this->mChampComplementaireObligatoire = $pChampComplementaireObligatoire;
	}

	/**
	* @name getChampComplementaire()
	* @return VRelement
	* @desc Renvoie le VRelement mChampComplementaire
	*/
	public function getChampComplementaire() {
		return $this->mChampComplementaire;
	}

	/**
	* @name setChampComplementaire($pChampComplementaire)
	* @param VRelement
	* @desc Remplace le mChampComplementaire par $pChampComplementaire
	*/
	public function setChampComplementaire($pChampComplementaire) {
		$this->mChampComplementaire = $pChampComplementaire;
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