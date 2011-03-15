<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/01/2010
// Fichier : ModuleVO.php
//
// Description : Classe ModuleVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ModuleVO
 * @author Julien PIERRE
 * @since 27/01/2010
 * @desc Classe représentant un Module
 */
class ModuleVO extends DataTemplate
{
	/**
	 * @var integer 
	 * @desc ID du Module
	 */
	protected $mId;

	/**
	 * @var string 
	 * @desc Nom du Module
	 */
	protected $mNom;

	/**
	 * @var string 
	 * @desc Label du Module
	 */
	protected $mLabel;
	
	/**
	 * @var integer 
	 * @desc Si c'est un Module par défaut ou non
	 */
	protected $mDefaut;

	/**
	 * @var integer 
	 * @desc Ordre du Module
	 */
	protected $mOrdre;
	
	/**
	 * @var integer 
	 * @desc Si c'est un module d'admin
	 */
	protected $mAdmin;

	/**
	* @name getId()
	* @return integer
	* @desc Renvoie l'Id du Module
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param integer
	* @desc Remplace l'Id du Module par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNom()
	* @return string
	* @desc Renvoie le nom du Module
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param string
	* @desc Remplace le Nom du Module par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getLabel()
	* @return string
	* @desc Renvoie le Label du Module
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param string
	* @desc Remplace le Label du Module par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}
	
	/**
	* @name getDefaut()
	* @return integer
	* @desc Renvoie la valeur par défaut du module
	*/
	public function getDefaut() {
		return $this->mDefaut;
	}

	/**
	* @name setDefaut($pDefaut)
	* @param integer
	* @desc Remplace Defaut du module par $pDefaut
	*/
	public function setDefaut($pDefaut) {
		$this->mDefaut = $pDefaut;
	}
	
	/**
	* @name getOrdre()
	* @return integer
	* @desc Renvoie la position de classement du module
	*/
	public function getOrdre() {
		return $this->mOrdre;
	}

	/**
	* @name setOrdre($pOrdre)
	* @param integer
	* @desc Remplace la position de classement du module par $pOrdre
	*/
	public function setOrdre($pOrdre) {
		$this->mOrdre = $pOrdre;
	}
	
	/**
	* @name getAdmin()
	* @return integer
	* @desc Renvoie si c'est un module admin
	*/
	public function getAdmin() {
		return $this->mAdmin;
	}

	/**
	* @name setAdmin($pAdmin)
	* @param integer
	* @desc Remplace l'Admin par $pAdmin
	*/
	public function setAdmin($pAdmin) {
		$this->mAdmin = $pAdmin;
	}
}
?>
