<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : AchatCommandeToVO.php
//
// Description : Classe AchatCommandeToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "AchatCommandeVO.php" );

/**
 * @name AchatCommandeToVO
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une AchatCommandeToVO
 */
class AchatCommandeToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet AchatCommandeVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->idCompte)
			&& isset($lJson->produits)
			&& isset($lJson->rechargement);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($lJson->id);
			$lVo->setIdCompte($lJson->idCompte);
			$lVo->setProduits($lJson->produits);
			$lVo->setRechargement($lJson->rechargement);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet AchatCommandeVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['idCompte'])
			&& isset($pArray['produits'])
			&& isset($pArray['rechargement']);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setIdCompte($pArray['idCompte']);
			$lVo->setProduits($pArray['produits']);
			$lVo->setRechargement($pArray['rechargement']);
			return $lVo;
		}
		return NULL;
	}
}
?>