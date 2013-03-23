<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/08/2011
// Fichier : AchatAdherentResponse.php
//
// Description : Classe AchatAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AchatAdherentResponse
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe représentant une AchatAdherentResponse
 */
class AchatAdherentResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	 * @var MarcheVO
	 * @desc Le Marché
	 */
	protected $mMarche;
	
	/**
	 * @var array(AchatVO)
	 * @desc Les achats
	 */
	protected $mAchats;
	
	/**
	 * @var array(StockProduitViewVO)
	 * @desc Les Stocks solidaire
	 */
	protected $mStockSolidaire;
	
	/**
	* @name InfoAchatCommandeResponse()
	* @desc Le constructeur de InfoAchatCommandeResponse
	*/	
	public function InfoAchatCommandeResponse() {
		$this->mValid = true;
		$this->mAchats = array();
		$this->mStockSolidaire = array();
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
	* @name getMarche()
	* @return MarcheVO
	* @desc Renvoie le Marche
	*/
	public function getMarche() {
		return $this->mMarche;
	}

	/**
	* @name setMarche($pMarche)
	* @param MarcheVO
	* @desc Remplace le Marche par $pMarche
	*/
	public function setMarche($pMarche) {
		$this->mMarche = $pMarche;
	}
	
	/**
	* @name getAchats()
	* @return array(AchatVO)
	* @desc Renvoie le Achats
	*/
	public function getAchats() {
		return $this->mAchats;
	}

	/**
	* @name setAchats($pAchats)
	* @param array(AchatVO)
	* @desc Remplace le Achats par $pAchats
	*/
	public function setAchats($pAchats) {
		$this->mAchats = $pAchats;
	}
	
	/**
	* @name addAchats($pAchat)
	* @param AchatVO
	* @desc Ajoute Achats à $pAchats
	*/
	public function addAchats($pAchat) {
		array_push($this->mAchats,$pAchat);
	}
	
	/**
	* @name getStockSolidaire()
	* @return array(StockProduitViewVO)
	* @desc Renvoie le StockSolidaire
	*/
	public function getStockSolidaire() {
		return $this->mStockSolidaire;
	}

	/**
	* @name setStockSolidaire($pStockSolidaire)
	* @param array(StockProduitViewVO)
	* @desc Remplace le StockSolidaire par $pStockSolidaire
	*/
	public function setStockSolidaire($pStockSolidaire) {
		$this->mStockSolidaire = $pStockSolidaire;
	}
	
	/**
	* @name addStockSolidaire($pStockSolidaire)
	* @param StockProduitViewVO
	* @desc Remplace le StockSolidaire par $pStockSolidaire
	*/
	public function addStockSolidaire($pStockSolidaire) {
		array_push($this->mStockSolidaire, $pStockSolidaire);
	}
}
?>