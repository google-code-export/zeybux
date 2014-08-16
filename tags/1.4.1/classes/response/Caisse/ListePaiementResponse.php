<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/02/2014
// Fichier : ListePaiementResponse.php
//
// Description : Classe ListePaiementResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListePaiementResponse
 * @author Julien PIERRE
 * @since 13/02/2014
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
	* @var array(OperationAttenteVO)
	* @desc ListeChequeAdherent de la ListePaiementResponse
	*/
	protected $mListeCheque;	
	
	/**
	* @var array(OperationAttenteVO)
	* @desc ListeEspeceAdherent de la ListePaiementResponse
	*/
	protected $mListeEspece;	
		
	/**
	 * @var int
	 * @desc Numero Le numéro du marché
	 */
	protected $mNumero;
	
	/**
	* @name ListePaiementResponse()
	* @desc Le constructeur de ListePaiementResponse
	*/	
	public function ListePaiementResponse() {
		$this->mValid = true;
		$this->mListeCheque = array();
		$this->mListeEspece = array();
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
	* @name getListeCheque()
	* @return array(OperationAttenteVO)
	* @desc Renvoie le membre ListeCheque de la ListePaiementResponse
	*/
	public function getListeCheque(){
		return $this->mListeCheque;
	}

	/**
	* @name setListeCheque($pListeCheque)
	* @param array(OperationAttenteVO)
	* @desc Remplace le membre ListeCheque de la ListePaiementResponse par $pListeCheque
	*/
	public function setListeCheque($pListeCheque) {
		$this->mListeCheque = $pListeCheque;
	}
	
	/**
	* @name addListeCheque($pListeCheque)
	* @param OperationAttenteVO
	* @desc Ajoute $pListeCheque à ListeCheque
	*/
	public function addListeCheque($pListeCheque){
		array_push($this->mListeCheque,$pListeCheque);
	}
	
	/**
	* @name getListeEspece()
	* @return array(OperationAttenteVO)
	* @desc Renvoie le membre ListeEspece de la ListePaiementResponse
	*/
	public function getListeEspece(){
		return $this->mListeEspece;
	}

	/**
	* @name setListeEspece($pListeEspece)
	* @param array(OperationAttenteVO)
	* @desc Remplace le membre ListeEspece de la ListePaiementResponse par $pListeEspece
	*/
	public function setListeEspece($pListeEspece) {
		$this->mListeEspece = $pListeEspece;
	}
	
	/**
	* @name addListeEspece($pListeEspece)
	* @param OperationAttenteVO
	* @desc Ajoute $pListeEspece à ListeEspece
	*/
	public function addListeEspece($pListeEspece){
		array_push($this->mListeEspece,$pListeEspece);
	}
		
	/**
	* @name getNumero()
	* @return int
	* @desc Renvoie les Numero
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param int
	* @desc Remplace les Numero par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}
}
?>