<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : GroupeCommandeVO.php
//
// Description : Classe GroupeCommandeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name GroupeCommandeVO
 * @author Julien PIERRE
 * @since 02/09/2010
 * @desc Classe représentant une GroupeCommandeVO
 */
class GroupeCommandeVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la GroupeCommandeVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdCompte de la GroupeCommandeVO
	*/
	protected $mIdCompte;

	/**
	* @var int(11)
	* @desc IdCommande de la GroupeCommandeVO
	*/
	protected $mIdCommande;
	
	/**
	* @var tinyint(1)
	* @desc Etat de la GroupeCommandeVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la GroupeCommandeVO
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la GroupeCommandeVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la GroupeCommandeVO
	*/
	public function getIdCompte(){
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la GroupeCommandeVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getIdCommande()
	* @return int(11)
	* @desc Renvoie le membre IdCommande de la GroupeCommandeVO
	*/
	public function getIdCommande(){
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param int(11)
	* @desc Remplace le membre IdCommande de la GroupeCommandeVO par $pIdCommande
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}
	
	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la GroupeCommandeVO
	*/
	public function getEtat(){
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la GroupeCommandeVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>