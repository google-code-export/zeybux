<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/07/2013
// Fichier : ChampComplementaireVR.php
//
// Description : Classe ChampComplementaireVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ChampComplementaireVR
 * @author Julien PIERRE
 * @since 27/07/2013
 * @desc Classe représentant une ChampComplementaireVR
 */
class ChampComplementaireVR extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validté de l'objet
	 */
	protected $mValid;

	/**
	 * @var VRelement
	 * @desc Le Log de l'objet
	 */
	protected $mLog;

	/**
	 * @var VRelement
	 * @desc Id de l'objet
	 */
	protected $mId;

	/**
	 * @var VRelement
	 * @desc Valeur de la ChampComplementaireVR
	 */
	protected $mValeur;

	/**
	* @name ChampComplementaireVR()
	* @return bool
	* @desc Constructeur
	*/
	function ChampComplementaireVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mValeur = new VRelement();
	}

	/**
	* @name getValid()
	* @return bool
	* @desc Renvoie la Validite de l'élément
	*/
	public function getValid() {
		return $this->mValid;
	}

	/**
	* @name setValid($pValid)
	* @param bool
	* @desc Remplace la Validite de l'élément par $pValid
	*/
	public function setValid($pValid) {
		$this->mValid = $pValid;
	}

	/**
	* @name getLog()
	* @return VRelement
	* @desc Renvoie le VRelement Log
	*/
	public function getLog() {
		return $this->mLog;
	}

	/**
	* @name setLog($pLog)
	* @param VRelement
	* @desc Remplace le VRelement Log par $pLog
	*/
	public function setLog($pLog) {
		$this->mLog = $pLog;
	}

	/**
	* @name getId()
	* @return VRelement
	* @desc Renvoie le VRelement Id
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le VRelement Id par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getValeur()
	* @return VRelement
	* @desc Renvoie le VRelement mValeur
	*/
	public function getValeur() {
		return $this->mValeur;
	}

	/**
	* @name setValeur($pValeur)
	* @param VRelement
	* @desc Remplace le mValeur par $pValeur
	*/
	public function setValeur($pValeur) {
		$this->mValeur = $pValeur;
	}
}
?>