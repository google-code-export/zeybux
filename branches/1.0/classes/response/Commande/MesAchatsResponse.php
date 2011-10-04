<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/10/2011
// Fichier : MesAchatsResponse.php
//
// Description : Classe MesAchatsResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name MesAchatsResponse
 * @author Julien PIERRE
 * @since 03/10/2011
 * @desc Classe représentant une MesAchatsResponse
 */
class MesAchatsResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(MesAchatsViewVO)
	* @desc LaListe d'achat
	*/
	protected $mAchats;
	
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
	* @name ListeCommandeResponse()
	* @desc Le constructeur
	*/
	public function MesAchatsResponse() {
		$this->mValid = true;
		$this->mAchats = array();
	}
	
	/**
	* @name getAchats()
	* @return array(MesAchatsViewVO)
	* @desc Renvoie le membre Achats de la MesAchatsResponse
	*/
	public function getAchats(){
		return $this->mAchats;
	}

	/**
	* @name setAchats($pAchats)
	* @param array(MesAchatsViewVO)
	* @desc Remplace le membre Achats de la MesAchatsResponse par $pAchats
	*/
	public function setAchats($pAchats) {
		$this->mAchats = $pAchats;
	}
	
	/**
	* @name addAchats($pAchats)
	* @param MesAchatsViewVO
	* @desc Ajoute $pAchats à Achats
	*/
	public function addAchats($pAchats){
		array_push($this->mAchats,$pAchats);
	}
}