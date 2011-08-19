<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/09/2010
// Fichier : OperationAvenirViewVO.php
//
// Description : Classe OperationAvenirViewVO
//
//****************************************************************

/**
 * @name OperationAvenirViewVO
 * @author Julien PIERRE
 * @since 09/09/2010
 * @desc Classe représentant une OperationAvenirViewVO
 */
class OperationAvenirViewVO
{
	/**
	* @var datetime
	* @desc ComDateMarche de la OperationAvenirViewVO
	*/
	private $mComDateMarche;

	/**
	* @name getComDateMarche()
	* @return datetime
	* @desc Renvoie le membre ComDateMarche de la OperationAvenirViewVO
	*/
	public function getComDateMarche() {
		return $this->mComDateMarche;
	}

	/**
	* @name setComDateMarche($pComDateMarche)
	* @param datetime
	* @desc Remplace le membre ComDateMarche de la OperationAvenirViewVO par $pComDateMarche
	*/
	public function setComDateMarche($pComDateMarche) {
		$this->mComDateMarche = $pComDateMarche;
	}

}
?>