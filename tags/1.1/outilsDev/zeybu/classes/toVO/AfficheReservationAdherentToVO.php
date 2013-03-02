<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/02/2011
// Fichier : AfficheReservationAdherentToVO.php
//
// Description : Classe AfficheReservationAdherentToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "AfficheReservationAdherentVO.php" );

/**
 * @name AfficheReservationAdherentToVO
 * @author Julien PIERRE
 * @since 06/02/2011
 * @desc Classe représentant une AfficheReservationAdherentToVO
 */
class AfficheReservationAdherentToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet AfficheReservationAdherentVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->id_adherent)
			&& isset($lJson->id_commande);

		if($lValid) {
			$lVo = new AfficheReservationAdherentVO();
			$lVo->setId($lJson->id);
			$lVo->setId_adherent($lJson->id_adherent);
			$lVo->setId_commande($lJson->id_commande);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet AfficheReservationAdherentVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['id_adherent'])
			&& isset($pArray['id_commande']);

		if($lValid) {
			$lVo = new AfficheReservationAdherentVO();
			$lVo->setId($pArray['id']);
			$lVo->setId_adherent($pArray['id_adherent']);
			$lVo->setId_commande($pArray['id_commande']);
			return $lVo;
		}
		return NULL;
	}
}
?>