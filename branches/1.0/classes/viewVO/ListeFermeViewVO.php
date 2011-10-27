<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : ListeFermeViewVO.php
//
// Description : Classe ListeFermeViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeFermeViewVO
 * @author Julien PIERRE
 * @since 23/10/2011
 * @desc Classe représentant une ListeFermeViewVO
 */
class ListeFermeViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc FerId de la ListeFermeViewVO
	*/
	protected $mFerId;

	/**
	* @var int(11)
	* @desc FerNumero de la ListeFermeViewVO
	*/
	protected $mFerNumero;

	/**
	* @var 	varchar(30)
	* @desc CptLabel de la ListeFermeViewVO
	*/
	protected $mCptLabel;

	/**
	* @var text
	* @desc FerNom de la ListeFermeViewVO
	*/
	protected $mFerNom;

	/**
	* @name getFerId()
	* @return int(11)
	* @desc Renvoie le membre FerId de la ListeFermeViewVO
	*/
	public function getFerId() {
		return $this->mFerId;
	}

	/**
	* @name setFerId($pFerId)
	* @param int(11)
	* @desc Remplace le membre FerId de la ListeFermeViewVO par $pFerId
	*/
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}

	/**
	* @name getFerNumero()
	* @return int(11)
	* @desc Renvoie le membre FerNumero de la ListeFermeViewVO
	*/
	public function getFerNumero() {
		return $this->mFerNumero;
	}

	/**
	* @name setFerNumero($pFerNumero)
	* @param int(11)
	* @desc Remplace le membre FerNumero de la ListeFermeViewVO par $pFerNumero
	*/
	public function setFerNumero($pFerNumero) {
		$this->mFerNumero = $pFerNumero;
	}

	/**
	* @name getCptLabel()
	* @return 	varchar(30)
	* @desc Renvoie le membre CptLabel de la ListeFermeViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param 	varchar(30)
	* @desc Remplace le membre CptLabel de la ListeFermeViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getFerNom()
	* @return text
	* @desc Renvoie le membre FerNom de la ListeFermeViewVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param text
	* @desc Remplace le membre FerNom de la ListeFermeViewVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}

}
?>