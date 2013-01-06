<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/08/2010
// Fichier : testVR.php
//
// Description : Classe testVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );

/**
 * @name testVR
 * @author Julien PIERRE
 * @since 27/08/2010
 * @desc Classe représentant une testVR
 */
class testVR
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	private $mValid = true;

	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	private $mId = new VRelement();

	/**
	 * @var VRelement
	 * @desc Toto de la testVR
	 */
	private $mToto = new VRelement();


	/**
	 * @var VRelement
	 * @desc Tata de la testVR
	 */
	private $mTata = new VRelement();


	/**
	 * @var VRelement
	 * @desc Titi de la testVR
	 */
	private $mTiti = new VRelement();


	/**
	 * @var VRelement
	 * @desc Float de la testVR
	 */
	private $mFloat = new VRelement();


	/**
	 * @var VRelement
	 * @desc Mail de la testVR
	 */
	private $mMail = new VRelement();


	/**
	 * @var VRelement
	 * @desc Date de la testVR
	 */
	private $mDate = new VRelement();


	/**
	 * @var VRelement
	 * @desc Tab de la testVR
	 */
	private $mTab = array();


	/**
	 * @var VRelement
	 * @desc Obj de la testVR
	 */
	private $mObj = new VRelement();

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
	* @name getToto()
	* @return VRelement
	* @desc Renvoie le VRelement mToto
	*/
	public function getToto() {
		return $this->mToto;
	}

	/**
	* @name setToto($pToto)
	* @param VRelement
	* @desc Remplace le mToto par $pToto
	*/
	public function setToto($pToto) {
		$this->mToto = $pToto;
	}

	/**
	* @name getTata()
	* @return VRelement
	* @desc Renvoie le VRelement mTata
	*/
	public function getTata() {
		return $this->mTata;
	}

	/**
	* @name setTata($pTata)
	* @param VRelement
	* @desc Remplace le mTata par $pTata
	*/
	public function setTata($pTata) {
		$this->mTata = $pTata;
	}

	/**
	* @name getTiti()
	* @return VRelement
	* @desc Renvoie le VRelement mTiti
	*/
	public function getTiti() {
		return $this->mTiti;
	}

	/**
	* @name setTiti($pTiti)
	* @param VRelement
	* @desc Remplace le mTiti par $pTiti
	*/
	public function setTiti($pTiti) {
		$this->mTiti = $pTiti;
	}

	/**
	* @name getFloat()
	* @return VRelement
	* @desc Renvoie le VRelement mFloat
	*/
	public function getFloat() {
		return $this->mFloat;
	}

	/**
	* @name setFloat($pFloat)
	* @param VRelement
	* @desc Remplace le mFloat par $pFloat
	*/
	public function setFloat($pFloat) {
		$this->mFloat = $pFloat;
	}

	/**
	* @name getMail()
	* @return VRelement
	* @desc Renvoie le VRelement mMail
	*/
	public function getMail() {
		return $this->mMail;
	}

	/**
	* @name setMail($pMail)
	* @param VRelement
	* @desc Remplace le mMail par $pMail
	*/
	public function setMail($pMail) {
		$this->mMail = $pMail;
	}

	/**
	* @name getDate()
	* @return VRelement
	* @desc Renvoie le VRelement mDate
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param VRelement
	* @desc Remplace le mDate par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getTab()
	* @return VRelement
	* @desc Renvoie le VRelement mTab
	*/
	public function getTab() {
		return $this->mTab;
	}

	/**
	* @name setTab($pTab)
	* @param VRelement
	* @desc Remplace le mTab par $pTab
	*/
	public function setTab($pTab) {
		$this->mTab = $pTab;
	}

	/**
	* @name getObj()
	* @return VRelement
	* @desc Renvoie le VRelement mObj
	*/
	public function getObj() {
		return $this->mObj;
	}

	/**
	* @name setObj($pObj)
	* @param VRelement
	* @desc Remplace le mObj par $pObj
	*/
	public function setObj($pObj) {
		$this->mObj = $pObj;
	}

}
?>
