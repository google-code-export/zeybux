<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/05/2014
// Fichier : RemiseChequeService.php
//
// Description : Classe RemiseChequeService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "/RemiseChequeDetailVO.php");
include_once(CHEMIN_CLASSES_VO . "/OperationRemiseChequeVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "/RemiseChequeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "/OperationRemiseChequeManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "/InformationBancaireService.php");
include_once(CHEMIN_CLASSES_SERVICE . "/OperationService.php");
require_once(CHEMIN_CLASSES_PDF . 'html2pdf.class.php');

/**
 * @name RemiseChequeService
 * @author Julien PIERRE
 * @since 04/05/2014
 * @desc Classe Service de Remise de cheque
 */
class RemiseChequeService
{	
	/**
	 * @name set($pRemiseChequeDetail)
	 * @param RemiseChequeDetailVO
	 * @return integer
	 * @desc Ajoute une Remise de chèque
	 */
	public function set($pRemiseChequeDetail) {
		return $this->insert($pRemiseChequeDetail);
	}
	
	/**
	 * @name insert($pRemiseChequeDetail)
	 * @param RemiseChequeDetailVO
	 * @return integer
	 * @desc Ajoute une Remise de chèque
	 */
	private function insert($pRemiseChequeDetail) {	
		// Création de la remise de chèque
		$lIdRemiseChequeDetail = RemiseChequeManager::insert($pRemiseChequeDetail);
						
		// Ajout de l'ID remise de cheque pour le lien avec les operations
		$lOperations = array();
		foreach($pRemiseChequeDetail->getOperations() as $lOperation) {
			array_push($lOperations, new OperationRemiseChequeVO($lIdRemiseChequeDetail, $lOperation->getId()));
		}
		// Enregistrement des operations
		OperationRemiseChequeManager::insert($lOperations);
		
		// Maj de l'Id
		$pRemiseChequeDetail->setId($lIdRemiseChequeDetail);
		// Ajout du numéro
		$pRemiseChequeDetail->setNumero($lIdRemiseChequeDetail);
		// Calcul du montant
		$pRemiseChequeDetail->setMontant(OperationRemiseChequeManager::calculMontantRemiseCheque($lIdRemiseChequeDetail));
		
		// Enregistrement du montant et du numéro
		RemiseChequeManager::update($pRemiseChequeDetail);

		return $lIdRemiseChequeDetail;
	}
	
	/**
	 * @name delete($pIdRemiseCheque)
	 * @param integer
	 * @desc Supprime une remise de cheque
	 */
	public function delete($pIdRemiseCheque) {
		// Suppression des liens avec les operations
		OperationRemiseChequeManager::deleteByIdRemiseCheque($pIdRemiseCheque);
		// La remise
		$lRemise = $this->get($pIdRemiseCheque);
		// Maj de l'état à supprimé
		$lRemise->setEtat(2);
		// Enregistrement
		RemiseChequeManager::update($lRemise);
	}
	
	/**
	 * @name get($pIdRemiseCheque)
	 * @param integer
	 * @return RemiseChequeVO
	 * @desc Retourne une Remise de Cheque
	 */
	public function get($pIdRemiseCheque) {
		return $this->select($pIdRemiseCheque);
	}
	
	/**
	 * @name select($pIdRemiseCheque)
	 * @param integer
	 * @return RemiseChequeVO
	 * @desc Retourne une Remise de Cheque
	 */
	private function select($pIdRemiseCheque) {
		return RemiseChequeManager::select($pIdRemiseCheque);
	}

	/**
	 * @name getDetail($pIdRemiseCheque)
	 * @param integer
	 * @return RemiseChequeVO
	 * @desc Retourne une Remise de Cheque
	 */
	public function getDetail($pIdRemiseCheque) {
		return $this->selectDetail($pIdRemiseCheque);
	}
	
	/**
	 * @name selectDetail($pIdRemiseCheque)
	 * @param integer
	 * @return RemiseChequeDetailVO
	 * @desc Retourne une Remise de Cheque
	 */
	private function selectDetail($pIdRemiseCheque) {
		$lRemiseChequeDetail = new RemiseChequeDetailVO();
		$lRemiseCheque = $this->select($pIdRemiseCheque);
		
		$lRemiseChequeDetail->setId($lRemiseCheque->getId());
		$lRemiseChequeDetail->setNumero($lRemiseCheque->getNumero());
		$lRemiseChequeDetail->setIdCompte($lRemiseCheque->getIdCompte());
		$lRemiseChequeDetail->setMontant($lRemiseCheque->getMontant());
		$lRemiseChequeDetail->setDateCreation($lRemiseCheque->getDateCreation());
		$lRemiseChequeDetail->setDateModification($lRemiseCheque->getDateModification());
		$lRemiseChequeDetail->setEtat($lRemiseCheque->getEtat());
		$lRemiseChequeDetail->setOperations(OperationRemiseChequeManager::selectOperationPresentation($pIdRemiseCheque));
		
		return $lRemiseChequeDetail;
	}
	
	/**
	 * @name ajoutOperation($pRemiseChequeDetail)
	 * @param RemiseChequeDetailVO
	 * @desc Ajoute des operations à une remise de cheque une Remise de Cheque
	 */
	public function ajoutOperation($pRemiseChequeDetail) {		
		$lOperations = array();
		foreach($pRemiseChequeDetail->getOperations() as $lOperation) {
			array_push($lOperations, new OperationRemiseChequeVO($pRemiseChequeDetail->getId(), $lOperation->getId()));
		}
		
		$lRetour = OperationRemiseChequeManager::insert($lOperations);
		
		// Calcul du nouveau montant
		$lIdRemiseChequeDetail = $pRemiseChequeDetail->getId();
		$lRemiseChequeDetail = $this->get($lIdRemiseChequeDetail);
		$lRemiseChequeDetail->setMontant(OperationRemiseChequeManager::calculMontantRemiseCheque($lIdRemiseChequeDetail));
		
		// Enregistrement du montant
		RemiseChequeManager::update($lRemiseChequeDetail);
		
		return $lRetour;
	}
	
	/**
	 * @name getByCompte($pIdCompte, $pEtat)
	 * @param integer
	 * @param integer
	 * @return array(RemiseChequeVO)
	 * @desc Retourne un tableau de RemiseChequeVO qui sont sur l'état et le compte
	 */
	public function getByCompte($pIdCompte, $pEtat) {
		if($pEtat == 0) {
			return RemiseChequeManager::recherche(
					array(RemiseChequeManager::CHAMP_REMISECHEQUE_ID_COMPTE, RemiseChequeManager::CHAMP_REMISECHEQUE_ETAT),
					array('=', '='),
					array($pIdCompte, $pEtat),
					array(RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_CREATION),
					array('ASC'));
		} else {
			return RemiseChequeManager::recherche(
					array(RemiseChequeManager::CHAMP_REMISECHEQUE_ID_COMPTE, RemiseChequeManager::CHAMP_REMISECHEQUE_ETAT, RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_CREATION ),
					array('=', '=', '>'),
					array($pIdCompte, $pEtat, " DATE_SUB(now(), INTERVAL 1 YEAR) "),
					array(RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_CREATION),
					array('ASC'));
		}
	}
	
	/**
	 * @name getOperation($pIdRemiseCheque)
	 * @param integer
	 * @return array(OperationRemiseChequePresentationVO)
	 * @desc Récupère la liste des opérations liées à une remise de chèque
	 */
	public function getOperation($pIdRemiseCheque) {
		return OperationRemiseChequeManager::selectOperationPresentation($pIdRemiseCheque);
	}

	/**
	 * @name getPdf($pIdRemiseCheque)
	 * @param integer
	 * @return PDF
	 * @desc Génère la remise de chèque au format PDF
	 */
	public function getPdf($pIdRemiseCheque) {
		// Les infos de la remise
		$lRemise = $this->get($pIdRemiseCheque);
				
		// Les operations formatées pour l'export
		$lOperations = OperationRemiseChequeManager::selectOperationExport($pIdRemiseCheque);
		
		// Les informations bancaire
		$lInformationBancaireService = new InformationBancaireService();
		$lInfoBancaire = $lInformationBancaireService->getByIdCompte($lRemise->getIdCompte());
		
		// Les pages
		// get the HTML
		ob_start();
		// Le PDF
		include(CHEMIN_TEMPLATE . '/PDF/RemiseCheque.php');
		$content = ob_get_clean();
			
		// convert to PDF
		try {
			$html2pdf = new HTML2PDF('P', 'A4', 'fr');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->writeHTML($content, 0);
			$html2pdf->Output('RemiseCheque.pdf','D');
		}
		catch(HTML2PDF_exception $e) {
			// Initialisation du Logger
			$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
			$lLogger->setMask(Log::MAX(LOG_LEVEL));
			$lLogger->log("Erreur de génération du PDF de Réservation : " . $e,PEAR_LOG_DEBUG); // Maj des logs
		}
		
	}
	
	
	/**
	 * @name encaisser($pIdRemiseCheque)
	 * @param integer
	 * @desc Valide les opérations
	 */
	public function encaisser($pIdRemiseCheque) {
		// Les infos de la remise
		$lRemise = $this->getDetail($pIdRemiseCheque);
		
		$lIdOperations = array();
		foreach($lRemise->getOperations() as $lOperation) {
			// récupération des Id Operations
			array_push($lIdOperations, $lOperation->getIdOperation());
		}
		
		$lOperationService = new OperationService();
		$lOperationService->validerPaiementByArray($lIdOperations); // Valide les opérations
		
		// Valide la remise
		$lRemise->setEtat(1);
		RemiseChequeManager::update($lRemise);		
	}

	/**
	 * @name existe($pIdRemiseCheque)
	 * @param integer
	 * @return bool
	 * @desc Retourne si la remise existe
	 */
	public function existe($pIdRemiseCheque) {
		// Les infos de la remise
		$lRemise = $this->get($pIdRemiseCheque);
		// Test si la remise existe		
		return $lRemise->getId() == $pIdRemiseCheque;
	}
	
	/**
	 * @name lienOperationRemiseExiste($pIdRemiseCheque, $pIdOperation)
	 * @param integer
	 * @param integer
	 * @return bool
	 * @desc Retourne si le lien entre l'operation et la remise existe
	 */
	public function lienOperationRemiseExiste($pIdRemiseCheque, $pIdOperation) {
		// Recherche le lien
		$lOperationsRemise = OperationRemiseChequeManager::recherche(
				array(OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE, OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION, OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT),
				array('=','=','='),
				array($pIdRemiseCheque, $pIdOperation,0),
				array(''),
				array(''));
		
		// Test si le lien existe 
		return $lOperationsRemise[0]->getIdOperation() == $pIdOperation;
	}

	/**
	 * @name deleteOperation($pOperationRemiseCheque)
	 * @param integer
	 * @desc Supprime le lien entre l'operation et la remise
	 */
	public function deleteOperation($pOperationRemiseCheque) {
		// Récupère le lien
		$lOperationsRemise = OperationRemiseChequeManager::recherche(
				array(OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_REMISE_CHEQUE, OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION, OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT),
				array('=','=','='),
				array($pOperationRemiseCheque->getIdRemiseCheque(), $pOperationRemiseCheque->getIdOperation(),0),
				array(''),
				array(''));
		
		$lOperation = $lOperationsRemise[0];
		
		// Maj de l'état
		$lOperation->setEtat(1);
		// Enregistrement
		OperationRemiseChequeManager::update($lOperation);
		
		// Calcul du nouveau montant
		$lIdRemiseChequeDetail = $pOperationRemiseCheque->getIdRemiseCheque();
		$lRemiseChequeDetail = $this->get($lIdRemiseChequeDetail);
		$lRemiseChequeDetail->setMontant(OperationRemiseChequeManager::calculMontantRemiseCheque($lIdRemiseChequeDetail));
		// Enregistrement du montant
		RemiseChequeManager::update($lRemiseChequeDetail);
	}
	
	/**
	 * @name operationDejaSurRemise($pIdOperation)
	 * @param array()
	 * @return bool
	 * @desc Vérifie si l'une des operations n'est pas déjà sur une remise
	 */
	public function operationDejaSurRemise($pIdOperation) {
		// Récupère le lien
		$lOperationsRemise = OperationRemiseChequeManager::recherche(
				array(OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ID_OPERATION, OperationRemiseChequeManager::CHAMP_OPERATIONREMISECHEQUE_ETAT),
				array('in','='),
				array($pIdOperation,0),
				array(''),
				array(''));
		
		$lIdOperation = $lOperationsRemise[0]->getIdOperation();
		
		return count($lOperationsRemise) > 1 || !empty($lIdOperation);
	}
}
?>