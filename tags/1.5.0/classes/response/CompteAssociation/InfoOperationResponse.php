<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/02/2014
// Fichier : InfoOperationResponse.php
//
// Description : Classe InfoOperationResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoOperationResponse
 * @author Julien PIERRE
 * @since 12/02/2014
 * @desc Classe représentant une InfoOperationResponse
 */
class InfoOperationResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;
	
	/**
	 * @var array(TypePaiementVO)
	 * @desc La liste des types de paiement
	 */
	protected $mTypePaiement;
	
	/**
	 * @var array(BanqueVO)
	 * @desc Les Banques
	 */
	protected $mBanques;
	
	/**
	* @name InfoRechargementResponse()
	* @desc Le constructeur
	*/
	public function InfoOperationResponse($pTypePaiement = null, $pBanques = null) {
		$this->mValid = true;
		if(!is_null($pTypePaiement)) {$this->mTypePaiement = $pTypePaiement; } else { $this->mTypePaiement = array();}
		if(!is_null($pBanques)) {$this->mBanques = $pBanques; } else { $this->mBanques = array();}
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
}
?>