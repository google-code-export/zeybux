<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/08/2011
// Fichier : SupprimerAchatAdherentVR.php
//
// Description : Classe SupprimerAchatAdherentVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name SupprimerAchatAdherentVR
 * @author Julien PIERRE
 * @since 07/08/2011
 * @desc Classe représentant une SupprimerAchatAdherentVR
 */
class SupprimerAchatAdherentVR extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;

	/**
	 * @var VRelement
	 * @desc Le Log de l'objet
	 */
	protected $mLog;

	/**
	 * @var VRelement
	 * @desc L'IdAchat de l'objet
	 */
	protected $mIdAchat;

	/**
	* @name SupprimerAchatAdherentVR()
	* @return bool
	* @desc Constructeur
	*/
	function SupprimerAchatAdherentVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mIdAchat = new VRelement();
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
	* @name getIdAchat()
	* @return VRelement
	* @desc Renvoie le VRelement IdAchat
	*/
	public function getIdAchat() {
		return $this->mIdAchat;
	}

	/**
	* @name setIdAchat($pIdAchat)
	* @param VRelement
	* @desc Remplace le VRelement IdAchat par $pIdAchat
	*/
	public function setIdAchat($pIdAchat) {
		$this->mIdAchat = $pIdAchat;
	}
}
?>