<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/11/2013
// Fichier : ListeAdhesionVO.php
//
// Description : Classe ListeAdhesionVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdhesionVO
 * @author Julien PIERRE
 * @since 10/11/2013
 * @desc Classe représentant une ListeAdhesionVO
 */
class ListeAdhesionVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc AdadId de la ListeAdhesionVO
	*/
	protected $mAdadId;

	/**
	* @var varchar(20)
	* @desc PadLabel de la ListeAdhesionVO
	*/
	protected $mPadLabel;

	/**
	* @var varchar(45)
	* @desc TpaLabel de la ListeAdhesionVO
	*/
	protected $mTpaLabel;

	/**
	* @var decimal(10,2) 	
	* @desc TpaMontant de la ListeAdhesionVO
	*/
	protected $mTpaMontant;

	/**
	* @var varchar(45)
	* @desc AdsLabel de la ListeAdhesionVO
	*/
	protected $mAdsLabel;

	/**
	* @var datetime
	* @desc AdsDateDebut de la ListeAdhesionVO
	*/
	protected $mAdsDateDebut;

	/**
	* @var datetime
	* @desc AdsDateFin de la ListeAdhesionVO
	*/
	protected $mAdsDateFin;
	
	/**
	 * @name ListeAdhesionVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function ListeAdhesionVO($pAdadId = null, $pPadLabel = null, $pTpaLabel = null, $pTpaMontant = null, $pAdsLabel = null, $pAdsDateDebut = null, $pAdsDateFin = null) {
		if(!is_null($pAdadId)) { $this->mAdadId = $pAdadId; }
		if(!is_null($pPadLabel)) { $this->mPadLabel = $pPadLabel; }
		if(!is_null($pTpaLabel)) { $this->mTpaLabel = $pTpaLabel; }
		if(!is_null($pTpaMontant)) { $this->mTpaMontant = $pTpaMontant; }
		if(!is_null($pAdsLabel)) { $this->mAdsLabel = $pAdsLabel; }
		if(!is_null($pAdsDateDebut)) { $this->mAdsDateDebut = $pAdsDateDebut; }
		if(!is_null($pAdsDateFin)) { $this->mAdsDateFin = $pAdsDateFin; }
	}

	/**
	* @name getAdadId()
	* @return int(11)
	* @desc Renvoie le membre AdadId de la ListeAdhesionVO
	*/
	public function getAdadId() {
		return $this->mAdadId;
	}

	/**
	* @name setAdadId($pAdadId)
	* @param int(11)
	* @desc Remplace le membre AdadId de la ListeAdhesionVO par $pAdadId
	*/
	public function setAdadId($pAdadId) {
		$this->mAdadId = $pAdadId;
	}

	/**
	* @name getPadLabel()
	* @return varchar(20)
	* @desc Renvoie le membre PadLabel de la ListeAdhesionVO
	*/
	public function getPadLabel() {
		return $this->mPadLabel;
	}

	/**
	* @name setPadLabel($pPadLabel)
	* @param varchar(20)
	* @desc Remplace le membre PadLabel de la ListeAdhesionVO par $pPadLabel
	*/
	public function setPadLabel($pPadLabel) {
		$this->mPadLabel = $pPadLabel;
	}

	/**
	* @name getTpaLabel()
	* @return varchar(45)
	* @desc Renvoie le membre TpaLabel de la ListeAdhesionVO
	*/
	public function getTpaLabel() {
		return $this->mTpaLabel;
	}

	/**
	* @name setTpaLabel($pTpaLabel)
	* @param varchar(45)
	* @desc Remplace le membre TpaLabel de la ListeAdhesionVO par $pTpaLabel
	*/
	public function setTpaLabel($pTpaLabel) {
		$this->mTpaLabel = $pTpaLabel;
	}

	/**
	* @name getTpaMontant()
	* @return decimal(10,2) 	
	* @desc Renvoie le membre TpaMontant de la ListeAdhesionVO
	*/
	public function getTpaMontant() {
		return $this->mTpaMontant;
	}

	/**
	* @name setTpaMontant($pTpaMontant)
	* @param decimal(10,2) 	
	* @desc Remplace le membre TpaMontant de la ListeAdhesionVO par $pTpaMontant
	*/
	public function setTpaMontant($pTpaMontant) {
		$this->mTpaMontant = $pTpaMontant;
	}

	/**
	* @name getAdsLabel()
	* @return varchar(45)
	* @desc Renvoie le membre AdsLabel de la ListeAdhesionVO
	*/
	public function getAdsLabel() {
		return $this->mAdsLabel;
	}

	/**
	* @name setAdsLabel($pAdsLabel)
	* @param varchar(45)
	* @desc Remplace le membre AdsLabel de la ListeAdhesionVO par $pAdsLabel
	*/
	public function setAdsLabel($pAdsLabel) {
		$this->mAdsLabel = $pAdsLabel;
	}

	/**
	* @name getAdsDateDebut()
	* @return datetime
	* @desc Renvoie le membre AdsDateDebut de la ListeAdhesionVO
	*/
	public function getAdsDateDebut() {
		return $this->mAdsDateDebut;
	}

	/**
	* @name setAdsDateDebut($pAdsDateDebut)
	* @param datetime
	* @desc Remplace le membre AdsDateDebut de la ListeAdhesionVO par $pAdsDateDebut
	*/
	public function setAdsDateDebut($pAdsDateDebut) {
		$this->mAdsDateDebut = $pAdsDateDebut;
	}

	/**
	* @name getAdsDateFin()
	* @return datetime
	* @desc Renvoie le membre AdsDateFin de la ListeAdhesionVO
	*/
	public function getAdsDateFin() {
		return $this->mAdsDateFin;
	}

	/**
	* @name setAdsDateFin($pAdsDateFin)
	* @param datetime
	* @desc Remplace le membre AdsDateFin de la ListeAdhesionVO par $pAdsDateFin
	*/
	public function setAdsDateFin($pAdsDateFin) {
		$this->mAdsDateFin = $pAdsDateFin;
	}
}
?>