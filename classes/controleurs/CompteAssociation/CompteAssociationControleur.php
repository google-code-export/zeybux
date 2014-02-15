<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/02/2014
// Fichier : CompteassociationControleur.php
//
// Description : Classe CompteassociationControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ASSOCIATION . "/InfoCompteResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ASSOCIATION . "/ListeOperationResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ASSOCIATION . "/InfoOperationResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php");
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "VirementService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMPTE_ASSOCIATION . "/CompteAssociationValid.php");
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_TOVO . "OperationDetailToVO.php" );
include_once(CHEMIN_CLASSES_SERVICE . "VirementService.php" );

/**
 * @name CompteassociationControleur
 * @author Julien PIERRE
 * @since 09/02/2014
 * @desc Classe controleur du compte association
 */
class CompteassociationControleur
{
	/**
	* @name getInfoCompte()
	* @desc Donne les infos sur le compte association
	*/
	public function getInfoCompte() {
		$lCompteService = new CompteService();
		return new InfoCompteResponse($lCompteService->get(-4)->getSolde());	
	}
	
	/**
	 * @name getRechercheOperation($pParam)
	 * @desc Donne les opérations sur le compte association
	 */
	public function getRechercheOperation($pParam) {
		$lVr = CompteAssociationValid::validRecherche($pParam);
		if($lVr->getValid()) {
			$lDateDebut = NULL;
			if(!empty($pParam['dateDebut'])) {
				$lDateDebut = $pParam['dateDebut'];
			}
			$lDateFin = NULL;
			if(!empty($pParam['dateFin'])) {
				$lDateFin = $pParam['dateFin'];
			}
			
			$lOperationService = new OperationService();
			return new ListeOperationResponse($lOperationService->rechercheOperationAssociation($lDateDebut, $lDateFin));
			
		}
		return $lVr;
	}

	/**
	 * @name exportOperation($pParam)
	 * @desc Donne les opérations sur le compte du zeybu
	 */
	public function exportOperation($pParam) {
		$lVr = CompteAssociationValid::validRecherche($pParam);
		if($lVr->getValid()) {
			$lDateDebut = NULL;
			if(!empty($pParam['dateDebut'])) {
				$lDateDebut = $pParam['dateDebut'];
			}
			$lDateFin = NULL;
			if(!empty($pParam['dateFin'])) {
				$lDateFin = $pParam['dateFin'];
			}
						
			$lCSV = new CSV();
			$lCSV->setNom('CompteAssociation.csv'); // Le Nom
			
			// L'entete
			$lEntete = array("Date","Compte", "Libelle", "Paiement", "N°", "Debit","","Credit","");
			$lCSV->setEntete($lEntete);
			
			// Les données
			$lOperationService = new OperationService();
			$lOperations = $lOperationService->rechercheOperationAssociation( $lDateDebut, $lDateFin);
			
			$lContenuTableau = array();
			
			foreach($lOperations as $lOperation) {
				$lDate = StringUtils::extractDate($lOperation->getOpeDate());
				
				$lPaiement = '';
				if(!is_null($lOperation->getTppType())) {
					$lPaiement = $lOperation->getTppType();
				}
				
				$lCheque = '';
				if(!is_null($lOperation->getNumeroCheque())) {
					$lCheque = $lOperation->getNumeroCheque();
				}
				
				$lDebit = '';
				$lCredit = '';
				if($lOperation->getOpeMontant() < 0) {
					$lDebit = $lOperation->getOpeMontant() * -1;
				} else {
					$lCredit = $lOperation->getOpeMontant();
				}
				
				$lLignecontenu = array(	
						$lDate,
						$lOperation->getCptLabel(),
						$lOperation->getOpeLibelle(),
						$lPaiement,
						$lCheque,
						$lDebit,
						SIGLE_MONETAIRE,
						$lCredit,
						SIGLE_MONETAIRE
				);
				
				array_push($lContenuTableau,$lLignecontenu);
			}
			$lCSV->setData($lContenuTableau);
				
			// Export en CSV
			$lCSV->output();
		} else {
			return $lVr;
		}
	}
	
	/**
	 * @name getInfoOperation($pParam)
	 * @return InfoOperationResponse
	 * @desc Retourne les infos pour l'ajout d'une opération
	 */
	public function getInfoOperation() {
		$lTypePaiementService = new TypePaiementService();
		$lBanqueService = new BanqueService();
		return new InfoOperationResponse($lTypePaiementService->selectVisible(),
					$lBanqueService->getAllActif());
	}
	
	/**
	 * @name ajoutOperation($pParam)
	 * @return OperationDetailVR
	 * @desc Ajoute une operation au compte association
	 */
	public function ajoutOperation($pParam) {
		$lVr = CompteAssociationValid::validAjoutOperation($pParam);
		if($lVr->getValid()) {
			$lOperationService = new OperationService();
			$lOperation = OperationDetailToVO::convertFromArray($pParam);
			$lOperation->setIdCompte(-4); // Le Compte Association
			$lOperationService->set($lOperation);
		}
		return $lVr;
	}
	
	/**
	 * @name ajoutVirement($pParam)
	 * @return CompteAssociationAjoutVirementVR
	 * @desc Ajoute un virement
	 */
	public function ajoutVirement($pParam) {
		$lVr = CompteAssociationValid::validAjoutVirement($pParam);
		if($lVr->getValid()) {
			$lVirement = new VirementVO(); // Le virement
			$lIdVirement = new IdVirementVO(); // Id du virement
			$lVirement->setId($lIdVirement);
			$lVirement->setCptDebit(-4); // Le compte association
			$lVirement->setCptCredit(-1); // Le compte Marché
			$lVirement->setMontant($pParam['montant']);
			$lVirement->setType(1); // Virement classique
				
			$lVirementService = new VirementService();
			$lVirementService->set($lVirement); // Enregistre le virement
		}
		return $lVr;
	}
}
?>