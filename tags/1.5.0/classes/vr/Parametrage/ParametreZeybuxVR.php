<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/05/2014
// Fichier : ParametreZeybuxVR.php
//
// Description : Classe ParametreZeybuxVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ParametreZeybuxVR
 * @author Julien PIERRE
 * @since 30/05/2014
 * @desc Classe représentant une ParametreZeybuxVR
 */
class ParametreZeybuxVR extends DataTemplate
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
	 * @desc MailSupport de la ParametreZeybuxVR
	 */
	protected $mMailSupport;
	
	/**
	 * @var VRelement
	 * @desc MailMailingListe de la ParametreZeybuxVR
	 */
	protected $mMailMailingListe;
	
	/**
	 * @var VRelement
	 * @desc MailMailingListeDomaine de la ParametreZeybuxVR
	 */
	protected $mMailMailingListeDomaine;
	
	/**
	 * @var VRelement
	 * @desc AdresseWSDL de la ParametreZeybuxVR
	 */
	protected $mAdresseWSDL;
	
	/**
	 * @var VRelement
	 * @desc SOAPLogin de la ParametreZeybuxVR
	 */
	protected $mSOAPLogin;
	
	/**
	 * @var VRelement
	 * @desc SOAPPass de la ParametreZeybuxVR
	 */
	protected $mSOAPPass;
	
	/**
	 * @var VRelement
	 * @desc ZeybuxTitre de la ParametreZeybuxVR
	 */
	protected $mZeybuxTitre;
	
	/**
	 * @var VRelement
	 * @desc ZeybuxAdresse de la ParametreZeybuxVR
	 */
	protected $mZeybuxAdresse;
	
	/**
	 * @var VRelement
	 * @desc PropNom de la ParametreZeybuxVR
	 */
	protected $mPropNom;
	
	/**
	 * @var VRelement
	 * @desc PropAdresse de la ParametreZeybuxVR
	 */
	protected $mPropAdresse;
	
	/**
	 * @var VRelement
	 * @desc PropCP de la ParametreZeybuxVR
	 */
	protected $mPropCP;
	
	/**
	 * @var VRelement
	 * @desc PropVille de la ParametreZeybuxVR
	 */
	protected $mPropVille;
	
	/**
	 * @var VRelement
	 * @desc PropTel de la ParametreZeybuxVR
	 */
	protected $mPropTel;
	
	/**
	 * @var VRelement
	 * @desc PropMail de la ParametreZeybuxVR
	 */
	protected $mPropMail;
	
	/**
	 * @var VRelement
	 * @desc PropRespMarcheNom de la ParametreZeybuxVR
	 */
	protected $mPropRespMarcheNom;
	
	/**
	 * @var VRelement
	 * @desc PropRespMarchePrenom de la ParametreZeybuxVR
	 */
	protected $mPropRespMarchePrenom;
	
	/**
	 * @var VRelement
	 * @desc PropRespMarchePoste de la ParametreZeybuxVR
	 */
	protected $mPropRespMarchePoste;
	
	/**
	 * @var VRelement
	 * @desc PropRespMarcheTel de la ParametreZeybuxVR
	 */
	protected $mPropRespMarcheTel;

	/**
	* @name BanqueVR()
	* @return bool
	* @desc Constructeur
	*/
	function ParametreZeybuxVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mMailSupport = new VRelement();
		$this->mMailMailingListe = new VRelement();
		$this->mMailMailingListeDomaine = new VRelement();
		$this->mAdresseWSDL = new VRelement();
		$this->mSOAPLogin = new VRelement();
		$this->mSOAPPass = new VRelement();
		$this->mZeybuxTitre = new VRelement();
		$this->mZeybuxAdresse = new VRelement();
		$this->mPropNom = new VRelement();
		$this->mPropAdresse = new VRelement();
		$this->mPropCP = new VRelement();
		$this->mPropVille = new VRelement();
		$this->mPropTel = new VRelement();
		$this->mPropMail = new VRelement();
		$this->mPropRespMarcheNom = new VRelement();
		$this->mPropRespMarchePrenom = new VRelement();
		$this->mPropRespMarchePoste = new VRelement();
		$this->mPropRespMarcheTel = new VRelement();
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
	 * @name getMailSupport()
	 * @return varchar
	 * @desc Renvoie le membre MailSupport de la ParametreZeybuxVR
	 */
	public function getMailSupport() {
		return $this->mMailSupport;
	}
	
	/**
	 * @name setMailSupport($pMailSupport)
	 * @param varchar
	 * @desc Remplace le membre MailSupport de la ParametreZeybuxVR par $pMailSupport
	 */
	public function setMailSupport($pMailSupport) {
		$this->mMailSupport = $pMailSupport;
	}
	
	/**
	 * @name getMailMailingListe()
	 * @return varchar
	 * @desc Renvoie le membre MailMailingListe de la ParametreZeybuxVR
	 */
	public function getMailMailingListe() {
		return $this->mMailMailingListe;
	}
	
	/**
	 * @name setMailMailingListe($pMailMailingListe)
	 * @param varchar
	 * @desc Remplace le membre MailMailingListe de la ParametreZeybuxVR par $pMailMailingListe
	 */
	public function setMailMailingListe($pMailMailingListe) {
		$this->mMailMailingListe = $pMailMailingListe;
	}
	
	/**
	 * @name getMailMailingListeDomaine()
	 * @return varchar
	 * @desc Renvoie le membre MailMailingListeDomaine de la ParametreZeybuxVR
	 */
	public function getMailMailingListeDomaine() {
		return $this->mMailMailingListeDomaine;
	}
	
	/**
	 * @name setMailMailingListeDomaine($pMailMailingListeDomaine)
	 * @param varchar
	 * @desc Remplace le membre MailMailingListeDomaine de la ParametreZeybuxVR par $pMailMailingListeDomaine
	 */
	public function setMailMailingListeDomaine($pMailMailingListeDomaine) {
		$this->mMailMailingListeDomaine = $pMailMailingListeDomaine;
	}
	
	/**
	 * @name getAdresseWSDL()
	 * @return varchar
	 * @desc Renvoie le membre AdresseWSDL de la ParametreZeybuxVR
	 */
	public function getAdresseWSDL() {
		return $this->mAdresseWSDL;
	}
	
	/**
	 * @name setAdresseWSDL($pAdresseWSDL)
	 * @param varchar
	 * @desc Remplace le membre AdresseWSDL de la ParametreZeybuxVR par $pAdresseWSDL
	 */
	public function setAdresseWSDL($pAdresseWSDL) {
		$this->mAdresseWSDL = $pAdresseWSDL;
	}
	
	/**
	 * @name getSOAPLogin()
	 * @return varchar
	 * @desc Renvoie le membre SOAPLogin de la ParametreZeybuxVR
	 */
	public function getSOAPLogin() {
		return $this->mSOAPLogin;
	}
	
	/**
	 * @name setSOAPLogin($pSOAPLogin)
	 * @param varchar
	 * @desc Remplace le membre SOAPLogin de la ParametreZeybuxVR par $pSOAPLogin
	 */
	public function setSOAPLogin($pSOAPLogin) {
		$this->mSOAPLogin = $pSOAPLogin;
	}
	
	/**
	 * @name getSOAPPass()
	 * @return varchar
	 * @desc Renvoie le membre SOAPPass de la ParametreZeybuxVR
	 */
	public function getSOAPPass() {
		return $this->mSOAPPass;
	}
	
	/**
	 * @name setSOAPPass($pSOAPPass)
	 * @param varchar
	 * @desc Remplace le membre SOAPPass de la ParametreZeybuxVR par $pSOAPPass
	 */
	public function setSOAPPass($pSOAPPass) {
		$this->mSOAPPass = $pSOAPPass;
	}
	
	/**
	 * @name getZeybuxTitre()
	 * @return varchar
	 * @desc Renvoie le membre ZeybuxTitre de la ParametreZeybuxVR
	 */
	public function getZeybuxTitre() {
		return $this->mZeybuxTitre;
	}
	
	/**
	 * @name setZeybuxTitreSite($pZeybuxTitre)
	 * @param varchar
	 * @desc Remplace le membre ZeybuxTitre de la ParametreZeybuxVR par $pZeybuxTitre
	 */
	public function setZeybuxTitre($pZeybuxTitre) {
		$this->mZeybuxTitre = $pZeybuxTitre;
	}
	
	/**
	 * @name getZeybuxAdresse()
	 * @return varchar
	 * @desc Renvoie le membre ZeybuxAdresse de la ParametreZeybuxVR
	 */
	public function getZeybuxAdresse() {
		return $this->mZeybuxAdresse;
	}
	
	/**
	 * @name setZeybuxAdresse($pZeybuxAdresse)
	 * @param varchar
	 * @desc Remplace le membre ZeybuxAdresse de la ParametreZeybuxVR par $pZeybuxAdresse
	 */
	public function setZeybuxAdresse($pZeybuxAdresse) {
		$this->mZeybuxAdresse = $pZeybuxAdresse;
	}
	
	/**
	 * @name getPropNom()
	 * @return varchar
	 * @desc Renvoie le membre PropNom de la ParametreZeybuxVR
	 */
	public function getPropNom() {
		return $this->mPropNom;
	}
	
	/**
	 * @name setPropNom($pPropNom)
	 * @param varchar
	 * @desc Remplace le membre PropNom de la ParametreZeybuxVR par $pPropNom
	 */
	public function setPropNom($pPropNom) {
		$this->mPropNom = $pPropNom;
	}
	
	/**
	 * @name getPropAdresse()
	 * @return varchar
	 * @desc Renvoie le membre PropAdresse de la ParametreZeybuxVR
	 */
	public function getPropAdresse() {
		return $this->mPropAdresse;
	}
	
	/**
	 * @name setPropAdresse($pPropAdresse)
	 * @param varchar
	 * @desc Remplace le membre PropAdresse de la ParametreZeybuxVR par $pPropAdresse
	 */
	public function setPropAdresse($pPropAdresse) {
		$this->mPropAdresse = $pPropAdresse;
	}
	
	/**
	 * @name getPropCP()
	 * @return varchar
	 * @desc Renvoie le membre PropCP de la ParametreZeybuxVR
	 */
	public function getPropCP() {
		return $this->mPropCP;
	}
	
	/**
	 * @name setPropCP($pPropCP)
	 * @param varchar
	 * @desc Remplace le membre PropCP de la ParametreZeybuxVR par $pPropCP
	 */
	public function setPropCP($pPropCP) {
		$this->mPropCP = $pPropCP;
	}
	
	/**
	 * @name getPropVille()
	 * @return varchar
	 * @desc Renvoie le membre PropVille de la ParametreZeybuxVR
	 */
	public function getPropVille() {
		return $this->mPropVille;
	}
	
	/**
	 * @name setPropVille($pPropVille)
	 * @param varchar
	 * @desc Remplace le membre PropVille de la ParametreZeybuxVR par $pPropVille
	 */
	public function setPropVille($pPropVille) {
		$this->mPropVille = $pPropVille;
	}
	
	/**
	 * @name getPropTel()
	 * @return varchar
	 * @desc Renvoie le membre PropTel de la ParametreZeybuxVR
	 */
	public function getPropTel() {
		return $this->mPropTel;
	}
	
	/**
	 * @name setPropTel($pPropTel)
	 * @param varchar
	 * @desc Remplace le membre PropTel de la ParametreZeybuxVR par $pPropTel
	 */
	public function setPropTel($pPropTel) {
		$this->mPropTel = $pPropTel;
	}
	
	/**
	 * @name getPropMail()
	 * @return varchar
	 * @desc Renvoie le membre PropMail de la ParametreZeybuxVR
	 */
	public function getPropMail() {
		return $this->mPropMail;
	}
	
	/**
	 * @name setPropMail($pPropMail)
	 * @param varchar
	 * @desc Remplace le membre PropMail de la ParametreZeybuxVR par $pPropMail
	 */
	public function setPropMail($pPropMail) {
		$this->mPropMail = $pPropMail;
	}
	
	/**
	 * @name getPropRespMarcheNom()
	 * @return varchar
	 * @desc Renvoie le membre PropRespMarcheNom de la ParametreZeybuxVR
	 */
	public function getPropRespMarcheNom() {
		return $this->mPropRespMarcheNom;
	}
	
	/**
	 * @name setPropRespMarcheNom($pPropRespMarcheNom)
	 * @param varchar
	 * @desc Remplace le membre PropRespMarcheNom de la ParametreZeybuxVR par $pPropRespMarcheNom
	 */
	public function setPropRespMarcheNom($pPropRespMarcheNom) {
		$this->mPropRespMarcheNom = $pPropRespMarcheNom;
	}
	
	/**
	 * @name getPropRespMarchePrenom()
	 * @return varchar
	 * @desc Renvoie le membre PropRespMarchePrenom de la ParametreZeybuxVR
	 */
	public function getPropRespMarchePrenom() {
		return $this->mPropRespMarchePrenom;
	}
	
	/**
	 * @name setPropRespMarchePrenom($pPropRespMarchePrenom)
	 * @param varchar
	 * @desc Remplace le membre PropRespMarchePrenom de la ParametreZeybuxVR par $pPropRespMarchePrenom
	 */
	public function setPropRespMarchePrenom($pPropRespMarchePrenom) {
		$this->mPropRespMarchePrenom = $pPropRespMarchePrenom;
	}
	
	/**
	 * @name getPropRespMarchePoste()
	 * @return varchar
	 * @desc Renvoie le membre PropRespMarchePoste de la ParametreZeybuxVR
	 */
	public function getPropRespMarchePoste() {
		return $this->mPropRespMarchePoste;
	}
	
	/**
	 * @name setPropRespMarchePoste($pPropRespMarchePoste)
	 * @param varchar
	 * @desc Remplace le membre PropRespMarchePoste de la ParametreZeybuxVR par $pPropRespMarchePoste
	 */
	public function setPropRespMarchePoste($pPropRespMarchePoste) {
		$this->mPropRespMarchePoste = $pPropRespMarchePoste;
	}
	
	/**
	 * @name getPropRespMarcheTel()
	 * @return varchar
	 * @desc Renvoie le membre PropRespMarcheTel de la ParametreZeybuxVR
	 */
	public function getPropRespMarcheTel() {
		return $this->mPropRespMarcheTel;
	}
	
	/**
	 * @name setPropRespMarcheTel($pPropRespMarcheTel)
	 * @param varchar
	 * @desc Remplace le membre PropRespMarcheTel de la ParametreZeybuxVR par $pPropRespMarcheTel
	 */
	public function setPropRespMarcheTel($pPropRespMarcheTel) {
		$this->mPropRespMarcheTel = $pPropRespMarcheTel;
	}
}
?>