<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/08/2010
// Fichier : VRerreur.php
//
// Description : À REMPLIR
//
//****************************************************************

/**
 * @name VRerreur
 * @author Julien PIERRE
 * @since 04/08/2010
 * @desc Classe représentant un VRerreur
 */
class VRerreur
{
	/**
	 * @var integer
	 * @desc Le code erreur
	 */
	protected $mCode = '';
	
	/**
	 * @var string
	 * @desc Le message d'erreur
	 */
	protected $mMessage = '';
	
	/**
	* @name getCode()
	* @return integer
	* @desc Renvoie le code erreur
	*/
	public function getCode() {
		return $this->mCode;
	}
	
	/**
	* @name setCode($pCode)
	* @param integer
	* @desc Remplace le code erreur par $pCode
	*/
	public function setCode($pCode) {
		$this->mCode = $pCode;
	}
	
	/**
	* @name getMessage()
	* @return string
	* @desc Renvoie le message d'erreur
	*/
	public function getMessage() {
		return $this->mMessage;
	}
	
	/**
	* @name setMessage($pMessage)
	* @param string
	* @desc Remplace le message d'erreur par $pMessage
	*/
	public function setMessage($pMessage) {
		$this->mMessage = $pMessage;
	}
	
	/**
	* @name export()
	* @return json
	* @desc Retourne la valeur des membres en les renommant au format tableau
	*/
	public function export() {
		$lMembresJs['code'] = $this->mCode;
		$lMembresJs['message'] = $this->mMessage;
		return $lMembresJs;
	}
}
?>