<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/05/2012
// Fichier : validerPaiementVR.php
//
// Description : Classe validerPaiementVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name validerPaiementVR
 * @author Julien PIERRE
 * @since 13/05/2012
 * @desc Classe représentant une validerPaiementVR
 */
class validerPaiementVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc Id de la validerPaiementVR
	 */
	protected $mId;
	
	/**
	* @name validerPaiementVR()
	* @return bool
	* @desc Constructeur
	*/
	function validerPaiementVR() {
		$this->mId = new VRelement();
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
}
?>