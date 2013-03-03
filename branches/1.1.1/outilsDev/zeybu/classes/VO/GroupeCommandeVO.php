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

/**
 * @name GroupeCommandeVO
 * @author Julien PIERRE
 * @since 02/09/2010
 * @desc Classe représentant une GroupeCommandeVO
 */
class GroupeCommandeVO
{
	/**
	* @var int(11)
	* @desc Id de la GroupeCommandeVO
	*/
	private $mId;

	/**
	* @var int(11)
	* @desc IdCompte de la GroupeCommandeVO
	*/
	private $mIdCompte;

	/**
	* @var int(11)
	* @desc IdCommande de la GroupeCommandeVO
	*/
	private $mIdCommande;

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

}
?>