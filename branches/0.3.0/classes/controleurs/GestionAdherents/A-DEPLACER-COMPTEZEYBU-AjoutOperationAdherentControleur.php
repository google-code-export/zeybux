<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : AjoutOperationAdherentControleur.php
//
// Description : Script d'ajout d'Operation à un Adherent
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_VO . "OperationVO.php");
include_once(CHEMIN_CLASSES_PO . MOD_GESTION_ADHERENTS . "/AjoutOperationAdherentPO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");

/**
 * @name AjoutOperationAdherentControleur
 * @author Julien PIERRE
 * @since 01/02/2010
 * @desc Classe d'ajout d'Operation à un Adherent
 */
class AjoutOperationAdherentControleur
{
	/**
	 * @var AjoutOperationAdherentPO
	 * @desc La AjoutOperationAdherentPO du controleur
	 */
	private $mOperation;

	/**
	* @name getOperation()
	* @return AjoutOperationAdherentPO
	* @desc Renvoie l'Operation du controleur
	*/
	public function getOperation() {
		return $this->mOperation;
	}
	
	/**
	* @name setOperation($pOperation)
	* @param AjoutOperationAdherentPO
	* @desc Remplace l'Operation du controleur par $pOperation
	*/
	public function setOperation($pOperation) {
		$this->mOperation = $pOperation;
	}

	/**
	* @name ajouterOperation()
	* @param AjoutOperationAdherentPO
	* @desc Ajoute l'Operation du controleur dans la BDD si le format du montant est valide. Accepte le . ou la , comme délimitateur.
	*/
	public function ajouterOperation() {
		$lOperation = $this->getOperation()->getOperation();

		// Supression des espaces avant et après
		$lOperation->setMontant( trim($lOperation->getMontant()) );
		$lOperation->setLibelle( trim($lOperation->getLibelle()) );
		$lOperation->setDate( trim($lOperation->getDate()) );
		
		$lListeErreur = array( 	"ErreurChamps" => false,
								"ErreurFormatDate" => false,		
								"ErreurFormatMontant" => false,		
								"ErreurTailleMontant" => false,
								"ErreurSuperZeybu" => false);
				
	
		$lListeErreur['ErreurChamps'] = ($lOperation->getMontant() == '' || $lOperation->getLibelle() == '' || $lOperation->getDate() == '' );
		
		// Test du format de la date
		$lDateActuelle = date('d/m/Y');
		$lListeErreur['ErreurFormatDate'] = !(StringUtils::verifierDateFr( $lOperation->getDate() ) || StringUtils::dateEstPLusGrandeEgale($lDateActuelle,$lOperation->getDate()) );

		// Test du format du montant type BDD
		if( !StringUtils::verifierDecimalDb( $lOperation->getMontant() ) ) {
			// Test du format du montant si il est en Fr
			if( StringUtils::verifierDecimalFr( $lOperation->getMontant() ) ) {
				// Transformation du montant en format BDD
				$lOperation->setMontant( StringUtils::decimalFrToDb($lOperation->getMontant()) );
			} else {
				$lListeErreur['ErreurFormatMontant'] = true;
			}
		}
		
		// Test la taille du montant
		$lListeErreur['ErreurTailleMontant'] = !($lOperation->getMontant() <= 99999999.99);
	
		// Ne réalise l'ajout que si ce n'est pas un super zeybu
		$lAdherent = AdherentManager::select($lOperation->getIdAdherent());
		$lListeErreur['ErreurSuperZeybu'] = ($lAdherent->getSuperZeybu() != 0);
		
		// Test sur les erreurs
		if( array_search(true, $lListeErreur) === false ) {
			// Transformation de la date pour insertion
			$lOperation->setDate(StringUtils::dateFrToDb($lOperation->getDate()));
			
			// C'est une modification manuelle pas de commande
			$lOperation->setIdCommande(0);
			
			// Insertion de la nouvelle opération
			OperationManager::insert( $lOperation );
		}
		
		return $lListeErreur;
	}
}
?>
