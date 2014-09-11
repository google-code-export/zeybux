<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/08/2011
// Fichier : ListeAdherentAdhesionVO.php
//
// Description : Classe ListeAdherentAdhesionVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdherentAdhesionVO
 * @author Julien PIERRE
 * @since 03/08/2011
 * @desc Classe représentant une ListeAdherentAdhesionVO
 */
class ListeAdherentAdhesionVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc AdhId de la ListeAdherentAdhesionVO
	*/
	protected $mAdhId;

	/**
	* @var int(11)
	* @desc AdhNumero de la ListeAdherentAdhesionVO
	*/
	protected $mAdhNumero;

	/**
	* @var int(11)
	* @desc AdhIdCompte de la ListeAdherentAdhesionVO
	*/
	protected $mAdhIdCompte;

	/**
	* @var varchar(30)
	* @desc CptLabel de la ListeAdherentAdhesionVO
	*/
	protected $mCptLabel;

	/**
	* @var varchar(50)
	* @desc AdhNom de la ListeAdherentAdhesionVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la ListeAdherentAdhesionVO
	*/
	protected $mAdhPrenom;

	/**
	* @var int(11)
	* @desc IdAdhesionAdherent de la ListeAdherentAdhesionVO
	*/
	protected $mIdAdhesionAdherent;

	/**
	* @var tinyint(1)
	* @desc AdadStatutFormulaire; de la ListeAdherentAdhesionVO
	*/
	protected $pAdadStatutFormulaire;	
	
	/**
	 * @name ListeAdherentAdhesionVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function ListeAdherentAdhesionVO($pAdhId = null, $pAdhNumero = null, $pAdhIdCompte = null, $pCptLabel = null, $pAdhNom = null, $pAdhPrenom = null, $pIdAdhesionAdherent = null, $pAdadStatutFormulaire = null) {
		if(!is_null($pAdhId)) { $this->mAdhId = $pAdhId; }
		if(!is_null($pAdhNumero)) { $this->mAdhNumero = $pAdhNumero; }
		if(!is_null($pAdhIdCompte)) { $this->mAdhIdCompte = $pAdhIdCompte; }
		if(!is_null($pCptLabel)) { $this->mCptLabel = $pCptLabel; }
		if(!is_null($pAdhNom)) { $this->mAdhNom = $pAdhNom; }
		if(!is_null($pAdhPrenom)) { $this->mAdhPrenom = $pAdhPrenom; }
		if(!is_null($pIdAdhesionAdherent)) { $this->mIdAdhesionAdherent = $pIdAdhesionAdherent; }
		if(!is_null($pAdadStatutFormulaire)) { $this->mAdadStatutFormulaire = $pAdadStatutFormulaire; }
	}

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeAdherentAdhesionVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeAdherentAdhesionVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return int(11)
	* @desc Renvoie le membre AdhNumero de la ListeAdherentAdhesionVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param int(11)
	* @desc Remplace le membre AdhNumero de la ListeAdherentAdhesionVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhIdCompte()
	* @return int(11)
	* @desc Renvoie le membre AdhIdCompte de la ListeAdherentAdhesionVO
	*/
	public function getAdhIdCompte() {
		return $this->mAdhIdCompte;
	}

	/**
	* @name setAdhIdCompte($pAdhIdCompte)
	* @param int(11)
	* @desc Remplace le membre AdhIdCompte de la ListeAdherentAdhesionVO par $pAdhIdCompte
	*/
	public function setAdhIdCompte($pAdhIdCompte) {
		$this->mAdhIdCompte = $pAdhIdCompte;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la ListeAdherentAdhesionVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la ListeAdherentAdhesionVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ListeAdherentAdhesionVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ListeAdherentAdhesionVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ListeAdherentAdhesionVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ListeAdherentAdhesionVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}

	/**
	* @name getIdAdhesionAdherent()
	* @return int(11)
	* @desc Renvoie le membre IdAdhesionAdherent de la ListeAdherentAdhesionVO
	*/
	public function getIdAdhesionAdherent() {
		return $this->mIdAdhesionAdherent;
	}

	/**
	* @name setIdAdhesionAdherent($pIdAdhesionAdherent)
	* @param int(11)
	* @desc Remplace le membre IdAdhesionAdherent de la ListeAdherentAdhesionVO par $pIdAdhesionAdherent
	*/
	public function setIdAdhesionAdherent($pIdAdhesionAdherent) {
		$this->mIdAdhesionAdherent = $pIdAdhesionAdherent;
	}

	/**
	* @name getAdadStatutFormulaire()
	* @return tinyint(1)
	* @desc Renvoie le membre AdadStatutFormulaire de la ListeAdherentAdhesionVO
	*/
	public function getAdadStatutFormulaire() {
		return $this->mAdadStatutFormulaire;
	}

	/**
	* @name setAdadStatutFormulaire($pAdadStatutFormulaire)
	* @param tinyint(1)
	* @desc Remplace le membre AdadStatutFormulaire de la ListeAdherentAdhesionVO par $pAdadStatutFormulaire
	*/
	public function setAdadStatutFormulaire($pAdadStatutFormulaire) {
		$this->mAdadStatutFormulaire = $pAdadStatutFormulaire;
	}
}
?>