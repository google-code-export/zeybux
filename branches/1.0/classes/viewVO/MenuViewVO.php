<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/10/2010
// Fichier : MenuViewVO.php
//
// Description : Classe MenuViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name MenuViewVO
 * @author Julien PIERRE
 * @since 28/10/2010
 * @desc Classe représentant une MenuViewVO
 */
class MenuViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc AdhId de la MenuViewVO
	*/
	protected $mAdhId;

	/**
	* @var int(11)
	* @desc ModId de la MenuViewVO
	*/
	protected $mModId;

	/**
	* @var varchar(50)
	* @desc ModNom de la MenuViewVO
	*/
	protected $mModNom;

	/**
	* @var varchar(80)
	* @desc ModLabel de la MenuViewVO
	*/
	protected $mModLabel;
	
	/**
	 * @var integer 
	 * @desc Si c'est un module d'admin
	 */
	protected $mModAdmin;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la MenuViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la MenuViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}
	
	/**
	* @name getModId()
	* @return int(11)
	* @desc Renvoie le membre ModId de la MenuViewVO
	*/
	public function getModId() {
		return $this->mModId;
	}

	/**
	* @name setModId($pModId)
	* @param int(11)
	* @desc Remplace le membre ModId de la MenuViewVO par $pModId
	*/
	public function setModId($pModId) {
		$this->mModId = $pModId;
	}

	/**
	* @name getModNom()
	* @return varchar(50)
	* @desc Renvoie le membre ModNom de la MenuViewVO
	*/
	public function getModNom() {
		return $this->mModNom;
	}

	/**
	* @name setModNom($pModNom)
	* @param varchar(50)
	* @desc Remplace le membre ModNom de la MenuViewVO par $pModNom
	*/
	public function setModNom($pModNom) {
		$this->mModNom = $pModNom;
	}

	/**
	* @name getModLabel()
	* @return varchar(80)
	* @desc Renvoie le membre ModLabel de la MenuViewVO
	*/
	public function getModLabel() {
		return $this->mModLabel;
	}
	
	/**
	* @name setModLabel($pModLabel)
	* @param varchar(80)
	* @desc Remplace le membre ModLabel de la MenuViewVO par $pModLabel
	*/
	public function setModLabel($pModLabel) {
		$this->mModLabel = $pModLabel;
	}	
	
	/**
	* @name getModAdmin()
	* @return integer
	* @desc Renvoie si c'est un module admin
	*/
	public function getModAdmin() {
		return $this->mModAdmin;
	}

	/**
	* @name setModAdmin($pModAdmin)
	* @param integer
	* @desc Remplace le ModAdmin par $pModAdmin
	*/
	public function setModAdmin($pModAdmin) {
		$this->mModAdmin = $pModAdmin;
	}
}
?>