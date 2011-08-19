<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : GestionProducteurVO.php
//
// Description : Classe GestionProducteurVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "ProducteurVO.php");

/**
 * @name GestionProducteurVO
 * @author Julien PIERRE
 * @since 23/12/2010
 * @desc Classe représentant un producteur avec son compte
 */
class GestionProducteurVO extends ProducteurVO
{
	/**
	 * @var varchar(30)
	 * @desc Compte de l'adhérent
	 */
	protected $mCompte;

	/**
	* @name getCompte()
	* @return varchar(30)
	* @desc Renvoie le Compte de l'Adherent
	*/
	public function getCompte() {
		return $this->mCompte;
	}
	
	/**
	* @name setCompte($pCompte)
	* @param varchar(30)
	* @desc Remplace le Compte du Producteur par $pCompte
	*/
	public function setCompte($pCompte) {
		$this->mCompte = $pCompte;
	}
}
?>