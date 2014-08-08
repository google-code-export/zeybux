<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/06/2014
// Fichier : RemiseChequeControleur.php
//
// Description : Classe RemiseChequeControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMPTE_ASSOCIATION . "/RemiseChequeValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMPTE_ASSOCIATION . "/OperationRemiseChequeValid.php");
include_once(CHEMIN_CLASSES_TOVO . "RemiseChequeDetailToVO.php");
include_once(CHEMIN_CLASSES_TOVO . "OperationRemiseChequeToVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "RemiseChequeService.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ASSOCIATION . "/RemiseChequeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ASSOCIATION . "/ListeRemiseChequeResponse.php" );

/**
 * @name RemiseChequeControleur
 * @author Julien PIERRE
 * @since 22/06/2014
 * @desc Classe controleur de remise de cheque
 */
class RemiseChequeControleur
{
	/**
	* @name ajoutRemiseCheque($pParam)
	* @desc Ajoute une remise de cheque
	*/
	public function ajoutRemiseCheque($pParam) {
		$lVr = RemiseChequeValid::validAjout($pParam);
		if($lVr->getValid()) {
			// Récupération de l'objet
			$lRemiseCheque = RemiseChequeDetailToVO::convertFromArray($pParam);
			
			// Positionne le compte
			$lRemiseCheque->setIdCompte(-4);
			
			// enregistrement
			$lRemiseChequeService = new RemiseChequeService();
			$lRemiseCheque->setId($lRemiseChequeService->set($lRemiseCheque));
			
			return new RemiseChequeResponse($lRemiseCheque);
		}
		return $lVr;	
	}
	
	/**
	 * @name getListeRemiseChequeActive()
	 * @desc Retrourne la liste des remises de chèques actives
	 */
	public function getListeRemiseChequeActive() {			
		// Retrourne la liste des remises de chèques actives
		$lRemiseChequeService = new RemiseChequeService();			
		return new ListeRemiseChequeResponse($lRemiseChequeService->getByCompte(-4,0));
	}
	
	/**
	 * @name ajoutOperationsRemiseCheque($pParam)
	 * @desc Ajoute des opérations à la remise de chèque
	 */
	public function ajoutOperationsRemiseCheque($pParam) {
		$lVr = RemiseChequeValid::validAjoutOperation($pParam);
		if($lVr->getValid()) {
			// Récupération de l'objet
			$lRemiseCheque = RemiseChequeDetailToVO::convertFromArray($pParam);
						
			// enregistrement
			$lRemiseChequeService = new RemiseChequeService();
			$lRemiseChequeService->ajoutOperation($lRemiseCheque);
			
			return new RemiseChequeResponse($lRemiseCheque);
		}
		return $lVr;	
	}
	
	/**
	 * @name supprimerOperation($pParam)
	 * @desc Supprime une opération à la remise de chèque
	 */
	public function supprimerOperation($pParam) {
		$lVr = OperationRemiseChequeValid::validDelete($pParam);
		if($lVr->getValid()) {
			// Récupération de l'objet
			$lOperationRemiseCheque = OperationRemiseChequeToVO::convertFromArray($pParam);
	
			// Suppression
			$lRemiseChequeService = new RemiseChequeService();
			$lRemiseChequeService->deleteOperation($lOperationRemiseCheque);
		}
		return $lVr;
	}
	
	/**
	 * @name getListeRemiseChequeEncaissee()
	 * @desc Retrourne la liste des remises de chèques encaissées
	 */
	public function getListeRemiseChequeEncaissee() {
		// Retrourne la liste des remises de chèques actives
		$lRemiseChequeService = new RemiseChequeService();
		return new ListeRemiseChequeResponse($lRemiseChequeService->getByCompte(-4,1));
	}
	
	/**
	 * @name getDetailRemiseCheque($pParam)
	 * @desc Retourne une remise de chèque
	 */
	public function getDetailRemiseCheque($pParam) {
		$lVr = RemiseChequeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lRemiseChequeService = new RemiseChequeService();			
			return new RemiseChequeResponse($lRemiseChequeService->getDetail($pParam['id']));
		}
		return $lVr;	
	}
	
	/**
	 * @name exportPDF($pParam)
	 * @desc Retourne une remise de chèque en PDF
	 */
	public function exportPDF($pParam) {
		$lVr = RemiseChequeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lRemiseChequeService = new RemiseChequeService();			
			$lRemiseChequeService->getPdf($pParam['id']);
		}
		return $lVr;	
	}
	
	/**
	 * @name encaisser($pParam)
	 * @desc Valide les opérations d'une remise de chèque
	 */
	public function encaisser($pParam) {
		$lVr = RemiseChequeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lRemiseChequeService = new RemiseChequeService();			
			$lRemiseChequeService->encaisser($pParam['id']);
		}
		return $lVr;	
	}
	
	/**
	 * @name supprimerRemise($pParam)
	 * @desc Supprime la remise de chèque
	 */
	public function supprimerRemise($pParam) {
		$lVr = RemiseChequeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lRemiseChequeService = new RemiseChequeService();			
			$lRemiseChequeService->delete($pParam['id']);
		}
		return $lVr;	
	}
}
?>