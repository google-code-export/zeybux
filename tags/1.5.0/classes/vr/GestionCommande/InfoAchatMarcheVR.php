<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 16/09/2013
// Fichier : InfoAchatMarcheVR.php
//
// Description : Classe InfoAchatMarcheVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name InfoAchatMarcheVR
 * @author Julien PIERRE
 * @since 16/09/2013
 * @desc Classe représentant une InfoAchatMarcheVR
 */
class InfoAchatMarcheVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc Id de la InfoAchatMarcheVR
	 */
	protected $mId;
	
	/**
	 * @var VRelement
	 * @desc IdAdherent de la InfoAchatMarcheVR
	 */
	protected $mIdAdherent;
	
	/**
	 * @var VRelement
	 * @desc IdMarche de la InfoAchatMarcheVR
	 */
	protected $mIdMarche;
	
	/**
	* @name InfoAchatMarcheVR()
	* @return bool
	* @desc Constructeur
	*/
	function InfoAchatMarcheVR() {
		parent::__construct();		
		$this->mId = new VRelement();
		$this->mIdAdherent = new VRelement();
		$this->mIdMarche = new VRelement();
	}

	/**
	* @name getId()
	* @return VRelement
	* @desc Renvoie le VRelement mId
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le mId par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdAdherent()
	* @return VRelement
	* @desc Renvoie le VRelement mIdAdherent
	*/
	public function getIdAdherent() {
		return $this->mIdAdherent;
	}

	/**
	* @name setIdAdherent($pIdAdherent)
	* @param VRelement
	* @desc Remplace le mIdAdherent par $pIdAdherent
	*/
	public function setIdAdherent($pIdAdherent) {
		$this->mIdAdherent = $pIdAdherent;
	}

	/**
	* @name getIdMarche()
	* @return VRelement
	* @desc Renvoie le VRelement mIdMarche
	*/
	public function getIdMarche() {
		return $this->mIdMarche;
	}

	/**
	* @name setIdMarche($pIdMarche)
	* @param VRelement
	* @desc Remplace le mIdMarche par $pIdMarche
	*/
	public function setIdMarche($pIdMarche) {
		$this->mIdMarche = $pIdMarche;
	}
}
?>