<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/09/2010
// Fichier : CommandeCompleteEnCoursViewVO.php
//
// Description : Classe CommandeCompleteEnCoursViewVO
//
//****************************************************************

/**
 * @name CommandeCompleteEnCoursViewVO
 * @author Julien PIERRE
 * @since 18/09/2010
 * @desc Classe représentant une CommandeCompleteEnCoursViewVO
 */
class CommandeCompleteEnCoursViewVO
{
	/**
	* @var int(11)
	* @desc ComId de la CommandeCompleteEnCoursViewVO
	*/
	private $mComId;

	/**
	* @var int(11)
	* @desc ComNumero de la CommandeCompleteEnCoursViewVO
	*/
	private $mComNumero;

	/**
	* @var varchar(100)
	* @desc ComNom de la CommandeCompleteEnCoursViewVO
	*/
	private $mComNom;

	/**
	* @var text
	* @desc ComDescription de la CommandeCompleteEnCoursViewVO
	*/
	private $mComDescription;

	/**
	* @var datetime
	* @desc ComDateMarcheDebut de la CommandeCompleteEnCoursViewVO
	*/
	private $mComDateMarcheDebut;

	/**
	* @var datetime
	* @desc ComDateMarcheFin de la CommandeCompleteEnCoursViewVO
	*/
	private $mComDateMarcheFin;

	/**
	* @var datetime
	* @desc ComDateFinReservation de la CommandeCompleteEnCoursViewVO
	*/
	private $mComDateFinReservation;

	/**
	* @var tinyint(1)
	* @desc ComArchive de la CommandeCompleteEnCoursViewVO
	*/
	private $mComArchive;

	/**
	* @var int(11)
	* @desc ProId de la CommandeCompleteEnCoursViewVO
	*/
	private $mProId;

	/**
	* @var int(11)
	* @desc ProIdCommande de la CommandeCompleteEnCoursViewVO
	*/
	private $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdNomProduit de la CommandeCompleteEnCoursViewVO
	*/
	private $mProIdNomProduit;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la CommandeCompleteEnCoursViewVO
	*/
	private $mProUniteMesure;

	/**
	* @var decimal(10,2)
	* @desc ProMaxProduitCommande de la CommandeCompleteEnCoursViewVO
	*/
	private $mProMaxProduitCommande;

	/**
	* @var int(11)
	* @desc NproId de la CommandeCompleteEnCoursViewVO
	*/
	private $mNproId;

	/**
	* @var varchar(50)
	* @desc NproNom de la CommandeCompleteEnCoursViewVO
	*/
	private $mNproNom;

	/**
	* @var text
	* @desc NproDescription de la CommandeCompleteEnCoursViewVO
	*/
	private $mNproDescription;

	/**
	* @var int(11)
	* @desc NproIdCategorie de la CommandeCompleteEnCoursViewVO
	*/
	private $mNproIdCategorie;

	/**
	* @var int(11)
	* @desc DcomId de la CommandeCompleteEnCoursViewVO
	*/
	private $mDcomId;

	/**
	* @var int(11)
	* @desc DcomIdProduit de la CommandeCompleteEnCoursViewVO
	*/
	private $mDcomIdProduit;

	/**
	* @var decimal(10,2)
	* @desc DcomTaille de la CommandeCompleteEnCoursViewVO
	*/
	private $mDcomTaille;

	/**
	* @var decimal(10,2)
	* @desc DcomPrix de la CommandeCompleteEnCoursViewVO
	*/
	private $mDcomPrix;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la CommandeCompleteEnCoursViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la CommandeCompleteEnCoursViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la CommandeCompleteEnCoursViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la CommandeCompleteEnCoursViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getComNom()
	* @return varchar(100)
	* @desc Renvoie le membre ComNom de la CommandeCompleteEnCoursViewVO
	*/
	public function getComNom() {
		return $this->mComNom;
	}

	/**
	* @name setComNom($pComNom)
	* @param varchar(100)
	* @desc Remplace le membre ComNom de la CommandeCompleteEnCoursViewVO par $pComNom
	*/
	public function setComNom($pComNom) {
		$this->mComNom = $pComNom;
	}

	/**
	* @name getComDescription()
	* @return text
	* @desc Renvoie le membre ComDescription de la CommandeCompleteEnCoursViewVO
	*/
	public function getComDescription() {
		return $this->mComDescription;
	}

	/**
	* @name setComDescription($pComDescription)
	* @param text
	* @desc Remplace le membre ComDescription de la CommandeCompleteEnCoursViewVO par $pComDescription
	*/
	public function setComDescription($pComDescription) {
		$this->mComDescription = $pComDescription;
	}

	/**
	* @name getComDateMarcheDebut()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheDebut de la CommandeCompleteEnCoursViewVO
	*/
	public function getComDateMarcheDebut() {
		return $this->mComDateMarcheDebut;
	}

	/**
	* @name setComDateMarcheDebut($pComDateMarcheDebut)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheDebut de la CommandeCompleteEnCoursViewVO par $pComDateMarcheDebut
	*/
	public function setComDateMarcheDebut($pComDateMarcheDebut) {
		$this->mComDateMarcheDebut = $pComDateMarcheDebut;
	}

	/**
	* @name getComDateMarcheFin()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheFin de la CommandeCompleteEnCoursViewVO
	*/
	public function getComDateMarcheFin() {
		return $this->mComDateMarcheFin;
	}

	/**
	* @name setComDateMarcheFin($pComDateMarcheFin)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheFin de la CommandeCompleteEnCoursViewVO par $pComDateMarcheFin
	*/
	public function setComDateMarcheFin($pComDateMarcheFin) {
		$this->mComDateMarcheFin = $pComDateMarcheFin;
	}

	/**
	* @name getComDateFinReservation()
	* @return datetime
	* @desc Renvoie le membre ComDateFinReservation de la CommandeCompleteEnCoursViewVO
	*/
	public function getComDateFinReservation() {
		return $this->mComDateFinReservation;
	}

	/**
	* @name setComDateFinReservation($pComDateFinReservation)
	* @param datetime
	* @desc Remplace le membre ComDateFinReservation de la CommandeCompleteEnCoursViewVO par $pComDateFinReservation
	*/
	public function setComDateFinReservation($pComDateFinReservation) {
		$this->mComDateFinReservation = $pComDateFinReservation;
	}

	/**
	* @name getComArchive()
	* @return tinyint(1)
	* @desc Renvoie le membre ComArchive de la CommandeCompleteEnCoursViewVO
	*/
	public function getComArchive() {
		return $this->mComArchive;
	}

	/**
	* @name setComArchive($pComArchive)
	* @param tinyint(1)
	* @desc Remplace le membre ComArchive de la CommandeCompleteEnCoursViewVO par $pComArchive
	*/
	public function setComArchive($pComArchive) {
		$this->mComArchive = $pComArchive;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la CommandeCompleteEnCoursViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la CommandeCompleteEnCoursViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la CommandeCompleteEnCoursViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la CommandeCompleteEnCoursViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre ProIdNomProduit de la CommandeCompleteEnCoursViewVO
	*/
	public function getProIdNomProduit() {
		return $this->mProIdNomProduit;
	}

	/**
	* @name setProIdNomProduit($pProIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre ProIdNomProduit de la CommandeCompleteEnCoursViewVO par $pProIdNomProduit
	*/
	public function setProIdNomProduit($pProIdNomProduit) {
		$this->mProIdNomProduit = $pProIdNomProduit;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la CommandeCompleteEnCoursViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la CommandeCompleteEnCoursViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getProMaxProduitCommande()
	* @return decimal(10,2)
	* @desc Renvoie le membre ProMaxProduitCommande de la CommandeCompleteEnCoursViewVO
	*/
	public function getProMaxProduitCommande() {
		return $this->mProMaxProduitCommande;
	}

	/**
	* @name setProMaxProduitCommande($pProMaxProduitCommande)
	* @param decimal(10,2)
	* @desc Remplace le membre ProMaxProduitCommande de la CommandeCompleteEnCoursViewVO par $pProMaxProduitCommande
	*/
	public function setProMaxProduitCommande($pProMaxProduitCommande) {
		$this->mProMaxProduitCommande = $pProMaxProduitCommande;
	}

	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la CommandeCompleteEnCoursViewVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la CommandeCompleteEnCoursViewVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la CommandeCompleteEnCoursViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la CommandeCompleteEnCoursViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getNproDescription()
	* @return text
	* @desc Renvoie le membre NproDescription de la CommandeCompleteEnCoursViewVO
	*/
	public function getNproDescription() {
		return $this->mNproDescription;
	}

	/**
	* @name setNproDescription($pNproDescription)
	* @param text
	* @desc Remplace le membre NproDescription de la CommandeCompleteEnCoursViewVO par $pNproDescription
	*/
	public function setNproDescription($pNproDescription) {
		$this->mNproDescription = $pNproDescription;
	}

	/**
	* @name getNproIdCategorie()
	* @return int(11)
	* @desc Renvoie le membre NproIdCategorie de la CommandeCompleteEnCoursViewVO
	*/
	public function getNproIdCategorie() {
		return $this->mNproIdCategorie;
	}

	/**
	* @name setNproIdCategorie($pNproIdCategorie)
	* @param int(11)
	* @desc Remplace le membre NproIdCategorie de la CommandeCompleteEnCoursViewVO par $pNproIdCategorie
	*/
	public function setNproIdCategorie($pNproIdCategorie) {
		$this->mNproIdCategorie = $pNproIdCategorie;
	}

	/**
	* @name getDcomId()
	* @return int(11)
	* @desc Renvoie le membre DcomId de la CommandeCompleteEnCoursViewVO
	*/
	public function getDcomId() {
		return $this->mDcomId;
	}

	/**
	* @name setDcomId($pDcomId)
	* @param int(11)
	* @desc Remplace le membre DcomId de la CommandeCompleteEnCoursViewVO par $pDcomId
	*/
	public function setDcomId($pDcomId) {
		$this->mDcomId = $pDcomId;
	}

	/**
	* @name getDcomIdProduit()
	* @return int(11)
	* @desc Renvoie le membre DcomIdProduit de la CommandeCompleteEnCoursViewVO
	*/
	public function getDcomIdProduit() {
		return $this->mDcomIdProduit;
	}

	/**
	* @name setDcomIdProduit($pDcomIdProduit)
	* @param int(11)
	* @desc Remplace le membre DcomIdProduit de la CommandeCompleteEnCoursViewVO par $pDcomIdProduit
	*/
	public function setDcomIdProduit($pDcomIdProduit) {
		$this->mDcomIdProduit = $pDcomIdProduit;
	}

	/**
	* @name getDcomTaille()
	* @return decimal(10,2)
	* @desc Renvoie le membre DcomTaille de la CommandeCompleteEnCoursViewVO
	*/
	public function getDcomTaille() {
		return $this->mDcomTaille;
	}

	/**
	* @name setDcomTaille($pDcomTaille)
	* @param decimal(10,2)
	* @desc Remplace le membre DcomTaille de la CommandeCompleteEnCoursViewVO par $pDcomTaille
	*/
	public function setDcomTaille($pDcomTaille) {
		$this->mDcomTaille = $pDcomTaille;
	}

	/**
	* @name getDcomPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre DcomPrix de la CommandeCompleteEnCoursViewVO
	*/
	public function getDcomPrix() {
		return $this->mDcomPrix;
	}

	/**
	* @name setDcomPrix($pDcomPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre DcomPrix de la CommandeCompleteEnCoursViewVO par $pDcomPrix
	*/
	public function setDcomPrix($pDcomPrix) {
		$this->mDcomPrix = $pDcomPrix;
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