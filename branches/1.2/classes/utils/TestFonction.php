<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/08/2010
// Fichier : TestFonction.php
//
// Description : Classe d'utilitaire pour les tests
//
//****************************************************************

/**
 * @name TestFonction
 * @author Julien PIERRE
 * @since 25/08/2010
 * 
 * @desc Classe d'utilitaire pour les tests
 */
class TestFonction
{
	/**
	* @name checkLength($pString)
	* @param string
	* @param integer
	* @param integer
	* @return bool
	* @desc Test si $pString a une longueur comprise entre $pMin et $pMax
	*/
	public static function checkLength($pString,$pMin,$pMax) {
		return !(strlen($pString) > $pMax ||  strlen($pString) < $pMin);
	}
	
	/**
	* @name checkCourriel($pAdresse)
	* @param string
	* @return bool
	* @desc Vérifie que l'adresse correspond au format d'un courriel
	*/
	public static function checkCourriel($pAdresse) {
		$lSyntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';		
		return preg_match($lSyntaxe,$pAdresse);
	}
	
	/**
	* @name checkTime($pTime)
	* @param string
	* @return bool
	* @desc Vérifie que l'heure est au format heure
	*/
	public static function checkTime($pTime) {
		$lSyntaxe = '#^[0-9]{2}[:]{1}[0-9]{2}[:]{1}[0-9]{2}$#';		
		return preg_match($lSyntaxe,$pTime);
	}

	/**
	* @name checkTimeExist($pTime)
	* @param string
	* @return bool
	* @desc Vérifie que l'heure existe
	*/
	public static function checkTimeExist($pTime) {
		$lTime = explode(':',$pTime);
		if(count($lTime) == 3) {
			return intval($lTime[0]) >= 0 && intval($lTime[0]) < 24 && intval($lTime[1]) >= 0 && intval($lTime[1]) < 60 && intval($lTime[2]) >= 0 && intval($lTime[2]) < 60;
		}
		return false;
	}
	
	/**
	* @name checkDate($pDate)
	* @param string
	* @param string
	* @return bool
	* @desc Vérifie que $pDate est au format Date
	*/
	public static function checkDate($pDate,$pType = 'db') {
		
		if($pType == 'db') {
			$lSyntaxe =  '#^[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}$#';
		} else if($pType == 'fr') {
			$lSyntaxe =  '#^[0-9]{2}[/]{1}[0-9]{2}[/]{1}[0-9]{4}$#';
		} else return false;	
		return preg_match($lSyntaxe,$pDate);
	}
	
	/**
	* @name checkDateExist($pDate)
	* @param string
	* @param string
	* @return bool
	* @desc Vérifie que $pDate existe
	*/
	public static function checkDateExist($pDate,$pType = 'db') {		
		if($pType == 'db') {
			$lSplit = '-'; 
			$lIndexAnnee = 0; 
			$lIndexDate = 2;
		} else if($pType == 'fr') {
			$lSplit = '/'; 
			$lIndexAnnee = 2; 
			$lIndexDate = 0;
		} else return false;	
		
		$lLaDate = explode($lSplit,$pDate);
		if ( count($lLaDate) != 3 ) return false;
		$lLaDate[0] = intval($lLaDate[0]);
		$lLaDate[1] = intval($lLaDate[1]);
		$lLaDate[2] = intval($lLaDate[2]);
		return checkdate($lLaDate[1],$lLaDate[$lIndexDate],$lLaDate[$lIndexAnnee]);
	}

	/**
	* @name checkDateTime($pDate)
	* @param string
	* @return bool
	* @desc Vérifie que $pDateTime est au format DateTime
	*/
	public static function checkDateTime($pDate) {
		$lDateTime = explode(' ',$pDate);
		if(count($lDateTime) == 2) {
			return ( TestFonction::checkDate($lDateTime[0],'db') && TestFonction::checkTime($lDateTime[1]) );
		}
		return false;
	}
	
	/**
	* @name checkDateTimeExist($pDate)
	* @param string
	* @return bool
	* @desc Vérifie que $pDateTime existe
	*/
	public static function checkDateTimeExist($pDate) {
		$lDateTime = explode(' ',$pDate);
		if(count($lDateTime) == 2) {
			return ( TestFonction::checkDateExist($lDateTime[0],'db') && TestFonction::checkTimeExist($lDateTime[1]) );
		}
		return false;
	}

	/**
	* @name dateTimeEstPLusGrandeEgale($pDateGrande,$pDatePetite,$pType)
	* @param string
	* @return bool
	* @desc Vérifie que la première dateTime est plus grande que la seconde
	*/
	public static function dateTimeEstPLusGrandeEgale($pDateGrande,$pDatePetite,$pType = 'db') {
		if($pType == 'db') {
			$lSplit = '-'; 
			$lIndexAnnee = 0; 
			$lIndexDate = 2;
		} else if($pType == 'fr') {
			$lSplit = '/'; 
			$lIndexAnnee = 2; 
			$lIndexDate = 0;
		} else return false;
		
		if(TestFonction::checkDateTime($pDateGrande,$pType) && TestFonction::checkDateTime($pDatePetite,$pType) && TestFonction::checkDateTimeExist($pDateGrande,$pType) && TestFonction::checkDateTimeExist($pDatePetite,$pType)) {
			$lDateTimeGrande = explode(' ',$pDateGrande);
			$lDateGrande = explode($lSplit,$lDateTimeGrande[0]);
			$lTimeGrande = str_replace(':','',$lDateTimeGrande[1]);	
			$lDateGrande = $lDateGrande[$lIndexAnnee] . $lDateGrande[1] . $lDateGrande[$lIndexDate] . $lTimeGrande;
			
			$lDateTimePetite = explode(' ',$pDatePetite);
			$lDatePetite = explode($lSplit,$lDateTimePetite[0]);
			$lTimePetite = str_replace(':','',$lDateTimePetite[1]);	
			$lDatePetite = $lDatePetite[$lIndexAnnee] . $lDatePetite[1] . $lDatePetite[$lIndexDate] . $lTimePetite;
						
			return $lDateGrande >= $lDatePetite;		
		}
		return false;
	}
	
	/**
	* @name dateEstPLusGrandeEgale($pDateGrande,$pDatePetite,$pType)
	* @param string,string,string
	* @return bool
	* @desc Vérifie que la première date est plus grande que la seconde
	*/
	public static function dateEstPLusGrandeEgale($pDateGrande,$pDatePetite,$pType = 'db') {
		if($pType == 'db') {
			$lSplit = '-'; 
			$lIndexAnnee = 0; 
			$lIndexDate = 2;
		} else if($pType == 'fr') {
			$lSplit = '/'; 
			$lIndexAnnee = 2; 
			$lIndexDate = 0;
		} else return false;
		
		if( TestFonction::checkDate($pDateGrande,$pType) && TestFonction::checkDate($pDatePetite,$pType) && TestFonction::checkDateExist($pDateGrande,$pType) && TestFonction::checkDateExist($pDatePetite,$pType)) {
			$lDateGrande = explode($lSplit, $pDateGrande);
			$lDateGrande = $lDateGrande[$lIndexAnnee].$lDateGrande[1].$lDateGrande[$lIndexDate];
			$lDatePetite = explode($lSplit, $pDatePetite);
			$lDatePetite = $lDatePetite[$lIndexAnnee].$lDatePetite[1].$lDatePetite[$lIndexDate];
	
			return intval($lDateGrande) >= intval($lDatePetite);
		} else return false;
	}
	
	/**
	* @name timeEstPLusGrandeEgale($pDateGrande,$pDatePetite)
	* @param string,string
	* @return bool
	* @desc Vérifie que la première Time est plus grande que la seconde
	*/
	public static function timeEstPLusGrandeEgale($pTimeGrande,$pTimePetite) {
		if(TestFonction::checkTime($pTimeGrande) && TestFonction::checkTime($pTimePetite) && TestFonction::checkTimeExist($pTimeGrande) && TestFonction::checkTimeExist($pTimePetite)) {
			$lTimeGrande = str_replace(':','',$pTimeGrande);
			$lTimePetite = str_replace(':','',$pTimePetite);			
			return intval($lTimeGrande) >= intval($lTimePetite);	
		}
		return false;
	}
}
?>