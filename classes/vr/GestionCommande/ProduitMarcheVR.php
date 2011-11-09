<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/11/2011
// Fichier : ProduitMarcheVR.php
//
// Description : Classe ProduitMarcheVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitMarcheVR
 * @author Julien PIERRE
 * @since 08/11/2011
 * @desc Classe représentant une ProduitMarcheVR
 */
class ProduitMarcheVR extends DataTemplate
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
	 * @desc IdNom de la ProduitMarcheVR
	 */
	protected $mIdNom;

	/**
	 * @var VRelement
	 * @desc Unite de la ProduitMarcheVR
	 */
	protected $mUnite;

	/**
	 * @var VRelement
	 * @desc QteMaxCommande de la ProduitMarcheVR
	 */
	protected $mQteMaxCommande;

	/**
	 * @var VRelement
	 * @desc QteRestante de la ProduitMarcheVR
	 */
	protected $mQteRestante;

	/**
	 * @var array(VRelement)
	 * @desc Lots de la ProduitMarcheVR
	 */
	protected $mLots;

	/**
	* @name ProduitMarcheVR()
	* @return bool
	* @desc Constructeur
	*/
	function ProduitMarcheVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdNom = new VRelement();
		$this->mUnite = new VRelement();
		$this->mQteMaxCommande = new VRelement();
		$this->mQteRestante = new VRelement();
		$this->mLots = array();
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
	* @name getIdNom()
	* @return VRelement
	* @desc Renvoie le VRelement mIdNom
	*/
	public function getIdNom() {
		return $this->mIdNom;
	}

	/**
	* @name setIdNom($pIdNom)
	* @param VRelement
	* @desc Remplace le mIdNom par $pIdNom
	*/
	public function setIdNom($pIdNom) {
		$this->mIdNom = $pIdNom;
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
	* @name getQteMaxCommande()
	* @return VRelement
	* @desc Renvoie le VRelement mQteMaxCommande
	*/
	public function getQteMaxCommande() {
		return $this->mQteMaxCommande;
	}

	/**
	* @name setQteMaxCommande($pQteMaxCommande)
	* @param VRelement
	* @desc Remplace le mQteMaxCommande par $pQteMaxCommande
	*/
	public function setQteMaxCommande($pQteMaxCommande) {
		$this->mQteMaxCommande = $pQteMaxCommande;
	}

	/**
	* @name getQteRestante()
	* @return VRelement
	* @desc Renvoie le VRelement mQteRestante
	*/
	public function getQteRestante() {
		return $this->mQteRestante;
	}

	/**
	* @name setQteRestante($pQteRestante)
	* @param VRelement
	* @desc Remplace le mQteRestante par $pQteRestante
	*/
	public function setQteRestante($pQteRestante) {
		$this->mQteRestante = $pQteRestante;
	}

	/**
	* @name getLots()
	* @return VRelement
	* @desc Renvoie le VRelement mLots
	*/
	public function getLots() {
		return $this->mLots;
	}

	/**
	* @name setLots($pLots)
	* @param VRelement
	* @desc Remplace le mLots par $pLots
	*/
	public function setLots($pLots) {
		$this->mLots = $pLots;
	}

	/**
	* @name addLots($pLots)
	* @param VRelement
	* @desc Ajoute le $pLots à mLots
	*/
	public function addLots($pLots) {
		array_push($this->mLots,$pLots);
	}
}
?>