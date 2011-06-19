<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/01/2010
// Fichier : StringUtils.php
//
// Description : Classe d'utilitaire pour la gestion des String
//
//****************************************************************

/**
 * @name StringUtils
 * @author Julien PIERRE
 * @since 27/01/2010
 * 
 * @desc Classe d'utilitaire pour la gestion des String
 */
class StringUtils
{
	const FORMAT_DATE_NULLE = "0000-00-00";

	/**
	* @name securiser($pString)
	* @param string
	* @return string
	* @desc Convertit les caractères spéciaux de $pString en entités HTML et renvoie la chaine
	*/
	public static function securiser($pString) {
		return htmlspecialchars($pString , ENT_QUOTES, 'UTF-8');
	}

	/**
	* @name formaterNom($pString)
	* @param string
	* @return string
	* @desc Met en majuscule $pString et renvoie la chaine
	*/
	public static function formaterNom($pString) {
		return mb_strtoupper($pString,'UTF-8');
	}

	/**
	* @name formaterPrenom($pString)
	* @param string
	* @return string
	* @desc Met en majuscule la première lettre de $pString et le reste en minuscule, puis renvoie la chaine
	*/
	public static function formaterPrenom($pString) {
		return ucfirst( strtolower($pString) );
	}

	/**
	* @name formaterVille($pString)
	* @param string
	* @return string
	* @desc Met en majuscule $pString et renvoie la chaine
	*/
	public static function formaterVille($pString) {
		return mb_strtoupper($pString,'UTF-8');
	}

	/**
	* @name verifierCourriel($pAdresse)
	* @param string
	* @return bool
	* @desc Vérifie que l'adresse correspond au format d'un courriel
	*/
	public static function verifierCourriel($pAdresse) {
		$lSyntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
		
		return preg_match($lSyntaxe,$pAdresse);
	}

	/**
	* @name verifierDateFr($pDate)
	* @param string
	* @return bool
	* @desc Vérifie que $pDate correspond au format d'une date française
	*/
	public static function verifierDateFr($pDate) {
		$lSyntaxe = '#^\d{2}/\d{2}/\d{4}$#';
		$lRetour = false;
		
		if ( preg_match($lSyntaxe,$pDate) ) {
			(int)$lMois = $pDate[3].$pDate[4];
			(int)$lJour = $pDate[0].$pDate[1];
			(int)$lAnnee = $pDate[6].$pDate[7].$pDate[8].$pDate[9];

			$lRetour = checkdate($lMois, $lJour, $lAnnee);
		}
		
		return $lRetour;
	}

	/**
	* @name dateFrToDb($pDate)
	* @param string
	* @return string
	* @desc Transforme $pDate d'un format français (jj/mm/aaaa) en format BDD (aaaa-mm-jj)
	*/
	public static function dateFrToDb($pDate) {
		return $pDate[6].$pDate[7].$pDate[8].$pDate[9].'-'.$pDate[3].$pDate[4].'-'.$pDate[0].$pDate[1];
	}

	/**
	* @name dateDbToFr($pDate)
	* @param string
	* @return string
	* @desc Transforme $pDate d'un format BDD (aaaa-mm-jj) en format français (jj/mm/aaaa)
	*/
	public static function dateDbToFr($pDate) {
		return $pDate[8].$pDate[9].'/'.$pDate[5].$pDate[6].'/'.$pDate[0].$pDate[1].$pDate[2].$pDate[3];
	}

	
	/**
	* @name extractDate($pDateTime)
	* @param string
	* @return string
	* @desc Extrait la date de $pDateTime d'un format BDD (aaaa-mm-jj HH:mm:ss) en format français (jj/mm/aaaa)
	*/
	public static function extractDate($pDateTime) {
		return $pDateTime[8].$pDateTime[9]."/".$pDateTime[5].$pDateTime[6]."/".$pDateTime[0].$pDateTime[1].$pDateTime[2].$pDateTime[3];
	}
	
	/**
	* @name dateTimeExtractTimeDbToFr($pDateTime)
	* @param string
	* @return string
	* @desc Extrait du temps de $pDateTime d'un format BDD (aaaa-mm-jj HH:mm:ss) en format français (HH:mm:ss)
	*/
	public static function dateTimeExtractTimeDbToFr($pDateTime) {
		return $pDateTime[11].$pDateTime[12].$pDateTime[13].$pDateTime[14].$pDateTime[15].$pDateTime[16].$pDateTime[17].$pDateTime[18];
	}
	
	/**
	* @name extractHeure($pTime)
	* @param string
	* @return string
	* @desc Extrait de l'heure de $pTime d'un format (HH:mm:ss) au format (HH)
	*/
	public static function extractHeure($pTime) {
		return $pTime[0].$pTime[1];
	}
	
	/**
	* @name extractMinute($pTime)
	* @param string
	* @return string
	* @desc Extrait des minutes de $pTime d'un format (HH:mm:ss) au format (mm)
	*/
	public static function extractMinute($pTime) {
		return $pTime[3].$pTime[4];
	}
	
	/**
	* @name extractSeconde($pTime)
	* @param string
	* @return string
	* @desc Extrait des secondes de $pTime d'un format (HH:mm:ss) au format (ss)
	*/
	public static function extractSeconde($pTime) {
		return $pTime[6].$pTime[7];
	}
	
	/**
	* @name creerDateTime($pDate,$pHeure,$pMinute)
	* @param string
	* @param string
	* @param string
	* @param string
	* @return string (datetime)
	* @desc Transforme une date + heure + minute + seconde en un datetime 
	*/
	public static function creerDateTime($pDate,$pHeure,$pMinute,$pSeconde) {
		if(strlen($pHeure) == 1) $mHeure = 0 . $pHeure;
		if(strlen($pHeure) == 2) $mHeure = $pHeure;
		
		if(strlen($pMinute) == 1) $mMinute = 0 . $pMinute;
		if(strlen($pMinute) == 2) $mMinute = $pMinute;
		
		if(strlen($pSeconde) == 1) $mSeconde = 0 . $pSeconde;
		if(strlen($pSeconde) == 2) $mSeconde = $pSeconde;
		
		return $pDate.' '.$mHeure.':'.$mMinute.':'.$mSeconde;
	}
	
	
	
	
	/**
	* @name dateEstPLusGrandeEgale($pDateGrande,$pDatePetite)
	* @param string,string
	* @return bool
	* @desc Vérifie que la première date est plus grande que la seconde
	*/
	public static function dateEstPLusGrandeEgale($pDateGrande,$pDatePetite) {
		$lDateGrande = explode("/", $pDateGrande);
		$lDateGrande = $lDateGrande[2].$lDateGrande[1].$lDateGrande[0];
		$lDatePetite = explode("/", $pDatePetite);
		$lDatePetite = $lDatePetite[2].$lDatePetite[1].$lDatePetite[0];

		return $lDateGrande >= $lDatePetite;
	}

	/**
	* @name dateEstNulle($pDate)
	* @param string
	* @return bool
	* @desc Vérifie si une date est nulle.
	*/
	public static function dateEstNulle($pDate) {
		return $pDate == StringUtils::FORMAT_DATE_NULLE;
	}

	/**
	* @name verifierDateTime($pDateTime)
	* @param string
	* @return bool
	* @desc Vérifie que $pDateTime correspond au format d'un datetime
	*/
	public static function verifierDateTime($pDateTime) {
		$lSyntaxe = '#^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$#';
		
		return preg_match($lSyntaxe,$pDateTime);
	}

	/**
	* @name verifierDecimalDb($pDecimal)
	* @param string
	* @return bool
	* @desc Vérifie que $pDecimal correspond au format d'un decimal de la BDD
	*/
	public static function verifierDecimalDb($pDecimal) {
		$lSyntaxe = '#^(-)?\d+(\.\d{0,2})?$#';
		
		return preg_match($lSyntaxe,$pDecimal);
	}

	/**
	* @name verifierDecimalFr($pDecimal)
	* @param string
	* @return bool
	* @desc Vérifie que $pDecimal correspond au format d'un decimal Français
	*/
	public static function verifierDecimalFr($pDecimal) {
		$lSyntaxe = '#^(-)?\d+(\,\d{0,2})?$#';
		
		return preg_match($lSyntaxe,$pDecimal);
	}

	/**
	* @name decimalFrToDb($pDecimal)
	* @param decimal
	* @return decimal
	* @desc Transforme un decimal Français (avec virgule) au format d'un decimal de la BDD (avec point)
	*/
	public static function decimalFrToDb($pDecimal) {	
		return str_ireplace(',', '.', $pDecimal);
	}
	
	public static function affichageMonetaireFr($pDecimal) {
		return number_format($pDecimal, 2, ',', ' ');
	}
	
	/**
	* @name dateAujourdhuiDb()
	* @return string
	* @desc Retourne la date actuelle au format 'AAAA-MM-JJ'
	*/
	public static function dateAujourdhuiDb() {
		return date('Y-m-d');
	}
	
	/**
	* @name dateTimeAujourdhuiDb()
	* @return string
	* @desc Retourne la date actuelle au format 'AAAA-MM-JJ HH:MM:SS'
	*/
	public static function dateTimeAujourdhuiDb() {
		return date('Y-m-d H:i:s');
	}
	
	/**
	* @name checkLength($pString,$pMin,$pMax)
	* @param string
	* @param integer
	* @param integer
	* @return bool
	* @desc Test la longueur d'une chaîne de caractère
	*/
	public static function checkLength($pString,$pMin,$pMax) {
		return (strlen($pString) > $pMax || strlen($pString) > $pMin );
	}	
}
?>
