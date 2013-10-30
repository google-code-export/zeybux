<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/10/2011
// Fichier : CategorieProduitToVO.php
//
// Description : Classe CategorieProduitToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "CategorieProduitVO.php" );

/**
 * @name CategorieProduitToVO
 * @author Julien PIERRE
 * @since 07/11/2010
 * @desc Classe représentant une CategorieProduitToVO
 */
class CategorieProduitToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet CategorieProduitVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->nom)
			&& isset($lJson->description);

		if($lValid) {
			$lVo = new CategorieProduitVO();
			$lVo->setId($lJson->id);
			$lVo->setNom($lJson->nom);
			$lVo->setDescription($lJson->description);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet CategorieProduitVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['nom'])
			&& isset($pArray['description']);

		if($lValid) {
			$lVo = new CategorieProduitVO();
			$lVo->setId($pArray['id']);
			$lVo->setNom($pArray['nom']);
			$lVo->setDescription($pArray['description']);
			return $lVo;
		}
		return NULL;
	}
}
?>