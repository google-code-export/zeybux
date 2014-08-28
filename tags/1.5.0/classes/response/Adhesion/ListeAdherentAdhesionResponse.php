<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/11/2013
// Fichier : ListeAdherentAdhesionResponse.php
//
// Description : Classe ListeAdherentAdhesionResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdherentAdhesionResponse
 * @author Julien PIERRE
 * @since 09/11/2013
 * @desc Classe représentant une ListeAdherentAdhesionResponse
 */
class ListeAdherentAdhesionResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var integer
	 * @desc L'Adhesion
	 */
	protected $mAdhesion;

	/**
	 * @var integer
	 * @desc Nombre d'adhérent sur l'adhésion
	 */
	protected $mNbAdherentSurAdhesion;

	/**
	 * @var integer
	 * @desc Nombre d'adhérent hors de l'adhésion
	 */
	protected $mNbAdherentHorsAdhesion;

	/**
	 * @var array(ListeAdherentAdhesionVO)
	 * @desc Les adhérents avec leur état sur l'adhésion
	 */
	protected $mListeAdherent;
	
	/**
	* @name ListeAdherentAdhesionResponse()
	* @desc Le constructeur
	*/
	public function ListeAdherentAdhesionResponse($pAdhesion = null, $pNbAdherentSurAdhesion = null, $pNbAdherentHorsAdhesion = null, $pListeAdherent = null) {
		$this->mValid = true;
		if(!is_null($pAdhesion)) { $this->mAdhesion = $pAdhesion; }
		if(!is_null($pNbAdherentSurAdhesion)) { $this->mNbAdherentSurAdhesion = $pNbAdherentSurAdhesion; }
		if(!is_null($pNbAdherentHorsAdhesion)) { $this->mNbAdherentHorsAdhesion = $pNbAdherentHorsAdhesion; }
		if(!is_null($pListeAdherent)) { $this->mListeAdherent = $pListeAdherent; }
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
	* @return integer
	* @desc Renvoie le Adhesion
	*/
	public function getAdhesion() {
		return $this->mAdhesion;
	}

	/**
	* @name setAdhesion($pAdhesion)
	* @param integer
	* @desc Remplace le Adhesion par $pAdhesion
	*/
	public function setAdhesion($pAdhesion) {
		$this->mAdhesion = $pAdhesion;
	}

	/**
	 * @name getNbAdherentSurAdhesion()
	 * @return integer
	 * @desc Renvoie le NbAdherentSurAdhesion
	 */
	public function getNbAdherentSurAdhesion() {
		return $this->mNbAdherentSurAdhesion;
	}
	
	/**
	 * @name setNbAdherentSurAdhesion($pNbAdherentSurAdhesion)
	 * @param integer
	 * @desc Remplace le NbAdherentSurAdhesion par $pNbAdherentSurAdhesion
	 */
	public function setNbAdherentSurAdhesion($pNbAdherentSurAdhesion) {
		$this->mNbAdherentSurAdhesion = $pNbAdherentSurAdhesion;
	}
	
	/**
	 * @name getNbAdherentHorsAdhesion()
	 * @return integer
	 * @desc Renvoie le NbAdherentHorsAdhesion
	 */
	public function getNbAdherentHorsAdhesion() {
		return $this->mNbAdherentHorsAdhesion;
	}
	
	/**
	 * @name setNbAdherentHorsAdhesion($pNbAdherentHorsAdhesion)
	 * @param integer
	 * @desc Remplace le NbAdherentHorsAdhesion par $pNbAdherentHorsAdhesion
	 */
	public function setNbAdherentHorsAdhesion($pNbAdherentHorsAdhesion) {
		$this->mNbAdherentHorsAdhesion = $pNbAdherentHorsAdhesion;
	}
	
	/**
	 * @name getListeAdherent()
	 * @return integer
	 * @desc Renvoie le ListeAdherent
	 */
	public function getListeAdherent() {
		return $this->mListeAdherent;
	}
	
	/**
	 * @name setListeAdherent($pListeAdherent)
	 * @param integer
	 * @desc Remplace le ListeAdherent par $pListeAdherent
	 */
	public function setListeAdherent($pListeAdherent) {
		$this->mListeAdherent = $pListeAdherent;
	}
}
?>