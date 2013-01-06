<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/10/2011
// Fichier : CategorieProduitActiveViewVO.php
//
// Description : Classe CategorieProduitActiveViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CategorieProduitActiveViewVO
 * @author Julien PIERRE
 * @since 09/10/2011
 * @desc Classe représentant une CategorieProduitActiveViewVO
 */
class CategorieProduitActiveViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CproId de la CategorieProduitActiveViewVO
	*/
	protected $mCproId;

	/**
	* @var varchar(50)
	* @desc CproNom de la CategorieProduitActiveViewVO
	*/
	protected $mCproNom;

	/**
	* @var text
	* @desc CproDescription de la CategorieProduitActiveViewVO
	*/
	protected $mCproDescription;

	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la CategorieProduitActiveViewVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la CategorieProduitActiveViewVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la CategorieProduitActiveViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la CategorieProduitActiveViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}

	/**
	* @name getCproDescription()
	* @return text
	* @desc Renvoie le membre CproDescription de la CategorieProduitActiveViewVO
	*/
	public function getCproDescription() {
		return $this->mCproDescription;
	}

	/**
	* @name setCproDescription($pCproDescription)
	* @param text
	* @desc Remplace le membre CproDescription de la CategorieProduitActiveViewVO par $pCproDescription
	*/
	public function setCproDescription($pCproDescription) {
		$this->mCproDescription = $pCproDescription;
	}

}
?>