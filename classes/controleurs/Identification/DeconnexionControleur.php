<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : DeconnexionControleur.php
//
// Description : Classe DeconnexionControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "AccesManager.php");

/**
 * @name DeconnexionControleur
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe controleur d'une DeconnexionControleur
 */
class DeconnexionControleur
{
	/**
	* @name deconnecter()
	* @desc Déconnecter l'utilisateur
	*/
	public function deconnecter() {	
		$lAcces = AccesManager::select($_SESSION[ID_CONNEXION]);
		$lAcces->setAutorise(0);
		AccesManager::update($lAcces); // Ferme l'accès pour cette connexion
		
		session_unset(); // Supprime les variables de session
		session_destroy();
		
		header('location:./index.php');
	}
}
?>