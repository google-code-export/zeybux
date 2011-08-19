<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : ReservationCommandeToVO.php
//
// Description : Classe ReservationCommandeToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ReservationCommandeVO.php" );

/**
 * @name ReservationCommandeToVO
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une ReservationCommandeToVO
 */
class ReservationCommandeToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet ReservationCommandeVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->stoQuantite)
			&& isset($lJson->stoIdProduit);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($lJson->id);
			$lVo->setStoQuantite($lJson->stoQuantite);
			$lVo->setStoIdProduit($lJson->stoIdProduit);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ReservationCommandeVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['stoQuantite'])
			&& isset($pArray['stoIdProduit']);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setStoQuantite($pArray['stoQuantite']);
			$lVo->setStoIdProduit($pArray['stoIdProduit']);
			return $lVo;
		}
		return NULL;
	}
}
?>