<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : AdherentSoldeVO.php
//
// Description : Classe AdherentSoldeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "AdherentVO.php");

/**
 * @name AdherentSoldeVO
 * @author Julien PIERRE
 * @since 01/02/2010
 * @desc Classe représentant un adhérent avec le solde de son compte
 */
class AdherentSoldeVO extends AdherentVO
{
	/**
	 * @var decimal
	 * @desc Solde de l'adhérent
	 */
	protected $mSolde;

	/**
	* @name getSolde()
	* @return decimal
	* @desc Renvoie le Solde de l'Adherent
	*/
	public function getSolde() {
		return $this->mSolde;
	}
	
	/**
	* @name setSolde($pSolde)
	* @param decimal
	* @desc Remplace le dans l'Adherent par $pSolde
	*/
	public function setSolde($pSolde) {
		$this->mSolde = $pSolde;
	}
}
?>
