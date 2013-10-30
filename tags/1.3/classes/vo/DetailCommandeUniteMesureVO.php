<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/05/2013
// Fichier : DetailCommandeUniteMesureVO.php
//
// Description : Classe DetailCommandeUniteMesureVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "DetailCommandeVO.php");

/**
 * @name DetailCommandeUniteMesureVO
 * @author Julien PIERRE
 * @since 26/07/2011
 * @desc Classe représentant une DetailCommandeUniteMesureVO
 */
class DetailCommandeUniteMesureVO  extends DetailCommandeVO
{

	/**
	* @var varchar(20)
	* @desc Unite de la DetailCommandeUniteMesureVO
	*/
	protected $mUnite;

	/**
	* @name getUnite()
	* @return varchar(20)
	* @desc Renvoie le membre Unite de la DetailCommandeUniteMesureVO
	*/
	public function getUnite() {
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param varchar(20)
	* @desc Remplace le membre Unite de la DetailCommandeUniteMesureVO par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}
}
?>