<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/07/2011
// Fichier : StockValid.php
//
// Description : Classe StockValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "MontantValid.php" );
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );

/**
 * @name StockValid
 * @author Julien PIERRE
 * @since 10/07/2011
 * @desc Classe représentant une StockValid
 */
class StockValid
{	
	/**
	* @name estStock($pStock)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estStock($pStock) {
		if(is_object($pStock)) {
			return (get_class($pStock) == "StockVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name id($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function id($pId) {
		$lIdValid = new IdValid();
		if(!empty($pId)){
			return $lIdValid->estId($pId);
		} else {
			return false;
		}
	}
	
	/**
	* @name date($pDate)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function date($pDate) {
		return TestFonction::checkDateTimeExist($pDate);
	}
	
	/**
	* @name quantite($pQuantite)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function quantite($pQuantite) {
		$lMontantValid = new MontantValid();
		return $lMontantValid->valeur($pQuantite);
	}
		
	/**
	* @name type($pType)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function type($pType) {
		$lIdValid = new IdValid();
		return $lIdValid->estId($pType);
	}
	
	/**
	* @name compte($pIdCompte)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function compte($pIdCompte) {
		$lCompteService = new CompteService();
		return $lCompteService->existe($pIdCompte);
	}
	
	/**
	* @name detailCommande($pDetailCommande)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function detailCommande($pDetailCommande) {
		$lIdValid = new IdValid();
		return $lIdValid->estId($pDetailCommande);
	}
	
	/**
	* @name insert($pStock)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pStock) {
		if($this->estStock($pStock)) {
			$lIdValid = new IdValid();
			$lId = $pStock->getId();
			return $lIdValid->estId($lId)
				&& empty($lId)
				&& $this->quantite($pStock->getQuantite())
				&& $this->type($pStock->getType())
				&& $this->compte($pStock->getIdCompte())
				&& $this->detailCommande($pStock->getIdDetailCommande());
				
		} else {
			return false;
		}
	}
	
	/**
	* @name update($pStock)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function update($pStock) {
		if($this->estStock($pStock)) {
			return $this->id($pStock->getId())
				&& $this->quantite($pStock->getQuantite())
				&& $this->type($pStock->getType())
				&& $this->compte($pStock->getIdCompte())
				&& $this->detailCommande($pStock->getIdDetailCommande());
		} else {
			return false;
		}
	}
	
	/**
	* @name delete($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function delete($pId) {
		return $this->id($pId);
	}
}
?>