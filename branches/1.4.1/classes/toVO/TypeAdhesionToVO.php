<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : TypeAdhesionToVO.php
//
// Description : Classe TypeAdhesionToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "TypeAdhesionVO.php" );

/**
 * @name TypeAdhesionToVO
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une TypeAdhesionToVO
 */
class TypeAdhesionToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet TypeAdhesionVO
	*/
	public static function convertFromArray($pArray) {
		if(isset($pArray['id'])) { $lId = $pArray['id']; } else { $lId = null;}
		if(isset($pArray['idAdhesion'])) { $lIdAdhesion = $pArray['idAdhesion']; } else { $lIdAdhesion = null;}
		if(isset($pArray['label'])) { $lLabel = $pArray['label']; } else { $lLabel = null;}
		if(isset($pArray['idPerimetre'])) {  $lIdPerimetre = $pArray['idPerimetre']; } else { $lIdPerimetre = null;}
		if(isset($pArray['montant'])) {  $lMontant = $pArray['montant']; } else { $lMontant = null;}
		if(isset($pArray['dateCreation'])) {  $lDateCreation = $pArray['dateCreation']; } else { $lDateCreation = null;}
		if(isset($pArray['dateModification'])) { $lDateModification = $pArray['dateModification']; } else { $lDateModification = null;}
		if(isset($pArray['etat'])) {  $lEtat = $pArray['etat']; } else { $lEtat = null;}
		
		return new TypeAdhesionVO($lId, $lIdAdhesion, $lLabel, $lIdPerimetre, $lMontant, $lDateCreation, $lDateModification, $lEtat);
	}
}
?>