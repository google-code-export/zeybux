<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : EditerCommandeResponse.php
//
// Description : Classe EditerCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name EditerCommandeResponse
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe représentant une EditerCommandeResponse
 */
class EditerCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var MarcheVO
	 * @desc Le Marché
	 */
	protected $mMarche;
	
	/**
	 * @var array(ListeAdherentCommandeViewVO)
	 * @desc La Liste des adhérents qui ont commandés
	 */
	protected $mListeAdherentCommande;
	
	/**
	* @name EditerCommandeResponse()
	* @desc Le constructeur
	*/
	public function EditerCommandeResponse() {
		$this->mValid = true;
		$this->mListeAdherentCommande = array();
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
	* @name getMarche()
	* @return MarcheVO
	* @desc Renvoie le Marche
	*/
	public function getMarche() {
		return $this->mMarche;
	}

	/**
	* @name setMarche($pMarche)
	* @param MarcheVO
	* @desc Remplace le Marche par $pMarche
	*/
	public function setMarche($pMarche) {
		$this->mMarche = $pMarche;
	}
		
	/**
	* @name getListeAdherentCommande()
	* @return array(ListeAdherentCommandeViewVO)
	* @desc Renvoie le membre ListeAdherentCommande de la EditerCommandeResponse
	*/
	public function getListeAdherentCommande(){
		return $this->mListeAdherentCommande;
	}

	/**
	* @name setListeAdherentCommande($pListeAdherentCommande)
	* @param array(ListeAdherentCommandeViewVO)
	* @desc Remplace le membre ListeAdherentCommande de la EditerCommandeResponse par $pListeAdherentCommande
	*/
	public function setListeAdherentCommande($pListeAdherentCommande) {
		$this->mListeAdherentCommande = $pListeAdherentCommande;
	}
	
	/**
	* @name addListeAdherentCommande($pListeAdherentCommande)
	* @param ListeAdherentCommandeViewVO
	* @desc Ajoute $pListeAdherentCommande à ListeAdherentCommande
	*/
	public function addListeAdherentCommande($pListeAdherentCommande){
		array_push($this->mListeAdherentCommande,$pListeAdherentCommande);
	}
}
?>