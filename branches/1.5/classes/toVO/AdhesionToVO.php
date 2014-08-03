<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : AdhesionToVO.php
//
// Description : Classe AdhesionToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "AdhesionVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "TypeAdhesionToVO.php" );

/**
 * @name AdhesionToVO
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une AdhesionToVO
 */
class AdhesionToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet AdhesionVO
	*/
	public static function convertFromArray($pArray) {		
		if(isset($pArray['id'])) { $lId = $pArray['id']; } else { $lId = NULL; }
		if(isset($pArray['label'])) { $lLabel = $pArray['label']; } else { $lLabel = NULL; }
		if(isset($pArray['dateDebut'])) { $lDateDebut = $pArray['dateDebut']; } else { $lDateDebut = NULL; }
		if(isset($pArray['dateFin'])) { $lDateFin = $pArray['dateFin']; } else { $lDateFin = NULL; }
		if(isset($pArray['dateCreation'])) { $lDateCreation = $pArray['dateCreation']; } else { $lDateCreation = NULL; }
		if(isset($pArray['dateModification'])) { $lDateModification = $pArray['dateModification']; } else { $lDateModification = NULL; }
		if(isset($pArray['etat'])) { $lEtat = $pArray['etat']; } else {  $lEtat = NULL; }
		
		if(isset($pArray['types'])) {
			$lTypes = array();
			foreach($pArray['types'] as $lType) {
				if(!is_null($lType)) {
					array_push($lTypes, TypeAdhesionToVO::convertFromArray($lType));
				}
			}
		} else { $lTypes = NULL; }
		
		return new AdhesionDetailVO($lId, $lLabel, $lDateDebut, $lDateFin, $lDateCreation, $lDateModification, $lEtat, $lTypes);
	}
}
?>