<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/10/2010
// Fichier : ListeReservationEnCoursViewVO.php
//
// Description : Classe ListeReservationEnCoursViewVO
//
//****************************************************************

/**
 * @name ListeReservationEnCoursViewVO
 * @author Julien PIERRE
 * @since 04/10/2010
 * @desc Classe représentant une ListeReservationEnCoursViewVO
 */
class ListeReservationEnCoursViewVO
{
	/**
	* @var int(11)
	* @desc AdhId de la ListeReservationEnCoursViewVO
	*/
	private $mAdhId;

	/**
	* @var varchar(5)
	* @desc AdhNumero de la ListeReservationEnCoursViewVO
	*/
	private $mAdhNumero;

	/**
	* @var int(11)
	* @desc AdhIdCompte de la ListeReservationEnCoursViewVO
	*/
	private $mAdhIdCompte;

	/**
	* @var tinyint(1)
	* @desc AdhSuperZeybu de la ListeReservationEnCoursViewVO
	*/
	private $mAdhSuperZeybu;

	/**
	* @var int(11)
	* @desc ComId de la ListeReservationEnCoursViewVO
	*/
	private $mComId;

	/**
	* @var int(11)
	* @desc ComNumero de la ListeReservationEnCoursViewVO
	*/
	private $mComNumero;

	/**
	* @var datetime
	* @desc ComDateMarcheDebut de la ListeReservationEnCoursViewVO
	*/
	private $mComDateMarcheDebut;

	/**
	* @var datetime
	* @desc ComDateMarcheFin de la ListeReservationEnCoursViewVO
	*/
	private $mComDateMarcheFin;

	/**
	* @var datetime
	* @desc ComDateFinReservation de la ListeReservationEnCoursViewVO
	*/
	private $mComDateFinReservation;

	/**
	* @var tinyint(1)
	* @desc ComArchive de la ListeReservationEnCoursViewVO
	*/
	private $mComArchive;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeReservationEnCoursViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeReservationEnCoursViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(5)
	* @desc Renvoie le membre AdhNumero de la ListeReservationEnCoursViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(5)
	* @desc Remplace le membre AdhNumero de la ListeReservationEnCoursViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhIdCompte()
	* @return int(11)
	* @desc Renvoie le membre AdhIdCompte de la ListeReservationEnCoursViewVO
	*/
	public function getAdhIdCompte() {
		return $this->mAdhIdCompte;
	}

	/**
	* @name setAdhIdCompte($pAdhIdCompte)
	* @param int(11)
	* @desc Remplace le membre AdhIdCompte de la ListeReservationEnCoursViewVO par $pAdhIdCompte
	*/
	public function setAdhIdCompte($pAdhIdCompte) {
		$this->mAdhIdCompte = $pAdhIdCompte;
	}

	/**
	* @name getAdhSuperZeybu()
	* @return tinyint(1)
	* @desc Renvoie le membre AdhSuperZeybu de la ListeReservationEnCoursViewVO
	*/
	public function getAdhSuperZeybu() {
		return $this->mAdhSuperZeybu;
	}

	/**
	* @name setAdhSuperZeybu($pAdhSuperZeybu)
	* @param tinyint(1)
	* @desc Remplace le membre AdhSuperZeybu de la ListeReservationEnCoursViewVO par $pAdhSuperZeybu
	*/
	public function setAdhSuperZeybu($pAdhSuperZeybu) {
		$this->mAdhSuperZeybu = $pAdhSuperZeybu;
	}

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la ListeReservationEnCoursViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la ListeReservationEnCoursViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la ListeReservationEnCoursViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la ListeReservationEnCoursViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getComDateMarcheDebut()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheDebut de la ListeReservationEnCoursViewVO
	*/
	public function getComDateMarcheDebut() {
		return $this->mComDateMarcheDebut;
	}

	/**
	* @name setComDateMarcheDebut($pComDateMarcheDebut)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheDebut de la ListeReservationEnCoursViewVO par $pComDateMarcheDebut
	*/
	public function setComDateMarcheDebut($pComDateMarcheDebut) {
		$this->mComDateMarcheDebut = $pComDateMarcheDebut;
	}

	/**
	* @name getComDateMarcheFin()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheFin de la ListeReservationEnCoursViewVO
	*/
	public function getComDateMarcheFin() {
		return $this->mComDateMarcheFin;
	}

	/**
	* @name setComDateMarcheFin($pComDateMarcheFin)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheFin de la ListeReservationEnCoursViewVO par $pComDateMarcheFin
	*/
	public function setComDateMarcheFin($pComDateMarcheFin) {
		$this->mComDateMarcheFin = $pComDateMarcheFin;
	}

	/**
	* @name getComDateFinReservation()
	* @return datetime
	* @desc Renvoie le membre ComDateFinReservation de la ListeReservationEnCoursViewVO
	*/
	public function getComDateFinReservation() {
		return $this->mComDateFinReservation;
	}

	/**
	* @name setComDateFinReservation($pComDateFinReservation)
	* @param datetime
	* @desc Remplace le membre ComDateFinReservation de la ListeReservationEnCoursViewVO par $pComDateFinReservation
	*/
	public function setComDateFinReservation($pComDateFinReservation) {
		$this->mComDateFinReservation = $pComDateFinReservation;
	}

	/**
	* @name getComArchive()
	* @return tinyint(1)
	* @desc Renvoie le membre ComArchive de la ListeReservationEnCoursViewVO
	*/
	public function getComArchive() {
		return $this->mComArchive;
	}

	/**
	* @name setComArchive($pComArchive)
	* @param tinyint(1)
	* @desc Remplace le membre ComArchive de la ListeReservationEnCoursViewVO par $pComArchive
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