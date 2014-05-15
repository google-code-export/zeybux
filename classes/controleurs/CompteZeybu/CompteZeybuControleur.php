<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : CompteZeybuControleur.php
//
// Description : Classe CompteZeybuControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ZEYBU . "/InfoCompteZeybuResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ZEYBU . "/ListeOperationResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMPTE_ZEYBU . "/CompteZeybuValid.php");
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");

/**
 * @name CompteZeybuControleur
 * @author Julien PIERRE
 * @since 24/12/2010
 * @desc Classe controleur du compte zeybu
 */
class CompteZeybuControleur
{
	/**
	* @name getInfoCompte()
	* @desc Donne les infos sur le compte du zeybu
	*/
	public function getInfoCompte() {
		$lCompteService = new CompteService();
		$lOperationService = new OperationService();
		$lMarcheService = new MarcheService();
		
		$lSoldeSolidaire = $lCompteService->get(-2)->getSolde();
		$lSoldeTotal = $lCompteService->get(-1)->getSolde();
		$lSoldeCaisse = $lOperationService->getSoldeCaisse();
		$lSoldeBanque = $lOperationService->getSoldeBanque();

		return new InfoCompteZeybuResponse(
				$lSoldeTotal,
				$lSoldeSolidaire,
				$lSoldeCaisse,
				$lSoldeBanque,
				$lMarcheService->get());	
	}
	
	/**
	 * @name getRechercheOperation($pParam)
	 * @desc Donne les opérations sur le compte du zeybu
	 */
	public function getRechercheOperation($pParam) {
		$lVr = CompteZeybuValid::validRecherche($pParam);
		if($lVr->getValid()) {
			$lDateDebut = NULL;
			if(!empty($pParam['dateDebut'])) {
				$lDateDebut = $pParam['dateDebut'];
			}
			$lDateFin = NULL;
			if(!empty($pParam['dateFin'])) {
				$lDateFin = $pParam['dateFin'];
			}
			$lIdMarche = NULL;
			if(!empty($pParam['idMarche'])) {
				$lIdMarche = $pParam['idMarche'];
			}
			
			$lOperationService = new OperationService();
			return new ListeOperationResponse($lOperationService->rechercheOperationZeybu($lDateDebut, $lDateFin, $lIdMarche));
			
		}
		return $lVr;
	}

	/**
	 * @name exportOperation($pParam)
	 * @desc Donne les opérations sur le compte du zeybu
	 */
	public function exportOperation($pParam) {
		$lVr = CompteZeybuValid::validRecherche($pParam);
		if($lVr->getValid()) {
			$lDateDebut = NULL;
			if(!empty($pParam['dateDebut'])) {
				$lDateDebut = $pParam['dateDebut'];
			}
			$lDateFin = NULL;
			if(!empty($pParam['dateFin'])) {
				$lDateFin = $pParam['dateFin'];
			}
			$lIdMarche = NULL;
			if(!empty($pParam['idMarche'])) {
				$lIdMarche = $pParam['idMarche'];
			}
						
			$lCSV = new CSV();
			$lCSV->setNom('CompteMarche.csv'); // Le Nom
			
			// L'entete
			$lEntete = array("Date","Compte", "Libelle", "Paiement", "N°", "Debit","","Credit","");
			$lCSV->setEntete($lEntete);
			
			// Les données
			$lOperationService = new OperationService();
			$lOperations = $lOperationService->rechercheOperationZeybu($lDateDebut, $lDateFin, $lIdMarche);
			
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
}
?>