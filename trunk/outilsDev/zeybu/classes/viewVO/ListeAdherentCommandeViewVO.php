<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : ListeAdherentCommandeViewVO.php
//
// Description : Classe ListeAdherentCommandeViewVO
//
//****************************************************************

/**
 * @name ListeAdherentCommandeViewVO
 * @author Julien PIERRE
 * @since 12/09/2010
 * @desc Classe représentant une ListeAdherentCommandeViewVO
 */
class ListeAdherentCommandeViewVO
{
	/**
	* @var int(11)
	* @desc ComId de la ListeAdherentCommandeViewVO
	*/
	private $mComId;

	/**
	* @var int(11)
	* @desc AdhId de la ListeAdherentCommandeViewVO
	*/
	private $mAdhId;

	/**
	* @var varchar(5)
	* @desc AdhNumero de la ListeAdherentCommandeViewVO
	*/
	private $mAdhNumero;

	/**
	* @var int(11)
	* @desc AdhLabelCompte de la ListeAdherentCommandeViewVO
	*/
	private $mAdhLabelCompte;

	/**
	* @var varchar(50)
	* @desc AdhNom de la ListeAdherentCommandeViewVO
	*/
	private $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la ListeAdherentCommandeViewVO
	*/
	private $mAdhPrenom;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la ListeAdherentCommandeViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la ListeAdherentCommandeViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeAdherentCommandeViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeAdherentCommandeViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(5)
	* @desc Renvoie le membre AdhNumero de la ListeAdherentCommandeViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(5)
	* @desc Remplace le membre AdhNumero de la ListeAdherentCommandeViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhLabelCompte()
	* @return int(11)
	* @desc Renvoie le membre AdhLabelCompte de la ListeAdherentCommandeViewVO
	*/
	public function getAdhLabelCompte() {
		return $this->mAdhLabelCompte;
	}

	/**
	* @name setAdhLabelCompte($pAdhLabelCompte)
	* @param int(11)
	* @desc Remplace le membre AdhLabelCompte de la ListeAdherentCommandeViewVO par $pAdhLabelCompte
	*/
	public function setAdhLabelCompte($pAdhLabelCompte) {
		$this->mAdhLabelCompte = $pAdhLabelCompte;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ListeAdherentCommandeViewVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ListeAdherentCommandeViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ListeAdherentCommandeViewVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ListeAdherentCommandeViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
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
			\}
			}
			return $lMembresJs;
		}
		return NULL;
	}

}
?>