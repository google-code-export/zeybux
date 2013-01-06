<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/05/2012
// Fichier : ListePaiementResponse.php
//
// Description : Classe ListePaiementResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListePaiementResponse
 * @author Julien PIERRE
 * @since 12/05/2012
 * @desc Classe représentant une ListePaiementResponse
 */
class ListePaiementResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(OperationAttenteAdherentViewVO)
	* @desc ListeChequeAdherent de la ListePaiementResponse
	*/
	protected $mListeChequeAdherent;	
	
	/**
	* @var array(OperationAttenteAdherentViewVO)
	* @desc ListeEspeceAdherent de la ListePaiementResponse
	*/
	protected $mListeEspeceAdherent;	
	
	/**
	* @var array(OperationAttenteFermeViewVO)
	* @desc ListeChequeFerme de la ListePaiementResponse
	*/
	protected $mListeChequeFerme;	
	
	/**
	* @var array(OperationAttenteFermeViewVO)
	* @desc ListeEspeceFerme de la ListePaiementResponse
	*/
	protected $mListeEspeceFerme;	
	
	/**
	* @name ListePaiementResponse()
	* @desc Le constructeur de ListePaiementResponse
	*/	
	public function ListePaiementResponse() {
		$this->mValid = true;
		$this->mListeChequeAdherent = array();
		$this->mListeEspeceAdherent = array();
		$this->mListeChequeFerme = array();
		$this->mListeEspeceFerme = array();
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
	* @name getListeChequeAdherent()
	* @return array(OperationAttenteAdherentViewVO)
	* @desc Renvoie le membre ListeChequeAdherent de la ListePaiementResponse
	*/
	public function getListeChequeAdherent(){
		return $this->mListeChequeAdherent;
	}

	/**
	* @name setListeChequeAdherent($pListeChequeAdherent)
	* @param array(OperationAttenteAdherentViewVO)
	* @desc Remplace le membre ListeChequeAdherent de la ListePaiementResponse par $pListeChequeAdherent
	*/
	public function setListeChequeAdherent($pListeChequeAdherent) {
		$this->mListeChequeAdherent = $pListeChequeAdherent;
	}
	
	/**
	* @name addListeChequeAdherent($pListeChequeAdherent)
	* @param OperationAttenteAdherentViewVO
	* @desc Ajoute $pListeChequeAdherent à ListeChequeAdherent
	*/
	public function addListeChequeAdherent($pListeChequeAdherent){
		array_push($this->mListeChequeAdherent,$pListeChequeAdherent);
	}
	
	/**
	* @name getListeEspeceAdherent()
	* @return array(OperationAttenteAdherentViewVO)
	* @desc Renvoie le membre ListeEspeceAdherent de la ListePaiementResponse
	*/
	public function getListeEspeceAdherent(){
		return $this->mListeEspeceAdherent;
	}

	/**
	* @name setListeEspeceAdherent($pListeEspeceAdherent)
	* @param array(OperationAttenteAdherentViewVO)
	* @desc Remplace le membre ListeEspeceAdherent de la ListePaiementResponse par $pListeEspeceAdherent
	*/
	public function setListeEspeceAdherent($pListeEspeceAdherent) {
		$this->mListeEspeceAdherent = $pListeEspeceAdherent;
	}
	
	/**
	* @name addListeEspeceAdherent($pListeEspeceAdherent)
	* @param OperationAttenteAdherentViewVO
	* @desc Ajoute $pListeEspeceAdherent à ListeEspeceAdherent
	*/
	public function addListeEspeceAdherent($pListeEspeceAdherent){
		array_push($this->mListeEspeceAdherent,$pListeEspeceAdherent);
	}
	
	/**
	* @name getListeChequeFerme()
	* @return array(OperationAttenteFermeViewVO)
	* @desc Renvoie le membre ListeChequeFerme de la ListePaiementResponse
	*/
	public function getListeChequeFerme(){
		return $this->mListeChequeFerme;
	}

	/**
	* @name setListeChequeFerme($pListeChequeFerme)
	* @param array(OperationAttenteFermeViewVO)
	* @desc Remplace le membre ListeChequeFerme de la ListePaiementResponse par $pListeChequeFerme
	*/
	public function setListeChequeFerme($pListeChequeFerme) {
		$this->mListeChequeFerme = $pListeChequeFerme;
	}
	
	/**
	* @name addListeChequeFerme($pListeChequeFerme)
	* @param OperationAttenteFermeViewVO
	* @desc Ajoute $pListeChequeFerme à ListeChequeFerme
	*/
	public function addListeChequeFerme($pListeChequeFerme){
		array_push($this->mListeChequeFerme,$pListeChequeFerme);
	}
	
	/**
	* @name getListeEspeceFerme()
	* @return array(OperationAttenteFermeViewVO)
	* @desc Renvoie le membre ListeEspeceFerme de la ListePaiementResponse
	*/
	public function getListeEspeceFerme(){
		return $this->mListeEspeceFerme;
	}

	/**
	* @name setListeEspeceFerme($pListeEspeceFerme)
	* @param array(OperationAttenteFermeViewVO)
	* @desc Remplace le membre ListeEspeceFerme de la ListePaiementResponse par $pListeEspeceFerme
	*/
	public function setListeEspeceFerme($pListeEspeceFerme) {
		$this->mListeEspeceFerme = $pListeEspeceFerme;
	}
	
	/**
	* @name addListeEspeceFerme($pListeEspeceFerme)
	* @param OperationAttenteFermeViewVO
	* @desc Ajoute $pListeEspeceFerme à ListeEspeceFerme
	*/
	public function addListeEspeceFerme($pListeEspeceFerme){
		array_push($this->mListeEspeceFerme,$pListeEspeceFerme);
	}
}
?>