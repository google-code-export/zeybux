<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/06/2014
// Fichier : InformationBancaireVR.php
//
// Description : Classe InformationBancaireVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name InformationBancaireVR
 * @author Julien PIERRE
 * @since 09/06/2014
 * @desc Classe représentant une InformationBancaireVR
 */
class InformationBancaireVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc Id de la InformationBancaireVR
	 */
	protected $mId;
	
	/**
	 * @var VRelement
	 * @desc IdCompte de la InformationBancaireVR
	 */
	protected $mIdCompte;
	
	/**
	 * @var VRelement
	 * @desc NumeroCompte de la InformationBancaireVR
	 */
	protected $mNumeroCompte;
	
	/**
	 * @var VRelement
	 * @desc RaisonSociale de la InformationBancaireVR
	 */
	protected $mRaisonSociale;
	
	/**
	* @name InformationBancaireVR()
	* @return bool
	* @desc Constructeur
	*/
	function InformationBancaireVR() {
		parent::__construct();
		$this->mId = new VRelement();
		$this->mIdCompte = new VRelement();
		$this->mNumeroCompte = new VRelement();
		$this->mRaisonSociale = new VRelement();
	}

	/**
	* @name getId()
	* @return VRelement
	* @desc Renvoie le VRelement mId
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le mId par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
		
	/**
	 * @name getIdCompte()
	 * @return VRelement
	 * @desc Renvoie le VRelement mIdCompte
	 */
	public function getIdCompte() {
		return $this->mIdCompte;
	}
	
	/**
	 * @name setIdCompte($pIdCompte)
	 * @param VRelement
	 * @desc Remplace le mIdCompte par $pIdCompte
	 */
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}
	
	/**
	 * @name getNumeroCompte()
	 * @return VRelement
	 * @desc Renvoie le VRelement mNumeroCompte
	 */
	public function getNumeroCompte() {
		return $this->mNumeroCompte;
	}
	
	/**
	 * @name setNumeroCompte($pNumeroCompte)
	 * @param VRelement
	 * @desc Remplace le mNumeroCompte par $pNumeroCompte
	 */
	public function setNumeroCompte($pNumeroCompte) {
		$this->mNumeroCompte = $pNumeroCompte;
	}
	
	/**
	 * @name getRaisonSociale()
	 * @return VRelement
	 * @desc Renvoie le VRelement mRaisonSociale
	 */
	public function getRaisonSociale() {
		return $this->mRaisonSociale;
	}
	
	/**
	 * @name setRaisonSociale($pRaisonSociale)
	 * @param VRelement
	 * @desc Remplace le mRaisonSociale par $pRaisonSociale
	 */
	public function setRaisonSociale($pRaisonSociale) {
		$this->mRaisonSociale = $pRaisonSociale;
	}
}
?>