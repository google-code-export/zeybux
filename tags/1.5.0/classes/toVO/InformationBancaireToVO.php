<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/06/2014
// Fichier : InformationBancaireToVO.php
//
// Description : Classe InformationBancaireToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "InformationBancaireVO.php" );

/**
 * @name InformationBancaireToVO
 * @author Julien PIERRE
 * @since 09/06/2014
 * @desc Classe représentant une InformationBancaireToVO
 */
class InformationBancaireToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet InformationBancaireVO
	*/
	public static function convertFromArray($pArray) {	
		if(isset($pArray['numeroCompte'])) { $lNumeroCompte = $pArray['numeroCompte']; } else { $lNumeroCompte = NULL; }			
		if(isset($pArray['raisonSociale'])) { $lRaisonSociale = $pArray['raisonSociale']; } else { $lRaisonSociale = NULL; }
		
		return new InformationBancaireVO(null, null, $lNumeroCompte, $lRaisonSociale);
	}
}
?>