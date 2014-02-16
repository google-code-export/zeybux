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
	 * @desc IDMarche du Produit
	 */
	protected $mIdMarche;
	
	/**
	 * @var integer 
	 * @desc ID du compte de la ferme
	 */
	protected $mIdCompteFerme;
	
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
	* @var varchar(50) 
	* @desc Nom de la catégorie du Produit
	*/
	protected $mCproNom;
		
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
	* @var decimal(10,2)
	* @desc La quantite restante de Produit
	*/
	protected $mStockReservation;
	
	/**
	* @var decimal(10,2)
	* @desc La quantite initiale de Produit
	*/
	protected $mStockInitial;
	
	/**
	* @var int(11)
	* @desc Type du produit
	*/
	protected $mType;
	
	/**
	* @var array(DetailMarcheVO)
	* @desc Les lots du Produit
	*/
	protected $mLots;
	
	/**
	* @var int(11)
	* @desc FerId du produit
	*/
	protected $mFerId;
	
	/**
	* @var varchar(20)
	* @desc FerNom du produit
	*/
	protected $mFerNom;
	
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
	* @name getIdMarche()
	* @return integer
	* @desc Renvoie l'IdMarche du Produit
	*/
	public function getIdMarche() {
		return $this->mIdMarche;
	}

	/**
	* @name setIdMarche($pIdMarche)
	* @param integer
	* @desc Remplace l'IdMarche par $pIdMarche
	*/
	public function setIdMarche($pIdMarche) {
		$this->mIdMarche = $pIdMarche;
	}
	
	/**
	* @name getIdCompteFerme()
	* @return integer
	* @desc Renvoie l'IdCompteFerme du Produit
	*/
	public function getIdCompteFerme() {
		return $this->mIdCompteFerme;
	}

	/**
	* @name setIdCompteFerme($pIdCompteFerme)
	* @param integer
	* @desc Remplace l'IdCompteFerme par $pIdCompteFerme
	*/
	public function setIdCompteFerme($pIdCompteFerme) {
		$this->mIdCompteFerme = $pIdCompteFerme;
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
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le CproNom du Produit
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le CproNom par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
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
	* @return decimal(10,2)
	* @desc Renvoie le StockReservation du Produit
	*/
	public function getStockReservation() {
		return $this->mStockReservation;
	}

	/**
	* @name setStockReservation($pStockReservation)
	* @param decimal(10,2)
	* @desc Remplace le StockReservation par $pStockReservation
	*/
	public function setStockReservation($pStockReservation) {
		$this->mStockReservation = $pStockReservation;
	}
	
	/**
	* @name getStockInitial()
	* @return decimal(10,2)
	* @desc Renvoie le StockInitial du Produit
	*/
	public function getStockInitial() {
		return $this->mStockInitial;
	}

	/**
	* @name setStockInitial($pStockInitial)
	* @param decimal(10,2)
	* @desc Remplace le StockInitial par $pStockInitial
	*/
	public function setStockInitial($pStockInitial) {
		$this->mStockInitial = $pStockInitial;
	}
	
	/**
	* @name getType()
	* @return int(11)
	* @desc Renvoie le membre Type du produit
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param int(11)
	* @desc Remplace le membre Type du produit par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
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
	
	/**
	* @name getFerId()
	* @return int(11)
	* @desc Renvoie le membre FerId du produit
	*/
	public function getFerId() {
		return $this->mFerId;
	}

	/**
	* @name setFerId($pFerId)
	* @param int(11)
	* @desc Remplace le membre FerId du produit par $pFerId
	*/
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}
	
	/**
	* @name getFerNom()
	* @return varchar(20)
	* @desc Renvoie le membre FerNom du produit
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param varchar(20)
	* @desc Remplace le membre FerNom du produit par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}
}
?>