<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/09/2010
// Fichier : ReservationViewVO.php
//
// Description : Classe ReservationViewVO
//
//****************************************************************

/**
 * @name ReservationViewVO
 * @author Julien PIERRE
 * @since 19/09/2010
 * @desc Classe représentant une ReservationViewVO
 */
class ReservationViewVO
{
	/**
	* @var int(11)
	* @desc ComId de la ReservationViewVO
	*/
	private $mComId;

	/**
	* @var int(11)
	* @desc ProId de la ReservationViewVO
	*/
	private $mProId;

	/**
	* @var int(11)
	* @desc StoId de la ReservationViewVO
	*/
	private $mStoId;

	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la ReservationViewVO
	*/
	private $mStoQuantite;

	/**
	* @var tinyint(1)
	* @desc StoType de la ReservationViewVO
	*/
	private $mStoType;

	/**
	* @var int(11)
	* @desc StoIdCompte de la ReservationViewVO
	*/
	private $mStoIdCompte;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la ReservationViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la ReservationViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la ReservationViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la ReservationViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la ReservationViewVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la ReservationViewVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la ReservationViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la ReservationViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}

	/**
	* @name getStoType()
	* @return tinyint(1)
	* @desc Renvoie le membre StoType de la ReservationViewVO
	*/
	public function getStoType() {
		return $this->mStoType;
	}

	/**
	* @name setStoType($pStoType)
	* @param tinyint(1)
	* @desc Remplace le membre StoType de la ReservationViewVO par $pStoType
	*/
	public function setStoType($pStoType) {
		$this->mStoType = $pStoType;
	}

	/**
	* @name getStoIdCompte()
	* @return int(11)
	* @desc Renvoie le membre StoIdCompte de la ReservationViewVO
	*/
	public function getStoIdCompte() {
		return $this->mStoIdCompte;
	}

	/**
	* @name setStoIdCompte($pStoIdCompte)
	* @param int(11)
	* @desc Remplace le membre StoIdCompte de la ReservationViewVO par $pStoIdCompte
	*/
	public function setStoIdCompte($pStoIdCompte) {
		$this->mStoIdCompte = $pStoIdCompte;
	}

	/**
	* @name export()
	* @return json
	* @desc Retourne la valeur des membres en les renommant au format tableau
	*/
	public function export() {
		$lMembres = get_object_vars($this);
		$lMembresJs = array();
		foreach($lMembres as $lCle => $lValeur) {
			$lCle = substr($lCle,1);
			$lCle[0] = strtolower($lCle[0]);
			if(is_object($lValeur)) {
				$lMembresJs[$lCle] = $lValeur->export();
			} else if(is_array($lValeur)) {
				$lMembresJs[$lCle] = $this->exportArray($lValeur);
			} else {
				$lMembresJs[$lCle] = $lValeur;
			}
		}
		return $lMembresJs;
	}

	/**
	* @name exportToJson()
	* @return json
	* @desc Retourne la valeur des membres en les renommant au format javascript
	*/
	public function exportToJson() {
		return json_encode($this->export());
	}

	/**
	* @name exportArray($pArray)
	* @return array()
	* @desc Retourne la valeur des membres en les renommant au format tableau
	*/
	public function exportArray($pArray) {
		if(is_array($pArray)) {
			$lMembresJs = array();
			foreach($pArray as $lCle => $lValeur) {
				if(is_object($lValeur)) {
					$lMembresJs[$lCle] = $lValeur->export();
				} else if(is_array($lValeur)) {
					$lMembresJs[$lCle] = $this->exportArray($lValeur);
				} else {
					$lMembresJs[$lCle] = $lValeur;
				}
			}
			return $lMembresJs;
		}
		return NULL;
	}

}
?>