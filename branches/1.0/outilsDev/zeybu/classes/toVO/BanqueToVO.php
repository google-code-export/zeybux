<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/01/2013
// Fichier : BanqueToVO.php
//
// Description : Classe BanqueToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "BanqueVO.php" );

/**
 * @name BanqueToVO
 * @author Julien PIERRE
 * @since 12/01/2013
 * @desc Classe représentant une BanqueToVO
 */
class BanqueToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet BanqueVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->id)
			&& isset($lJson->nomCourt)
			&& isset($lJson->nom)
			&& isset($lJson->description)
			&& isset($lJson->etat);

		if($lValid) {
			$lVo = new BanqueVO();
			$lVo->setId($lJson->id);
			$lVo->setId($lJson->id);
			$lVo->setNomCourt($lJson->nomCourt);
			$lVo->setNom($lJson->nom);
			$lVo->setDescription($lJson->description);
			$lVo->setEtat($lJson->etat);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet BanqueVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['id'])
			&& isset($pArray['nomCourt'])
			&& isset($pArray['nom'])
			&& isset($pArray['description'])
			&& isset($pArray['etat']);

		if($lValid) {
			$lVo = new BanqueVO();
			$lVo->setId($pArray['id']);
			$lVo->setId($pArray['id']);
			$lVo->setNomCourt($pArray['nomCourt']);
			$lVo->setNom($pArray['nom']);
			$lVo->setDescription($pArray['description']);
			$lVo->setEtat($pArray['etat']);
			return $lVo;
		}
		return NULL;
	}
}
?>