<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/04/2013
// Fichier : ProduitAjoutAchatToVO.php
//
// Description : Classe ProduitAjoutAchatToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ProduitAjoutAchatVO.php" );

/**
 * @name ProduitAjoutAchatToVO
 * @author Julien PIERRE
 * @since 14/04/2013
 * @desc Classe représentant une ProduitAjoutAchatToVO
 */
class ProduitAjoutAchatToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet ProduitAjoutAchatVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->idCompte)
			&& isset($lJson->idMarche)
			&& isset($lJson->idOperation)
			&& isset($lJson->idNomProduit)
			&& isset($lJson->quantite)
			&& isset($lJson->prix)
			&& isset($lJson->solidaire);

		if($lValid) {
			$lVo = new ProduitAjoutAchatVO();
			$lVo->setId($lJson->id);
			$lVo->setIdCompte($lJson->idCompte);
			$lVo->setIdMarche($lJson->idMarche);
			$lVo->setIdOperation($lJson->idOperation);
			$lVo->setIdNomProduit($lJson->idNomProduit);
			$lVo->setQuantite($lJson->quantite);
			$lVo->setPrix($lJson->prix);
			$lVo->setSolidaire($lJson->solidaire);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ProduitAjoutAchatVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['idCompte'])
			&& isset($pArray['idMarche'])
			&& isset($pArray['idOperation'])
			&& isset($pArray['idNomProduit'])
			&& isset($pArray['quantite'])
			&& isset($pArray['prix'])
			&& isset($pArray['solidaire']);

		if($lValid) {
			$lVo = new ProduitAjoutAchatVO();
			$lVo->setId($pArray['id']);
			$lVo->setIdCompte($pArray['idCompte']);
			$lVo->setIdMarche($pArray['idMarche']);
			$lVo->setIdOperation($pArray['idOperation']);
			$lVo->setIdNomProduit($pArray['idNomProduit']);
			$lVo->setQuantite($pArray['quantite']);
			$lVo->setPrix($pArray['prix']);
			$lVo->setSolidaire($pArray['solidaire']);
			return $lVo;
		}
		return NULL;
	}
}
?>