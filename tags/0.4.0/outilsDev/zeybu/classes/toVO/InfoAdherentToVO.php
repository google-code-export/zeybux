<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : InfoAdherentToVO.php
//
// Description : Classe InfoAdherentToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "InfoAdherentVO.php" );

/**
 * @name InfoAdherentToVO
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe représentant une InfoAdherentToVO
 */
class InfoAdherentToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet InfoAdherentVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->motPass)
			&& isset($lJson->motPassNouveau)
			&& isset($lJson->motPasseConfirm);

		if($lValid) {
			$lVo = new InfoAdherentVO();
			$lVo->setId($lJson->id);
			$lVo->setMotPass($lJson->motPass);
			$lVo->setMotPassNouveau($lJson->motPassNouveau);
			$lVo->setMotPasseConfirm($lJson->motPasseConfirm);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet InfoAdherentVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['motPass'])
			&& isset($pArray['motPassNouveau'])
			&& isset($pArray['motPasseConfirm']);

		if($lValid) {
			$lVo = new InfoAdherentVO();
			$lVo->setId($pArray['id']);
			$lVo->setMotPass($pArray['motPass']);
			$lVo->setMotPassNouveau($pArray['motPassNouveau']);
			$lVo->setMotPasseConfirm($pArray['motPasseConfirm']);
			return $lVo;
		}
		return NULL;
	}
}
?>