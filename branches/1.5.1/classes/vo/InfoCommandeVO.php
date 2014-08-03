<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/02/2011
// Fichier : InfoCommandeVO.php
//
// Description : Classe InfoCommandeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoCommandeVO
 * @author Julien PIERRE
 * @since 27/02/2011
 * @desc Classe représentant une InfoCommandeVO
 */
class InfoCommandeVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ComId de la InfoCommandeVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ProIdCompteFerme de la InfoCommandeVO
	*/
	protected $mProIdCompteFerme;

	/**
	* @var int(11)
	* @desc ProId de la InfoCommandeVO
	*/
	protected $mProId;

	/**
	* @var tinyint(4)
	* @desc ProType de la InfoCommandeVO
	*/
	protected $mProType;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la InfoCommandeVO
	*/
	protected $mProUniteMesure;

	/**
	* @var varchar(50)
	* @desc NproNom de la InfoCommandeVO
	*/
	protected $mNproNom;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la InfoCommandeVO
	*/
	protected $mOpeMontant;

	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la InfoCommandeVO
	*/
	protected $mStoQuantite;

	/**
	* @var decimal(10,2)
	* @desc OpeMontantLivraison de la InfoCommandeVO
	*/
	protected $mOpeMontantLivraison;

	/**
	* @var decimal(10,2)
	* @desc StoQuantiteLivraison de la InfoCommandeVO
	*/
	protected $mStoQuantiteLivraison;

	/**
	* @var decimal(10,2)
	* @desc StoQuantiteSolidaire de la InfoCommandeVO
	*/
	protected $mStoQuantiteSolidaire;

	/**
	* @var decimal(10,2)
	* @desc StoQuantiteVente de la InfoCommandeVO
	*/
	protected $mStoQuantiteVente;

	/**
	* @var decimal(10,2)
	* @desc StoQuantiteVenteSolidaire de la InfoCommandeVO
	*/
	protected $mStoQuantiteVenteSolidaire;

	/**
	* @var decimal(10,2)
	* @desc OpeMontantVente de la InfoCommandeVO
	*/
	protected $mOpeMontantVente;

	/**
	* @var decimal(10,2)
	* @desc OpeMontantVenteSolidaire de la InfoCommandeVO
	*/
	protected $mOpeMontantVenteSolidaire;
	
	/**
	 * @name InfoCommandeVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function InfoCommandeVO($pComId = null, $pProIdCompteFerme = null, $pProId = null, $pProType = null, $pUniteMesure = null, $pNproNom = null, $pOpeMontant = null, $pStoQuantite = null, $pOpeMontantLivraison = null, $pStoQuantiteLivraison = null, $pStoQuantiteSolidaire = null, $pStoQuantiteVente = null, $pStoQuantiteVenteSolidaire = null, $pOpeMontantVente =null, $pOpeMontantVenteSolidaire = null) {
		if(!is_null($pComId)) {
			$this->mComId = $pComId;
		}
		if(!is_null($pProIdCompteFerme)) {
			$this->mProIdCompteFerme = $pProIdCompteFerme;
		}
		if(!is_null($pProId)) {
			$this->mProId = $pProId;
		}
		if(!is_null($pProType)) {
			$this->mProType = $pProType;
		}
		if(!is_null($pUniteMesure)) {
			$this->mProUniteMesure = $pUniteMesure;
		}
		if(!is_null($pNproNom)) {
			$this->mNproNom = $pNproNom;
		}
		if(!is_null($pOpeMontant)) {
			$this->mOpeMontant = $pOpeMontant;
		}
		if(!is_null($pStoQuantite)) {
			$this->mStoQuantite = $pStoQuantite;
		}
		if(!is_null($pOpeMontantLivraison)) {
			$this->mOpeMontantLivraison = $pOpeMontantLivraison;
		}
		if(!is_null($pStoQuantiteLivraison)) {
			$this->mStoQuantiteLivraison = $pStoQuantiteLivraison;
		}
		if(!is_null($pStoQuantiteSolidaire)) {
			$this->mStoQuantiteSolidaire = $pStoQuantiteSolidaire;
		}		
		if(!is_null($pStoQuantiteVente)) {
			$this->mStoQuantiteVente = $pStoQuantiteVente;
		}
		if(!is_null($pStoQuantiteVenteSolidaire)) {
			$this->mStoQuantiteVenteSolidaire = $pStoQuantiteVenteSolidaire;
		}
		if(!is_null($pOpeMontantVente)) {
			$this->mOpeMontantVente = $pOpeMontantVente;
		}
		if(!is_null($pOpeMontantVenteSolidaire)) {
			$this->mOpeMontantVenteSolidaire = $pOpeMontantVenteSolidaire;
		}
	}

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la InfoCommandeVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la InfoCommandeVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getProIdCompteFerme()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteFerme de la InfoCommandeVO
	*/
	public function getProIdCompteFerme() {
		return $this->mProIdCompteFerme;
	}

	/**
	* @name setProIdCompteFerme($pProIdCompteFerme)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteFerme de la InfoCommandeVO par $pProIdCompteFerme
	*/
	public function setProIdCompteFerme($pProIdCompteFerme) {
		$this->mProIdCompteFerme = $pProIdCompteFerme;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la InfoCommandeVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la InfoCommandeVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProType()
	* @return tinyint(4)
	* @desc Renvoie le membre ProType de la InfoCommandeVO
	*/
	public function getProType() {
		return $this->mProType;
	}

	/**
	* @name setProType($pProType)
	* @param tinyint(4)
	* @desc Remplace le membre ProType de la InfoCommandeVO par $pProType
	*/
	public function setProType($pProType) {
		$this->mProType = $pProType;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la InfoCommandeVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la InfoCommandeVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la InfoCommandeVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la InfoCommandeVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la InfoCommandeVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la InfoCommandeVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la InfoCommandeVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la InfoCommandeVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}

	/**
	* @name getOpeMontantLivraison()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontantLivraison de la InfoCommandeVO
	*/
	public function getOpeMontantLivraison() {
		return $this->mOpeMontantLivraison;
	}

	/**
	* @name setOpeMontantLivraison($pOpeMontantLivraison)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontantLivraison de la InfoCommandeVO par $pOpeMontantLivraison
	*/
	public function setOpeMontantLivraison($pOpeMontantLivraison) {
		$this->mOpeMontantLivraison = $pOpeMontantLivraison;
	}

	/**
	* @name getStoQuantiteLivraison()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantiteLivraison de la InfoCommandeVO
	*/
	public function getStoQuantiteLivraison() {
		return $this->mStoQuantiteLivraison;
	}

	/**
	* @name setStoQuantiteLivraison($pStoQuantiteLivraison)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantiteLivraison de la InfoCommandeVO par $pStoQuantiteLivraison
	*/
	public function setStoQuantiteLivraison($pStoQuantiteLivraison) {
		$this->mStoQuantiteLivraison = $pStoQuantiteLivraison;
	}

	/**
	* @name getStoQuantiteSolidaire()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantiteSolidaire de la InfoCommandeVO
	*/
	public function getStoQuantiteSolidaire() {
		return $this->mStoQuantiteSolidaire;
	}

	/**
	* @name setStoQuantiteSolidaire($pStoQuantiteSolidaire)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantiteSolidaire de la InfoCommandeVO par $pStoQuantiteSolidaire
	*/
	public function setStoQuantiteSolidaire($pStoQuantiteSolidaire) {
		$this->mStoQuantiteSolidaire = $pStoQuantiteSolidaire;
	}

	/**
	* @name getStoQuantiteVente()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantiteVente de la InfoCommandeVO
	*/
	public function getStoQuantiteVente() {
		return $this->mStoQuantiteVente;
	}

	/**
	* @name setStoQuantiteVente($pStoQuantiteVente)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantiteVente de la InfoCommandeVO par $pStoQuantiteVente
	*/
	public function setStoQuantiteVente($pStoQuantiteVente) {
		$this->mStoQuantiteVente = $pStoQuantiteVente;
	}

	/**
	* @name getStoQuantiteVenteSolidaire()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantiteVenteSolidaire de la InfoCommandeVO
	*/
	public function getStoQuantiteVenteSolidaire() {
		return $this->mStoQuantiteVenteSolidaire;
	}

	/**
	* @name setStoQuantiteVenteSolidaire($pStoQuantiteVenteSolidaire)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantiteVenteSolidaire de la InfoCommandeVO par $pStoQuantiteVenteSolidaire
	*/
	public function setStoQuantiteVenteSolidaire($pStoQuantiteVenteSolidaire) {
		$this->mStoQuantiteVenteSolidaire = $pStoQuantiteVenteSolidaire;
	}

	/**
	* @name getOpeMontantVente()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontantVente de la InfoCommandeVO
	*/
	public function getOpeMontantVente() {
		return $this->mOpeMontantVente;
	}

	/**
	* @name setOpeMontantVente($pOpeMontantVente)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontantVente de la InfoCommandeVO par $pOpeMontantVente
	*/
	public function setOpeMontantVente($pOpeMontantVente) {
		$this->mOpeMontantVente = $pOpeMontantVente;
	}

	/**
	* @name getOpeMontantVenteSolidaire()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontantVenteSolidaire de la InfoCommandeVO
	*/
	public function getOpeMontantVenteSolidaire() {
		return $this->mOpeMontantVenteSolidaire;
	}

	/**
	* @name setOpeMontantVenteSolidaire($pOpeMontantVenteSolidaire)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontantVenteSolidaire de la InfoCommandeVO par $pOpeMontantVenteSolidaire
	*/
	public function setOpeMontantVenteSolidaire($pOpeMontantVenteSolidaire) {
		$this->mOpeMontantVenteSolidaire = $pOpeMontantVenteSolidaire;
	}

}
?>