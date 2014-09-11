<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/02/2014
// Fichier : CompteAssociationAjoutVirementVR.php
//
// Description : Classe CompteAssociationAjoutVirementVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteAssociationAjoutVirementVR
 * @author Julien PIERRE
 * @since 12/02/2014
 * @desc Classe représentant une CompteAssociationAjoutVirementVR
 */
class CompteAssociationAjoutVirementVR extends DataTemplate
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
	 * @desc Montant de la CompteAssociationAjoutVirementVR
	 */
	protected $mMontant;

	/**
	* @name CompteAssociationAjoutVirementVR()
	* @return bool
	* @desc Constructeur
	*/
	function CompteAssociationAjoutVirementVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mMontant = new VRelement();
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
	* @name getMontant()
	* @return VRelement
	* @desc Renvoie le VRelement mMontant
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param VRelement
	* @desc Remplace le mMontant par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}
}
?>