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
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name ChampComplementaireVR
 * @author Julien PIERRE
 * @since 27/07/2013
 * @desc Classe représentant une ChampComplementaireVR
 */
class ChampComplementaireVR extends TemplateVR
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
		parent::__construct();	
		$this->mId = new VRelement();
		$this->mValeur = new VRelement();
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