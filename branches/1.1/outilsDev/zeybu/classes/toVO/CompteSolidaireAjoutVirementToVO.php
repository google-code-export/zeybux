<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/07/2011
// Fichier : CompteSolidaireAjoutVirementToVO.php
//
// Description : Classe CompteSolidaireAjoutVirementToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "CompteSolidaireAjoutVirementVO.php" );

/**
 * @name CompteSolidaireAjoutVirementToVO
 * @author Julien PIERRE
 * @since 03/07/2011
 * @desc Classe représentant une CompteSolidaireAjoutVirementToVO
 */
class CompteSolidaireAjoutVirementToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet CompteSolidaireAjoutVirementVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->id)
			&& isset($lJson->montant);

		if($lValid) {
			$lVo = new CompteSolidaireAjoutVirementVO();
			$lVo->setId($lJson->id);
			$lVo->setId($lJson->id);
			$lVo->setMontant($lJson->montant);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet CompteSolidaireAjoutVirementVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['id'])
			&& isset($pArray['montant']);

		if($lValid) {
			$lVo = new CompteSolidaireAjoutVirementVO();
			$lVo->setId($pArray['id']);
			$lVo->setId($pArray['id']);
			$lVo->setMontant($pArray['montant']);
			return $lVo;
		}
		return NULL;
	}
}
?>