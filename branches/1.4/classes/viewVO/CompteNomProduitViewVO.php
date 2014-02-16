<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/11/2011
// Fichier : CompteNomProduitViewVO.php
//
// Description : Classe CompteNomProduitViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteNomProduitViewVO
 * @author Julien PIERRE
 * @since 08/11/2011
 * @desc Classe représentant une CompteNomProduitViewVO
 */
class CompteNomProduitViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc NproId de la CompteNomProduitViewVO
	*/
	protected $mNproId;

	/**
	* @var int(11)
	* @desc FerId de la CompteNomProduitViewVO
	*/
	protected $mFerId;

	/**
	* @var int(11)
	* @desc FerIdCompte de la CompteNomProduitViewVO
	*/
	protected $mFerIdCompte;

	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la CompteNomProduitViewVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la CompteNomProduitViewVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getFerId()
	* @return int(11)
	* @desc Renvoie le membre FerId de la CompteNomProduitViewVO
	*/
	public function getFerId() {
		return $this->mFerId;
	}

	/**
	* @name setFerId($pFerId)
	* @param int(11)
	* @desc Remplace le membre FerId de la CompteNomProduitViewVO par $pFerId
	*/
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}

	/**
	* @name getFerIdCompte()
	* @return int(11)
	* @desc Renvoie le membre FerIdCompte de la CompteNomProduitViewVO
	*/
	public function getFerIdCompte() {
		return $this->mFerIdCompte;
	}

	/**
	* @name setFerIdCompte($pFerIdCompte)
	* @param int(11)
	* @desc Remplace le membre FerIdCompte de la CompteNomProduitViewVO par $pFerIdCompte
	*/
	public function setFerIdCompte($pFerIdCompte) {
		$this->mFerIdCompte = $pFerIdCompte;
	}

}
?>