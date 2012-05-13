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
	* @var array(OperationPasseeViewVO)
	* @desc Operation de la InfoCompteZeybuResponse
	*/
	protected $mOperation;
	
	/**
	* @name InfoCompteZeybuResponse()
	* @desc Le constructeur de InfoCompteZeybuResponse
	*/	
	public function InfoCompteZeybuResponse() {
		$this->mValid = true;		
		$this->mOperation = array();
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
	* @name getOperation()
	* @return array(OperationPasseeViewVO)
	* @desc Renvoie le membre Operation de la InfoCompteZeybuResponse
	*/
	public function getOperation(){
		return $this->mOperation;
	}

	/**
	* @name setOperation($pOperation)
	* @param array(OperationPasseeViewVO)
	* @desc Remplace le membre Operation de la InfoCompteZeybuResponse par $pOperation
	*/
	public function setOperation($pOperation) {
		$this->mOperation = $pOperation;
	}
	
	/**
	* @name addOperation($pOperation)
	* @param OperationPasseeViewVO
	* @desc Ajoute $pOperation à Operation
	*/
	public function addOperation($pOperation){
		array_push($this->mOperation,$pOperation);
	}
}
?>