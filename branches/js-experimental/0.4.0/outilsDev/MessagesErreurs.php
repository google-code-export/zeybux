<?php
//****************************************************************
//
// Createur : Guillaume PORTE
// Date de creation : 26/01/2010
// Fichier : MessagesErreurs.php
//
// Description : Classe statique stockant les constantes d'erreurs
//
//****************************************************************

/**
 * @name MessagesErreurs.php
 * @author Guillaume PORTE
 * @since 26/01/2010
 * 
 * @desc Classe statique stockant les constantes d'erreurs
 */
class MessagesErreurs
{
	/* ERREURS BDD */
	const ERR_BDD_CONNEXION = "Echec de la connexion à la base.";
	const ERR_BDD_SELECTION = "Echec de la sélection de la base.";
	const ERR_BDD_FERMETURE = "Echec de la fermeture de la connexion.";
	const ERR_BDD_EXECUTION = "Echec de l'exécution de la requête.";
}
?>
