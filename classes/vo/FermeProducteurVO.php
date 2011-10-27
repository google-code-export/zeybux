<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/10/2011
// Fichier : FermeProducteurVO.php
//
// Description : Classe FermeProducteurVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name FermeProducteurVO
 * @author Julien PIERRE
 * @since 22/10/2011
 * @desc Classe représentant une FermeProducteurVO
 */
class FermeProducteurVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la FermeProducteurVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdFerme de la FermeProducteurVO
	*/
	protected $mIdFerme;

	/**
	* @var int(11)
	* @desc IdProducteur de la FermeProducteurVO
	*/
	protected $mIdProducteur;

	/**
	* @var tinyint(1)
	* @desc Etat de la FermeProducteurVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la FermeProducteurVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la FermeProducteurVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdFerme()
	* @return int(11)
	* @desc Renvoie le membre IdFerme de la FermeProducteurVO
	*/
	public function getIdFerme() {
		return $this->mIdFerme;
	}

	/**
	* @name setIdFerme($pIdFerme)
	* @param int(11)
	* @desc Remplace le membre IdFerme de la FermeProducteurVO par $pIdFerme
	*/
	public function setIdFerme($pIdFerme) {
		$this->mIdFerme = $pIdFerme;
	}

	/**
	* @name getIdProducteur()
	* @return int(11)
	* @desc Renvoie le membre IdProducteur de la FermeProducteurVO
	*/
	public function getIdProducteur() {
		return $this->mIdProducteur;
	}

	/**
	* @name setIdProducteur($pIdProducteur)
	* @param int(11)
	* @desc Remplace le membre IdProducteur de la FermeProducteurVO par $pIdProducteur
	*/
	public function setIdProducteur($pIdProducteur) {
		$this->mIdProducteur = $pIdProducteur;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la FermeProducteurVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la FermeProducteurVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>