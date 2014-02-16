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
	* @name idOperation($pIdOperation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function idOperation($pIdOperation) {
		$lIdValid = new IdValid();
		return $lIdValid->estId($pIdOperation);
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
				&& $this->detailCommande($pStock->getIdDetailCommande())
				&& $this->idOperation($pStock->getIdOperation());
				
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
				&& $this->detailCommande($pStock->getIdDetailCommande())
				&& $this->idOperation($pStock->getIdOperation());
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
	
	/** Solidaire **/
	/**
	* @name inputSolidaire($pStockSolidaire)
	* @return bool
	* @desc Test la validite de l'élément
	*/
/*	public function inputSolidaire($pStockSolidaire) {
		if(is_object($pStockSolidaire)) {
			$lInput = true;
			$lInput &= get_class($pStockSolidaire) == "StockSolidaireVO";
			$lIdValid = new IdValid();
			if($pStockSolidaire->getId() != "") {
				$lInput &= $lIdValid->estId($pStockSolidaire->getId());
			}
			$lInput &= $lIdValid->estId($pStockSolidaire->getIdNomProduit());					
			$lInput &= TestFonction::checkLength($pStockSolidaire->getQuantite(),0,12);
			$lInput &= is_float((float)$pStockSolidaire->getQuantite());			
			$lInput &= TestFonction::checkLength($pStockSolidaire->getUnite(),0,20);
			return $lInput;
		} else {
			return false;
		}
	}*/
	
	/**
	* @name insertSolidaire($pStock)
	* @return bool
	* @desc Test la validite de l'élément
	*/
/*	public function insertSolidaire($pStock) {
		$lId = $pStock->getId();
		return empty($lId);
	}*/
	
	/**
	* @name updateSolidaire($pStock)
	* @return bool
	* @desc Test la validite de l'élément
	*/
/*	public function updateSolidaire($pStock) {
		$lId = $pStock->getId();
		return !empty($lId);
	}*/
	
	/**
	* @name deleteSolidaire($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
/*	public function deleteSolidaire($pId) {
		$lIdValid = new IdValid();
		if($pId != "") {
			return $lIdValid->estId($pId);
		}
		return false;
	}*/
	
	/* Stockquantite */
	
	/**
	 * @name inputStockQuantite($pStockQuantite)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function inputStockQuantite($pStockQuantite) {
		if(is_object($pStockQuantite)) {
			$lInput = true;
			$lInput &= get_class($pStockQuantite) == "StockQuantiteVO";
			$lIdValid = new IdValid();
			if($pStockQuantite->getId() != "") {
				$lInput &= $lIdValid->estId($pStockQuantite->getId());
			}
			if($pStockQuantite->getIdNomProduit() != "") {
				$lInput &= $lIdValid->estId($pStockQuantite->getIdNomProduit());	
			}
			$lInput &= TestFonction::checkLength($pStockQuantite->getQuantite(),0,12);
			$lInput &= is_float((float)$pStockQuantite->getQuantite());
			$lInput &= TestFonction::checkLength($pStockQuantite->getQuantiteSolidaire(),0,12);
			$lInput &= is_float((float)$pStockQuantite->getQuantiteSolidaire());
			$lInput &= TestFonction::checkLength($pStockQuantite->getUnite(),0,20);
			return $lInput;
		} else {
			return false;
		}
	}
	
	/**
	 * @name insertStockQuantite($pStockQuantite)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function insertStockQuantite($pStockQuantite) {
		$lId = $pStockQuantite->getId();
		$lIdNomProduit = $pStockQuantite->getIdNomProduit();
		return empty($lId) && !empty($lIdNomProduit);
	}
	
	/**
	 * @name updateStockQuantite($pStockQuantite)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function updateStockQuantite($pStockQuantite) {
		$lId = $pStockQuantite->getId();
		return !empty($lId);
	}
	
	/**
	 * @name deleteStockQuantite($pId)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function deleteStockQuantite($pId) {
		$lIdValid = new IdValid();
		if($pId != "") {
			return $lIdValid->estId($pId);
		}
		return false;
	}
}
?>