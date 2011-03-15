<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : ListeReservationCommandeToVO.php
//
// Description : Classe ListeReservationCommandeToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ListeReservationCommandeVO.php" );

/**
 * @name ListeReservationCommandeToVO
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une ListeReservationCommandeToVO
 */
class ListeReservationCommandeToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet ListeReservationCommandeVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->commandes);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($lJson->id);
			$lVo->setCommandes($lJson->commandes);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ListeReservationCommandeVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['commandes']);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setCommandes($pArray['commandes']);
			return $lVo;
		}
		return NULL;
	}
}
?>