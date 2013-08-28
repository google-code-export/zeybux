<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/08/2013
// Fichier : TypePaiementChampComplementaireVO.php
//
// Description : Classe TypePaiementChampComplementaireVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name TypePaiementChampComplementaireVO
 * @author Julien PIERRE
 * @since 27/08/2013
 * @desc Classe représentant une TypePaiementChampComplementaireVO
 */
class TypePaiementChampComplementaireVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc TppId de la TypePaiementChampComplementaireVO
	*/
	protected $mTppId;

	/**
	* @var int(11)
	* @desc ChcpId de la TypePaiementChampComplementaireVO
	*/
	protected $mChcpId;

	/**
	* @var tinyint(1)
	* @desc MajAutorise de la TypePaiementChampComplementaireVO
	*/
	protected $mMajAutorise;

	/**
	* @var int(11)
	* @desc Ordre de la TypePaiementChampComplementaireVO
	*/
	protected $mOrdre;

	/**
	* @var tinyint(1)
	* @desc Visible de la TypePaiementChampComplementaireVO
	*/
	protected $mVisible;

	/**
	* @var tinyint(1)
	* @desc Etat de la TypePaiementChampComplementaireVO
	*/
	protected $mEtat;

	/**
	 * @name TypePaiementChampComplementaireVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function TypePaiementChampComplementaireVO($pTppId = null, $pChcpId = null, $pMajAutorise = null, $pOrdre = null, $pVisible = null, $pEtat = null) {
		if(!is_null($pTppId)) { $this->mTppId = $pTppId; }
		if(!is_null($pChcpId)) { $this->mChcpId = $pChcpId; }
		if(!is_null($pMajAutorise)) { $this->mMajAutorise = $pMajAutorise; }
		if(!is_null($pOrdre)) { $this->mOrdre = $pOrdre; }
		if(!is_null($pVisible)) { $this->mVisible = $pVisible; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}

	/**
	* @name getTppId()
	* @return int(11)
	* @desc Renvoie le membre TppId de la TypePaiementChampComplementaireVO
	*/
	public function getTppId() {
		return $this->mTppId;
	}

	/**
	* @name setTppId($pTppId)
	* @param int(11)
	* @desc Remplace le membre TppId de la TypePaiementChampComplementaireVO par $pTppId
	*/
	public function setTppId($pTppId) {
		$this->mTppId = $pTppId;
	}

	/**
	* @name getChcpId()
	* @return int(11)
	* @desc Renvoie le membre ChcpId de la TypePaiementChampComplementaireVO
	*/
	public function getChcpId() {
		return $this->mChcpId;
	}

	/**
	* @name setChcpId($pChcpId)
	* @param int(11)
	* @desc Remplace le membre ChcpId de la TypePaiementChampComplementaireVO par $pChcpId
	*/
	public function setChcpId($pChcpId) {
		$this->mChcpId = $pChcpId;
	}

	/**
	* @name getMajAutorise()
	* @return tinyint(1)
	* @desc Renvoie le membre MajAutorise de la TypePaiementChampComplementaireVO
	*/
	public function getMajAutorise() {
		return $this->mMajAutorise;
	}

	/**
	* @name setMajAutorise($pMajAutorise)
	* @param tinyint(1)
	* @desc Remplace le membre MajAutorise de la TypePaiementChampComplementaireVO par $pMajAutorise
	*/
	public function setMajAutorise($pMajAutorise) {
		$this->mMajAutorise = $pMajAutorise;
	}

	/**
	* @name getOrdre()
	* @return int(11)
	* @desc Renvoie le membre Ordre de la TypePaiementChampComplementaireVO
	*/
	public function getOrdre() {
		return $this->mOrdre;
	}

	/**
	* @name setOrdre($pOrdre)
	* @param int(11)
	* @desc Remplace le membre Ordre de la TypePaiementChampComplementaireVO par $pOrdre
	*/
	public function setOrdre($pOrdre) {
		$this->mOrdre = $pOrdre;
	}

	/**
	* @name getVisible()
	* @return tinyint(1)
	* @desc Renvoie le membre Visible de la TypePaiementChampComplementaireVO
	*/
	public function getVisible() {
		return $this->mVisible;
	}

	/**
	* @name setVisible($pVisible)
	* @param tinyint(1)
	* @desc Remplace le membre Visible de la TypePaiementChampComplementaireVO par $pVisible
	*/
	public function setVisible($pVisible) {
		$this->mVisible = $pVisible;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la TypePaiementChampComplementaireVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la TypePaiementChampComplementaireVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>