<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/08/2010
// Fichier : CommandeCompleteToVO.php
//
// Description : Classe CommandeCompleteToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "CommandeCompleteVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "ProduitCommandeToVO.php" );

/**
 * @name CommandeCompleteToVO
 * @author Julien PIERRE
 * @since 29/08/2010
 * @desc Classe représentant une CommandeCompleteToVO
 */
class CommandeCompleteToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet CommandeCompleteVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->numero)
			&& isset($lJson->nom)
			&& isset($lJson->description)
			&& isset($lJson->dateMarcheDebut)
			&& isset($lJson->timeMarcheDebut)
			&& isset($lJson->dateMarcheFin)
			&& isset($lJson->timeMarcheFin)
			&& isset($lJson->dateFinReservation)
			&& isset($lJson->timeFinReservation)
			&& isset($lJson->archive)
			&& isset($lJson->produits);

		if($lValid) {
			$lProduits = json_decode($lJson->produits,true);
			if(is_array($lProduits)) {
				$lVo = new CommandeCompleteVO();
				$lVo->setId($lJson->id);
				$lVo->setNumero($lJson->numero);
				$lVo->setNom($lJson->nom);
				$lVo->setDescription($lJson->description);
				$lVo->setDateMarcheDebut($lJson->dateMarcheDebut . " " . $lJson->timeMarcheDebut);
				$lVo->setDateMarcheFin($lJson->dateMarcheFin . " " . $lJson->timeMarcheFin);
				$lVo->setDateFinReservation($lJson->dateFinReservation . " " . $lJson->timeFinReservation);
				$lVo->setArchive($lJson->archive);
				foreach($lProduits as $lProduit) {
					$lVo->addProduits(ProduitCommandeToVO::convertFromArray($lProduit));
				}
				return $lVo;
			}
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet CommandeCompleteVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['numero'])
			&& isset($pArray['nom'])
			&& isset($pArray['description'])
			&& isset($pArray['dateMarcheDebut'])
			&& isset($pArray['timeMarcheDebut'])
			&& isset($pArray['dateMarcheFin'])
			&& isset($pArray['timeMarcheFin'])
			&& isset($pArray['dateFinReservation'])
			&& isset($pArray['timeFinReservation'])
			&& isset($pArray['archive'])
			&& isset($pArray['produits'])
			&& is_array($pArray['produits']);

		if($lValid) {
			$lVo = new CommandeCompleteVO();
			$lVo->setId($pArray['id']);
			$lVo->setNumero($pArray['numero']);
			$lVo->setNom($pArray['nom']);
			$lVo->setDescription($pArray['description']);
			$lVo->setDateMarcheDebut($pArray['dateMarcheDebut'] . " " . $pArray['timeMarcheDebut']);
			$lVo->setDateMarcheFin($pArray['dateMarcheFin'] . " " . $pArray['timeMarcheFin']);
			$lVo->setDateFinReservation($pArray['dateFinReservation'] . " " . $pArray['timeFinReservation']);
			$lVo->setArchive($pArray['archive']);
			foreach($pArray['produits'] as $lProduit) {
				$lVo->addProduits(ProduitCommandeToVO::convertFromArray($lProduit));
			}
			return $lVo;
		}
		return NULL;
	}
}
?>