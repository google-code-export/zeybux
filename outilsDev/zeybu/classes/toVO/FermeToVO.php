<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : FermeToVO.php
//
// Description : Classe FermeToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "FermeVO.php" );

/**
 * @name FermeToVO
 * @author Julien PIERRE
 * @since 23/10/2011
 * @desc Classe représentant une FermeToVO
 */
class FermeToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet FermeVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id);

		if($lValid) {
			$lVo = new FermeVO();
			$lVo->setId($lJson->id);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet FermeVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id']);

		if($lValid) {
			$lVo = new FermeVO();
			$lVo->setId($pArray['id']);
			return $lVo;
		}
		return NULL;
	}
}
?>