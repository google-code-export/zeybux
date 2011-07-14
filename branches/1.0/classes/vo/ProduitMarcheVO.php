<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/07/2011
// Fichier : ProduitMarcheVO.php
//
// Description : Classe ProduitMarcheVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");
include_once(CHEMIN_CLASSES_VO . "DetailMarcheVO.php");

/**
 * @name ProduitMarcheVO
 * @author Julien PIERRE
 * @since 13/07/2011
 * @desc Classe représentant une ProduitMarcheVO
 */
class ProduitMarcheVO extends DataTemplate
{
	/**
	 * @var integer 
	 * @desc ID du Produit
	 */
	protected $mId;
	
	/**
	 * @var integer 
	 * @desc ID du Producteur
	 */
	protected $mIdProducteur;
	
	/**
	* @var integer 
	* @desc ID du Nom du Produit
	*/
	protected $mIdNom;
	
	/**
	* @var string
	* @desc Nom du Produit
	*/
	protected $mNom;
	
	/**
	* @var string
	* @desc Description du Produit
	*/
	protected $mDescription;
	
	/**
	* @var integer 
	* @desc ID de la Categorie du Produit
	*/
	protected $mIdCategorie;
		
	/**
	* @var string
	* @desc Unite du Produit
	*/
	protected $mUnite;
	
	/**
	* @var integer
	* @desc La quantite max de Produit par adherent
	*/
	protected $mQteMaxCommande;
	
	/**
	* @var integer
	* @desc La quantite restante de Produit
	*/
	protected $mStockReservation;
	
	/**
	* @var array(DetailMarcheVO)
	* @desc Les lots du Produit
	*/
	protected $mLots;
	
	/**
	* @name ProduitMarcheVO()
	* @desc Le constructeur
	*/
	public function ProduitMarcheVO() {
		$this->mLots = array();
	}
		
	/**
	* @name getId()
	* @return integer
	* @desc Renvoie l'Id du Produit
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param integer
	* @desc Remplace l'Id par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
	
	/**
	* @name getIdProducteur()
	* @return integer
	* @desc Renvoie l'IdProducteur du Produit
	*/
	public function getIdProducteur() {
		return $this->mIdProducteur;
	}

	/**
	* @name setIdProducteur($pIdProducteur)
	* @param integer
	* @desc Remplace l'IdProducteur par $pIdProducteur
	*/
	public function setIdProducteur($pIdProducteur) {
		$this->mIdProducteur = $pIdProducteur;
	}
	
	/**
	* @name getIdNom()
	* @return integer
	* @desc Renvoie l'IdNom du Produit
	*/
	public function getIdNom() {
		return $this->mIdNom;
	}

	/**
	* @name setIdNom($pIdNom)
	* @param integer
	* @desc Remplace l'IdNom par $pIdNom
	*/
	public function setIdNom($pIdNom) {
		$this->mIdNom = $pIdNom;
	}
	
	/**
	* @name getNom()
	* @return string
	* @desc Renvoie le Nom du Produit
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param string
	* @desc Remplace le Nom par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}
	
	/**
	* @name getDescription()
	* @return string
	* @desc Renvoie le Description du Produit
	*/
	public function getDescription() {
		return $this->mDescription;
	}

	/**
	* @name setDescription($pDescription)
	* @param string
	* @desc Remplace le Description par $pDescription
	*/
	public function setDescription($pDescription) {
		$this->mDescription = $pDescription;
	}

	/**
	* @name getIdCategorie()
	* @return integer
	* @desc Renvoie le IdCategorie du Produit
	*/
	public function getIdCategorie() {
		return $this->mIdCategorie;
	}

	/**
	* @name setIdCategorie($pIdCategorie)
	* @param integer
	* @desc Remplace le IdCategorie par $pIdCategorie
	*/
	public function setIdCategorie($pIdCategorie) {
		$this->mIdCategorie = $pIdCategorie;
	}
	
	/**
	* @name getUnite()
	* @return string
	* @desc Renvoie le Unite du Produit
	*/
	public function getUnite() {
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param string
	* @desc Remplace le Unite par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}
	
	/**
	* @name getQteMaxCommande()
	* @return integer
	* @desc Renvoie le QteMaxCommande du Produit
	*/
	public function getQteMaxCommande() {
		return $this->mQteMaxCommande;
	}

	/**
	* @name setQteMaxCommande($pQteMaxCommande)
	* @param integer
	* @desc Remplace le QteMaxCommande par $pQteMaxCommande
	*/
	public function setQteMaxCommande($pQteMaxCommande) {
		$this->mQteMaxCommande = $pQteMaxCommande;
	}
	
	/**
	* @name getStockReservation()
	* @return integer
	* @desc Renvoie le StockReservation du Produit
	*/
	public function getStockReservation() {
		return $this->mStockReservation;
	}

	/**
	* @name setStockReservation($pStockReservation)
	* @param integer
	* @desc Remplace le StockReservation par $pStockReservation
	*/
	public function setStockReservation($pStockReservation) {
		$this->mStockReservation = $pStockReservation;
	}
	
	/**
	* @name getLots()
	* @return array(DetailCommandeVO)
	* @desc Renvoie le Lots du Produit
	*/
	public function getLots() {
		return $this->mLots;
	}

	/**
	* @name setLots($pLots)
	* @param array(DetailCommandeVO)
	* @desc Remplace le Lots par $pLots
	*/
	public function setLots($pLots) {
		$this->mLots = $pLots;
	}
	
	/**
	* @name addLots($pLots)
	* @param DetailCommandeVO
	* @desc Ajoute $pLots à Lots
	*/
	public function addLots($pLots) {
		array_push($this->mLots,$pLots);
	}
}
?>