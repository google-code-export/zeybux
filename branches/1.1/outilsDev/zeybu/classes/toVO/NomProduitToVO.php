<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/11/2010
// Fichier : NomProduitToVO.php
//
// Description : Classe NomProduitToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "NomProduitVO.php" );

/**
 * @name NomProduitToVO
 * @author Julien PIERRE
 * @since 07/11/2010
 * @desc Classe représentant une NomProduitToVO
 */
class NomProduitToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet NomProduitVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->nom)
			&& isset($lJson->description)
			&& isset($lJson->idCategorie);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($lJson->id);
			$lVo->setNom($lJson->nom);
			$lVo->setDescription($lJson->description);
			$lVo->setIdCategorie($lJson->idCategorie);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet NomProduitVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['nom'])
			&& isset($pArray['description'])
			&& isset($pArray['idCategorie']);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setNom($pArray['nom']);
			$lVo->setDescription($pArray['description']);
			$lVo->setIdCategorie($pArray['idCategorie']);
			return $lVo;
		}
		return NULL;
	}
}
?>