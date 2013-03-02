<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : ProduitAchatToVO.php
//
// Description : Classe ProduitAchatToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ProduitAchatVO.php" );

/**
 * @name ProduitAchatToVO
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une ProduitAchatToVO
 */
class ProduitAchatToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet ProduitAchatVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->quantite)
			&& isset($lJson->prix);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($lJson->id);
			$lVo->setQuantite($lJson->quantite);
			$lVo->setPrix($lJson->prix);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ProduitAchatVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['quantite'])
			&& isset($pArray['prix']);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setQuantite($pArray['quantite']);
			$lVo->setPrix($pArray['prix']);
			return $lVo;
		}
		return NULL;
	}
}
?>