<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/11/2011
// Fichier : ModelesLotResponse.php
//
// Description : Classe ModelesLotResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ModelesLotResponse
 * @author Julien PIERRE
 * @since 05/11/2011
 * @desc Classe représentant une ModelesLotResponse
 */
class ModelesLotResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var ModeleLotViewVO
	* @desc DetailProduit de la ModelesLotResponse
	*/
	protected $mModelesLot;
	
	/**
	* @var ProduitAbonnementVO
	* @desc DetailAbonnement de la ModelesLotResponse
	*/
	protected $mDetailAbonnement;
	
	/**
	* @name ModelesLotResponse()
	* @desc Le constructeur
	*/
	public function ModelesLotResponse() {
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
	* @name getModelesLot()
	* @return ModeleLotViewVO
	* @desc Renvoie le membre ModelesLot de la ModelesLotResponse
	*/
	public function getModelesLot(){
		return $this->mModelesLot;
	}

	/**
	* @name setModelesLot($pModelesLot)
	* @param ModeleLotViewVO
	* @desc Remplace le membre ModelesLot de la ModelesLotResponse par $pModelesLot
	*/
	public function setModelesLot($pModelesLot) {
		$this->mModelesLot = $pModelesLot;
	}
	
	/**
	* @name getDetailAbonnement()
	* @return ProduitAbonnementVO
	* @desc Renvoie le membre DetailAbonnement de la DetailAbonnementResponse
	*/
	public function getDetailAbonnement(){
		return $this->mDetailAbonnement;
	}

	/**
	* @name setDetailAbonnement($pDetailAbonnement)
	* @param ProduitAbonnementVO
	* @desc Remplace le membre DetailAbonnement de la DetailAbonnementResponse par $pDetailAbonnement
	*/
	public function setDetailAbonnement($pDetailAbonnement) {
		$this->mDetailAbonnement = $pDetailAbonnement;
	}
}
?>