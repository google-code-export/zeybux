<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/06/2010
// Fichier : AutorisationVO.php
//
// Description : Classe AutorisationVO
//
//****************************************************************

/**
 * @name AutorisationVO
 * @author Julien PIERRE
 * @since 10/06/2010
 * @desc Classe représentant une AutorisationVO
 */
class AutorisationVO
{
	/**
	* @var int(11)
	* @desc Id de la AutorisationVO
	*/
	private $mId;

	/**
	* @var int(11)
	* @desc IdAdherent de la AutorisationVO
	*/
	private $mIdAdherent;

	/**
	* @var int(11)
	* @desc IdModule de la AutorisationVO
	*/
	private $mIdModule;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la AutorisationVO
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AutorisationVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdAdherent()
	* @return int(11)
	* @desc Renvoie le membre IdAdherent de la AutorisationVO
	*/
	public function getIdAdherent(){
		return $this->mIdAdherent;
	}

	/**
	* @name setIdAdherent($pIdAdherent)
	* @param int(11)
	* @desc Remplace le membre IdAdherent de la AutorisationVO par $pIdAdherent
	*/
	public function setIdAdherent($pIdAdherent) {
		$this->mIdAdherent = $pIdAdherent;
	}

	/**
	* @name getIdModule()
	* @return int(11)
	* @desc Renvoie le membre IdModule de la AutorisationVO
	*/
	public function getIdModule(){
		return $this->mIdModule;
	}

	/**
	* @name setIdModule($pIdModule)
	* @param int(11)
	* @desc Remplace le membre IdModule de la AutorisationVO par $pIdModule
	*/
	public function setIdModule($pIdModule) {
		$this->mIdModule = $pIdModule;
	}

}
?>