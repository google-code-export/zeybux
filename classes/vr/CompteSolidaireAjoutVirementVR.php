<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/07/2011
// Fichier : CompteSolidaireAjoutVirementVR.php
//
// Description : Classe CompteSolidaireAjoutVirementVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name CompteSolidaireAjoutVirementVR
 * @author Julien PIERRE
 * @since 03/07/2011
 * @desc Classe représentant une CompteSolidaireAjoutVirementVR
 */
class CompteSolidaireAjoutVirementVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc Id de la CompteSolidaireAjoutVirementVR
	 */
	protected $mId;

	/**
	 * @var VRelement
	 * @desc Montant de la CompteSolidaireAjoutVirementVR
	 */
	protected $mMontant;

	/**
	* @name CompteSolidaireAjoutVirementVR()
	* @return bool
	* @desc Constructeur
	*/
	function CompteSolidaireAjoutVirementVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mMontant = new VRelement();
	}

	/**
	* @name getId()
	* @return VRelement
	* @desc Renvoie le VRelement mId
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le mId par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
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