<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2012
// Fichier : ListeProduitsNonAbonneViewVO.php
//
// Description : Classe ListeProduitsNonAbonneViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitsNonAbonneViewVO
 * @author Julien PIERRE
 * @since 15/02/2012
 * @desc Classe représentant une ListeProduitsNonAbonneViewVO
 */
class ListeProduitsNonAbonneViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProAboId de la ListeProduitsNonAbonneViewVO
	*/
	protected $mProAboId;
	
	/**
	* @var int(11)
	* @desc FerId de la ListeProduitsNonAbonneViewVO
	*/
	protected $mFerId;
	
	/**
	* @var int(11)
	* @desc CproId de la ListeProduitsNonAbonneViewVO
	*/
	protected $mCproId;
	
	/**
	* @var int(11)
	* @desc NproId de la ListeProduitsNonAbonneViewVO
	*/
	protected $mNproId;

	/**
	* @var varchar(50)
	* @desc NproNom de la ListeProduitsNonAbonneViewVO
	*/
	protected $mNproNom;

	/**
	* @var varchar(50)
	* @desc CproNom de la ListeProduitsNonAbonneViewVO
	*/
	protected $mCproNom;
	
	/**
	* @var text
	* @desc FerNom de la ListeProduitsNonAbonneViewVO
	*/
	protected $mFerNom;

	/**
	* @name getProAboId()
	* @return int(11)
	* @desc Renvoie le membre ProAboId de la ListeProduitsNonAbonneViewVO
	*/
	public function getProAboId() {
		return $this->mProAboId;
	}

	/**
	* @name setProAboId($pProAboId)
	* @param int(11)
	* @desc Remplace le membre ProAboId de la ListeProduitsNonAbonneViewVO par $pProAboId
	*/
	public function setProAboId($pProAboId) {
		$this->mProAboId = $pProAboId;
	}

	/**
	* @name getFerId()
	* @return int(11)
	* @desc Renvoie le membre FerId de la ListeProduitsNonAbonneViewVO
	*/
	public function getFerId() {
		return $this->mFerId;
	}

	/**
	* @name setFerId($pFerId)
	* @param int(11)
	* @desc Remplace le membre FerId de la ListeProduitsNonAbonneViewVO par $pFerId
	*/
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}

	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la ListeProduitsNonAbonneViewVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la ListeProduitsNonAbonneViewVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}

	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la ListeProduitsNonAbonneViewVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la ListeProduitsNonAbonneViewVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getFerNom()
	* @return text
	* @desc Renvoie le membre FerNom de la ListeProduitsNonAbonneViewVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param text
	* @desc Remplace le membre FerNom de la ListeProduitsNonAbonneViewVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la ListeProduitsNonAbonneViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la ListeProduitsNonAbonneViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la ListeProduitsNonAbonneViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la ListeProduitsNonAbonneViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}

}
?>