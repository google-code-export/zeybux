<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2010
// Fichier : InfoCompteAdherentResponse.php
//
// Description : Classe InfoCompteAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoCompteAdherentResponse
 * @author Julien PIERRE
 * @since 03/11/2010
 * @desc Classe représentant une InfoCompteAdherentResponse
 */
class InfoCompteAdherentResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var AdherentViewVO
	* @desc Le compte de l'adherent de la InfoCompteAdherentResponse
	*/
	protected $mAdherent;
	
	/**
	* @var array(AutorisationVO)
	* @desc Les autorisations de la InfoCompteAdherentResponse
	*/
	protected $mAutorisations;
	
	/**
	* @var array(OperationAvenirViewVO)
	* @desc OperationAvenir de la InfoCompteAdherentResponse
	*/
	protected $mOperationAvenir;
	
	/**
	* @var array(OperationPasseeViewVO)
	* @desc OperationPassee de la InfoCompteAdherentResponse
	*/
	protected $mOperationPassee;	
	
	/**
	* @var array(ModuleVO)
	* @desc Les Modules de la InfoCompteAdherentResponse
	*/
	protected $mModules;
	
	/**
	* @var array(TypePaiementVO)
	* @desc Les TypePaiement de la InfoCompteAdherentResponse
	*/
	protected $mTypePaiement;
	
	/**
	* @name InfoCompteAdherentResponse()
	* @desc Le constructeur de InfoCompteAdherentResponse
	*/	
	public function InfoCompteAdherentResponse() {
		$this->mValid = true;
		$this->mAutorisations = array();
		$this->mOperationAvenir = array();
		$this->mOperationPassee = array();
		$this->mModules = array();
		$this->mTypePaiement = array();
	}
	
	/**
	* @name getValid()
	* @return bool
	* @desc Renvoie la validite de l'élément
	*/
	public function getValid() {
		return $this->mValid;
	}

	/**
	* @name setValid($pValid)
	* @param bool
	* @desc Remplace la validite de l'élément par $pValid
	*/
	public function setValid($pValid) {
		$this->mValid = $pValid;
	}
		
	/**
	* @name getAdherent()
	* @return AdherentViewVO
	* @desc Renvoie l'Adherent de l'élément
	*/
	public function getAdherent() {
		return $this->mAdherent;
	}

	/**
	* @name setAdherent($pAdherent)
	* @param AdherentViewVO
	* @desc Remplace l'Adherent de l'élément par $pAdherent
	*/
	public function setAdherent($pAdherent) {
		$this->mAdherent = $pAdherent;
	}
	
	/**
	* @name getAutorisations()
	* @return array(AutorisationVO)
	* @desc Renvoie l'Autorisations de l'élément
	*/
	public function getAutorisations() {
		return $this->mAutorisations;
	}

	/**
	* @name setAutorisations($pAutorisations)
	* @param array(AutorisationVO)
	* @desc Remplace l'Autorisations de l'élément par $pAutorisations
	*/
	public function setAutorisations($pAutorisations) {
		$this->mAutorisations = $pAutorisations;
	}
	
	/**
	* @name addAutorisations($pAutorisations)
	* @param AutorisationVO
	* @desc Ajoute $pAutorisations à Autorisations
	*/
	public function addAutorisations($pAutorisations){
		array_push($this->mAutorisations,$pAutorisations);
	}
	
	/**
	* @name getOperationAvenir()
	* @return array(OperationAvenirViewVO)
	* @desc Renvoie le membre OperationAvenir de la InfoCompteAdherentResponse
	*/
	public function getOperationAvenir(){
		return $this->mOperationAvenir;
	}

	/**
	* @name setOperationAvenir($pOperationAvenir)
	* @param array(OperationAvenirViewVO)
	* @desc Remplace le membre OperationAvenir de la InfoCompteResponse par $pOperationAvenir
	*/
	public function setOperationAvenir($pOperationAvenir) {
		$this->mOperationAvenir = $pOperationAvenir;
	}
	
	/**
	* @name addOperationAvenir($pOperationAvenir)
	* @param OperationAvenirViewVO
	* @desc Ajoute $pOperationAvenir à OperationAvenir
	*/
	public function addOperationAvenir($pOperationAvenir){
		array_push($this->mOperationAvenir,$pOperationAvenir);
	}
	
	/**
	* @name getOperationPassee()
	* @return array(OperationPasseeViewVO)
	* @desc Renvoie le membre OperationPassee de la InfoCompteAdherentResponse
	*/
	public function getOperationPassee(){
		return $this->mOperationPassee;
	}

	/**
	* @name setOperationPassee($pOperationPassee)
	* @param array(OperationPasseeViewVO)
	* @desc Remplace le membre OperationPassee de la InfoCompteAdherentResponse par $pOperationPassee
	*/
	public function setOperationPassee($pOperationPassee) {
		$this->mOperationPassee = $pOperationPassee;
	}
	
	/**
	* @name addOperationPassee($pOperationPassee)
	* @param OperationPasseeViewVO
	* @desc Ajoute $pOperationPassee à OperationPassee
	*/
	public function addOperationPassee($pOperationPassee){
		array_push($this->mOperationPassee,$pOperationPassee);
	}
	
	/**
	* @name getModules()
	* @return array(ModulesVO)
	* @desc Renvoie le membre Modules de la InfoCompteAdherentResponse
	*/
	public function getModules(){
		return $this->mModules;
	}

	/**
	* @name setModules($pModules)
	* @param array(ModulesVO)
	* @desc Remplace le membre Modules de la InfoCompteAdherentResponse par $pModules
	*/
	public function setModules($pModules) {
		$this->mModules = $pModules;
	}
	
	/**
	* @name addModules($pModules)
	* @param ModulesVO
	* @desc Ajoute $pModules à Modules
	*/
	public function addModules($pModules){
		array_push($this->mModules,$pModules);
	}
	
	/**
	* @name getTypePaiement()
	* @return array(TypePaiementVO)
	* @desc Renvoie le membre TypePaiement de la InfoCompteAdherentResponse
	*/
	public function getTypePaiement(){
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param array(TypePaiementVO)
	* @desc Remplace le membre TypePaiement de la InfoCompteAdherentResponse par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}
	
	/**
	* @name addTypePaiement($pTypePaiement)
	* @param TypePaiementVO
	* @desc Ajoute $pTypePaiement à TypePaiement
	*/
	public function addTypePaiement($pTypePaiement){
		array_push($this->mTypePaiement,$pTypePaiement);
	}
}
?>