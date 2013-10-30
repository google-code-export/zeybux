<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2011
// Fichier : AchatValid.php
//
// Description : Classe AchatValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "OperationValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR  . MOD_SERVICE . "/ProduitAchatValid.php");

/**
 * @name AchatValid
 * @author Julien PIERRE
 * @since 22/07/2011
 * @desc Classe représentant une AchatValid
 */
class AchatValid
{
	/**
	* @name estAchat($pAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estAchat($pAchat) {
		if(is_object($pAchat)) {
			return (get_class($pAchat) == "AchatVO");
		} else {
			return false;
		}
	}
	
	/**
	 * @name produits($pProduits)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function produits($pProduits) {		
		if(is_array($pProduits) && count($pProduits) > 0) {
			$lValid = true;
			$lProduitAchatValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\ProduitAchatValid();
			foreach($pProduits as $lProduit) {
				$lValid &= $lProduitAchatValid->produit($lProduit);
			}
			return $lValid;
		}
		return false;
	}

	/**
	 * @name input($pAchat)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function input($pAchat) {
		if($this->estAchat($pAchat)) {
			$lOperationAchat = $pAchat->getOperationAchat();
			$lOperationAchatSolidaire = $pAchat->getOperationAchatSolidaire();
			$lRechargement = $pAchat->getRechargement();
			
			$lOperationValid = new \OperationValid();	
			return (
						(
							( !is_null($lOperationAchat->getIdCompte()) && $lOperationValid->insert($pAchat->getOperationAchat()) ) 
							||
							( !is_null($lOperationAchatSolidaire->getIdCompte()) && $lOperationValid->insert($pAchat->getOperationAchatSolidaire()) ) 
						)
						&& 
						$this->produits($pAchat->getProduits())
					) 
					|| 
					( !is_null($lRechargement->getIdCompte()) && $lOperationValid->insert($pAchat->getRechargement()) );
		} else {
			return false;
		}
	}
	
	/**
	 * @name insert($pAchat)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function insert($pAchat) {
		$lOperationAchat = $pAchat->getOperationAchat()->getId();
		$lOperationAchatSolidaire = $pAchat->getOperationAchatSolidaire()->getId();
		$lOperationRechargement = $pAchat->getRechargement()->getId();
	
		return (is_null($lOperationAchat) || empty($lOperationAchat) )
		&& (is_null($lOperationAchatSolidaire) || empty($lOperationAchatSolidaire))
		&& (is_null($lOperationRechargement) || empty($lOperationRechargement));
	}
	
	/**
	 * @name update($pAchat)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function update($pAchat) {
		$lOperationAchat = $pAchat->getOperationAchat()->getId();
		$lOperationAchatSolidaire = $pAchat->getOperationAchatSolidaire()->getId();
		$lOperationRechargement = $pAchat->getRechargement()->getId();
	
		return (!is_null($lOperationAchat) || !empty($lOperationAchat) )
		|| (!is_null($lOperationAchatSolidaire) || !empty($lOperationAchatSolidaire))
		|| (!is_null($lOperationRechargement) || !empty($lOperationRechargement));
	}
	
	/**
	 * @name delete($pId)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function delete($pId) {
		$lOperationValid = new \OperationValid();
		return $lOperationValid->delete($pId);
	}

	/**
	* @name insert($pAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	/*public function insert($pAchat) {
		if($this->estAchat($pAchat)) {
			$lIdAchatValid = new IdAchatValid();
			$lIdValid = $lIdAchatValid->estAjout($pAchat->getId());
			if(!is_null($lIdValid) && $lIdValid) {
				if($this->detailAchat($pAchat->getDetailAchat())
					&& $this->detailAchatSolidaire($pAchat->getDetailAchatSolidaire())) {
					$lDetailValid = true;
					$lDetailReservation = $pAchat->getDetailAchat();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = $lDetailReservationValid->insert($lDetailReservation[$i]);
						$i++;
					}
					
					$lDetailReservation = $pAchat->getDetailAchatSolidaire();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = $lDetailReservationValid->insert($lDetailReservation[$i]);
						$i++;
					}					
					return $lDetailValid;				
				}
			}
		}
		return false;
	}*/
	
	/**
	* @name updateReservation($pAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	/*public function updateReservation($pAchat) {
		if($this->estAchat($pAchat)) {
			$lIdAchatValid = new IdAchatValid();
			$lIdValid = $lIdAchatValid->estReservation($pAchat->getId());
			if(!is_null($lIdValid) && $lIdValid) {
				if($this->detailAchat($pAchat->getDetailAchat())
					&& $this->detailAchatSolidaire($pAchat->getDetailAchatSolidaire())) {
					$lDetailValid = true;
					$lDetailReservation = $pAchat->getDetailAchat();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = ( $lDetailReservationValid->update($lDetailReservation[$i]) || $lDetailReservationValid->insert($lDetailReservation[$i]) );
						$i++;
					}
					
					$lDetailReservation = $pAchat->getDetailAchatSolidaire();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = ( $lDetailReservationValid->update($lDetailReservation[$i]) || $lDetailReservationValid->insert($lDetailReservation[$i]) );
						$i++;
					}					
					return $lDetailValid;				
				}
			}
		}
		return false;
	}
	
	/**
	* @name updateReservation($pAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	/*public function updateAchat($pAchat) {
		if($this->estAchat($pAchat)) {
			$lIdAchatValid = new IdAchatValid();
			$lIdValid = $lIdAchatValid->estAchat($pAchat->getId());
			if(!is_null($lIdValid) && $lIdValid) {
				if($this->detailAchat($pAchat->getDetailAchat())
					&& $this->detailAchatSolidaire($pAchat->getDetailAchatSolidaire())) {
					$lDetailValid = true;
					$lDetailReservation = $pAchat->getDetailAchat();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = ( $lDetailReservationValid->update($lDetailReservation[$i]) || $lDetailReservationValid->insert($lDetailReservation[$i]) );
						$i++;
					}
					
					$lDetailReservation = $pAchat->getDetailAchatSolidaire();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = ( $lDetailReservationValid->update($lDetailReservation[$i]) || $lDetailReservationValid->insert($lDetailReservation[$i]) );
						$i++;
					}					
					return $lDetailValid;				
				}
			}
		}
		return false;
	}
		
	/**
	* @name select($pIdAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function select($pIdAchat) {	
		$lIdValid = new IdValid();
		if(!empty($pIdAchat)){
			$lIdAchatValid = new IdAchatValid();
			return $lIdAchatValid->estSelect($pIdAchat);
		}
		return false;
	}
	
	/**
	* @name selectAll($pIdAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function selectAll($pIdAchat) {
		if(!empty($pIdAchat)){
			$lIdAchatValid = new IdAchatValid();
			return $lIdAchatValid->estAjout($pIdAchat);
		}
		return false;
	}
}
?>