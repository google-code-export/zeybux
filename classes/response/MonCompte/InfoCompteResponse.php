<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2010
// Fichier : InfoCompteResponse.php
//
// Description : Classe InfoCompteResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoCompteResponse
 * @author Julien PIERRE
 * @since 01/11/2010
 * @desc Classe représentant une InfoCompteResponse
 */
class InfoCompteResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var AdherentViewVO
	* @desc Le compte de l'adherent de la InfoCompteResponse
	*/
	protected $mAdherent;
	
	/**
	* @var array(AdherentVO)
	* @desc Les adhérent sur le compte de la InfoCompteResponse
	*/
	protected $mAdherentCompte;
	
	/**
	* @var array(OperationAvenirViewVO)
	* @desc ListeCommande de la InfoCompteResponse
	*/
	protected $mOperationAvenir;
	
	/**
	* @var array(OperationPasseeViewVO)
	* @desc ListeCommande de la InfoCompteResponse
	*/
	protected $mOperationPassee;
	
	/**
	 * @var integer
	 * @desc NbAdhesionEnCours de la InfoCompteResponse
	 */
	protected $mNbAdhesionEnCours;
	
	/**
	* @name InfoCompteResponse()
	* @desc Le constructeur de InfoCompteResponse
	*/	
	public function InfoCompteResponse() {
		$this->mValid = true;
		$this->mOperationAvenir = array();
		$this->mOperationPassee = array();
		$this->mAdherentCompte = array();
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
	* @name getOperationAvenir()
	* @return array(OperationAvenirViewVO)
	* @desc Renvoie le membre OperationAvenir de la InfoCompteResponse
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
	* @desc Renvoie le membre OperationPassee de la InfoCompteResponse
	*/
	public function getOperationPassee(){
		return $this->mOperationPassee;
	}

	/**
	* @name setOperationPassee($pOperationPassee)
	* @param array(OperationPasseeViewVO)
	* @desc Remplace le membre OperationPassee de la InfoCompteResponse par $pOperationPassee
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
	* @name getAdherentCompte()
	* @return array(AdherentVO)
	* @desc Renvoie le membre AdherentCompte de la InfoCompteResponse
	*/
	public function getAdherentCompte(){
		return $this->mAdherentCompte;
	}

	/**
	* @name setAdherentCompte($pAdherentCompte)
	* @param array(AdherentVO)
	* @desc Remplace le membre AdherentCompte de la InfoCompteResponse par $pAdherentCompte
	*/
	public function setAdherentCompte($pAdherentCompte) {
		$this->mAdherentCompte = $pAdherentCompte;
	}
	
	/**
	* @name addAdherentCompte($pAdherentCompte)
	* @param AdherentVO
	* @desc Ajoute $pAdherentCompte à AdherentCompte
	*/
	public function addAdherentCompte($pAdherentCompte){
		array_push($this->mAdherentCompte,$pAdherentCompte);
	}
	
	/**
	* @name getNbAdhesionEnCours()
	* @return integer
	* @desc Renvoie le membre NbAdhesionEnCours de la InfoCompteResponse
	*/
	public function getNbAdhesionEnCours(){
		return $this->mNbAdhesionEnCours;
	}

	/**
	* @name setNbAdhesionEnCours($pNbAdhesionEnCours)
	* @param integer
	* @desc Remplace le membre NbAdhesionEnCours de la InfoCompteResponse par $pNbAdhesionEnCours
	*/
	public function setNbAdhesionEnCours($pNbAdhesionEnCours) {
		$this->mNbAdhesionEnCours = $pNbAdhesionEnCours;
	}
}
?>