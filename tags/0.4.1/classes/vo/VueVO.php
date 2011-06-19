<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : VueVO.php
//
// Description : Classe VueVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name VueVO
 * @author Julien PIERRE
 * @since 01/02/2010
 * @desc Classe représentant une Vue
 */
class VueVO extends DataTemplate
{
	/**
	 * @var integer 
	 * @desc ID de la vue
	 */
	protected $mId;

	/**
	 * @var integer 
	 * @desc ID du Module
	 */
	protected $mIdModule;

	/**
	 * @var string 
	 * @desc Nom de la vue
	 */
	protected $mNom;

	/**
	 * @var string 
	 * @desc Label de la vue
	 */
	protected $mLabel;

	/**
	 * @var integer 
	 * @desc Ordre de la vue
	 */
	protected $mOrdre;

	/**
	* @name getId()
	* @return integer
	* @desc Renvoie l'Id de la vue
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param integer
	* @desc Remplace l'Id de la vue par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdModule()
	* @return integer
	* @desc Renvoie l'Id du Module
	*/
	public function getIdModule() {
		return $this->mIdModule;
	}

	/**
	* @name setIdModule($pIdModule)
	* @param integer
	* @desc Remplace l'Id du Module par $pIdModule
	*/
	public function setIdModule($pIdModule) {
		$this->mIdModule = $pIdModule;
	}

	/**
	* @name getNom()
	* @return string
	* @desc Renvoie le nom de la vue
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param string
	* @desc Remplace le Nom de la vue par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getLabel()
	* @return string
	* @desc Renvoie le Label de la vue
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param string
	* @desc Remplace le Label de la vue par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
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
}
?>
