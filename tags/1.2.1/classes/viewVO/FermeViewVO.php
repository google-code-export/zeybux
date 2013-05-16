<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/10/2011
// Fichier : FermeViewVO.php
//
// Description : Classe FermeViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name FermeViewVO
 * @author Julien PIERRE
 * @since 26/10/2011
 * @desc Classe représentant une FermeViewVO
 */
class FermeViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc FerId de la FermeViewVO
	*/
	protected $mFerId;

	/**
	* @var varchar(20)
	* @desc FerNumero de la FermeViewVO
	*/
	protected $mFerNumero;

	/**
	* @var varchar(30)
	* @desc CptLabel de la FermeViewVO
	*/
	protected $mCptLabel;

	/**
	* @var text
	* @desc FerNom de la FermeViewVO
	*/
	protected $mFerNom;

	/**
	* @var int(9)
	* @desc FerSiren de la FermeViewVO
	*/
	protected $mFerSiren;

	/**
	* @var varchar(300)
	* @desc FerAdresse de la FermeViewVO
	*/
	protected $mFerAdresse;

	/**
	* @var varchar(10)
	* @desc FerCodePostal de la FermeViewVO
	*/
	protected $mFerCodePostal;

	/**
	* @var varchar(100)
	* @desc FerVille de la FermeViewVO
	*/
	protected $mFerVille;

	/**
	* @var date
	* @desc FerDateAdhesion de la FermeViewVO
	*/
	protected $mFerDateAdhesion;

	/**
	* @var text
	* @desc FerDescription de la FermeViewVO
	*/
	protected $mFerDescription;

	/**
	* @var int(11)
	* @desc FerIdCompte de la FermeViewVO
	*/
	protected $mFerIdCompte;

	/**
	* @name getFerId()
	* @return int(11)
	* @desc Renvoie le membre FerId de la FermeViewVO
	*/
	public function getFerId() {
		return $this->mFerId;
	}

	/**
	* @name setFerId($pFerId)
	* @param int(11)
	* @desc Remplace le membre FerId de la FermeViewVO par $pFerId
	*/
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}

	/**
	* @name getFerNumero()
	* @return varchar(20)
	* @desc Renvoie le membre FerNumero de la FermeViewVO
	*/
	public function getFerNumero() {
		return $this->mFerNumero;
	}

	/**
	* @name setFerNumero($pFerNumero)
	* @param varchar(20)
	* @desc Remplace le membre FerNumero de la FermeViewVO par $pFerNumero
	*/
	public function setFerNumero($pFerNumero) {
		$this->mFerNumero = $pFerNumero;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la FermeViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la FermeViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getFerNom()
	* @return text
	* @desc Renvoie le membre FerNom de la FermeViewVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param text
	* @desc Remplace le membre FerNom de la FermeViewVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}

	/**
	* @name getFerSiren()
	* @return int(9)
	* @desc Renvoie le membre FerSiren de la FermeViewVO
	*/
	public function getFerSiren() {
		return $this->mFerSiren;
	}

	/**
	* @name setFerSiren($pFerSiren)
	* @param int(9)
	* @desc Remplace le membre FerSiren de la FermeViewVO par $pFerSiren
	*/
	public function setFerSiren($pFerSiren) {
		$this->mFerSiren = $pFerSiren;
	}

	/**
	* @name getFerAdresse()
	* @return varchar(300)
	* @desc Renvoie le membre FerAdresse de la FermeViewVO
	*/
	public function getFerAdresse() {
		return $this->mFerAdresse;
	}

	/**
	* @name setFerAdresse($pFerAdresse)
	* @param varchar(300)
	* @desc Remplace le membre FerAdresse de la FermeViewVO par $pFerAdresse
	*/
	public function setFerAdresse($pFerAdresse) {
		$this->mFerAdresse = $pFerAdresse;
	}

	/**
	* @name getFerCodePostal()
	* @return varchar(10)
	* @desc Renvoie le membre FerCodePostal de la FermeViewVO
	*/
	public function getFerCodePostal() {
		return $this->mFerCodePostal;
	}

	/**
	* @name setFerCodePostal($pFerCodePostal)
	* @param varchar(10)
	* @desc Remplace le membre FerCodePostal de la FermeViewVO par $pFerCodePostal
	*/
	public function setFerCodePostal($pFerCodePostal) {
		$this->mFerCodePostal = $pFerCodePostal;
	}

	/**
	* @name getFerVille()
	* @return varchar(100)
	* @desc Renvoie le membre FerVille de la FermeViewVO
	*/
	public function getFerVille() {
		return $this->mFerVille;
	}

	/**
	* @name setFerVille($pFerVille)
	* @param varchar(100)
	* @desc Remplace le membre FerVille de la FermeViewVO par $pFerVille
	*/
	public function setFerVille($pFerVille) {
		$this->mFerVille = $pFerVille;
	}

	/**
	* @name getFerDateAdhesion()
	* @return date
	* @desc Renvoie le membre FerDateAdhesion de la FermeViewVO
	*/
	public function getFerDateAdhesion() {
		return $this->mFerDateAdhesion;
	}

	/**
	* @name setFerDateAdhesion($pFerDateAdhesion)
	* @param date
	* @desc Remplace le membre FerDateAdhesion de la FermeViewVO par $pFerDateAdhesion
	*/
	public function setFerDateAdhesion($pFerDateAdhesion) {
		$this->mFerDateAdhesion = $pFerDateAdhesion;
	}

	/**
	* @name getFerDescription()
	* @return text
	* @desc Renvoie le membre FerDescription de la FermeViewVO
	*/
	public function getFerDescription() {
		return $this->mFerDescription;
	}

	/**
	* @name setFerDescription($pFerDescription)
	* @param text
	* @desc Remplace le membre FerDescription de la FermeViewVO par $pFerDescription
	*/
	public function setFerDescription($pFerDescription) {
		$this->mFerDescription = $pFerDescription;
	}

	/**
	* @name getFerIdCompte()
	* @return int(11)
	* @desc Renvoie le membre FerIdCompte de la FermeViewVO
	*/
	public function getFerIdCompte() {
		return $this->mFerIdCompte;
	}

	/**
	* @name setFerIdCompte($pFerIdCompte)
	* @param int(11)
	* @desc Remplace le membre FerIdCompte de la FermeViewVO par $pFerIdCompte
	*/
	public function setFerIdCompte($pFerIdCompte) {
		$this->mFerIdCompte = $pFerIdCompte;
	}

}
?>