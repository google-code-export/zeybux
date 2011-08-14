<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/10/2010
// Fichier : MenuResponse.php
//
// Description : Classe MenuResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name MenuResponse
 * @author Julien PIERRE
 * @since 28/10/2010
 * @desc Classe représentant une MenuResponse
 */
class MenuResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var MenuViewVO
	 * @desc Le Menu
	 */
	protected $mMenu;
	
	/**
	 * @var MenuViewVO
	 * @desc Si des modules de droit admin
	 */
	protected $mAdmin = false;
		
	/**
	* @name MenuResponse()
	* @desc Le constructeur de MenuResponse
	*/	
	public function MenuResponse() {
		$this->mValid = true;
		$this->mAdmin = false;
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
	* @name getMenu()
	* @return MenuViewVO
	* @desc Renvoie mMenu
	*/
	public function getMenu() {
		return $this->mMenu;
	}

	/**
	* @name setMenu($pMenu)
	* @param MenuViewVO
	* @desc Remplace mMenu de l'élément par $pMenu
	*/
	public function setMenu($pMenu) {
		$this->mMenu = $pMenu;
	}
	
	/**
	* @name getAdmin()
	* @return bool
	* @desc Renvoie mMenu
	*/
	public function getAdmin() {
		return $this->mAdmin;
	}

	/**
	* @name setAdmin($pAdmin)
	* @param bool
	* @desc Remplace mAdmin de l'élément par $pAdmin
	*/
	public function setAdmin($pAdmin) {
		$this->mAdmin = $pAdmin;
	}
}
?>