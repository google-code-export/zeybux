<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/03/2012
// Fichier : ListeProduitVO.php
//
// Description : Classe ListeProduitVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitVO
 * @author Julien PIERRE
 * @since 01/03/2012
 * @desc Classe représentant une ListeProduitVO
 */
class ListeProduitVO extends DataTemplate
{
	/**
	* @var array(ListeProduitFermeVO)
	* @desc Fermes de la ListeProduitVO
	*/
	protected $mFermes;
	
	/**
	* @name ListeProduitVO()
	* @desc Le constructeur
	*/
	public function ListeProduitVO() {
		$this->mFermes = array();
	}
	
	/**
	* @name getFermes()
	* @return array(ListeProduitFermeVO)
	* @desc Renvoie le membre Fermes de la ListeProduitVO
	*/
	public function getFermes(){
		return $this->mFermes;
	}

	/**
	* @name setFermes($pFermes)
	* @param array(ListeProduitFermeVO)
	* @desc Remplace le membre Fermes de la ListeProduitVO par $pFermes
	*/
	public function setFermes($pFermes) {
		$this->mFermes = $pFermes;
	}
	
	/**
	* @name addFermes($pFerme)
	* @param ListeProduitFermeVO
	* @desc Ajoute $pFerme à Fermes
	*/
	public function addFermes($pFerme){
		array_push($this->mFermes,$pFerme);
	}
}
?>