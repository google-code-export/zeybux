<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/06/2013
// Fichier : OperationChampComplementaireVO.php
//
// Description : Classe OperationChampComplementaireVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationChampComplementaireVO
 * @author Julien PIERRE
 * @since 15/06/2013
 * @desc Classe représentant une OperationChampComplementaireVO
 */
class OperationChampComplementaireVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc OpeId de la OperationChampComplementaireVO
	*/
	protected $mOpeId;

	/**
	* @var int(11)
	* @desc ChcpId de la OperationChampComplementaireVO
	*/
	protected $mChcpId;

	/**
	* @var varchar(50)
	* @desc Valeur de la OperationChampComplementaireVO
	*/
	protected $mValeur;
	
	/**
	 * @name OperationChampComplementaireVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function OperationChampComplementaireVO($pOpeId = null, $pChcpId = null, $pValeur = null) {
		if(!is_null($pOpeId)) {
			$this->mOpeId = $pOpeId;
		}
		if(!is_null($pChcpId)) {
			$this->mChcpId = $pChcpId;
		}
		if(!is_null($pValeur)) {
			$this->mValeur = $pValeur;
		}
	}

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la OperationChampComplementaireVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la OperationChampComplementaireVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

	/**
	* @name getChcpId()
	* @return int(11)
	* @desc Renvoie le membre ChcpId de la OperationChampComplementaireVO
	*/
	public function getChcpId() {
		return $this->mChcpId;
	}

	/**
	* @name setChcpId($pChcpId)
	* @param int(11)
	* @desc Remplace le membre ChcpId de la OperationChampComplementaireVO par $pChcpId
	*/
	public function setChcpId($pChcpId) {
		$this->mChcpId = $pChcpId;
	}

	/**
	* @name getValeur()
	* @return varchar(50)
	* @desc Renvoie le membre Valeur de la OperationChampComplementaireVO
	*/
	public function getValeur() {
		return $this->mValeur;
	}

	/**
	* @name setValeur($pValeur)
	* @param varchar(50)
	* @desc Remplace le membre Valeur de la OperationChampComplementaireVO par $pValeur
	*/
	public function setValeur($pValeur) {
		$this->mValeur = $pValeur;
	}

}
?>