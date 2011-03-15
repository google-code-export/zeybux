<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : SuppressionProducteurControleur.php
//
// Description : Classe SuppressionProducteurControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "ModifierProducteurResponse.php");

/**
 * @name SuppressionProducteurControleur
 * @author Julien PIERRE
 * @since 24/12/2010
 * @desc Classe controleur d'une Suppression d'un producteur
 */
class SuppressionProducteurControleur
{
	/**
	* @name supprimerProducteur($pParam)
	* @desc Passe le producteur en état supprimé
	*/
	public function supprimerProducteur($pParam) {
		$lId = $pParam['id_producteur'];		
		$lProducteur = ProducteurManager::select( $lId );
				
		// Change l'état
		$lProducteur->setEtat(2);
		ProducteurManager::update( $lProducteur );
			
		$lResponse = new ModifierProducteurResponse();
		$lResponse->setNumero($lProducteur->getNumero());
		
		return $lResponse;
	}
}
?>