<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/08/2010
// Fichier : VRelement.php
//
// Description : À REMPLIR
//
//****************************************************************

/**
 * @name VRelement
 * @author Julien PIERRE
 * @since 04/08/2010
 * @desc Classe représentant un VRelement
 */
class VRelement
{
	/**
	 * @var bool
	 * @desc Donne la validite de l'élément
	 */
	protected $mValid = true;
	
	/**
	 * @var array(VRerreur)
	 * @desc Liste des erreurs 
	 */
	protected $mErreurs = array();
	
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
	* @name getErreurs()
	* @return array(VRerreur)
	* @desc Renvoie la liste des erreurs 
	*/
	public function getErreurs() {
		return $this->mErreurs;
	}
	
	/**
	* @name setErreurs($pErreurs)
	* @param array(VRerreur)
	* @desc Remplace la liste des erreurs par $pErreurs
	*/
	public function setErreurs($pErreurs) {
		$this->mErreurs = $pErreurs;
	}
	
	/**
	* @name addErreur($pErreur)
	* @param VRerreur
	* @desc Ajoute $pErreur à la liste des erreurs
	*/
	public function addErreur($pErreur) {
		array_push($this->mErreurs,$pErreur);
	}
	
	/**
	* @name export()
	* @return json
	* @desc Retourne la valeur des membres en les renommant au format tableau
	*/
	public function export() {
		$lMembresJs['valid'] = $this->mValid;
		$lMembresJs['erreurs'] = array();
		foreach($this->mErreurs as $lErreur){
			array_push($lMembresJs['erreurs'],$lErreur->export());
		}		
		return $lMembresJs;
	}
	
	/**
	* @name exportToArray()
	* @return array
	* @desc Retourne la valeur des membres en les renommant au format tableau
	*/
	public function exportToArray() {
		$lMembresJs['valid'] = $this->mValid;
		$lMembresJs['erreurs'] = array();
		foreach($this->mErreurs as $lErreur){
			array_push($lMembresJs['erreurs'],$lErreur->export());
		}		
		return $lMembresJs;
	}
}
?>