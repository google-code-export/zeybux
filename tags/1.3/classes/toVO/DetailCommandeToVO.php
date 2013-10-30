<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/08/2010
// Fichier : DetailCommandeToVO.php
//
// Description : Classe DetailCommandeToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "DetailCommandeVO.php" );

/**
 * @name DetailCommandeToVO
 * @author Julien PIERRE
 * @since 29/08/2010
 * @desc Classe représentant une DetailCommandeToVO
 */
class DetailCommandeToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet DetailCommandeVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->idProduit)
			&& isset($lJson->taille)
			&& isset($lJson->prix);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($lJson->id);
			$lVo->setIdProduit($lJson->idProduit);
			$lVo->setTaille($lJson->taille);
			$lVo->setPrix($lJson->prix);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet DetailCommandeVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['idProduit'])
			&& isset($pArray['taille'])
			&& isset($pArray['prix']);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setIdProduit($pArray['idProduit']);
			$lVo->setTaille($pArray['taille']);
			$lVo->setPrix($pArray['prix']);
			return $lVo;
		}
		return NULL;
	}
}
?>