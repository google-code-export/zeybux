<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/10/2010
// Fichier : MenuModuleVO.php
//
// Description : Classe MenuModuleVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name MenuModuleVO
 * @author Julien PIERRE
 * @since 28/10/2010
 * @desc Classe représentant une MenuModuleVO
 */
class MenuModuleVO extends DataTemplate
{
	/**
	* @var varchar(50)
	* @desc ModuleNom de la MenuModuleVO
	*/
	protected $mModuleNom;
	
	/**
	* @var varchar(50)
	* @desc Nom de la MenuModuleVO
	*/
	protected $mNom;
	
	/**
	* @var varchar(80)
	* @desc Label de la MenuModuleVO
	*/
	protected $mLabel;
	
	/**
	* @var array(VueVO)
	* @desc Les Vues de la MenuModuleVO
	*/
	protected $mVues;
	
	/**
	* @name MenuModuleVO()
	* @desc Le constructeur
	*/
	public function MenuModuleVO() {
		$this->mVues = array();
	}
	
	/**
	* @name getModuleNom()
	* @return varchar(50)
	* @desc Renvoie l'ModuleNom de la MenuModuleVO
	*/
	public function getModuleNom(){
		return $this->mModuleNom;
	}

	/**
	* @name setModuleNom($pModuleNom)
	* @param varchar(50)
	* @desc Remplace le membre ModuleNom de la MenuModuleVO par $pModuleNom
	*/
	public function setModuleNom($pModuleNom) {
		$this->mModuleNom = $pModuleNom;
	}
	
	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie l'Nom de la MenuModuleVO
	*/
	public function getNom(){
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la MenuModuleVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}
	
	/**
	* @name getLabel()
	* @return varchar(80)
	* @desc Renvoie le Label de la MenuModuleVO
	*/
	public function getLabel(){
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(80)
	* @desc Remplace le membre Label de la MenuModuleVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}
	
	/**
	* @name getVues()
	* @return array(VueVO)
	* @desc Renvoie les Vues de la MenuModuleVO
	*/
	public function getVues(){
		return $this->mVues;
	}

	/**
	* @name setVues($pVues)
	* @param array(VueVO)
	* @desc Remplace le membre Vues de la MenuModuleVO par $pVues
	*/
	public function setVues($pVues) {
		$this->mVues = $pVues;
	}
	
	/**
	* @name addVues($pVues)
	* @param VueVO
	* @desc Ajoute le $pVues à Vues
	*/
	public function addVues($pVues) {
		array_push($this->mVues, $pVues);
	}
}