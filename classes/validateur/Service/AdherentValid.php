<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/12/2012
// Fichier : AdherentValid.php
//
// Description : Classe AdherentValid
//
//****************************************************************

namespace NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE;

// Inclusion des classes
/*include_once(CHEMIN_CLASSES_VO . "AchatVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdAchatValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "DetailReservationValid.php" );*/
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");

/**
 * @name AdherentValid
 * @author Julien PIERRE
 * @since 28/12/2012
 * @desc Classe représentant une AdherentValid
 */
class AdherentValid
{
	/**
	* @name estAdherent($pAdherent)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estAdherent($pAdherent) {
		if(is_object($pAdherent)) {
			return (get_class($pAdherent) == "AdherentVO");
		} else {
			return false;
		}
	}
			
	/**
	* @name insert($pAdherent)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pAdherent) {
		if($this->estAdherent($pAdherent)) {
			$lIdValid = new \IdValid();
			$lId = $pAdherent->getId();
			
			return $lIdValid->estId($lId)
			&& empty($lId)
			&& $pAdherent->getNom() != ''
			&& $pAdherent->getPrenom() != ''
			&& $pAdherent->getDateAdhesion() != ''
			&& is_int((int)$pAdherent->getIdCompte());
		} else {
			return false;
		}
	}
	
	/**
	 * @name update($pAdherent)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function update($pAdherent) {
		if($this->estAdherent($pAdherent)) {
			$lIdValid = new \IdValid();
			$lId = $pAdherent->getId();
	
			return $lIdValid->estId($lId)
			&& !empty($lId)
			&& $pAdherent->getNom() != ''
			&& $pAdherent->getPrenom() != ''
			&& $pAdherent->getDateAdhesion() != ''
			&& is_int((int)$pAdherent->getIdCompte());
		} else {
			return false;
		}
	}
	
	/**
	* @name updateReservation($pAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	/*public function updateReservation($pAchat) {
		if($this->estAchat($pAchat)) {
			$lIdAchatValid = new IdAchatValid();
			$lIdValid = $lIdAchatValid->estReservation($pAchat->getId());
			if(!is_null($lIdValid) && $lIdValid) {
				if($this->detailAchat($pAchat->getDetailAchat())
					&& $this->detailAchatSolidaire($pAchat->getDetailAchatSolidaire())) {
					$lDetailValid = true;
					$lDetailReservation = $pAchat->getDetailAchat();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = ( $lDetailReservationValid->update($lDetailReservation[$i]) || $lDetailReservationValid->insert($lDetailReservation[$i]) );
						$i++;
					}
					
					$lDetailReservation = $pAchat->getDetailAchatSolidaire();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = ( $lDetailReservationValid->update($lDetailReservation[$i]) || $lDetailReservationValid->insert($lDetailReservation[$i]) );
						$i++;
					}					
					return $lDetailValid;				
				}
			}
		}
		return false;
	}*/
		
	/**
	* @name delete($pIdReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
/*	public function delete($pIdReservation) {
		/*$lIdReservationValid = new IdReservationValid();
		$lIdValid = $lIdReservationValid->estValide($pIdReservation);
		if($lIdValid != NULL) {
			return $lIdValid;
		} else {
			return false;
		}*/
/*		return false;
	}*/
	
	/**
	* @name delete($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function delete($pId) {	
		$lIdValid = new \IdValid();
		if(!empty($pId)){
			return $lIdValid->estId($pId);
		}
		return false;
	}	
}
?>