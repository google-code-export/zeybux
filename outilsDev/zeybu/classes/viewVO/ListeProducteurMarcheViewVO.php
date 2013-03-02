<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/11/2011
// Fichier : ListeProducteurMarcheViewVO.php
//
// Description : Classe ListeProducteurMarcheViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProducteurMarcheViewVO
 * @author Julien PIERRE
 * @since 09/11/2011
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
	* @desc ProIdCompteFerme de la ListeProducteurMarcheViewVO
	*/
	protected $mProIdCompteFerme;

	/**
	* @var text
	* @desc FerNom de la ListeProducteurMarcheViewVO
	*/
	protected $mFerNom;

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
	* @name getProIdCompteFerme()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteFerme de la ListeProducteurMarcheViewVO
	*/
	public function getProIdCompteFerme() {
		return $this->mProIdCompteFerme;
	}

	/**
	* @name setProIdCompteFerme($pProIdCompteFerme)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteFerme de la ListeProducteurMarcheViewVO par $pProIdCompteFerme
	*/
	public function setProIdCompteFerme($pProIdCompteFerme) {
		$this->mProIdCompteFerme = $pProIdCompteFerme;
	}

	/**
	* @name getFerNom()
	* @return text
	* @desc Renvoie le membre FerNom de la ListeProducteurMarcheViewVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param text
	* @desc Remplace le membre FerNom de la ListeProducteurMarcheViewVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}

}
?>