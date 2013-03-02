<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : ListeCategorieProduitViewVO.php
//
// Description : Classe ListeCategorieProduitViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeCategorieProduitViewVO
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une ListeCategorieProduitViewVO
 */
class ListeCategorieProduitViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CproId de la ListeCategorieProduitViewVO
	*/
	protected $mCproId;

	/**
	* @var varchar(50)
	* @desc CproNom de la ListeCategorieProduitViewVO
	*/
	protected $mCproNom;

	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la ListeCategorieProduitViewVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la ListeCategorieProduitViewVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la ListeCategorieProduitViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la ListeCategorieProduitViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}

}
?>