<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/08/2013
// Fichier : UniteNomProduitVO.php
//
// Description : Classe UniteNomProduitVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name UniteNomProduitVO
 * @author Julien PIERRE
 * @since 13/08/2013
 * @desc Classe représentant une UniteNomProduitVO
 */
class UniteNomProduitVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CproId de la UniteNomProduitVO
	*/
	protected $mCproId;
	
	/**
	* @var varchar(50)
	* @desc CproNom de la UniteNomProduitVO
	*/
	protected $mCproNom;
	
	/**
	* @var int(11)
	* @desc NproId de la UniteNomProduitVO
	*/
	protected $mNproId;
	
	/**
	* @var varchar(50)
	* @desc NproNumero de la UniteNomProduitVO
	*/
	protected $mNproNumero;

	/**
	* @var varchar(50)
	* @desc NproNom de la UniteNomProduitVO
	*/
	protected $mNproNom;

	/**
	* @var array(varchar(20));
	* @desc MLotUnite de la UniteNomProduitVO
	*/
	protected $mMLotUnite;

	/**
	 * @name UniteNomProduitVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function UniteNomProduitVO($pCproId = null, $pCproNom = null, $pNproId = null, $pNproNumero = null, $pNproNom = null, $pMLotUnite = null) {
		if(!is_null($pCproId)) { $this->mCproId = $pCproId; }
		if(!is_null($pCproNom)) {$this->mCproNom = $pCproNom; }
		if(!is_null($pNproId)) {$this->mNproId = $pNproId; }
		if(!is_null($pNproNumero)) {$this->mNproNumero = $pNproNumero; }
		if(!is_null($pNproNom)) {$this->mNproNom = $pNproNom; }
		if(!is_null($pMLotUnite)) {$this->mMLotUnite = $pMLotUnite; }
		else { $this->mMLotUnite = array();}
	}
	
	/**
	 * @name getCproId()
	 * @return int(11)
	 * @desc Renvoie le membre CproId de la UniteNomProduitVO
	 */
	public function getCproId() {
		return $this->mCproId;
	}
	
	/**
	 * @name setCproId($pCproId)
	 * @param int(11)
	 * @desc Remplace le membre CproId de la UniteNomProduitVO par $pCproId
	 */
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}
	
	/**
	 * @name getCproNom()
	 * @return varchar(50)
	 * @desc Renvoie le membre CproNom de la UniteNomProduitVO
	 */
	public function getCproNom() {
		return $this->mCproNom;
	}
	
	/**
	 * @name setCproNom($pCproNom)
	 * @param varchar(50)
	 * @desc Remplace le membre CproNom de la UniteNomProduitVO par $pCproNom
	 */
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}
	
	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la UniteNomProduitVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la UniteNomProduitVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getNproNumero()
	* @return int(11)
	* @desc Renvoie le membre NproNumero de la UniteNomProduitVO
	*/
	public function getNproNumero() {
		return $this->mNproNumero;
	}

	/**
	* @name setNproNumero($pNproNumero)
	* @param int(11)
	* @desc Remplace le membre NproNumero de la UniteNomProduitVO par $pNproNumero
	*/
	public function setNproNumero($pNproNumero) {
		$this->mNproNumero = $pNproNumero;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre getNproNom de la UniteNomProduitVO
	*/
	public function getNproNom() {
		return $this->mgetNproNom;
	}

	/**
	* @name setgetNproNom($pgetNproNom)
	* @param varchar(50)
	* @desc Remplace le membre getNproNom de la UniteNomProduitVO par $pgetNproNom
	*/
	public function setgetNproNom($pgetNproNom) {
		$this->mgetNproNom = $pgetNproNom;
	}

	/**
	* @name getMLotUnite()
	* @return array(varchar(20))
	* @desc Renvoie le membre MLotUnite de la UniteNomProduitVO
	*/
	public function getMLotUnite() {
		return $this->mMLotUnite;
	}

	/**
	* @name setMLotUnite($pMLotUnite)
	* @param array(varchar(20))
	* @desc Remplace le membre MLotUnite de la UniteNomProduitVO par $pMLotUnite
	*/
	public function setMLotUnite($pMLotUnite) {
		$this->mMLotUnite = $pMLotUnite;
	}

	/**
	* @name addMLotUnite($pMLotUnite)
	* @param varchar(20)
	* @desc Ajoute $pMLotUnite au membre MLotUnite de la UniteNomProduitVO 
	*/
	public function addMLotUnite($pMLotUnite) {
		array_push($this->mMLotUnite, $pMLotUnite);
	}

}
?>