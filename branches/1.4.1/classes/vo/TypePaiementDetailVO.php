<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/07/2013
// Fichier : TypePaiementDetailVO.php
//
// Description : Classe TypePaiementDetailVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "TypePaiementVO.php");

/**
 * @name TypePaiementDetailVO
 * @author Julien PIERRE
 * @since 23/07/2013
 * @desc Classe représentant une TypePaiementDetailVO
 */
class TypePaiementDetailVO extends TypePaiementVO
{
	/**
	* @var array(TypePaiementDetailVO)
	* @desc ChampComplementaire de la TypePaiementDetailVO
	*/
	protected $mChampComplementaire;
	
	/**
	* @name TypePaiementDetailVO()
	* @desc Le constructeur
	*/
	public function TypePaiementDetailVO() {
		$this->mChampComplementaire = array();
	}
	
	/**
	* @name getChampComplementaire()
	* @return array(TypePaiementDetailVO)
	* @desc Renvoie le membre ChampComplementaire de la TypePaiementDetailVO
	*/
	public function getChampComplementaire(){
		return $this->mChampComplementaire;
	}

	/**
	* @name setChampComplementaire($pProduit)
	* @param array(TypePaiementDetailVO)
	* @desc Remplace le membre ChampComplementaire de la TypePaiementDetailVO par $pChampComplementaire
	*/
	public function setChampComplementaire($pChampComplementaire) {
		$this->mChampComplementaire = $pChampComplementaire;
	}
	
	/**
	* @name addChampComplementaire($pChampComplementaire)
	* @param TypePaiementDetailVO
	* @desc Ajoute $pProduit à ChampComplementaire
	*/
	public function addChampComplementaire($pChampComplementaire){
		array_push($this->mChampComplementaire,$pChampComplementaire);
	}
}
?>