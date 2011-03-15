<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/10/2010
// Fichier : MenuViewVO.php
//
// Description : Classe MenuViewVO
//
//****************************************************************

/**
 * @name MenuViewVO
 * @author Julien PIERRE
 * @since 28/10/2010
 * @desc Classe représentant une MenuViewVO
 */
class MenuViewVO
{
	/**
	* @var int(11)
	* @desc AdhId de la MenuViewVO
	*/
	private $mAdhId;

	/**
	* @var int(11)
	* @desc ModId de la MenuViewVO
	*/
	private $mModId;

	/**
	* @var varchar(50)
	* @desc ModNom de la MenuViewVO
	*/
	private $mModNom;

	/**
	* @var varchar(80)
	* @desc ModLabel de la MenuViewVO
	*/
	private $mModLabel;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la MenuViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la MenuViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getModId()
	* @return int(11)
	* @desc Renvoie le membre ModId de la MenuViewVO
	*/
	public function getModId() {
		return $this->mModId;
	}

	/**
	* @name setModId($pModId)
	* @param int(11)
	* @desc Remplace le membre ModId de la MenuViewVO par $pModId
	*/
	public function setModId($pModId) {
		$this->mModId = $pModId;
	}

	/**
	* @name getModNom()
	* @return varchar(50)
	* @desc Renvoie le membre ModNom de la MenuViewVO
	*/
	public function getModNom() {
		return $this->mModNom;
	}

	/**
	* @name setModNom($pModNom)
	* @param varchar(50)
	* @desc Remplace le membre ModNom de la MenuViewVO par $pModNom
	*/
	public function setModNom($pModNom) {
		$this->mModNom = $pModNom;
	}

	/**
	* @name getModLabel()
	* @return varchar(80)
	* @desc Renvoie le membre ModLabel de la MenuViewVO
	*/
	public function getModLabel() {
		return $this->mModLabel;
	}

	/**
	* @name setModLabel($pModLabel)
	* @param varchar(80)
	* @desc Remplace le membre ModLabel de la MenuViewVO par $pModLabel
	*/
	public function setModLabel($pModLabel) {
		$this->mModLabel = $pModLabel;
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