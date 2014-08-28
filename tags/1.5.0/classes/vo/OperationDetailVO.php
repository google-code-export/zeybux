<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/06/2013
// Fichier : OperationDetailVO.php
//
// Description : Classe OperationDetailVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "OperationVO.php");

/**
 * @name OperationDetailVO
 * @author Julien PIERRE
 * @since 23/06/2013
 * @desc Classe représentant une OperationDetailVO
 */
class OperationDetailVO extends OperationVO
{
	/**
	 * @var int(11)
	 * @desc TppId de la OperationDetailVO
	 */
	protected $mTppId;
	
	/**
	 * @var varchar(100)
	 * @desc TppType de la OperationDetailVO
	 */
	protected $mTppType;
	
	/**
	 * @var tinyint(4)
	 * @desc TppChampComplementaire de la OperationDetailVO
	 */
	protected $mTppChampComplementaire;
	
	/**
	 * @var tinyint(1)
	 * @desc TppVisible de la OperationDetailVO
	 */
	protected $mTppVisible;
	
	/**
	* @var array(OperationDetailVO)
	* @desc ChampComplementaire de la OperationDetailVO
	*/
	protected $mChampComplementaire;
	
	/**
	* @name OperationDetailVO()
	* @desc Le constructeur
	*/
	public function OperationDetailVO($pId = null, $pIdCompte = null, $pMontant = null,$pLibelle = null, $pDate = null, $pTypePaiement = null, $pType = null, $pDateMaj = null, $pIdLogin = null, $pTppId = null, $pTppType = null, $pTppChamComplementaire = null, $pTppVisible = null, $pChampComplementaire = NULL) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pIdCompte)) { $this->mIdCompte = $pIdCompte; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }
		if(!is_null($pLibelle)) { $this->mLibelle = $pLibelle; }
		if(!is_null($pDate)) { $this->mDate = $pDate; }
		if(!is_null($pTypePaiement)) { $this->mTypePaiement = $pTypePaiement; }
		if(!is_null($pType)) { $this->mType = $pType; }
		if(!is_null($pDateMaj)) { $this->mDateMaj = $pDateMaj; }
		if(!is_null($pIdLogin)) { $this->mIdLogin = $pIdLogin; }
		if(!is_null($pTppId)) { $this->mTppId = $pTppId; }
		if(!is_null($pTppType)) { $this->mTppType = $pTppType; }
		if(!is_null($pTppChamComplementaire)) { $this->mTppChampComplementaire = $pTppChamComplementaire; }
		if(!is_null($pTppVisible)) { $this->mTppVisible = $pTppVisible; }
		if(!is_null($pChampComplementaire)) { $this->mChampComplementaire = $pChampComplementaire; } else { $this->mChampComplementaire = array(); }
	}
	
	/**
	 * @name getTppId()
	 * @return int(11)
	 * @desc Renvoie le membre TppId de la OperationDetailVO
	 */
	public function getTppId() {
		return $this->mTppId;
	}
	
	/**
	 * @name setTppId($pTppId)
	 * @param int(11)
	 * @desc Remplace le membre TppId de la OperationDetailVO par $pTppId
	 */
	public function setTppId($pTppId) {
		$this->mTppId = $pTppId;
	}
	
	/**
	 * @name getTppType()
	 * @return varchar(100)
	 * @desc Renvoie le membre TppType de la OperationDetailVO
	 */
	public function getTppType() {
		return $this->mTppType;
	}
	
	/**
	 * @name setTppType($pTppType)
	 * @param varchar(100)
	 * @desc Remplace le membre TppType de la OperationDetailVO par $pTppType
	 */
	public function setTppType($pTppType) {
		$this->mTppType = $pTppType;
	}
	
	/**
	 * @name getTppChampComplementaire()
	 * @return tinyint(4)
	 * @desc Renvoie le membre TppChampComplementaire de la OperationDetailVO
	 */
	public function getTppChampComplementaire() {
		return $this->mTppChampComplementaire;
	}
	
	/**
	 * @name setTppChampComplementaire($pTppChampComplementaire)
	 * @param tinyint(4)
	 * @desc Remplace le membre TppChampComplementaire de la OperationDetailVO par $pTppChampComplementaire
	 */
	public function setTppChampComplementaire($pTppChampComplementaire) {
		$this->mTppChampComplementaire = $pTppChampComplementaire;
	}
	
	/**
	 * @name getTppVisible()
	 * @return tinyint(1)
	 * @desc Renvoie le membre TppVisible de la OperationDetailVO
	 */
	public function getTppVisible() {
		return $this->mTppVisible;
	}
	
	/**
	 * @name setTppVisible($pTppVisible)
	 * @param tinyint(1)
	 * @desc Remplace le membre TppVisible de la OperationDetailVO par $pTppVisible
	 */
	public function setTppVisible($pTppVisible) {
		$this->mTppVisible = $pTppVisible;
	}
	
	/**
	* @name getChampComplementaire()
	* @return array(OperationDetailVO)
	* @desc Renvoie le membre ChampComplementaire de la OperationDetailVO
	*/
	public function getChampComplementaire(){
		return $this->mChampComplementaire;
	}

	/**
	* @name setChampComplementaire($pProduit)
	* @param array(OperationDetailVO)
	* @desc Remplace le membre ChampComplementaire de la OperationDetailVO par $pChampComplementaire
	*/
	public function setChampComplementaire($pChampComplementaire) {
		$this->mChampComplementaire = $pChampComplementaire;
	}
	
	/**
	* @name addChampComplementaire($pChampComplementaire)
	* @param OperationDetailVO
	* @desc Ajoute $pProduit à ChampComplementaire
	*/
	public function addChampComplementaire($pChampComplementaire){
		array_push($this->mChampComplementaire,$pChampComplementaire);
	}
}
?>