<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : ListeAdhesionAdherentResponse.php
//
// Description : Classe ListeAdhesionAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdhesionAdherentResponse
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une ListeAdhesionAdherentResponse
 */
class ListeAdhesionAdherentResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var AdherentVO
	* @desc Adherent de la ListeAdhesionAdherentResponse
	*/
	protected $mAdherent;
	
	/**
	* @var array(AdhesionVO)
	* @desc ListeAdhesion de la ListeAdhesionAdherentResponse
	*/
	protected $mListeAdhesion;
	
	/**
	* @name ListeAdhesionAdherentResponse()
	* @desc Le constructeur de ListeAdhesionAdherentResponse
	*/	
	public function ListeAdhesionAdherentResponse($pAdherent = null, $pAdhesions = null) {
		$this->mValid = true;
		if(!is_null($pAdherent)) {$this->mAdherent = $pAdherent; }
		if(!is_null($pAdhesions)) {$this->mListeAdhesion = $pAdhesions; } else {$this->mListeAdhesion = array();}
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
	 * @return bool
	 * @desc Renvoie la validite de l'élément
	 */
	public function getAdherent() {
		return $this->mAdherent;
	}
	
	/**
	 * @name setAdherent($pAdherent)
	 * @param bool
	 * @desc Remplace la validite de l'élément par $pAdherent
	 */
	public function setAdherent($pAdherent) {
		$this->mAdherent = $pAdherent;
	}
	
	/**
	* @name getListeAdhesion()
	* @return array(AdhesionVO)
	* @desc Renvoie le membre ListeAdhesion de la ListeAdhesionAdherentResponse
	*/
	public function getListeAdhesion(){
		return $this->mListeAdhesion;
	}

	/**
	* @name setListeAdhesion($pListeAdhesion)
	* @param array(AdhesionVO)
	* @desc Remplace le membre ListeAdhesion de la ListeAdhesionAdherentResponse par $pListeAdhesion
	*/
	public function setListeAdhesion($pListeAdhesion) {
		$this->mListeAdhesion = $pListeAdhesion;
	}
	
	/**
	* @name addListeAdhesion($pListeAdhesion)
	* @param AdhesionVO
	* @desc Ajoute $pListeAdhesion à ListeAdhesion
	*/
	public function addListeAdhesion($pListeAdhesion){
		array_push($this->mListeAdhesion,$pListeAdhesion);
	}
}
?>