<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/09/2010
// Fichier : ListeAdherentViewVO.php
//
// Description : Classe ListeAdherentViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdherentViewVO
 * @author Julien PIERRE
 * @since 05/09/2010
 * @desc Classe représentant une ListeAdherentViewVO
 */
class ListeAdherentViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc AdhId de la ListeAdherentViewVO
	*/
	protected $mAdhId;
	
	/**
	* @var varchar(5)
	* @desc AdhNumero de la ListeAdherentViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var varchar(50)
	* @desc AdhNom de la ListeAdherentViewVO
	*/
	protected $mAdhNom;
	
	/**
	* @var varchar(50)
	* @desc AdhPrenom de la AdhPrenomViewVO
	*/
	protected $mAdhPrenom;
	
	/**
	* @var varchar(100)
	* @desc AdhCourrielPrincipal de la ListeAdherentViewVO
	*/
	protected $mAdhCourrielPrincipal;
	
	/**
	* @var decimal(32,2)
	* @desc OpeMontant de la ListeAdherentViewVO
	*/
	protected $mOpeMontant;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeAdherentViewVO
	*/
	public function getAdhId(){
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeAdherentViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}
	
	/**
	* @name getAdhNumero()
	* @return varchar(5)
	* @desc Renvoie le membre AdhNumero de la ListeAdherentViewVO
	*/
	public function getAdhNumero(){
		return $this->mAdhNumero;
	}

	/**
	* @name setId($pAdhNumero)
	* @param varchar(5)
	* @desc Remplace le membre AdhNumero de la ListeAdherentViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ListeAdherentViewVO
	*/
	public function getAdhNom(){
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ListeAdherentViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ListeAdherentViewVO
	*/
	public function getAdhPrenom(){
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ListeAdherentViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}
		
	/**
	* @name getAdhCourrielPrincipal()
	* @return  varchar(100)
	* @desc Renvoie le membre AdhCourrielPrincipal de la ListeAdherentViewVO
	*/
	public function getAdhCourrielPrincipal(){
		return $this->mAdhCourrielPrincipal;
	}

	/**
	* @name setAdhCourrielPrincipal($pAdhCourrielPrincipal)
	* @param  varchar(100)
	* @desc Remplace le membre AdhCourrielPrincipal de la ListeAdherentViewVO par $pAdhCourrielPrincipal
	*/
	public function setAdhCourrielPrincipal($pAdhCourrielPrincipal) {
		$this->mAdhCourrielPrincipal = $pAdhCourrielPrincipal;
	}
	
	/**
	* @name getOpeMontant()
	* @return decimal(32,2)
	* @desc Renvoie le membre OpeMontant de la ListeAdherentViewVO
	*/
	public function getOpeMontant(){
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(32,2)
	* @desc Remplace le membre OpeMontant de la ListeAdherentViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
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