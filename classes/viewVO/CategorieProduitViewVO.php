<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : CategorieProduitViewVO.php
//
// Description : Classe CategorieProduitViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CategorieProduitViewVO
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une CategorieProduitViewVO
 */
class CategorieProduitViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CproId de la CategorieProduitViewVO
	*/
	protected $mCproId;

	/**
	* @var varchar(50)
	* @desc CproNom de la CategorieProduitViewVO
	*/
	protected $mCproNom;

	/**
	* @var text
	* @desc CproDescription de la CategorieProduitViewVO
	*/
	protected $mCproDescription;

	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la CategorieProduitViewVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la CategorieProduitViewVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la CategorieProduitViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la CategorieProduitViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}

	/**
	* @name getCproDescription()
	* @return text
	* @desc Renvoie le membre CproDescription de la CategorieProduitViewVO
	*/
	public function getCproDescription() {
		return $this->mCproDescription;
	}

	/**
	* @name setCproDescription($pCproDescription)
	* @param text
	* @desc Remplace le membre CproDescription de la CategorieProduitViewVO par $pCproDescription
	*/
	public function setCproDescription($pCproDescription) {
		$this->mCproDescription = $pCproDescription;
	}

}
?>