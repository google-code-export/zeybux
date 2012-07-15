<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/01/2010
// Fichier : AutorisationVO.php
//
// Description : Classe AutorisationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AutorisationVO
 * @author Julien PIERRE
 * @since 27/01/2010
 * @desc Classe représentant une Autorisation
 */
class AutorisationVO extends DataTemplate
{
	/**
	 * @var integer 
	 * @desc ID de l'Autorisation
	 */
	protected $mId;

	/**
	 * @var integer 
	 * @desc ID de l'Adherent
	 */
	protected $mIdAdherent;

	/**
	 * @var integer 
	 * @desc ID du Module
	 */
	protected $mIdModule;

	/**
	* @name getId()
	* @return integer
	* @desc Renvoie l'Id de l'Autorisation
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param integer
	* @desc Remplace l'Id par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdAdherent()
	* @return integer
	* @desc Renvoie l'Id de l'Adherent
	*/
	public function getIdAdherent() {
		return $this->mIdAdherent;
	}

	/**
	* @name setIdAdherent($pIdAdherent)
	* @param integer
	* @desc Remplace l'IdAdherent par $pIdAdherent
	*/
	public function setIdAdherent($pIdAdherent) {
		$this->mIdAdherent = $pIdAdherent;
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
	* @desc Remplace l'IdModule par $pIdModule
	*/
	public function setIdModule($pIdModule) {
		$this->mIdModule = $pIdModule;
	}
}
?>
