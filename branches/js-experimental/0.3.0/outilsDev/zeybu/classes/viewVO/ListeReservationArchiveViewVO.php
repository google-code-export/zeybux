<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/10/2010
// Fichier : ListeReservationArchiveViewVO.php
//
// Description : Classe ListeReservationArchiveViewVO
//
//****************************************************************

/**
 * @name ListeReservationArchiveViewVO
 * @author Julien PIERRE
 * @since 04/10/2010
 * @desc Classe représentant une ListeReservationArchiveViewVO
 */
class ListeReservationArchiveViewVO
{
	/**
	* @var int(11)
	* @desc AdhId de la ListeReservationArchiveViewVO
	*/
	private $mAdhId;

	/**
	* @var varchar(5)
	* @desc AdhNumero de la ListeReservationArchiveViewVO
	*/
	private $mAdhNumero;

	/**
	* @var int(11)
	* @desc AdhIdCompte de la ListeReservationArchiveViewVO
	*/
	private $mAdhIdCompte;

	/**
	* @var tinyint(1)
	* @desc AdhSuperZeybu de la ListeReservationArchiveViewVO
	*/
	private $mAdhSuperZeybu;

	/**
	* @var int(11)
	* @desc ComId de la ListeReservationArchiveViewVO
	*/
	private $mComId;

	/**
	* @var int(11)
	* @desc ComNumero de la ListeReservationArchiveViewVO
	*/
	private $mComNumero;

	/**
	* @var datetime
	* @desc ComDateMarcheDebut de la ListeReservationArchiveViewVO
	*/
	private $mComDateMarcheDebut;

	/**
	* @var datetime
	* @desc ComDateMarcheFin de la ListeReservationArchiveViewVO
	*/
	private $mComDateMarcheFin;

	/**
	* @var datetime
	* @desc ComDateFinReservation de la ListeReservationArchiveViewVO
	*/
	private $mComDateFinReservation;

	/**
	* @var tinyint(1)
	* @desc ComArchive de la ListeReservationArchiveViewVO
	*/
	private $mComArchive;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeReservationArchiveViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeReservationArchiveViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(5)
	* @desc Renvoie le membre AdhNumero de la ListeReservationArchiveViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(5)
	* @desc Remplace le membre AdhNumero de la ListeReservationArchiveViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhIdCompte()
	* @return int(11)
	* @desc Renvoie le membre AdhIdCompte de la ListeReservationArchiveViewVO
	*/
	public function getAdhIdCompte() {
		return $this->mAdhIdCompte;
	}

	/**
	* @name setAdhIdCompte($pAdhIdCompte)
	* @param int(11)
	* @desc Remplace le membre AdhIdCompte de la ListeReservationArchiveViewVO par $pAdhIdCompte
	*/
	public function setAdhIdCompte($pAdhIdCompte) {
		$this->mAdhIdCompte = $pAdhIdCompte;
	}

	/**
	* @name getAdhSuperZeybu()
	* @return tinyint(1)
	* @desc Renvoie le membre AdhSuperZeybu de la ListeReservationArchiveViewVO
	*/
	public function getAdhSuperZeybu() {
		return $this->mAdhSuperZeybu;
	}

	/**
	* @name setAdhSuperZeybu($pAdhSuperZeybu)
	* @param tinyint(1)
	* @desc Remplace le membre AdhSuperZeybu de la ListeReservationArchiveViewVO par $pAdhSuperZeybu
	*/
	public function setAdhSuperZeybu($pAdhSuperZeybu) {
		$this->mAdhSuperZeybu = $pAdhSuperZeybu;
	}

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la ListeReservationArchiveViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la ListeReservationArchiveViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la ListeReservationArchiveViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la ListeReservationArchiveViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getComDateMarcheDebut()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheDebut de la ListeReservationArchiveViewVO
	*/
	public function getComDateMarcheDebut() {
		return $this->mComDateMarcheDebut;
	}

	/**
	* @name setComDateMarcheDebut($pComDateMarcheDebut)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheDebut de la ListeReservationArchiveViewVO par $pComDateMarcheDebut
	*/
	public function setComDateMarcheDebut($pComDateMarcheDebut) {
		$this->mComDateMarcheDebut = $pComDateMarcheDebut;
	}

	/**
	* @name getComDateMarcheFin()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheFin de la ListeReservationArchiveViewVO
	*/
	public function getComDateMarcheFin() {
		return $this->mComDateMarcheFin;
	}

	/**
	* @name setComDateMarcheFin($pComDateMarcheFin)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheFin de la ListeReservationArchiveViewVO par $pComDateMarcheFin
	*/
	public function setComDateMarcheFin($pComDateMarcheFin) {
		$this->mComDateMarcheFin = $pComDateMarcheFin;
	}

	/**
	* @name getComDateFinReservation()
	* @return datetime
	* @desc Renvoie le membre ComDateFinReservation de la ListeReservationArchiveViewVO
	*/
	public function getComDateFinReservation() {
		return $this->mComDateFinReservation;
	}

	/**
	* @name setComDateFinReservation($pComDateFinReservation)
	* @param datetime
	* @desc Remplace le membre ComDateFinReservation de la ListeReservationArchiveViewVO par $pComDateFinReservation
	*/
	public function setComDateFinReservation($pComDateFinReservation) {
		$this->mComDateFinReservation = $pComDateFinReservation;
	}

	/**
	* @name getComArchive()
	* @return tinyint(1)
	* @desc Renvoie le membre ComArchive de la ListeReservationArchiveViewVO
	*/
	public function getComArchive() {
		return $this->mComArchive;
	}

	/**
	* @name setComArchive($pComArchive)
	* @param tinyint(1)
	* @desc Remplace le membre ComArchive de la ListeReservationArchiveViewVO par $pComArchive
	*/
	public function setComArchive($pComArchive) {
		$this->mComArchive = $pComArchive;
	}

	/**
	* @name export()
	* @return json
	* @desc Retourne la valeur des membres en les renommant au format tableau
	*/
	public function export() {
		$lMembres = get_object_vars($this);
		$lMembresJs = array();
		foreach($lMembres as $lCle => $lValeur) {
			$lCle = substr($lCle,1);
			$lCle[0] = strtolower($lCle[0]);
			if(is_object($lValeur)) {
				$lMembresJs[$lCle] = $lValeur->export();
			} else if(is_array($lValeur)) {
				$lMembresJs[$lCle] = $this->exportArray($lValeur);
			} else {
				$lMembresJs[$lCle] = $lValeur;
			}
		}
		return $lMembresJs;
	}

	/**
	* @name exportToJson()
	* @return json
	* @desc Retourne la valeur des membres en les renommant au format javascript
	*/
	public function exportToJson() {
		return json_encode($this->export());
	}

	/**
	* @name exportArray($pArray)
	* @return array()
	* @desc Retourne la valeur des membres en les renommant au format tableau
	*/
	public function exportArray($pArray) {
		if(is_array($pArray)) {
			$lMembresJs = array();
			foreach($pArray as $lCle => $lValeur) {
				if(is_object($lValeur)) {
					$lMembresJs[$lCle] = $lValeur->export();
				} else if(is_array($lValeur)) {
					$lMembresJs[$lCle] = $this->exportArray($lValeur);
				} else {
					$lMembresJs[$lCle] = $lValeur;
				}
			}
			return $lMembresJs;
		}
		return NULL;
	}

}
?>