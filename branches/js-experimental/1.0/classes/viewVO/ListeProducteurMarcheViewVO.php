<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/01/2011
// Fichier : ListeProducteurMarcheViewVO.php
//
// Description : Classe ListeProducteurMarcheViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProducteurMarcheViewVO
 * @author Julien PIERRE
 * @since 03/01/2011
 * @desc Classe représentant une ListeProducteurMarcheViewVO
 */
class ListeProducteurMarcheViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProIdCommande de la ListeProducteurMarcheViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc PrdtIdCompte de la ListeProducteurMarcheViewVO
	*/
	protected $mPrdtIdCompte;

	/**
	* @var varchar(50)
	* @desc PrdtNom de la ListeProducteurMarcheViewVO
	*/
	protected $mPrdtNom;

	/**
	* @var varchar(50)
	* @desc PrdtPrenom de la ListeProducteurMarcheViewVO
	*/
	protected $mPrdtPrenom;

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la ListeProducteurMarcheViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la ListeProducteurMarcheViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getPrdtIdCompte()
	* @return int(11)
	* @desc Renvoie le membre PrdtIdCompte de la ListeProducteurMarcheViewVO
	*/
	public function getPrdtIdCompte() {
		return $this->mPrdtIdCompte;
	}

	/**
	* @name setPrdtIdCompte($pPrdtIdCompte)
	* @param int(11)
	* @desc Remplace le membre PrdtIdCompte de la ListeProducteurMarcheViewVO par $pPrdtIdCompte
	*/
	public function setPrdtIdCompte($pPrdtIdCompte) {
		$this->mPrdtIdCompte = $pPrdtIdCompte;
	}

	/**
	* @name getPrdtNom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtNom de la ListeProducteurMarcheViewVO
	*/
	public function getPrdtNom() {
		return $this->mPrdtNom;
	}

	/**
	* @name setPrdtNom($pPrdtNom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtNom de la ListeProducteurMarcheViewVO par $pPrdtNom
	*/
	public function setPrdtNom($pPrdtNom) {
		$this->mPrdtNom = $pPrdtNom;
	}

	/**
	* @name getPrdtPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtPrenom de la ListeProducteurMarcheViewVO
	*/
	public function getPrdtPrenom() {
		return $this->mPrdtPrenom;
	}

	/**
	* @name setPrdtPrenom($pPrdtPrenom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtPrenom de la ListeProducteurMarcheViewVO par $pPrdtPrenom
	*/
	public function setPrdtPrenom($pPrdtPrenom) {
		$this->mPrdtPrenom = $pPrdtPrenom;
	}

}
?>