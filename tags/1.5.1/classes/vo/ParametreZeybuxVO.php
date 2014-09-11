<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/05/2014
// Fichier : ParametreZeybuxVO.php
//
// Description : Classe ParametreZeybuxVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ParametreZeybuxVO
 * @author Julien PIERRE
 * @since 30/05/2014
 * @desc Classe représentant une ParametreZeybuxVO
 */
class ParametreZeybuxVO  extends DataTemplate
{
	/**
	* @var varchar
	* @desc MailSupport de la ParametreZeybuxVO
	*/
	protected $mMailSupport;

	/**
	* @var varchar
	* @desc MailMailingListe de la ParametreZeybuxVO
	*/
	protected $mMailMailingListe;

	/**
	* @var varchar
	* @desc MailMailingListeDomaine de la ParametreZeybuxVO
	*/
	protected $mMailMailingListeDomaine;

	/**
	* @var varchar
	* @desc AdresseWSDL de la ParametreZeybuxVO
	*/
	protected $mAdresseWSDL;

	/**
	* @var varchar
	* @desc SOAPLogin de la ParametreZeybuxVO
	*/
	protected $mSOAPLogin;

	/**
	* @var varchar
	* @desc SOAPPass de la ParametreZeybuxVO
	*/
	protected $mSOAPPass;

	/**
	* @var varchar
	* @desc ZeybuxTitre de la ParametreZeybuxVO
	*/
	protected $mZeybuxTitre;

	/**
	* @var varchar
	* @desc ZeybuxAdresse de la ParametreZeybuxVO
	*/
	protected $mZeybuxAdresse;
	
	/**
	 * @var varchar
	 * @desc PropNom de la ParametreZeybuxVO
	 */
	protected $mPropNom;
	
	/**
	 * @var varchar
	 * @desc PropAdresse de la ParametreZeybuxVO
	 */
	protected $mPropAdresse;
	
	/**
	 * @var varchar
	 * @desc PropCP de la ParametreZeybuxVO
	 */
	protected $mPropCP;

	/**
	 * @var varchar
	 * @desc PropVille de la ParametreZeybuxVO
	 */
	protected $mPropVille;

	/**
	 * @var varchar
	 * @desc PropTel de la ParametreZeybuxVO
	 */
	protected $mPropTel;

	/**
	 * @var varchar
	 * @desc PropMail de la ParametreZeybuxVO
	 */
	protected $mPropMail;

	/**
	 * @var varchar
	 * @desc PropRespMarcheNom de la ParametreZeybuxVO
	 */
	protected $mPropRespMarcheNom;

	/**
	 * @var varchar
	 * @desc PropRespMarchePrenom de la ParametreZeybuxVO
	 */
	protected $mPropRespMarchePrenom;

	/**
	 * @var varchar
	 * @desc PropRespMarchePoste de la ParametreZeybuxVO
	 */
	protected $mPropRespMarchePoste;

	/**
	 * @var varchar
	 * @desc PropRespMarcheTel de la ParametreZeybuxVO
	 */
	protected $mPropRespMarcheTel;

	/**
	 * @name ParametreZeybuxVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function ParametreZeybuxVO($pMailSupport = null, $pMailMailingListe = null, $pMailMailingListeDomaine = null, $pAdresseWSDL = null, $pSOAPLogin = null, $pSOAPPass = null, $pZeybuxTitre = null, $pZeybuxAdresse = null, $pPropNom = null, $pPropAdresse = null, $pPropCP = null, $pPropVille = null, $pPropTel = null, $pPropMail = null, $pPropRespMarcheNom = null, $pPropRespMarchePrenom = null, $pPropRespMarchePoste = null, $pPropRespMarcheTel = null) {
		if(!is_null($pMailSupport)) { $this->mMailSupport = $pMailSupport; }
		if(!is_null($pMailMailingListe)) { $this->mMailMailingListe = $pMailMailingListe; }
		if(!is_null($pMailMailingListeDomaine)) { $this->mMailMailingListeDomaine = $pMailMailingListeDomaine; }
		if(!is_null($pAdresseWSDL)) { $this->mAdresseWSDL = $pAdresseWSDL; }
		if(!is_null($pSOAPLogin)) { $this->mSOAPLogin = $pSOAPLogin; }
		if(!is_null($pSOAPPass)) { $this->mSOAPPass = $pSOAPPass; }
		if(!is_null($pZeybuxTitre)) { $this->mZeybuxTitre = $pZeybuxTitre; }
		if(!is_null($pZeybuxAdresse)) { $this->mZeybuxAdresse = $pZeybuxAdresse; }
		if(!is_null($pPropNom)) { $this->mPropNom = $pPropNom; }
		if(!is_null($pPropAdresse)) { $this->mPropAdresse = $pPropAdresse; }
		if(!is_null($pPropCP)) { $this->mPropCP = $pPropCP; }
		if(!is_null($pPropVille)) { $this->mPropVille = $pPropVille; }
		if(!is_null($pPropTel)) { $this->mPropTel = $pPropTel; }
		if(!is_null($pPropMail)) { $this->mPropMail = $pPropMail; }
		if(!is_null($pPropRespMarcheNom)) { $this->mPropRespMarcheNom = $pPropRespMarcheNom; }
		if(!is_null($pPropRespMarchePrenom)) { $this->mPropRespMarchePrenom = $pPropRespMarchePrenom; }
		if(!is_null($pPropRespMarchePoste)) { $this->mPropRespMarchePoste = $pPropRespMarchePoste; }
		if(!is_null($pPropRespMarcheTel)) { $this->mPropRespMarcheTel = $pPropRespMarcheTel; }
	}
	/**
	 * @name getMailSupport()
	 * @return varchar
	 * @desc Renvoie le membre MailSupport de la ParametreZeybuxVO
	 */
	public function getMailSupport() {
		return $this->mMailSupport;
	}
	
	/**
	 * @name setMailSupport($pMailSupport)
	 * @param varchar
	 * @desc Remplace le membre MailSupport de la ParametreZeybuxVO par $pMailSupport
	 */
	public function setMailSupport($pMailSupport) {
		$this->mMailSupport = $pMailSupport;
	}
	
	/**
	 * @name getMailMailingListe()
	 * @return varchar
	 * @desc Renvoie le membre MailMailingListe de la ParametreZeybuxVO
	 */
	public function getMailMailingListe() {
		return $this->mMailMailingListe;
	}
	
	/**
	 * @name setMailMailingListe($pMailMailingListe)
	 * @param varchar
	 * @desc Remplace le membre MailMailingListe de la ParametreZeybuxVO par $pMailMailingListe
	 */
	public function setMailMailingListe($pMailMailingListe) {
		$this->mMailMailingListe = $pMailMailingListe;
	}
	
	/**
	 * @name getMailMailingListeDomaine()
	 * @return varchar
	 * @desc Renvoie le membre MailMailingListeDomaine de la ParametreZeybuxVO
	 */
	public function getMailMailingListeDomaine() {
		return $this->mMailMailingListeDomaine;
	}
	
	/**
	 * @name setMailMailingListeDomaine($pMailMailingListeDomaine)
	 * @param varchar
	 * @desc Remplace le membre MailMailingListeDomaine de la ParametreZeybuxVO par $pMailMailingListeDomaine
	 */
	public function setMailMailingListeDomaine($pMailMailingListeDomaine) {
		$this->mMailMailingListeDomaine = $pMailMailingListeDomaine;
	}
	
	/**
	 * @name getAdresseWSDL()
	 * @return varchar
	 * @desc Renvoie le membre AdresseWSDL de la ParametreZeybuxVO
	 */
	public function getAdresseWSDL() {
		return $this->mAdresseWSDL;
	}
	
	/**
	 * @name setAdresseWSDL($pAdresseWSDL)
	 * @param varchar
	 * @desc Remplace le membre AdresseWSDL de la ParametreZeybuxVO par $pAdresseWSDL
	 */
	public function setAdresseWSDL($pAdresseWSDL) {
		$this->mAdresseWSDL = $pAdresseWSDL;
	}
	
	/**
	 * @name getSOAPLogin()
	 * @return varchar
	 * @desc Renvoie le membre SOAPLogin de la ParametreZeybuxVO
	 */
	public function getSOAPLogin() {
		return $this->mSOAPLogin;
	}
	
	/**
	 * @name setSOAPLogin($pSOAPLogin)
	 * @param varchar
	 * @desc Remplace le membre SOAPLogin de la ParametreZeybuxVO par $pSOAPLogin
	 */
	public function setSOAPLogin($pSOAPLogin) {
		$this->mSOAPLogin = $pSOAPLogin;
	}
	
	/**
	 * @name getSOAPPass()
	 * @return varchar
	 * @desc Renvoie le membre SOAPPass de la ParametreZeybuxVO
	 */
	public function getSOAPPass() {
		return $this->mSOAPPass;
	}
	
	/**
	 * @name setSOAPPass($pSOAPPass)
	 * @param varchar
	 * @desc Remplace le membre SOAPPass de la ParametreZeybuxVO par $pSOAPPass
	 */
	public function setSOAPPass($pSOAPPass) {
		$this->mSOAPPass = $pSOAPPass;
	}

	/**
	 * @name getZeybuxTitre()
	 * @return varchar
	 * @desc Renvoie le membre ZeybuxTitre de la ParametreZeybuxVO
	 */
	public function getZeybuxTitre() {
		return $this->mZeybuxTitre;
	}
	
	/**
	 * @name setZeybuxTitreSite($pZeybuxTitre)
	 * @param varchar
	 * @desc Remplace le membre ZeybuxTitre de la ParametreZeybuxVO par $pZeybuxTitre
	 */
	public function setZeybuxTitre($pZeybuxTitre) {
		$this->mZeybuxTitre = $pZeybuxTitre;
	}

	/**
	 * @name getZeybuxAdresse()
	 * @return varchar
	 * @desc Renvoie le membre ZeybuxAdresse de la ParametreZeybuxVO
	 */
	public function getZeybuxAdresse() {
		return $this->mZeybuxAdresse;
	}
	
	/**
	 * @name setZeybuxAdresse($pZeybuxAdresse)
	 * @param varchar
	 * @desc Remplace le membre ZeybuxAdresse de la ParametreZeybuxVO par $pZeybuxAdresse
	 */
	public function setZeybuxAdresse($pZeybuxAdresse) {
		$this->mZeybuxAdresse = $pZeybuxAdresse;
	}
	
	/**
	 * @name getPropNom()
	 * @return varchar
	 * @desc Renvoie le membre PropNom de la ParametreZeybuxVO
	 */
	public function getPropNom() {
		return $this->mPropNom;
	}
	
	/**
	 * @name setPropNom($pPropNom)
	 * @param varchar
	 * @desc Remplace le membre PropNom de la ParametreZeybuxVO par $pPropNom
	 */
	public function setPropNom($pPropNom) {
		$this->mPropNom = $pPropNom;
	}
	
	/**
	 * @name getPropAdresse()
	 * @return varchar
	 * @desc Renvoie le membre PropAdresse de la ParametreZeybuxVO
	 */
	public function getPropAdresse() {
		return $this->mPropAdresse;
	}
	
	/**
	 * @name setPropAdresse($pPropAdresse)
	 * @param varchar
	 * @desc Remplace le membre PropAdresse de la ParametreZeybuxVO par $pPropAdresse
	 */
	public function setPropAdresse($pPropAdresse) {
		$this->mPropAdresse = $pPropAdresse;
	}
	
	/**
	 * @name getPropCP()
	 * @return varchar
	 * @desc Renvoie le membre PropCP de la ParametreZeybuxVO
	 */
	public function getPropCP() {
		return $this->mPropCP;
	}
	
	/**
	 * @name setPropCP($pPropCP)
	 * @param varchar
	 * @desc Remplace le membre PropCP de la ParametreZeybuxVO par $pPropCP
	 */
	public function setPropCP($pPropCP) {
		$this->mPropCP = $pPropCP;
	}
	
	/**
	 * @name getPropVille()
	 * @return varchar
	 * @desc Renvoie le membre PropVille de la ParametreZeybuxVO
	 */
	public function getPropVille() {
		return $this->mPropVille;
	}
	
	/**
	 * @name setPropVille($pPropVille)
	 * @param varchar
	 * @desc Remplace le membre PropVille de la ParametreZeybuxVO par $pPropVille
	 */
	public function setPropVille($pPropVille) {
		$this->mPropVille = $pPropVille;
	}
	
	/**
	 * @name getPropTel()
	 * @return varchar
	 * @desc Renvoie le membre PropTel de la ParametreZeybuxVO
	 */
	public function getPropTel() {
		return $this->mPropTel;
	}
	
	/**
	 * @name setPropTel($pPropTel)
	 * @param varchar
	 * @desc Remplace le membre PropTel de la ParametreZeybuxVO par $pPropTel
	 */
	public function setPropTel($pPropTel) {
		$this->mPropTel = $pPropTel;
	}
	
	/**
	 * @name getPropMail()
	 * @return varchar
	 * @desc Renvoie le membre PropMail de la ParametreZeybuxVO
	 */
	public function getPropMail() {
		return $this->mPropMail;
	}
	
	/**
	 * @name setPropMail($pPropMail)
	 * @param varchar
	 * @desc Remplace le membre PropMail de la ParametreZeybuxVO par $pPropMail
	 */
	public function setPropMail($pPropMail) {
		$this->mPropMail = $pPropMail;
	}
	
	/**
	 * @name getPropRespMarcheNom()
	 * @return varchar
	 * @desc Renvoie le membre PropRespMarcheNom de la ParametreZeybuxVO
	 */
	public function getPropRespMarcheNom() {
		return $this->mPropRespMarcheNom;
	}
	
	/**
	 * @name setPropRespMarcheNom($pPropRespMarcheNom)
	 * @param varchar
	 * @desc Remplace le membre PropRespMarcheNom de la ParametreZeybuxVO par $pPropRespMarcheNom
	 */
	public function setPropRespMarcheNom($pPropRespMarcheNom) {
		$this->mPropRespMarcheNom = $pPropRespMarcheNom;
	}
	
	/**
	 * @name getPropRespMarchePrenom()
	 * @return varchar
	 * @desc Renvoie le membre PropRespMarchePrenom de la ParametreZeybuxVO
	 */
	public function getPropRespMarchePrenom() {
		return $this->mPropRespMarchePrenom;
	}
	
	/**
	 * @name setPropRespMarchePrenom($pPropRespMarchePrenom)
	 * @param varchar
	 * @desc Remplace le membre PropRespMarchePrenom de la ParametreZeybuxVO par $pPropRespMarchePrenom
	 */
	public function setPropRespMarchePrenom($pPropRespMarchePrenom) {
		$this->mPropRespMarchePrenom = $pPropRespMarchePrenom;
	}
	
	/**
	 * @name getPropRespMarchePoste()
	 * @return varchar
	 * @desc Renvoie le membre PropRespMarchePoste de la ParametreZeybuxVO
	 */
	public function getPropRespMarchePoste() {
		return $this->mPropRespMarchePoste;
	}
	
	/**
	 * @name setPropRespMarchePoste($pPropRespMarchePoste)
	 * @param varchar
	 * @desc Remplace le membre PropRespMarchePoste de la ParametreZeybuxVO par $pPropRespMarchePoste
	 */
	public function setPropRespMarchePoste($pPropRespMarchePoste) {
		$this->mPropRespMarchePoste = $pPropRespMarchePoste;
	}
	
	/**
	* @name getPropRespMarcheTel()
	* @return varchar
	* @desc Renvoie le membre PropRespMarcheTel de la ParametreZeybuxVO
	*/
	public function getPropRespMarcheTel() {
		return $this->mPropRespMarcheTel;
	}

	/**
	* @name setPropRespMarcheTel($pPropRespMarcheTel)
	* @param varchar
	* @desc Remplace le membre PropRespMarcheTel de la ParametreZeybuxVO par $pPropRespMarcheTel
	*/
	public function setPropRespMarcheTel($pPropRespMarcheTel) {
		$this->mPropRespMarcheTel = $pPropRespMarcheTel;
	}
}
?>