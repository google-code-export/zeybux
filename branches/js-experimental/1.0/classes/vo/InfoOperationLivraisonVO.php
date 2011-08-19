<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/08/2011
// Fichier : InfoOperationLivraisonVO.php
//
// Description : Classe InfoOperationLivraisonVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoOperationLivraisonVO
 * @author Julien PIERRE
 * @since 12/08/2011
 * @desc Classe représentant une InfoOperationLivraisonVO
 */
class InfoOperationLivraisonVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la InfoOperationLivraisonVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdOpeZeybu de la InfoOperationLivraisonVO
	*/
	protected $mIdOpeZeybu;

	/**
	* @var int(11)
	* @desc IdOpeProducteur de la InfoOperationLivraisonVO
	*/
	protected $mIdOpeProducteur;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la InfoOperationLivraisonVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la InfoOperationLivraisonVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdOpeZeybu()
	* @return int(11)
	* @desc Renvoie le membre IdOpeZeybu de la InfoOperationLivraisonVO
	*/
	public function getIdOpeZeybu() {
		return $this->mIdOpeZeybu;
	}

	/**
	* @name setIdOpeZeybu($pIdOpeZeybu)
	* @param int(11)
	* @desc Remplace le membre IdOpeZeybu de la InfoOperationLivraisonVO par $pIdOpeZeybu
	*/
	public function setIdOpeZeybu($pIdOpeZeybu) {
		$this->mIdOpeZeybu = $pIdOpeZeybu;
	}

	/**
	* @name getIdOpeProducteur()
	* @return int(11)
	* @desc Renvoie le membre IdOpeProducteur de la InfoOperationLivraisonVO
	*/
	public function getIdOpeProducteur() {
		return $this->mIdOpeProducteur;
	}

	/**
	* @name setIdOpeProducteur($pIdOpeProducteur)
	* @param int(11)
	* @desc Remplace le membre IdOpeProducteur de la InfoOperationLivraisonVO par $pIdOpeProducteur
	*/
	public function setIdOpeProducteur($pIdOpeProducteur) {
		$this->mIdOpeProducteur = $pIdOpeProducteur;
	}

}
?>