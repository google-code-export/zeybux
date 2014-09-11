<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/08/2010
// Fichier : ProduitCommandeToVO.php
//
// Description : Classe ProduitCommandeToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ProduitCommandeVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "DetailCommandeToVO.php" );

/**
 * @name ProduitCommandeToVO
 * @author Julien PIERRE
 * @since 29/08/2010
 * @desc Classe représentant une ProduitCommandeToVO
 */
class ProduitCommandeToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet ProduitCommandeVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->idNom)
			&& isset($lJson->nom)
			&& isset($lJson->description)
			&& isset($lJson->idCategorie)
			&& isset($lJson->categorie)
			&& isset($lJson->descriptionCategorie)
			&& isset($lJson->unite)
			&& isset($lJson->qteMaxCommande)
			&& isset($lJson->qteRestante)
			&& isset($lJson->type)
			&& isset($lJson->lots);

		if($lValid) {
			$lLots = json_decode($lJson->lots,true);
			if(is_array($lLots)) {
				$lVo = new ProduitCommandeVO();
				$lVo->setId($lJson->id);
				$lVo->setIdNom($lJson->idNom);
				$lVo->setNom($lJson->nom);
				$lVo->setDescription($lJson->description);
				$lVo->setIdCategorie($lJson->idCategorie);
				$lVo->setCategorie($lJson->categorie);
				$lVo->setDescriptionCategorie($lJson->descriptionCategorie);
				$lVo->setUnite($lJson->unite);
				$lVo->setQteMaxCommande($lJson->qteMaxCommande);
				$lVo->setQteRestante($lJson->qteRestante);
				$lVo->setType($lJson->type);
				foreach($lLots as $lLot) {
					$lVo->addLots(DetailCommandeToVO::convertFromArray($lLot));
				}
				return $lVo;
			}
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ProduitCommandeVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['idNom'])
			&& isset($pArray['nom'])
			&& isset($pArray['description'])
			&& isset($pArray['idCategorie'])
			&& isset($pArray['categorie'])
			&& isset($pArray['descriptionCategorie'])
			&& isset($pArray['unite'])
			&& isset($pArray['qteMaxCommande'])
			&& isset($pArray['qteRestante'])
			&& isset($pArray['type'])
			&& isset($pArray['lots'])
			&& is_array($pArray['lots']);

		if($lValid) {
			$lVo = new ProduitCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setIdNom($pArray['idNom']);
			$lVo->setNom($pArray['nom']);
			$lVo->setDescription($pArray['description']);
			$lVo->setIdCategorie($pArray['idCategorie']);
			$lVo->setCategorie($pArray['categorie']);
			$lVo->setDescriptionCategorie($pArray['descriptionCategorie']);
			$lVo->setUnite($pArray['unite']);
			$lVo->setQteMaxCommande($pArray['qteMaxCommande']);
			$lVo->setQteRestante($pArray['qteRestante']);
			$lVo->setType($pArray['type']);
			foreach($pArray['lots'] as $lLot) {
				$lVo->addLots(DetailCommandeToVO::convertFromArray($lLot));
			}
			return $lVo;
		}
		return NULL;
	}
}
?>