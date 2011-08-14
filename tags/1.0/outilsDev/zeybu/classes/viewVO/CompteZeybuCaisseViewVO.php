<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : CompteZeybuCaisseViewVO.php
//
// Description : Classe CompteZeybuCaisseViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteZeybuCaisseViewVO
 * @author Julien PIERRE
 * @since 24/12/2010
 * @desc Classe représentant une CompteZeybuCaisseViewVO
 */
class CompteZeybuCaisseViewVO  extends DataTemplate	
{
	/**
	* @var decimal(33,2) 
	* @desc OpeMontant de la CompteZeybuCaisseViewVO
	*/
	protected $mOpeMontant;

	/**
	* @name getOpeMontant()
	* @return decimal(33,2) 
	* @desc Renvoie le membre OpeMontant de la CompteZeybuCaisseViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(33,2) 
	* @desc Remplace le membre OpeMontant de la CompteZeybuCaisseViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

}
?>