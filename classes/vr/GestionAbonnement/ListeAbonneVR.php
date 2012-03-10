<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2012
// Fichier : ListeAbonneVR.php
//
// Description : Classe ListeAbonneVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAbonneVR
 * @author Julien PIERRE
 * @since 15/02/2012
 * @desc Classe représentant une ListeAbonneVR
 */
class ListeAbonneVR extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;

	/**
	 * @var VRelement
	 * @desc Le Log de l'objet
	 */
	protected $mLog;

	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	protected $mId;

	/**
	 * @var VRelement
	 * @desc IdAdherent de la ListeAbonneVR
	 */
	protected $mIdAdherent;

	/**
	 * @var VRelement
	 * @desc IdCompte de la ListeAbonneVR
	 */
	protected $mIdCompte;

	/**
	 * @var VRelement
	 * @desc IdProduitAbonnement de la ListeAbonneVR
	 */
	protected $mIdProduitAbonnement;

	/**
	 * @var VRelement
	 * @desc Quantite de la ListeAbonneVR
	 */
	protected $mQuantite;

	/**
	 * @var VRelement
	 * @desc Date de Debut de Suspension de la ListeAbonneVR
	 */
	protected $mDateDebutSuspension;

	/**
	 * @var VRelement
	 * @desc Date de Fin de Suspension de la ListeAbonneVR
	 */
	protected $mDateFinSuspension;

	/**
	* @name ListeAbonneVR()
	* @return bool
	* @desc Constructeur
	*/
	function ListeAbonneVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdAdherent = new VRelement();
		$this->mIdCompte = new VRelement();
		$this->mIdProduitAbonnement = new VRelement();
		$this->mQuantite = new VRelement();
		$this->mDateDebutSuspension = new VRelement();
		$this->mDateFinSuspension = new VRelement();
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
	* @name getLog()
	* @return VRelement
	* @desc Renvoie le VRelement Log
	*/
	public function getLog() {
		return $this->mLog;
	}

	/**
	* @name setLog($pLog)
	* @param VRelement
	* @desc Remplace le VRelement Log par $pLog
	*/
	public function setLog($pLog) {
		$this->mLog = $pLog;
	}

	/**
	* @name getId()
	* @return VRelement
	* @desc Renvoie le VRelement Id
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le VRelement Id par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdAdherent()
	* @return VRelement
	* @desc Renvoie le VRelement mIdAdherent
	*/
	public function getIdAdherent() {
		return $this->mIdAdherent;
	}

	/**
	* @name setIdAdherent($pIdAdherent)
	* @param VRelement
	* @desc Remplace le mIdAdherent par $pIdAdherent
	*/
	public function setIdAdherent($pIdAdherent) {
		$this->mIdAdherent = $pIdAdherent;
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
	* @name getIdProduitAbonnement()
	* @return VRelement
	* @desc Renvoie le VRelement mIdProduitAbonnement
	*/
	public function getIdProduitAbonnement() {
		return $this->mIdProduitAbonnement;
	}

	/**
	* @name setIdProduitAbonnement($pIdProduitAbonnement)
	* @param VRelement
	* @desc Remplace le mIdProduitAbonnement par $pIdProduitAbonnement
	*/
	public function setIdProduitAbonnement($pIdProduitAbonnement) {
		$this->mIdProduitAbonnement = $pIdProduitAbonnement;
	}

	/**
	* @name getQuantite()
	* @return VRelement
	* @desc Renvoie le VRelement mQuantite
	*/
	public function getQuantite() {
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param VRelement
	* @desc Remplace le mQuantite par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getDateDebutSuspension()
	* @return VRelement
	* @desc Renvoie le VRelement mDateDebutSuspension
	*/
	public function getDateDebutSuspension() {
		return $this->mDateDebutSuspension;
	}

	/**
	* @name setDateDebutSuspension($pDateDebutSuspension)
	* @param VRelement
	* @desc Remplace le mDateDebutSuspension par $pDateDebutSuspension
	*/
	public function setDateDebutSuspension($pDateDebutSuspension) {
		$this->mDateDebutSuspension = $pDateDebutSuspension;
	}

	/**
	* @name getDateFinSuspension()
	* @return VRelement
	* @desc Renvoie le VRelement mDateFinSuspension
	*/
	public function getDateFinSuspension() {
		return $this->mDateFinSuspension;
	}

	/**
	* @name setDateFinSuspension($pDateFinSuspension)
	* @param VRelement
	* @desc Remplace le mDateFinSuspension par $pDateFinSuspension
	*/
	public function setDateFinSuspension($pDateFinSuspension) {
		$this->mDateFinSuspension = $pDateFinSuspension;
	}

}
?>