<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/07/2011
// Fichier : InfoCommandeVR.php
//
// Description : Classe InfoCommandeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoCommandeVR
 * @author Julien PIERRE
 * @since 24/07/2011
 * @desc Classe représentant une InfoCommandeVR
 */
class InfoCommandeVR extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var VRelement
	 * @desc Le Log de l'objet
	 */
	protected $mLog;
	
	/**
	 * @var VRelement
	 * @desc Id Commande de l'objet
	 */
	protected $mIdCommande;

	/**
	* @name InfoCommandeVR()
	* @return bool
	* @desc Constructeur
	*/
	function InfoCommandeVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mIdCommande = new VRelement();
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
	* @name getIdCommande()
	* @return VRelement
	* @desc Renvoie le VRelement IdCommande
	*/
	public function getIdCommande() {
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param VRelement
	* @desc Remplace le VRelement IdCommande par $pIdCommande
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}
}
?>