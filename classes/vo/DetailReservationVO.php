<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : DetailReservationVO.php
//
// Description : Classe DetailReservationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");
include_once(CHEMIN_CLASSES_VO . "IdDetailReservationVO.php");

/**
 * @name DetailReservationVO
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe représentant une DetailReservationVO
 */
class DetailReservationVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la DetailReservationVO
	*/
	protected $mId;
	
	/**
	* @var int(11)
	* @desc Id du lot de la DetailReservationVO
	*/
	protected $mIdDetailCommande;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la DetailReservationVO
	*/
	protected $mQuantite;

	/**
	* @var decimal(10,2)
	* @desc Montant de la DetailReservationVO
	*/
	protected $mMontant;

	/**
	* @name DetailReservationVO()
	* @desc Le constructeur
	*/
	public function DetailReservationVO() {
		$this->mId = new IdDetailReservationVO();
	}
	
	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la DetailReservationVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la DetailReservationVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
	
	/**
	* @name getIdDetailCommande()
	* @return int(11)
	* @desc Renvoie le membre IdDetailCommande de la DetailReservationVO
	*/
	public function getIdDetailCommande() {
		return $this->mIdDetailCommande;
	}

	/**
	* @name setIdDetailCommande($pIdDetailCommande)
	* @param int(11)
	* @desc Remplace le membre IdDetailCommande de la DetailReservationVO par $pIdDetailCommande
	*/
	public function setIdDetailCommande($pIdDetailCommande) {
		$this->mIdDetailCommande = $pIdDetailCommande;
	}

	/**
	* @name getQuantite()
	* @return varchar(30)
	* @desc Renvoie le membre Quantite de la DetailReservationVO
	*/
	public function getQuantite() {
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param varchar(30)
	* @desc Remplace le membre Quantite de la DetailReservationVO par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getMontant()
	* @return int(11)
	* @desc Renvoie le membre Montant de la DetailReservationVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param int(11)
	* @desc Remplace le membre Montant de la DetailReservationVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

}
?>