<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/01/2012
// Fichier : MotDePasseUtils.php
//
// Description : Classe statique permettant de générer des mots de passe
//
//****************************************************************

// Inclusion des classes

/**
 * @name MotDePasseUtils
 * @author Julien PIERRE
 * @since 22/01/2012
 * 
 * @desc Classe statique permettant de générer des mots de passe
 */
class MotDePasseUtils
{
	/**
	* @name generer($pLongeur, $pPossible)
	* @desc génère un mot de passe aléatoire
	*/
	public static function generer($pLongeur=10, $pPossible='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
		$lPassword = '';
		$lPossibleLongueur = strlen($pPossible) - 1;

		while ($pLongeur--) {
			$lExcept = substr($lPassword, - $lPossibleLongueur / 2);

			for ($lN = 0 ; $lN < 5 ; $lN++) {
            	$lChar = $pPossible{mt_rand(0, $lPossibleLongueur)};
				if (strpos($lExcept, $lChar) === false) {
					break;
				}
			}
			$lPassword .= $lChar;
		}
		return $lPassword;
	}
}
?>