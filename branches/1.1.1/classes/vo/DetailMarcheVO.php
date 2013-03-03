<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/07/2011
// Fichier : DetailMarcheVO.php
//
// Description : Classe DetailMarcheVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailMarcheVO
 * @author Julien PIERRE
 * @since 13/07/2011
 * @desc Classe représentant une DetailMarcheVO
 */
class DetailMarcheVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la DetailMarcheVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc Taille de la DetailMarcheVO
	*/
	protected $mTaille;

	/**
	* @var decimal(10,2)
	* @desc Prix de la DetailMarcheVO
	*/
	protected $mPrix;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la DetailMarcheVO
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la DetailMarcheVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getTaille()
	* @return int(11)
	* @desc Renvoie le membre Taille de la DetailMarcheVO
	*/
	public function getTaille(){
		return $this->mTaille;
	}

	/**
	* @name setTaille($pTaille)
	* @param int(11)
	* @desc Remplace le membre Taille de la DetailMarcheVO par $pTaille
	*/
	public function setTaille($pTaille) {
		$this->mTaille = $pTaille;
	}

	/**
	* @name getPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre Prix de la DetailMarcheVO
	*/
	public function getPrix(){
		return $this->mPrix;
	}

	/**
	* @name setPrix($pPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre Prix de la DetailMarcheVO par $pPrix
	*/
	public function setPrix($pPrix) {
		$this->mPrix = $pPrix;
	}

}
?>