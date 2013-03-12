<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/09/2010
// Fichier : AdherentViewVO.php
//
// Description : Classe AdherentViewVO
//
//****************************************************************

/**
 * @name AdherentViewVO
 * @author Julien PIERRE
 * @since 09/09/2010
 * @desc Classe représentant une AdherentViewVO
 */
class AdherentViewVO
{
	/**
	* @var varchar(30)
	* @desc CptLabel de la AdherentViewVO
	*/
	private $mCptLabel;

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la AdherentViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la AdherentViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

}
?>