<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/10/2010
// Fichier : DetailMarcheResponse.php
//
// Description : Classe DetailMarcheResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailMarcheResponse
 * @author Julien PIERRE
 * @since 19/10/2010
 * @desc Classe représentant une DetailMarcheResponse
 */
class DetailMarcheResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var array(MarcheVO)
	 * @desc Le marche
	 */
	protected $mMarche;
	
	/**
	 * @var AdherentViewVO
	 * @desc L'adhérent
	 */
	protected $mAdherent;
	
	/**
	* @name DetailMarcheResponse()
	* @desc Le constructeur de DetailMarcheResponse
	*/	
	public function DetailMarcheResponse() {
		$this->mValid = true;
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
	* @name getAdherent()
	* @return AdherentViewVO
	* @desc Renvoie l'Adherent
	*/
	public function getAdherent() {
		return $this->mAdherent;
	}

	/**
	* @name setAdherent($pAdherent)
	* @param AdherentViewVO
	* @desc Remplace l'Adherent par $pAdherent
	*/
	public function setAdherent($pAdherent) {
		$this->mAdherent = $pAdherent;
	}
}
?>