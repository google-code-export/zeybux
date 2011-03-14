<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2010
// Fichier : IdentificationToVO.php
//
// Description : Classe IdentificationToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "IdentificationVO.php" );

/**
 * @name IdentificationToVO
 * @author Julien PIERRE
 * @since 01/11/2010
 * @desc Classe représentant une IdentificationToVO
 */
class IdentificationToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet IdentificationVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->login)
			&& isset($lJson->pass);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($lJson->id);
			$lVo->setLogin($lJson->login);
			$lVo->setPass($lJson->pass);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet IdentificationVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['login'])
			&& isset($pArray['pass']);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setLogin($pArray['login']);
			$lVo->setPass($pArray['pass']);
			return $lVo;
		}
		return NULL;
	}
}
?>