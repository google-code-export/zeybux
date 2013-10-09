<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : InfoCompteZeybuResponse.php
//
// Description : Classe InfoCompteZeybuResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoCompteZeybuResponse
 * @author Julien PIERRE
 * @since 24/12/2010
 * @desc Classe représentant une InfoCompteZeybuResponse
 */
class InfoCompteZeybuResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var decimal(33,2)
	 * @desc Le Solde Total
	 */
	protected $mSoldeTotal;
	
	/**
	 * @var decimal(33,2)
	 * @desc Le Solde du compte solidaire
	 */
	protected $mSoldeSolidaire;
	
	/**
	 * @var decimal(33,2)
	 * @desc Le Solde en caisse
	 */
	protected $mSoldeCaisse;
		
	/**
	 * @var decimal(33,2)
	 * @desc Le Solde en Banque
	 */
	protected $mSoldeBanque;
	
	/**
	* @var array(CommandeVO)
	* @desc ListeMarche de la InfoCompteZeybuResponse
	*/
	protected $mListeMarche;
	
	/**
	* @name InfoCompteZeybuResponse()
	* @desc Le constructeur de InfoCompteZeybuResponse
	*/	
	public function InfoCompteZeybuResponse($pSoldeTotal = null, $pSoldeSolidaire = null, $pSoldeCaisse = null, $pSoldeBanque = null, $pListeMarche = null) {
		$this->mValid = true;		
		if(!is_null($pSoldeTotal)) { $this->mSoldeTotal = $pSoldeTotal;}
		if(!is_null($pSoldeSolidaire)) { $this->mSoldeSolidaire = $pSoldeSolidaire;}
		if(!is_null($pSoldeCaisse)) { $this->mSoldeCaisse = $pSoldeCaisse;}
		if(!is_null($pSoldeBanque)) { $this->mSoldeBanque = $pSoldeBanque;}
		if(!is_null($pListeMarche)) { $this->mListeMarche = $pListeMarche;} else { $this->mListeMarche = array(); }
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
	* @name getSoldeTotal()
	* @return decimal(33,2)
	* @desc Renvoie le SoldeTotal
	*/
	public function getSoldeTotal() {
		return $this->mSoldeTotal;
	}

	/**
	* @name setSoldeTotal($pSoldeTotal)
	* @param decimal(33,2)
	* @desc Remplace le SoldeTotal par $pSoldeTotal
	*/
	public function setSoldeTotal($pSoldeTotal) {
		$this->mSoldeTotal = $pSoldeTotal;
	}
	
	/**
	* @name getSoldeSolidaire()
	* @return decimal(33,2)
	* @desc Renvoie le SoldeSolidaire
	*/
	public function getSoldeSolidaire() {
		return $this->mSoldeSolidaire;
	}

	/**
	* @name setSoldeSolidaire($pSoldeSolidaire)
	* @param decimal(33,2)
	* @desc Remplace le SoldeSolidaire par $pSoldeSolidaire
	*/
	public function setSoldeSolidaire($pSoldeSolidaire) {
		$this->mSoldeSolidaire = $pSoldeSolidaire;
	}
	
	/**
	* @name getSoldeCaisse()
	* @return decimal(33,2)
	* @desc Renvoie le SoldeCaisse
	*/
	public function getSoldeCaisse() {
		return $this->mSoldeCaisse;
	}

	/**
	* @name setSoldeCaisse($pSoldeCaisse)
	* @param decimal(33,2)
	* @desc Remplace le SoldeCaisse par $pSoldeCaisse
	*/
	public function setSoldeCaisse($pSoldeCaisse) {
		$this->mSoldeCaisse = $pSoldeCaisse;
	}
			
	/**
	* @name getSoldeBanque()
	* @return decimal(33,2)
	* @desc Renvoie le SoldeBanque
	*/
	public function getSoldeBanque() {
		return $this->mSoldeBanque;
	}

	/**
	* @name setSoldeBanque($pSoldeBanque)
	* @param decimal(33,2)
	* @desc Remplace le SoldeBanque par $pSoldeBanque
	*/
	public function setSoldeBanque($pSoldeBanque) {
		$this->mSoldeBanque = $pSoldeBanque;
	}
	
	/**
	* @name getListeMarche()
	* @return array(CommandeVO)
	* @desc Renvoie le membre ListeMarche de la InfoCompteZeybuResponse
	*/
	public function getListeMarche(){
		return $this->mListeMarche;
	}

	/**
	* @name setListeMarche($pListeMarche)
	* @param array(CommandeVO)
	* @desc Remplace le membre ListeMarche de la InfoCompteZeybuResponse par $pListeMarche
	*/
	public function setListeMarche($pListeMarche) {
		$this->mListeMarche = $pListeMarche;
	}
	
	/**
	* @name addListeMarche($pListeMarche)
	* @param CommandeVO
	* @desc Ajoute $pListeMarche à ListeMarche
	*/
	public function addListeMarche($pListeMarche){
		array_push($this->mListeMarche,$pListeMarche);
	}
}
?>