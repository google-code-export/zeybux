<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : IdAchatValid.php
//
// Description : Classe IdAchatValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php" );

/**
 * @name IdAchatValid
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe représentant une IdAchatValid
 */
class IdAchatValid extends IdValid 
{
	/**
	* @name estIdAchat($pIdAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estIdAchat($pIdAchat) {
		if(is_object($pIdAchat)) {
			return (get_class($pIdAchat) == "IdAchatVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name estAjout($pIdAchat)
	* @return bool
	* @desc Test si le paramètre est bien un IdAchatVO et si il est vide
	*/
	public function estAjout($pIdAchat) {
		if($this->format($pIdAchat)) {
			 return $pIdAchat->getIdCompte() != ''
			 && $pIdAchat->getIdCommande() != ''
			 && $pIdAchat->getIdAchat() == ''
			 && $pIdAchat->getIdReservation() == '';
		} else {
			return NULL;
		}
	}
	
	/**
	* @name estReservation($pIdAchat)
	* @return bool
	* @desc Test si le paramètre est bien un IdAchatVO et si il est vide
	*/
	public function estReservation($pIdAchat) {
		if($this->format($pIdAchat)) {
			 return $pIdAchat->getIdCompte() != ''
			 && $pIdAchat->getIdCommande() != ''
			 && $pIdAchat->getIdAchat() == ''
			 && $pIdAchat->getIdReservation() != '';
		} else {
			return NULL;
		}
	}
	
	/**
	* @name estAchat($pIdAchat)
	* @return bool
	* @desc Test si le paramètre est bien un IdAchatVO et si il est vide
	*/
	public function estAchat($pIdAchat) {
		if($this->format($pIdAchat)) {
			 return $pIdAchat->getIdCompte() != ''
			 && $pIdAchat->getIdCommande() != ''
			 && $pIdAchat->getIdAchat() != ''
			 && $pIdAchat->getIdReservation() == '';
		} else {
			return NULL;
		}
	}
	
	/**
	* @name format($pIdAchat)
	* @return bool
	* @desc Test le format du paramètre
	*/
	public function format($pIdAchat) {
		if($this->estIdAchat($pIdAchat)) {
			return $this->estId($pIdAchat->getIdCompte()) 
			&& $this->estId($pIdAchat->getIdCommande())
			&& $this->estId($pIdAchat->getIdAchat())
			&& $this->estId($pIdAchat->getIdReservation()) ;
		} else {	
			return false;
		}
	}
}
?>