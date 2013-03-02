<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/01/2011
// Fichier : totoViewVO.php
//
// Description : Classe totoViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name totoViewVO
 * @author Julien PIERRE
 * @since 02/01/2011
 * @desc Classe représentant une totoViewVO
 */
class totoViewVO  extends DataTemplate	
{
	/**
	* @var entier
	* @desc alpha de la totoViewVO
	*/
	protected $malpha;

	/**
	* @name getalpha()
	* @return entier
	* @desc Renvoie le membre alpha de la totoViewVO
	*/
	public function getalpha() {
		return $this->malpha;
	}

	/**
	* @name setalpha($palpha)
	* @param entier
	* @desc Remplace le membre alpha de la totoViewVO par $palpha
	*/
	public function setalpha($palpha) {
		$this->malpha = $palpha;
	}

}
?>