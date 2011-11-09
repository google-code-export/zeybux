<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/07/2011
// Fichier : GestionCommandeReservationProducteurViewVO.php
//
// Description : Classe GestionCommandeReservationProducteurViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name GestionCommandeReservationProducteurViewVO
 * @author Julien PIERRE
 * @since 31/07/2011
 * @desc Classe représentant une GestionCommandeReservationProducteurViewVO
 */
class GestionCommandeReservationProducteurViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProIdCommande de la GestionCommandeReservationProducteurViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdCompteFerme de la GestionCommandeReservationProducteurViewVO
	*/
	protected $mProIdCompteFerme;

	/**
	* @var int(11)
	* @desc ProId de la GestionCommandeReservationProducteurViewVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc StoId de la GestionCommandeReservationProducteurViewVO
	*/
	protected $mStoId;

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la GestionCommandeReservationProducteurViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la GestionCommandeReservationProducteurViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdCompteFerme()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteFerme de la GestionCommandeReservationProducteurViewVO
	*/
	public function getProIdCompteFerme() {
		return $this->mProIdCompteFerme;
	}

	/**
	* @name setProIdCompteFerme($pProIdCompteFerme)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteFerme de la GestionCommandeReservationProducteurViewVO par $pProIdCompteFerme
	*/
	public function setProIdCompteFerme($pProIdCompteFerme) {
		$this->mProIdCompteFerme = $pProIdCompteFerme;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la GestionCommandeReservationProducteurViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la GestionCommandeReservationProducteurViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la GestionCommandeReservationProducteurViewVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la GestionCommandeReservationProducteurViewVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}

}
?>