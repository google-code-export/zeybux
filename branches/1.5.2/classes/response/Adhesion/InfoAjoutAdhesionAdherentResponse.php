<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/11/2013
// Fichier : InfoAjoutAdhesionAdherentResponse.php
//
// Description : Classe InfoAjoutAdhesionAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoAjoutAdhesionAdherentResponse
 * @author Julien PIERRE
 * @since 10/11/2013
 * @desc Classe représentant une InfoAjoutAdhesionAdherentResponse
 */
class InfoAjoutAdhesionAdherentResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var AdhesionDetailVO
	 * @desc L'Adhésion
	 */
	protected $mAdhesion;
	
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
	 * @var AdhesionAdherentDetailVO
	 * @desc L'Adhésion de l'adhérent
	 */
	protected $mAdhesionAdherent;

	/**
	* @name InfoAjoutAdhesionAdherentResponse()
	* @desc Le constructeur de InfoAjoutAdhesionAdherentResponse
	*/	
	public function InfoAjoutAdhesionAdherentResponse($pAdhesion = null, $pTypePaiement = null, $pBanques = null, $pAdhesionAdherent = null) {
		$this->mValid = true;
		if(!is_null($pAdhesion)) {$this->mAdhesion = $pAdhesion; }
		if(!is_null($pTypePaiement)) {$this->mTypePaiement = $pTypePaiement; } else { $this->mTypePaiement = array();}
		if(!is_null($pBanques)) {$this->mBanques = $pBanques; } else { $this->mBanques = array();}
		if(!is_null($pAdhesionAdherent)) {$this->mAdhesionAdherent = $pAdhesionAdherent; } else { $this->mAdhesionAdherent = array();}
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
	* @name getAdhesion()
	* @return AdhesionDetailVO
	* @desc Renvoie l'Adhesion
	*/
	public function getAdhesion() {
		return $this->mAdhesion;
	}

	/**
	* @name setAdhesion($pAdhesion)
	* @param AdhesionDetailVO
	* @desc Remplace l'Adhesion par $pAdhesion
	*/
	public function setAdhesion($pAdhesion) {
		$this->mAdhesion = $pAdhesion;
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
		
	/**
	* @name getAdhesionAdherent()
	* @return array(BanqueVO)
	* @desc Renvoie les AdhesionAdherent
	*/
	public function getAdhesionAdherent() {
		return $this->mAdhesionAdherent;
	}

	/**
	* @name setAdhesionAdherent($pAdhesionAdherent)
	* @param array(BanqueVO)
	* @desc Remplace les AdhesionAdherent par $pAdhesionAdherent
	*/
	public function setAdhesionAdherent($pAdhesionAdherent) {
		$this->mAdhesionAdherent = $pAdhesionAdherent;
	}
}
?>