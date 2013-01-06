<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/01/2011
// Fichier : ProduitsBonDeCommandeToVO.php
//
// Description : Classe ProduitsBonDeCommandeToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ProduitsBonDeCommandeVO.php" );

/**
 * @name ProduitsBonDeCommandeToVO
 * @author Julien PIERRE
 * @since 18/01/2011
 * @desc Classe représentant une ProduitsBonDeCommandeToVO
 */
class ProduitsBonDeCommandeToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet ProduitsBonDeCommandeVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->id_commande)
			&& isset($lJson->id_producteur)
			&& isset($lJson->export)
			&& isset($lJson->produits);

		if($lValid) {
			$lVo = new ProduitsBonDeCommandeVO();
			$lVo->setId($lJson->id);
			$lVo->setId_commande($lJson->id_commande);
			$lVo->setId_producteur($lJson->id_producteur);
			$lVo->setExport($lJson->export);
			$lVo->setProduits($lJson->produits);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ProduitsBonDeCommandeVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['id_commande'])
			&& isset($pArray['id_producteur'])
			&& isset($pArray['export'])
			&& isset($pArray['produits']);

		if($lValid) {
			$lVo = new ProduitsBonDeCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setId_commande($pArray['id_commande']);
			$lVo->setId_producteur($pArray['id_producteur']);
			$lVo->setExport($pArray['export']);
			$lVo->setProduits($pArray['produits']);
			return $lVo;
		}
		return NULL;
	}
}
?>