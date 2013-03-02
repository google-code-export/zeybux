<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/01/2011
// Fichier : ExportListeReservationToVO.php
//
// Description : Classe ExportListeReservationToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ExportListeReservationVO.php" );

/**
 * @name ExportListeReservationToVO
 * @author Julien PIERRE
 * @since 02/01/2011
 * @desc Classe représentant une ExportListeReservationToVO
 */
class ExportListeReservationToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet ExportListeReservationVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->id_commande)
			&& isset($lJson->id_produits);

		if($lValid) {
			$lVo = new ExportListeReservationVO();
			$lVo->setId($lJson->id);
			$lVo->setId_commande($lJson->id_commande);
			$lVo->setId_produits($lJson->id_produits);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ExportListeReservationVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['id_commande'])
			&& isset($pArray['id_produits']);

		if($lValid) {
			$lVo = new ExportListeReservationVO();
			$lVo->setId($pArray['id']);
			$lVo->setId_commande($pArray['id_commande']);
			$lVo->setId_produits($pArray['id_produits']);
			return $lVo;
		}
		return NULL;
	}
}
?>