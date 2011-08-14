<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/06/2011
// Fichier : ListeAdherentRechargementResponse.php
//
// Description : Classe ListeAdherentRechargementResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdherentRechargementResponse
 * @author Julien PIERRE
 * @since 12/06/2011
 * @desc Classe représentant une ListeAdherentRechargementResponse
 */
class ListeAdherentRechargementResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ListeAdherentViewVO)
	* @desc ListeCommande de la ListeAdherentResponse
	*/
	protected $mListeAdherent;
	
	/**
	 * @var array(TypePaiementVO)
	 * @desc La liste des types de paiement
	 */
	protected $mTypePaiement;
	
	/**
	* @name ListeAdherentRechargementResponse()
	* @desc Le constructeur de ListeAdherentRechargementResponse
	*/	
	public function ListeAdherentRechargementResponse() {
		$this->mValid = true;
		$this->mListeAdherent = array();
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
	* @name getListeAdherent()
	* @return array(ListeAdherentViewVO)
	* @desc Renvoie le membre ListeAdherent de la ListeAdherentResponse
	*/
	public function getListeAdherent(){
		return $this->mListeAdherent;
	}

	/**
	* @name setListeAdherent($pListeAdherent)
	* @param array(ListeAdherentViewVO)
	* @desc Remplace le membre ListeAdherent de la ListeAdherentResponse par $pListeAdherent
	*/
	public function setListeAdherent($pListeAdherent) {
		$this->mListeAdherent = $pListeAdherent;
	}
	
	/**
	* @name addListeAdherent($pListeAdherent)
	* @param ListeAdherentViewVO
	* @desc Ajoute $pListeAdherent à ListeAdherent
	*/
	public function addListeAdherent($pListeAdherent){
		array_push($this->mListeAdherent,$pListeAdherent);
	}
	
	/**
	* @name getTypePaiement()
	* @return array(TypePaiementVO)
	* @desc Renvoie le TypePaiement
	*/
	public function getTypePaiement() {
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param array(TypePaiementVO)
	* @desc Remplace le TypePaiement par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}
	
	/**
	* @name addTypePaiement($pTypePaiement)
	* @param TypePaiementVO
	* @desc Ajoute le $pTypePaiement à TypePaiement
	*/
	public function addTypePaiement($pTypePaiement) {
		array_push($this->mTypePaiement, $pTypePaiement);
	}
}