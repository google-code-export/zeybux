<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/04/2013
// Fichier : StockQuantiteToVO.php
//
// Description : Classe StockQuantiteToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "StockQuantiteVO.php" );

/**
 * @name StockQuantiteToVO
 * @author Julien PIERRE
 * @since 30/04/2013
 * @desc Classe représentant une StockQuantiteToVO
 */
class StockQuantiteToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet StockQuantiteVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->quantite)
			&& isset($lJson->quantiteSolidaire);

		if($lValid) {
			$lVo = new StockQuantiteVO();
			$lVo->setId($lJson->id);
			$lVo->setQuantite($lJson->quantite);
			$lVo->setQuantiteSolidaire($lJson->quantiteSolidaire);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet StockQuantiteVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['quantite'])
			&& isset($pArray['quantiteSolidaire']);

		if($lValid) {
			$lVo = new StockQuantiteVO();
			$lVo->setId($pArray['id']);
			$lVo->setQuantite($pArray['quantite']);
			$lVo->setQuantiteSolidaire($pArray['quantiteSolidaire']);
			return $lVo;
		}
		return NULL;
	}
}
?>