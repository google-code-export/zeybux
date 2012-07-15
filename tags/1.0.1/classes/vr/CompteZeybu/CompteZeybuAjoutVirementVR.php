<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/08/2011
// Fichier : CompteZeybuAjoutVirementVR.php
//
// Description : Classe CompteZeybuAjoutVirementVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteZeybuAjoutVirementVR
 * @author Julien PIERRE
 * @since 11/08/2011
 * @desc Classe représentant une CompteZeybuAjoutVirementVR
 */
class CompteZeybuAjoutVirementVR extends DataTemplate
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
	 * @desc IdDebit de la CompteZeybuAjoutVirementVR
	 */
	protected $mIdDebit;
	
	/**
	 * @var VRelement
	 * @desc IdCredit de la CompteZeybuAjoutVirementVR
	 */
	protected $mIdCredit;

	/**
	 * @var VRelement
	 * @desc Montant de la CompteZeybuAjoutVirementVR
	 */
	protected $mMontant;
	
	/**
	 * @var VRelement
	 * @desc Type de la CompteZeybuAjoutVirementVR
	 */
	protected $mType;

	/**
	* @name CompteZeybuAjoutVirementVR()
	* @return bool
	* @desc Constructeur
	*/
	function CompteZeybuAjoutVirementVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mIdDebit = new VRelement();
		$this->mIdCredit = new VRelement();
		$this->mMontant = new VRelement();
		$this->mType = new VRelement();
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
	* @name getIdDebit()
	* @return VRelement
	* @desc Renvoie le VRelement mIdDebit
	*/
	public function getIdDebit() {
		return $this->mIdDebit;
	}

	/**
	* @name setIdDebit($pIdDebit)
	* @param VRelement
	* @desc Remplace le mIdDebit par $pIdDebit
	*/
	public function setIdDebit($pIdDebit) {
		$this->mIdDebit = $pIdDebit;
	}
	
	/**
	* @name getIdCredit()
	* @return VRelement
	* @desc Renvoie le VRelement mIdCredit
	*/
	public function getIdCredit() {
		return $this->mIdCredit;
	}

	/**
	* @name setIdCredit($pIdCredit)
	* @param VRelement
	* @desc Remplace le mIdCredit par $pIdCredit
	*/
	public function setIdCredit($pIdCredit) {
		$this->mIdCredit = $pIdCredit;
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

	/**
	* @name getType()
	* @return VRelement
	* @desc Renvoie le VRelement mType
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param VRelement
	* @desc Remplace le mType par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}
}
?>