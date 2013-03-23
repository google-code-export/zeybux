<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : ModifierMonCompteControleur.php
//
// Description : Classe ModifierMonCompteControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_MON_COMPTE . "/InfoAdherentValid.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "MailingListeService.php");

/**
 * @name ModifierMonCompteControleur
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe controleur d'un compte
 */
class ModifierMonCompteControleur
{	
	/**
	* @name modifierPass($pParam)
	* @return VR
	* @desc Modification du mot de passe de l'adhérent.
	*/
	public function modifierPass($pParam) {		
		$lVr = InfoAdherentValid::validAjout($pParam);

		if($lVr->getValid()) {
			$lIdentification = IdentificationManager::selectByIdType($pParam['id_adherent'],1);
			$lIdentification = $lIdentification[0];
			$lIdentification->setPass( md5( $pParam['motPasseNouveau'] ) );
			IdentificationManager::update( $lIdentification );
		}
		return $lVr;
	}
	
	/**
	* @name modifierInformation($pParam)
	* @return VR
	* @desc Modification des informations de l'adhérent.
	*/
	public function modifierInformation($pParam) {		
		$lVr = InfoAdherentValid::validUpdateInformation($pParam);
		if($lVr->getValid()) {
			
			// Chargement de l'adherent
			$lAdherentActuel = AdherentManager::select( $pParam['id_adherent'] );

			//Mise à jour des inscriptions de mailing liste
			$lMailingListeService = new MailingListeService();
			if($lAdherentActuel->getCourrielPrincipal() != "") {
				$lMailingListeService->delete($lAdherentActuel->getCourrielPrincipal());	
			}
			if($lAdherentActuel->getCourrielSecondaire() != "") {
				$lMailingListeService->delete($lAdherentActuel->getCourrielSecondaire());			
			}
			if($pParam['courrielPrincipal'] != "") {
				$lMailingListeService->insert($pParam['courrielPrincipal']);	
			}
			if($pParam['courrielSecondaire'] != "") {
				$lMailingListeService->insert($pParam['courrielSecondaire']);			
			}
			
			$lAdherentActuel->setNom($pParam['nom']);
			$lAdherentActuel->setPrenom($pParam['prenom']);
			$lAdherentActuel->setCourrielPrincipal($pParam['courrielPrincipal']);
			$lAdherentActuel->setCourrielSecondaire($pParam['courrielSecondaire']);
			$lAdherentActuel->setTelephonePrincipal($pParam['telephonePrincipal']);
			$lAdherentActuel->setTelephoneSecondaire($pParam['telephoneSecondaire']);
			$lAdherentActuel->setAdresse($pParam['adresse']);
			$lAdherentActuel->setCodePostal($pParam['codePostal']);
			$lAdherentActuel->setVille($pParam['ville']);
			$lAdherentActuel->setDateNaissance($pParam['dateNaissance']);
			$lAdherentActuel->setCommentaire($pParam['commentaire']);
			
			// Insertion de la première mise à jour
			$lAdherentActuel->setDateMaj( StringUtils::dateTimeAujourdhuiDb() );
						
			// Maj de l'adherent dans la BDD
			AdherentManager::update( $lAdherentActuel );
		}	
		return $lVr;
	}
}
?>
