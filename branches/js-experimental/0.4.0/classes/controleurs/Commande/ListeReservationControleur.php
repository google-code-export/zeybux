<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/10/2010
// Fichier : ListeReservationControleur.php
//
// Description : Classe ListeReservationControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . "ListeReservationResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeReservationEnCoursViewManager.php");

/**
 * @name ListeReservationControleur
 * @author Julien PIERRE
 * @since 04/10/2010
 * @desc Classe controleur de la liste des reservations
 */
class ListeReservationControleur
{
	/**
	* @name getListeReservationEnCours()
	* @return ListeReservationResponse
	* @desc Retourne la liste des réservations d'un adhérent
	*/
	public function getListeReservationEnCours($pId) {
		$lResponse = new ListeReservationResponse();
		$lResponse->setReservations(ListeReservationEnCoursViewManager::select($pId));
		return $lResponse;
	}
}
?>
