<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/06/2013
// Fichier : ChampComplementaireDetailOperationVO.php
//
// Description : Classe ChampComplementaireDetailOperationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ChampComplementaireDetailOperationVO
 * @author Julien PIERRE
 * @since 23/06/2013
 * @desc Classe représentant une ChampComplementaireDetailOperationVO
 */
class ChampComplementaireDetailOperationVO  extends DataTemplate
{
	/**
	 * @var int(11)
	 * @desc TppCpTppId de la ChampComplementaireDetailOperationVO
	 */
	protected $mTppCpTppId;
	
	/**
	 * @var int(11)
	 * @desc TppCpChcpId de la ChampComplementaireDetailOperationVO
	 */
	protected $mTppCpChcpId;
	
	/**
	 * @var int(11)
	 * @desc TppCpOrdre de la ChampComplementaireDetailOperationVO
	 */
	protected $mTppCpOrdre;
	
	/**
	 * @var tinyint(1)
	 * @desc TppCpVisible de la ChampComplementaireDetailOperationVO
	 */
	protected $mTppCpVisible;
	
	/**
	 * @var tinyint(1)
	 * @desc TppCpEtat de la ChampComplementaireDetailOperationVO
	 */
	protected $mTppCpEtat;
		
	/**
	* @var int(11)
	* @desc ChCpId de la ChampComplementaireDetailOperationVO
	*/
	protected $mChCpId;

	/**
	* @var varchar(30)
	* @desc ChCpLabel de la ChampComplementaireDetailOperationVO
	*/
	protected $mChCpLabel;

	/**
	* @var tinyint(1)
	* @desc ChCpObligatoire de la ChampComplementaireDetailOperationVO
	*/
	protected $mChCpObligatoire;

	/**
	* @var tinyint(1)
	* @desc Etat de la ChampComplementaireDetailOperationVO
	*/
	protected $mChCpEtat;
	
	/**
	 * @var int(11)
	 * @desc OpeId de la ChampComplementaireDetailOperationVO
	 */
	protected $mOpeId;
	
	/**
	 * @var varchar(50)
	 * @desc Valeur de la ChampComplementaireDetailOperationVO
	 */
	protected $mValeur;
	
	/**
	 * @name getTppCpTppId()
	 * @return int(11)
	 * @desc Renvoie le membre TppCpTppId de la ChampComplementaireDetailOperationVO
	 */
	public function getTppCpTppId() {
		return $this->mTppCpTppId;
	}
	
	/**
	 * @name setTppCpTppId($pTppCpTppId)
	 * @param int(11)
	 * @desc Remplace le membre TppCpTppId de la ChampComplementaireDetailOperationVO par $pTppCpTppId
	 */
	public function setTppCpTppId($pTppCpTppId) {
		$this->mTppCpTppId = $pTppCpTppId;
	}
	
	/**
	 * @name getTppCpChcpId()
	 * @return int(11)
	 * @desc Renvoie le membre TppCpChcpId de la ChampComplementaireDetailOperationVO
	 */
	public function getTppCpChcpId() {
		return $this->mTppCpChcpId;
	}
	
	/**
	 * @name setTppCpChcpId($pTppCpChcpId)
	 * @param int(11)
	 * @desc Remplace le membre TppCpChcpId de la ChampComplementaireDetailOperationVO par $pTppCpChcpId
	 */
	public function setTppCpChcpId($pTppCpChcpId) {
		$this->mTppCpChcpId = $pTppCpChcpId;
	}
	
	/**
	 * @name getTppCpOrdre()
	 * @return int(11)
	 * @desc Renvoie le membre TppCpOrdre de la ChampComplementaireDetailOperationVO
	 */
	public function getTppCpOrdre() {
		return $this->mTppCpOrdre;
	}
	
	/**
	 * @name setTppCpOrdre($pTppCpOrdre)
	 * @param int(11)
	 * @desc Remplace le membre TppCpOrdre de la ChampComplementaireDetailOperationVO par $pTppCpOrdre
	 */
	public function setTppCpOrdre($pTppCpOrdre) {
		$this->mTppCpOrdre = $pTppCpOrdre;
	}
	
	/**
	 * @name getTppCpVisible()
	 * @return tinyint(1)
	 * @desc Renvoie le membre TppCpVisible de la ChampComplementaireDetailOperationVO
	 */
	public function getTppCpVisible() {
		return $this->mTppCpVisible;
	}
	
	/**
	 * @name setTppCpVisible($pTppCpVisible)
	 * @param tinyint(1)
	 * @desc Remplace le membre TppCpVisible de la ChampComplementaireDetailOperationVO par $pTppCpVisible
	 */
	public function setTppCpVisible($pTppCpVisible) {
		$this->mTppCpVisible = $pTppCpVisible;
	}
	
	/**
	 * @name getTppCpEtat()
	 * @return tinyint(1)
	 * @desc Renvoie le membre TppCpEtat de la ChampComplementaireDetailOperationVO
	 */
	public function getTppCpEtat() {
		return $this->mTppCpEtat;
	}
	
	/**
	 * @name setTppCpEtat($pTppCpEtat)
	 * @param tinyint(1)
	 * @desc Remplace le membre TppCpEtat de la ChampComplementaireDetailOperationVO par $pTppCpEtat
	 */
	public function setTppCpEtat($pTppCpEtat) {
		$this->mTppCpEtat = $pTppCpEtat;
	}

	/**
	* @name getChCpId()
	* @return int(11)
	* @desc Renvoie le membre ChCpId de la ChampComplementaireDetailOperationVO
	*/
	public function getChCpId() {
		return $this->mChCpId;
	}

	/**
	* @name setChCpId($pChCpId)
	* @param int(11)
	* @desc Remplace le membre ChCpId de la ChampComplementaireDetailOperationVO par $pChCpId
	*/
	public function setChCpId($pChCpId) {
		$this->mChCpId = $pChCpId;
	}

	/**
	* @name getChCpLabel()
	* @return varchar(30)
	* @desc Renvoie le membre ChCpLabel de la ChampComplementaireDetailOperationVO
	*/
	public function getChCpLabel() {
		return $this->mChCpLabel;
	}

	/**
	* @name setLabel($pChCpLabel)
	* @param varchar(30)
	* @desc Remplace le membre ChCpLabel de la ChampComplementaireDetailOperationVO par $pChCpLabel
	*/
	public function setChCpLabel($pChCpLabel) {
		$this->mChCpLabel = $pChCpLabel;
	}

	/**
	* @name getChCpObligatoire()
	* @return tinyint(1)
	* @desc Renvoie le membre ChCpObligatoire de la ChampComplementaireDetailOperationVO
	*/
	public function getChCpObligatoire() {
		return $this->mChCpObligatoire;
	}

	/**
	* @name setChCpObligatoire($pChCpObligatoire)
	* @param tinyint(1)
	* @desc Remplace le membre ChCpObligatoire de la ChampComplementaireDetailOperationVO par $pChCpObligatoire
	*/
	public function setChCpObligatoire($pChCpObligatoire) {
		$this->mChCpObligatoire = $pChCpObligatoire;
	}

	/**
	* @name getChCpEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre ChCpEtat de la ChampComplementaireDetailOperationVO
	*/
	public function getChCpEtat() {
		return $this->mChCpEtat;
	}

	/**
	* @name setChCpEtat($pChCpEtat)
	* @param tinyint(1)
	* @desc Remplace le membre ChCpEtat de la ChampComplementaireDetailOperationVO par $pChCpEtat
	*/
	public function setChCpEtat($pChCpEtat) {
		$this->mChCpEtat = $pChCpEtat;
	}
	
	/**
	 * @name getOpeId()
	 * @return int(11)
	 * @desc Renvoie le membre OpeId de la ChampComplementaireDetailOperationVO
	 */
	public function getOpeId() {
		return $this->mOpeId;
	}
	
	/**
	 * @name setOpeId($pOpeId)
	 * @param int(11)
	 * @desc Remplace le membre OpeId de la ChampComplementaireDetailOperationVO par $pOpeId
	 */
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}
		
	/**
	 * @name getValeur()
	 * @return varchar(50)
	 * @desc Renvoie le membre Valeur de la ChampComplementaireDetailOperationVO
	 */
	public function getValeur() {
		return $this->mValeur;
	}
	
	/**
	 * @name setValeur($pValeur)
	 * @param varchar(50)
	 * @desc Remplace le membre Valeur de la ChampComplementaireDetailOperationVO par $pValeur
	 */
	public function setValeur($pValeur) {
		$this->mValeur = $pValeur;
	}
}
?>