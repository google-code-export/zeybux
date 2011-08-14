<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/02/2011
// Fichier : InfoCommandeResponse.php
//
// Description : Classe InfoCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoCommandeResponse
 * @author Julien PIERRE
 * @since 27/02/2011
 * @desc Classe représentant une InfoCommandeResponse
 */
class InfoCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;
	
	/**
	 * @var array(InfoCommandeViewVO)
	 * @desc Les infos sur la commande
	 */
	protected $mInfoCommande;
	
	/**
	 * @var CommandeVO
	 * @desc Les infos générales sur le marché
	 */
	protected $mDetailMarche;
	
	/**
	* @name InfoCommandeResponse()
	* @desc Le constructeur
	*/
	public function InfoCommandeResponse() {
		$this->mValid = true;
		$this->mInfoCommande = array();
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
	* @name getInfoCommande()
	* @return array(InfoCommandeViewVO)
	* @desc Renvoie les infos sur la commande
	*/
	public function getInfoCommande() {
		return $this->mInfoCommande;
	}

	/**
	* @name setInfoCommande($pInfoCommande)
	* @param array(InfoCommandeViewVO)
	* @desc Remplace le InfoCommande par $pInfoCommande
	*/
	public function setInfoCommande($pInfoCommande) {
		$this->mInfoCommande = $pInfoCommande;
	}
	
	/**
	* @name addInfoCommande($pInfoCommande)
	* @param InfoCommandeViewVO
	* @desc Ajoute $pInfoCommande à InfoCommande
	*/
	public function addInfoCommande($pInfoCommande){
		array_push($this->mInfoCommande,$pInfoCommande);
	}
	
	/**
	* @name getDetailMarche()
	* @return bool
	* @desc Renvoie la DetailMarche de l'élément
	*/
	public function getDetailMarche() {
		return $this->mDetailMarche;
	}

	/**
	* @name setDetailMarche($pDetailMarche)
	* @param bool
	* @desc Remplace la DetailMarche de l'élément par $pDetailMarche
	*/
	public function setDetailMarche($pDetailMarche) {
		$this->mDetailMarche = $pDetailMarche;
	}
}
?>