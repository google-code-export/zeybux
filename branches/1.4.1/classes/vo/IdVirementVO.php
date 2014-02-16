<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : IdVirementVO.php
//
// Description : Classe IdVirementVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name IdVirementVO
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une IdVirementVO
 */
class IdVirementVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc IdDebit de la IdVirementVO
	*/
	protected $mIdDebit;
	
	/**
	* @var int(11)
	* @desc IdCredit de la IdVirementVO
	*/
	protected $mIdCredit;

	/**
	* @name getIdDebit()
	* @return int(11)
	* @desc Renvoie le membre IdDebit de la IdVirementVO
	*/
	public function getIdDebit() {
		return $this->mIdDebit;
	}

	/**
	* @name setIdDebit($pIdDebit)
	* @param int(11)
	* @desc Remplace le membre IdDebit de la IdVirementVO par $pIdDebit
	*/
	public function setIdDebit($pIdDebit) {
		$this->mIdDebit = $pIdDebit;
	}
	
	/**
	* @name getIdCredit()
	* @return int(11)
	* @desc Renvoie le membre IdCredit de la IdVirementVO
	*/
	public function getIdCredit() {
		return $this->mIdCredit;
	}

	/**
	* @name setIdCredit($pIdCredit)
	* @param int(11)
	* @desc Remplace le membre IdCredit de la IdVirementVO par $pIdCredit
	*/
	public function setIdCredit($pIdCredit) {
		$this->mIdCredit = $pIdCredit;
	}
}
?>