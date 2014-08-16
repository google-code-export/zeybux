<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/07/2011
// Fichier : IdAchatVO.php
//
// Description : Classe IdAchatVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");

/**
 * @name IdAchatVO
 * @author Julien PIERRE
 * @since 23/07/2011
 * @desc Classe représentant une IdAchatVO
 */
class IdAchatVO extends IdReservationVO
{
	/**
	* @var int(11)
	* @desc IdReservation de la IdAchatVO
	*/
	protected $mIdReservation;
	
	/**
	* @var int(11)
	* @desc IdAchat de la IdAchatVO
	*/
	protected $mIdAchat;

	/**
	* @name getIdReservation()
	* @return int(11)
	* @desc Renvoie le membre IdReservation de la IdAchatVO
	*/
	public function getIdReservation() {
		return $this->mIdReservation;
	}

	/**
	* @name setIdReservation($pIdReservation)
	* @param int(11)
	* @desc Remplace le membre IdReservation de la IdAchatVO par $pIdReservation
	*/
	public function setIdReservation($pIdReservation) {
		$this->mIdReservation = $pIdReservation;
	}
	
	/**
	* @name getIdAchat()
	* @return int(11)
	* @desc Renvoie le membre IdAchat de la IdAchatVO
	*/
	public function getIdAchat() {
		return $this->mIdAchat;
	}

	/**
	* @name setIdAchat($pIdAchat)
	* @param int(11)
	* @desc Remplace le membre IdAchat de la IdAchatVO par $pIdAchat
	*/
	public function setIdAchat($pIdAchat) {
		$this->mIdAchat = $pIdAchat;
	}
}
?>