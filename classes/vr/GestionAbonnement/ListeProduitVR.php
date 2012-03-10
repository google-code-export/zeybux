<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/02/2012
// Fichier : ListeProduitVR.php
//
// Description : Classe ListeProduitVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitVR
 * @author Julien PIERRE
 * @since 26/02/2012
 * @desc Classe représentant une ListeProduitVR
 */
class ListeProduitVR extends DataTemplate
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
	 * @desc L'Id de l'objet
	 */
	protected $mId;

	/**
	 * @var VRelement
	 * @desc IdNomProduit de la ListeProduitVR
	 */
	protected $mIdNomProduit;

	/**
	 * @var VRelement
	 * @desc Unite de la ListeProduitVR
	 */
	protected $mUnite;

	/**
	 * @var VRelement
	 * @desc StockInitial de la ListeProduitVR
	 */
	protected $mStockInitial;

	/**
	 * @var VRelement
	 * @desc Max de la ListeProduitVR
	 */
	protected $mMax;

	/**
	 * @var VRelement
	 * @desc Frequence de la ListeProduitVR
	 */
	protected $mFrequence;

	/**
	* @name ListeProduitVR()
	* @return bool
	* @desc Constructeur
	*/
	function ListeProduitVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdNomProduit = new VRelement();
		$this->mUnite = new VRelement();
		$this->mStockInitial = new VRelement();
		$this->mMax = new VRelement();
		$this->mFrequence = new VRelement();
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
	* @name getIdNomProduit()
	* @return VRelement
	* @desc Renvoie le VRelement mIdNomProduit
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param VRelement
	* @desc Remplace le mIdNomProduit par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getUnite()
	* @return VRelement
	* @desc Renvoie le VRelement mUnite
	*/
	public function getUnite() {
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param VRelement
	* @desc Remplace le mUnite par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}

	/**
	* @name getStockInitial()
	* @return VRelement
	* @desc Renvoie le VRelement mStockInitial
	*/
	public function getStockInitial() {
		return $this->mStockInitial;
	}

	/**
	* @name setStockInitial($pStockInitial)
	* @param VRelement
	* @desc Remplace le mStockInitial par $pStockInitial
	*/
	public function setStockInitial($pStockInitial) {
		$this->mStockInitial = $pStockInitial;
	}

	/**
	* @name getMax()
	* @return VRelement
	* @desc Renvoie le VRelement mMax
	*/
	public function getMax() {
		return $this->mMax;
	}

	/**
	* @name setMax($pMax)
	* @param VRelement
	* @desc Remplace le mMax par $pMax
	*/
	public function setMax($pMax) {
		$this->mMax = $pMax;
	}

	/**
	* @name getFrequence()
	* @return VRelement
	* @desc Renvoie le VRelement mFrequence
	*/
	public function getFrequence() {
		return $this->mFrequence;
	}

	/**
	* @name setFrequence($pFrequence)
	* @param VRelement
	* @desc Remplace le mFrequence par $pFrequence
	*/
	public function setFrequence($pFrequence) {
		$this->mFrequence = $pFrequence;
	}

}
?>