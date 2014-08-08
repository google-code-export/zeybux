<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2014
// Fichier : PaiementCaisseControleur.php
//
// Description : Classe PaiementCaisseControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE ."/CaisseListeCommandeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/ListePaiementResponse.php" );
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_CAISSE . "/MarcheValid.php");

/**
 * @name PaiementCaisseControleur
 * @author Julien PIERRE
 * @since 15/02/2014
 * @desc Classe controleur d'une PaiementCaisseControleur
 */
class PaiementCaisseControleur
{		
	/**
	* @name getListeMarche()
	* @return CaisseListeCommandeResponse
	* @desc Retourne la liste des marché en cours
	*/
	public function getListeMarche() {
		$lListeCommande = new CaisseListeCommandeResponse();
		$lMarcheService = new MarcheService();
		$lListeCommande->setListeCommande( $lMarcheService->selectCaisseListeMarche() );
		return $lListeCommande;
	}
	
	/**
	 * @name getListePaiement($pParam)
	 * @return InfoMarcheVR
	 * @desc Retourne la liste des adhérents qui ont réservé sur cette commande et les infos sur la commande.
	 */
	public function getListePaiement($pParam) {
		$lVr = MarcheValid::validGetMarche($pParam);
		if($lVr->getValid()) {
			$lIdMarche = $pParam["id"];
			
			$lOperationService = new OperationService();
			$lMarcheService = new MarcheService();
			
			$lResponse = new ListePaiementResponse();
			$lResponse->setListeCheque($lOperationService->getListeChequeCaisse($lIdMarche));
			$lResponse->setListeEspece($lOperationService->getListeEspeceCaisse($lIdMarche));
			$lResponse->setNumero($lMarcheService->getInfoMarche($lIdMarche)->getNumero());
	
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	 * @name getListePaiementExport($pParam)
	 * @return InfoMarcheVR
	 * @desc Retourne la liste des adhérents qui ont réservé sur cette commande et les infos sur la commande.
	 */
	public function getListePaiementExport($pParam) {
		$lVr = MarcheValid::validGetMarche($pParam);
		if($lVr->getValid()) {
			$lIdMarche = $pParam["id"];
			$lTypePaiement = $pParam["type"];
				
			
			$lCSV = new CSV();
			$lCSV->setNom('Caisse.csv'); // Le Nom
				
			// L'entete
			$lEntete = array("Date","N°","Compte","Nom","Prénom","Montant","");

			$lOperationService = new OperationService();
			if($lTypePaiement == 1) {
				$lOperations = $lOperationService->getListeEspeceCaisse($lIdMarche);
			} else {
				array_push($lEntete, "N°");
				$lOperations = $lOperationService->getListeChequeCaisse($lIdMarche);
			}
			
			$lCSV->setEntete($lEntete);
							
			// Les données
			$lContenuTableau = array();
			
			foreach($lOperations as $lOperation) {
				if(!is_null($lOperation->getCptLabel())) {
					$lDate = StringUtils::extractDate($lOperation->getOpeDate());
					if(is_null($lOperation->getAdhNumero())) {
						$lAdhNumero = '';
						$lAdhNom = '';
						$lAdhPrenom = '';
					} else {
						$lAdhNumero = $lOperation->getAdhNumero();
						$lAdhNom = $lOperation->getAdhNom();
						$lAdhPrenom = $lOperation->getAdhPrenom();					
					}
					
					$lLignecontenu = array(	
							$lDate,
							$lAdhNumero,
							$lOperation->getCptLabel(),
							$lAdhNom,
							$lAdhPrenom,
							$lOperation->getOpeMontant(),
							SIGLE_MONETAIRE
					);
					if($lTypePaiement == 2) {
						$lChampComplementaire = $lOperation->getOpeTypePaiementChampComplementaire();
						array_push($lLignecontenu, $lChampComplementaire[3]->getValeur());
					}
						
					array_push($lContenuTableau,$lLignecontenu);
				}
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