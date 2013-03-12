<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/01/2011
// Fichier : SupprimerReservationToVO.php
//
// Description : Classe SupprimerReservationToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "SupprimerReservationVO.php" );

/**
 * @name SupprimerReservationToVO
 * @author Julien PIERRE
 * @since 26/01/2011
 * @desc Classe représentant une SupprimerReservationToVO
 */
class SupprimerReservationToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet SupprimerReservationVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->id_commande)
			&& isset($lJson->id_adherent);

		if($lValid) {
			$lVo = new SupprimerReservationVO();
			$lVo->setId($lJson->id);
			$lVo->setId_commande($lJson->id_commande);
			$lVo->setId_adherent($lJson->id_adherent);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet SupprimerReservationVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['id_commande'])
			&& isset($pArray['id_adherent']);

		if($lValid) {
			$lVo = new SupprimerReservationVO();
			$lVo->setId($pArray['id']);
			$lVo->setId_commande($pArray['id_commande']);
			$lVo->setId_adherent($pArray['id_adherent']);
			return $lVo;
		}
		return NULL;
	}
}
?>