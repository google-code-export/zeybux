<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : ListeFermeResponse.php
//
// Description : Classe ListeFermeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeFermeResponse
 * @author Julien PIERRE
 * @since 23/10/2011
 * @desc Classe représentant une ListeFermeResponse
 */
class ListeFermeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(FermeViewVO)
	* @desc ListeFerme de la ListeFermeResponse
	*/
	protected $mListeFerme;
	
	/**
	* @var integer
	* @desc numeroFacture de la ListeFermeResponse
	*/
	protected $mNumeroFacture;
	
	/**
	 * @var array(BanqueVO)
	 * @desc Les Banques
	 */
	protected $mBanques;
	
	/**
	 * @var array(TypePaiementVO)
	 * @desc La liste des types de paiement
	 */
	protected $mTypePaiement;
	
	/**
	* @name ListeFermeResponse()
	* @desc Le constructeur de ListeFermeResponse
	*/	
	public function ListeFermeResponse($pListeFerme = null, $pNumeroFacture = null, $pBanques = null, $pTypePaiement = null) {
		$this->mValid = true;
		if(!is_null($pListeFerme)) { $this->mListeFerme = $pListeFerme; } else { $this->mListeFerme = array(); }
		if(!is_null($pNumeroFacture)) { $this->mNumeroFacture = $pNumeroFacture; }
		if(!is_null($pBanques)) { $this->mBanques = $pBanques; } else { $this->mBanques = array(); }
		if(!is_null($pTypePaiement)) { $this->mTypePaiement = $pTypePaiement; } else { $this->mTypePaiement = array(); }
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
	* @name getListeFerme()
	* @return array(FermeViewVO)
	* @desc Renvoie le membre ListeFerme de la ListeFermeResponse
	*/
	public function getListeFerme(){
		return $this->mListeFerme;
	}

	/**
	* @name setListeFerme($pListeFerme)
	* @param array(FermeViewVO)
	* @desc Remplace le membre ListeFerme de la ListeFermeResponse par $pListeFerme
	*/
	public function setListeFerme($pListeFerme) {
		$this->mListeFerme = $pListeFerme;
	}
	
	/**
	* @name addListeFerme($pListeFerme)
	* @param FermeViewVO
	* @desc Ajoute $pListeFerme à ListeFerme
	*/
	public function addListeFerme($pListeFerme){
		array_push($this->mListeFerme,$pListeFerme);
	}
	
	/**
	 * @name getNumeroFacture()
	 * @return integer
	 * @desc Renvoie le NumeroFacture de l'élément
	 */
	public function getNumeroFacture() {
		return $this->mNumeroFacture;
	}
	
	/**
	 * @name setNumeroFacture($pNumeroFacture)
	 * @param integer
	 * @desc Remplace le NumeroFacture de l'élément par $pNumeroFacture
	 */
	public function setNumeroFacture($pNumeroFacture) {
		$this->mNumeroFacture = $pNumeroFacture;
	}
	
	/**
	* @name getBanques()
	* @return array(BanqueVO)
	* @desc Renvoie les Banques
	*/
	public function getBanques() {
		return $this->mBanques;
	}

	/**
	* @name setBanques($pBanques)
	* @param array(BanqueVO)
	* @desc Remplace les Banques par $pBanques
	*/
	public function setBanques($pBanques) {
		$this->mBanques = $pBanques;
	}
	
	/**
	 * @name addBanques($pBanque)
	 * @param BanqueVO
	 * @desc Ajoute la Banque à Banques
	 */
	public function addBanques($pBanque) {
		array_push($this->mBanques,$pBanque);
	}
	
	/**
	* @name getTypePaiement()
	* @return array(TypePaiementVO)
	* @desc Renvoie le TypePaiement
	*/
	public function getTypePaiement() {
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param array(TypePaiementVO)
	* @desc Remplace le TypePaiement par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}
	
	/**
	* @name addTypePaiement($pTypePaiement)
	* @param TypePaiementVO
	* @desc Ajoute le $pTypePaiement à TypePaiement
	*/
	public function addTypePaiement($pTypePaiement) {
		array_push($this->mTypePaiement, $pTypePaiement);
	}
}
?>