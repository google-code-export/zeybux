<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : CompteZeybuViewVO.php
//
// Description : Classe CompteZeybuViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteZeybuViewVO
 * @author Julien PIERRE
 * @since 24/12/2010
 * @desc Classe représentant une CompteZeybuViewVO
 */
class CompteZeybuViewVO  extends DataTemplate	
{
	/**
	* @var decimal(33,2) 	
	* @desc OpeMontant de la CompteZeybuViewVO
	*/
	protected $mOpeMontant;

	/**
	* @name getOpeMontant()
	* @return decimal(33,2) 	
	* @desc Renvoie le membre OpeMontant de la CompteZeybuViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(33,2) 	
	* @desc Remplace le membre OpeMontant de la CompteZeybuViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

}
?>