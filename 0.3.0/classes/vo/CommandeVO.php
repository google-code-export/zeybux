<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/06/2010
// Fichier : CommandeVO.php
//
// Description : Classe CommandeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CommandeVO
 * @author Julien PIERRE
 * @since 10/06/2010
 * @desc Classe représentant une CommandeVO
 */
class CommandeVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la CommandeVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc Numero de la CommandeVO
	*/
	protected $mNumero;

	/**
	* @var varchar(100)
	* @desc Nom de la CommandeVO
	*/
	protected $mNom;

	/**
	* @var text
	* @desc Description de la CommandeVO
	*/
	protected $mDescription;

	/**
	* @var datetime
	* @desc DateMarcheDebut de la CommandeVO
	*/
	protected $mDateMarcheDebut;

	/**
	* @var datetime
	* @desc DateMarcheFin de la CommandeVO
	*/
	protected $mDateMarcheFin;

	/**
	* @var datetime
	* @desc DateFinReservation de la CommandeVO
	*/
	protected $mDateFinReservation;

	/**
	* @var tinyint(1)
	* @desc Archive de la CommandeVO
	*/
	protected $mArchive;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la CommandeVO
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la CommandeVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNumero()
	* @return int(11)
	* @desc Renvoie le membre Numero de la CommandeVO
	*/
	public function getNumero(){
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param int(11)
	* @desc Remplace le membre Numero de la CommandeVO par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}

	/**
	* @name getNom()
	* @return varchar(100)
	* @desc Renvoie le membre Nom de la CommandeVO
	*/
	public function getNom(){
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(100)
	* @desc Remplace le membre Nom de la CommandeVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getDescription()
	* @return text
	* @desc Renvoie le membre Description de la CommandeVO
	*/
	public function getDescription(){
		return $this->mDescription;
	}

	/**
	* @name setDescription($pDescription)
	* @param text
	* @desc Remplace le membre Description de la CommandeVO par $pDescription
	*/
	public function setDescription($pDescription) {
		$this->mDescription = $pDescription;
	}

	/**
	* @name getDateMarcheDebut()
	* @return datetime
	* @desc Renvoie le membre DateMarcheDebut de la CommandeVO
	*/
	public function getDateMarcheDebut(){
		return $this->mDateMarcheDebut;
	}

	/**
	* @name setDateMarcheDebut($pDateMarcheDebut)
	* @param datetime
	* @desc Remplace le membre DateMarcheDebut de la CommandeVO par $pDateMarcheDebut
	*/
	public function setDateMarcheDebut($pDateMarcheDebut) {
		$this->mDateMarcheDebut = $pDateMarcheDebut;
	}

	/**
	* @name getDateMarcheFin()
	* @return datetime
	* @desc Renvoie le membre DateMarcheFin de la CommandeVO
	*/
	public function getDateMarcheFin(){
		return $this->mDateMarcheFin;
	}

	/**
	* @name setDateMarcheFin($pDateMarcheFin)
	* @param datetime
	* @desc Remplace le membre DateMarcheFin de la CommandeVO par $pDateMarcheFin
	*/
	public function setDateMarcheFin($pDateMarcheFin) {
		$this->mDateMarcheFin = $pDateMarcheFin;
	}

	/**
	* @name getDateFinReservation()
	* @return datetime
	* @desc Renvoie le membre DateFinReservation de la CommandeVO
	*/
	public function getDateFinReservation(){
		return $this->mDateFinReservation;
	}

	/**
	* @name setDateFinReservation($pDateFinReservation)
	* @param datetime
	* @desc Remplace le membre DateFinReservation de la CommandeVO par $pDateFinReservation
	*/
	public function setDateFinReservation($pDateFinReservation) {
		$this->mDateFinReservation = $pDateFinReservation;
	}

	/**
	* @name getArchive()
	* @return tinyint(1)
	* @desc Renvoie le membre Archive de la CommandeVO
	*/
	public function getArchive(){
		return $this->mArchive;
	}

	/**
	* @name setArchive($pArchive)
	* @param tinyint(1)
	* @desc Remplace le membre Archive de la CommandeVO par $pArchive
	*/
	public function setArchive($pArchive) {
		$this->mArchive = $pArchive;
	}

}
?>