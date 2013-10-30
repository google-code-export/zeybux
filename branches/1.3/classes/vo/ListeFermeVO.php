<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : ListeFermeVO.php
//
// Description : Classe ListeFermeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeFermeVO
 * @author Julien PIERRE
 * @since 23/10/2011
 * @desc Classe représentant une ListeFermeVO
 */
class ListeFermeVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc FerId de la ListeFermeVO
	*/
	protected $mFerId;

	/**
	* @var int(11)
	* @desc FerNumero de la ListeFermeVO
	*/
	protected $mFerNumero;

	/**
	* @var 	varchar(30)
	* @desc CptLabel de la ListeFermeVO
	*/
	protected $mCptLabel;

	/**
	* @var text
	* @desc FerNom de la ListeFermeVO
	*/
	protected $mFerNom;

	/**
	* @var int(11)
	* @desc FerIdCompte de la ListeFermeVO
	*/
	protected $mFerIdCompte;
	
	/**
	 * @name ListeFermeVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function ListeFermeVO($pFerId = null, $pFerNumero = null, $pCptLabel = null, $pFerNom = null, $pFerIdCompte = null) {
		if(!is_null($pFerId)) { $this->mFerId = $pFerId; }
		if(!is_null($pFerNumero)) { $this->mFerNumero = $pFerNumero; }
		if(!is_null($pCptLabel)) { $this->mCptLabel = $pCptLabel; }
		if(!is_null($pFerNom)) { $this->mFerNom = $pFerNom; }
		if(!is_null($pFerIdCompte)) { $this->mFerIdCompte = $pFerIdCompte; }
	}
	
	/**
	* @name getFerId()
	* @return int(11)
	* @desc Renvoie le membre FerId de la ListeFermeVO
	*/
	public function getFerId() {
		return $this->mFerId;
	}

	/**
	* @name setFerId($pFerId)
	* @param int(11)
	* @desc Remplace le membre FerId de la ListeFermeVO par $pFerId
	*/
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}

	/**
	* @name getFerNumero()
	* @return int(11)
	* @desc Renvoie le membre FerNumero de la ListeFermeVO
	*/
	public function getFerNumero() {
		return $this->mFerNumero;
	}

	/**
	* @name setFerNumero($pFerNumero)
	* @param int(11)
	* @desc Remplace le membre FerNumero de la ListeFermeVO par $pFerNumero
	*/
	public function setFerNumero($pFerNumero) {
		$this->mFerNumero = $pFerNumero;
	}

	/**
	* @name getCptLabel()
	* @return 	varchar(30)
	* @desc Renvoie le membre CptLabel de la ListeFermeVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param 	varchar(30)
	* @desc Remplace le membre CptLabel de la ListeFermeVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getFerNom()
	* @return text
	* @desc Renvoie le membre FerNom de la ListeFermeVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param text
	* @desc Remplace le membre FerNom de la ListeFermeVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}

	/**
	* @name getFerIdCompte()
	* @return int(11)
	* @desc Renvoie le membre FerIdCompte de la ListeFermeVO
	*/
	public function getFerIdCompte() {
		return $this->mFerIdCompte;
	}

	/**
	* @name setFerIdCompte($pFerIdCompte)
	* @param int(11)
	* @desc Remplace le membre FerIdCompte de la ListeFermeVO par $pFerIdCompte
	*/
	public function setFerIdCompte($pFerIdCompte) {
		$this->mFerIdCompte = $pFerIdCompte;
	}
}
?>