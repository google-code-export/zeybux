<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/08/2013
// Fichier : ListeProduitFermeVR.php
//
// Description : Classe ListeProduitFermeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name ListeProduitFermeVR
 * @author Julien PIERRE
 * @since 24/08/2013
 * @desc Classe représentant une ListeProduitFermeVR
 */
class ListeProduitFermeVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc Id de la ListeProduitFermeVR
	 */
	protected $mId;
	
	/**
	 * @var VRelement
	 * @desc IdMarche de la ListeProduitFermeVR
	 */
	protected $mIdMarche;
		
	/**
	* @name ListeProduitFermeVR()
	* @return bool
	* @desc Constructeur
	*/
	function ListeProduitFermeVR() {
		parent::__construct();		
		$this->mId = new VRelement();
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