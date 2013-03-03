<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/03/2012/2011
// Fichier : ReservationMarcheVue.php
//
// Description : Retourne les détails d'une réservation
//
//****************************************************************
						
// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_GET['fonction'])) {	
			
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/ReservationMarcheControleur.php");					
		$lControleur = new ReservationMarcheControleur();
		
		// Inclusion des classes
		include_once(CHEMIN_CLASSES_UTILS . "Template.php");
		include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
		include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php");
		include_once(CHEMIN_CLASSES_UTILS . "InfobullesUtils.php");
		
		// Constante de titre de la page
		define("TITRE", ZEYBUX_TITRE_DEBUT . "Marche - " . ZEYBUX_TITRE_FIN);
		switch($_GET["fonction"]) {
			case "afficher":
				if(isset($_GET["id_marche"])) {
					$lParam = array("id_commande" => $_GET["id_marche"]);
					$lPage = $lControleur->getReservation($lParam);
					
					if( count($lPage->getReservation()) == 0) {// Pas de réservation
						if(TestFonction::dateTimeEstPLusGrandeEgale($lPage->getMarche()->getDateFinReservation(),StringUtils::dateTimeAujourdhuiDb())) { // Les réservations sont toujours possibles
							header('location:./index.php?m=MarcheHTML&v=ReservationMarche&fonction=modifierForm&id_marche=' . $_GET["id_marche"]);
						} else {
							include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
							include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
							$lVr = new TemplateVR();
							$lVr->setValid(false);
							$lVr->getLog()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_221_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_221_MSG);
							$lVr->getLog()->addErreur($lErreur);
							$_SESSION['msg'] = $lVr->exportToArray();
							header('location:./index.php?m=MarcheHTML&v=MonMarche');							
						}
					} else { // Une réservation en cours
						$lLogger->log("Affichage de la vue ReservationMarche par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

						// Préparation de l'affichage
						$lTemplate = new Template(CHEMIN_TEMPLATE);	
						
						// Entete
						$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
						$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
						InfobullesUtils::generer($lTemplate); // Messages d'erreur
						$lTemplate->assign_var_from_handle('ENTETE', 'entete');
						
						// Menu
						$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
						$lTemplate->assign_vars( array( 'menu-Marche' => "ui-state-active") );	
						$lTemplate->assign_var_from_handle('MENU', 'menu');
						
						// Body		
						$lTemplate->set_filenames( array('body' => MOD_COMMANDE . '/' . 'ReservationDetail.html') );
						
						$lData = array("categories" => array());						
						
						$lAbonnementSurReservation = false;
						
						$lTotal = 0;
						foreach($lPage->getMarche()->getProduits() as $lProduit) {
							foreach($lPage->getReservation() as $lReservation) {
								if($lReservation->getIdProduit() == $lProduit->getId()) {
									
									$lStoQuantite = $lReservation->getQuantite();
									$lPrix = 0;
									foreach($lProduit->getLots() as $lLot) {
										if($lLot->getId() == $lReservation->getIdDetailCommande() ) {
											$lPrix = -1 * ($lStoQuantite / $lLot->getTaille() ) * $lLot->getPrix();
										}
									}
									$lTotal += $lPrix;
									
									$lFlagType = "";
									if($lProduit->getType() == 2) {
										$lFlagType = file_get_contents( CHEMIN_TEMPLATE . MOD_COMMANDE . '/' . 'FlagAbonnement.html');
										$lAbonnementSurReservation = true;
									}
									
									$lPdt = array(	"proId" => $lProduit->getId(),
													"nproNom" => $lProduit->getNom(),
													"stoQuantite" => StringUtils::affichageMonetaireFr($lStoQuantite * -1),
													"prix" => StringUtils::affichageMonetaireFr($lPrix),
													"proUniteMesure" => $lProduit->getUnite(),
													"flagType" => $lFlagType);
								
									if(!isset($lData["categories"][$lProduit->getIdCategorie()])) {
										$lData["categories"][$lProduit->getIdCategorie()] = array("nom" => $lProduit->getCproNom(), "produits" => array());
									}									
									array_push($lData["categories"][$lProduit->getIdCategorie()]["produits"] , $lPdt);
								}
							}
						}
						
						foreach($lData["categories"] as $lCategorie) {
							$lTemplate->assign_block_vars('categories', array(
								'nom' => $lCategorie["nom"] ));							
							foreach($lCategorie["produits"] as $lProduit) {
								$lTemplate->assign_block_vars('categories.produits', $lProduit );
							}
						}
			
						$lSolde = $lPage->getAdherent()->getCptSolde();
						$lSoldeNv = $lSolde - $lTotal;

						$lTemplate->assign_vars( array(
													'idMarche' => $_GET["id_marche"],
													'sigleMonetaire' => SIGLE_MONETAIRE,
													'solde' => StringUtils::affichageMonetaireFr($lSolde),
													'soldeNv' => StringUtils::affichageMonetaireFr($lSoldeNv),
													'comNumero' => $lPage->getMarche()->getNumero(),
													'total' => StringUtils::affichageMonetaireFr($lTotal),
													'dateFinReservation' => StringUtils::extractDate($lPage->getMarche()->getDateFinReservation()),
													'heureFinReservation' => StringUtils::extractDbHeure($lPage->getMarche()->getDateFinReservation()),
													'minuteFinReservation'  => StringUtils::extractDbMinute($lPage->getMarche()->getDateFinReservation() ),
													'dateMarcheDebut' => StringUtils::extractDate($lPage->getMarche()->getDateMarcheDebut()),
													'heureMarcheDebut' => StringUtils::extractDbHeure($lPage->getMarche()->getDateMarcheDebut()),
													'minuteMarcheDebut'  => StringUtils::extractDbMinute($lPage->getMarche()->getDateMarcheDebut() ),
													'heureMarcheFin' => StringUtils::extractDbHeure($lPage->getMarche()->getDateMarcheFin()),
													'minuteMarcheFin'  => StringUtils::extractDbMinute($lPage->getMarche()->getDateMarcheFin() ) ));
					
						if(TestFonction::dateTimeEstPLusGrandeEgale($lPage->getMarche()->getDateFinReservation(),StringUtils::dateTimeAujourdhuiDb())) {	
							if($lAbonnementSurReservation) {
								$lTemplate->set_filenames( array('gestionReservation' => MOD_COMMANDE . '/' . 'GestionReservationModifier.html') );
							} else {
								$lTemplate->set_filenames( array('gestionReservation' => MOD_COMMANDE . '/' . 'GestionReservation.html') );
							}
							$lTemplate->assign_var_from_handle('GESTION_RESERVATION', 'gestionReservation');
						}

						// Pied de Page
						$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
						$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');
						
						
						$lTemplate->set_filenames( array('page' => 'Page.html') );
						$lTemplate->assign_var_from_handle('CONTENU', 'body');
						
						// Affichage
						$lTemplate->pparse('page');
					}
				}
				break;
				
			case "modifierForm":
					 if(isset($_GET["id_marche"])) {
					 
					    $lParam = array("id_commande" => $_GET["id_marche"]);
						$lPage = $lControleur->getReservation($lParam);
						$lLogger->log("Affichage du formulaire de modification de réservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

						// Préparation de l'affichage
						$lTemplate = new Template(CHEMIN_TEMPLATE);	
												
						// Menu
						$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
						$lTemplate->assign_vars( array( 'menu-Marche' => "ui-state-active") );	
						$lTemplate->assign_var_from_handle('MENU', 'menu');
						
						// Body		
						$lTemplate->set_filenames( array('body' => MOD_COMMANDE . '/' . 'ReservationFormulaire.html') );
						
						$lData = array("categories" => array());						
						
						$lTotal = 0;
						foreach($lPage->getMarche()->getProduits() as $lProduit) {
							$lResa = false;							
							foreach($lPage->getReservation() as $lReservation) {
								if($lReservation->getIdProduit() == $lProduit->getId()) {
									$lStock = $lProduit->getStockReservation() + $lReservation->getQuantite();				
									$lNoStock = false;
									if($lProduit->getQteMaxCommande() == -1 && $lProduit->getStockInitial() == -1) { // Si ni stock ni qmax
										$lNoStock = true;
									} else if($lProduit->getStockInitial()  == -1) { // Si qmax mais pas stock
										$lMax = $lProduit->getQteMaxCommande();
									} else if($lProduit->getQteMaxCommande() == -1) { // Si stock mais pas qmax
										$lMax = $lStock;
									} else { // Si stock et qmax
										if($lProduit->getQteMaxCommande() < $lStock) {
											$lMax = $lProduit->getQteMaxCommande();
										} else {
											$lMax = $lStock;
										}					
									}
									
									
									$lLots = array();
									$lStoQuantite = $lReservation->getQuantite();
									$lPrix = 0;
									$lDcomIdSelected = "";
									foreach($lProduit->getLots() as $lLot) {
										$lLotSelect = array("dcomId" => $lLot->getId(),
																	"dcomTaille" => StringUtils::affichageMonetaireFr($lLot->getTaille()),
																	"prixUnitaire" => StringUtils::affichageMonetaireFr($lLot->getPrix() / $lLot->getTaille() ) );
										
										$lReservationLotTest = $lLot->getId() == $lReservation->getIdDetailCommande();
										if( $lReservationLotTest ) {
											$lPrix = -1 * ($lStoQuantite / $lLot->getTaille() ) * $lLot->getPrix();
											$lLotSelect["selected"] = "selected=\"selected\"";
											$lDcomIdSelected = $lLot->getId();											
										}
										if($lNoStock || (!$lNoStock && $lLot->getTaille() <= $lMax) || $lReservationLotTest) {
											array_push($lLots,$lLotSelect);
										}
										
									}
									$lTotal += $lPrix;
																		
									$lFlagType = "";
									$lInfoHidden = "";
									$lAboInfoHidden = "";
									$lAboInfoDisabled = "";
									$lAboInfoChecked = "";
									if($lProduit->getType() == 2) {
										$lFlagType = file_get_contents( CHEMIN_TEMPLATE . MOD_COMMANDE . '/' . 'FlagAbonnement.html');
										$lAboInfoHidden = "ui-helper-hidden";
										$lAboInfoDisabled = "disabled=\"disabled\"";
										$lAboInfoChecked = "checked=\"checked\"";
									} else if($lProduit->getType() == 1) {
										$lFlagType = file_get_contents( CHEMIN_TEMPLATE . MOD_COMMANDE . '/' . 'FlagSolidaire.html');
										$lInfoHidden = "ui-helper-hidden";
									}
									
									$lPdt = array(	"checked" => "checked=\"checked\"",
													"proId" => $lProduit->getId(),
													"nproNom" => $lProduit->getNom(),
													"stoQuantite" => StringUtils::affichageMonetaireFr($lStoQuantite * -1),
													"prix" => StringUtils::affichageMonetaireFr($lPrix),
													"proUniteMesure" => $lProduit->getUnite(),
													"lot" => $lLots,
													"flagType" => $lFlagType,
													"info-hidden" => $lInfoHidden,
													"abo-info-disabled"=> $lAboInfoDisabled,
													"abo-info-hidden" => $lAboInfoHidden,
													"abo-info-checked" => $lAboInfoChecked);
									
									$lPdt["dcomIdSelected"] = $lDcomIdSelected;									
								
									if(!isset($lData["categories"][$lProduit->getIdCategorie()])) {
										$lData["categories"][$lProduit->getIdCategorie()] = array("nom" => $lProduit->getCproNom(), "produits" => array());
									}
									array_push($lData["categories"][$lProduit->getIdCategorie()]["produits"] , $lPdt);
									$lResa = true;
								}
							}
							
							if(!$lResa) {
								$lNoStock = false;
								if($lProduit->getQteMaxCommande() == -1 && $lProduit->getStockInitial() == -1) { // Si ni stock ni qmax
									$lNoStock = true;
								} else if($lProduit->getStockInitial()  == -1) { // Si qmax mais pas stock
									$lMax = $lProduit->getQteMaxCommande();
								} else if($lProduit->getQteMaxCommande() == -1) { // Si stock mais pas qmax
									$lMax = $lProduit->getStockReservation();
								} else { // Si stock et qmax
									if($lProduit->getQteMaxCommande() < $lProduit->getStockReservation()) {
										$lMax = $lProduit->getQteMaxCommande();
									} else {
										$lMax = $lProduit->getStockReservation();
									}					
								}
							
								$lLots = array();
								foreach($lProduit->getLots() as $lLot) {									
									if($lNoStock || (!$lNoStock && $lLot->getTaille() <= $lMax) ) {
										array_push($lLots,array("dcomId" => $lLot->getId(),
															"dcomTaille" => StringUtils::affichageMonetaireFr($lLot->getTaille()),
															"prixUnitaire" => StringUtils::affichageMonetaireFr($lLot->getPrix() / $lLot->getTaille())
												));
									}
								}
								
								$lFlagType = "";
								$lAboHidden = "";
								$lInfoHidden = "";
								if($lProduit->getType() == 2) {
									$lFlagType = file_get_contents( CHEMIN_TEMPLATE . MOD_COMMANDE . '/' . 'FlagAbonnement.html');
									$lAboHidden = "ui-helper-hidden";
								} else if($lProduit->getType() == 1) {
									$lFlagType = file_get_contents( CHEMIN_TEMPLATE . MOD_COMMANDE . '/' . 'FlagSolidaire.html');
									$lInfoHidden = "ui-helper-hidden";
								}
								$lPdt = array(	"proId" => $lProduit->getId(),
												"nproNom" => $lProduit->getNom(),
												"stoQuantite" => "",
												"prix" => StringUtils::affichageMonetaireFr(0),
												"proUniteMesure" => $lProduit->getUnite(),
												"lot" => $lLots,
												"flagType" => $lFlagType,
												"info-hidden" => $lInfoHidden,
												"abo-hidden" => $lAboHidden  );
							
								if(!isset($lData["categories"][$lProduit->getIdCategorie()])) {
									$lData["categories"][$lProduit->getIdCategorie()] = array("nom" => $lProduit->getCproNom(), "produits" => array());
								}
								array_push($lData["categories"][$lProduit->getIdCategorie()]["produits"] , $lPdt);
							}							
						}
						
						$lVal = false;
						if(isset($_SESSION['val']) && !empty($_SESSION['val']) && isset($_SESSION['val']['detailReservation']) && !empty($_SESSION['val']['detailReservation'])) {							
							$lVal = true;
						}
						
						$lErreur = false;
						if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { // Message d'erreur							
							$lLignesErr = array();
							if(!$_SESSION['msg']['valid']) {
								InfobullesUtils::compilerMessage($_SESSION['msg'],&$lLignesErr);
							}
							$lErreur = true;
						}

						foreach($lData["categories"] as $lCategorie) {
							$lTemplate->assign_block_vars('categories', array(
								'nom' => $lCategorie["nom"] ));							
							foreach($lCategorie["produits"] as $lProduit) {	
								// Si formulaire en erreur on affiche les données mal saisit
								$lIdLotSelected = 0;
								if($lVal) {
									if(isset($_SESSION['val']['detailReservation'][$lProduit["proId"]])) {
										$lProduit["checked"] = "checked=\"checked\"";
										$lProduit["stoQuantite"] = StringUtils::affichageMonetaireFr($_SESSION['val']['detailReservation'][$lProduit["proId"]]["stoQuantite"] * -1);	
										$lIdLotSelected = $_SESSION['val']['detailReservation'][$lProduit["proId"]]["stoIdDetailCommande"];							
									} else {
										$lProduit["checked"] = "";
										$lProduit["stoQuantite"] = "";
									}
								}
								
								if($lErreur) {
									//foreach($lProduit["lot"] as $lLot) {
										if(isset($lLignesErr["commandes" . $lProduit["proId"] . "stoQuantite"])) { 
											$lProduit['class-err']= "ui-state-error";
											$lProduit['class-err-msg'] = "ui-state-highlight message-erreur-champ";
											$lProduit['err'] = $lLignesErr["commandes" .  $lProduit["proId"] . "stoQuantite"];
										} else if(isset($lLignesErr["commandes" . $lProduit["proId"] . "stoIdProduit"])) {
											$lProduit['class-err']= "ui-state-error";
											$lProduit['class-err-msg'] = "ui-state-highlight message-erreur-champ";
											$lProduit['err'] = $lLignesErr["commandes" .  $lProduit["proId"] . "stoIdProduit"];
										}
									//}
								}
								
								if(!empty($lProduit["lot"])) {
									$lTemplate->assign_block_vars('categories.produits', $lProduit );
								} else {
									$lProduit["stoQuantite"] = "Plus de stock";
									$lProduit["disabled"] = "disabled=\"disabled\"";
									$lProduit["hidden"] = "ui-helper-hidden";
									$lTemplate->assign_block_vars('categories.produits', $lProduit );
								}
								foreach($lProduit["lot"] as $lLot) {
									if($lIdLotSelected == $lLot["dcomId"]) {
										$lLot["selected"] = "selected=\"selected\"";
									} else if($lIdLotSelected != 0) {
										$lLot["selected"] = "";										
									}							
									$lTemplate->assign_block_vars('categories.produits.lot', $lLot );
								}								
							}
						}
			
						$lSolde = $lPage->getAdherent()->getCptSolde();
						$lSoldeNv = $lSolde - $lTotal;

						$lTemplate->assign_vars( array(
													'FORM_ACTION' => "./index.php?m=MarcheHTML&v=ReservationMarche&fonction=modifierValider&id_marche=" . $_GET["id_marche"],
													'idMarche' => $_GET["id_marche"],
													'sigleMonetaire' => SIGLE_MONETAIRE,
													'solde' => StringUtils::affichageMonetaireFr($lSolde),
													'soldeNv' => StringUtils::affichageMonetaireFr($lSoldeNv),
													'comNumero' => $lPage->getMarche()->getNumero(),
													'total' => StringUtils::affichageMonetaireFr($lTotal),
													'dateFinReservation' => StringUtils::extractDate($lPage->getMarche()->getDateFinReservation()),
													'heureFinReservation' => StringUtils::extractDbHeure($lPage->getMarche()->getDateFinReservation()),
													'minuteFinReservation'  => StringUtils::extractDbMinute($lPage->getMarche()->getDateFinReservation() ),
													'dateMarcheDebut' => StringUtils::extractDate($lPage->getMarche()->getDateMarcheDebut()),
													'heureMarcheDebut' => StringUtils::extractDbHeure($lPage->getMarche()->getDateMarcheDebut()),
													'minuteMarcheDebut'  => StringUtils::extractDbMinute($lPage->getMarche()->getDateMarcheDebut() ),
													'heureMarcheFin' => StringUtils::extractDbHeure($lPage->getMarche()->getDateMarcheFin()),
													'minuteMarcheFin'  => StringUtils::extractDbMinute($lPage->getMarche()->getDateMarcheFin() ) ));

						// Boutons
						$lTemplate->set_filenames( array('boutons' =>  MOD_COMMANDE . '/' . 'BoutonMajCalculReservation.html') );
						$lTemplate->assign_var_from_handle('BOUTONS_CALCULER', 'boutons');
						
						// Page
						$lTemplate->set_filenames( array('page' => 'Page.html') );
						$lTemplate->assign_var_from_handle('CONTENU', 'body');	

						// Pied de Page
						$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
						$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');
						
						// Entete
						$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
						$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
						InfobullesUtils::generer($lTemplate); // Messages d'erreur
						$lTemplate->assign_var_from_handle('ENTETE', 'entete');	
						

						// Affichage
						$lTemplate->pparse('page');
						
					}
			break;
			
			case "modifierRetourForm":
				if(isset($_GET["id_marche"])) {	
					header('location:./index.php?m=MarcheHTML&v=ReservationMarche&fonction=modifierForm&id_marche=' . $_GET["id_marche"]);
				}
			break;
				
			case "modifierValider":	
					if(isset($_POST["id-produit"]) && isset($_GET["id_marche"]) || isset($_POST['id-produit-abonnement'])) {						
						$lParam = array("detailReservation" => array());
							
						if(isset($_POST['id-produit'])) {
							foreach($_POST['id-produit'] as $lIdProduit) {
								if(isset($_POST['produit-' . $lIdProduit . '-lot']) && isset($_POST['produit-' . $lIdProduit . '-quantite'])) {
									array_push($lParam["detailReservation"],array(	"id" => "",
																				"stoIdDetailCommande" => $_POST['produit-' . $lIdProduit . '-lot'],
																				"stoQuantite" => StringUtils::decimalFrToDb($_POST['produit-' . $lIdProduit . '-quantite']) * -1,
																				"idProduit" => $lIdProduit	 ));
								}
							}
						}
						if(isset($_POST['id-produit-abonnement'])) {
							foreach($_POST['id-produit-abonnement'] as $lIdProduit) {
								if(isset($_POST['produit-abonnement-' . $lIdProduit . '-lot']) && isset($_POST['produit-abonnement-' . $lIdProduit . '-quantite'])) {
									array_push($lParam["detailReservation"],array(	"id" => "",
																				"stoIdDetailCommande" => $_POST['produit-abonnement-' . $lIdProduit . '-lot'],
																				"stoQuantite" => StringUtils::decimalFrToDb($_POST['produit-abonnement-' . $lIdProduit . '-quantite']) * -1,
																				"idProduit" => $lIdProduit	 ));
								}
							}
						}
						
						$lPage = $lControleur->controleModifierReservation($lParam);

						if($lPage->getValid()) {
							$lLogger->log("Affichage page récapitulative de modification de réservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

							// Préparation de l'affichage
							$lTemplate = new Template(CHEMIN_TEMPLATE);	
							
							// Entete
							$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
							$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
							InfobullesUtils::generer($lTemplate); // Messages d'erreur
							$lTemplate->assign_var_from_handle('ENTETE', 'entete');
							
							// Menu
							$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
							$lTemplate->assign_vars( array( 'menu-Marche' => "ui-state-active") );	
							$lTemplate->assign_var_from_handle('MENU', 'menu');
							
							// Body		
							$lTemplate->set_filenames( array('body' => MOD_COMMANDE . '/' . 'ReservationDetail.html') );
							
							$lData = array("categories" => array());						
							
							$lTotal = 0;
							foreach($lPage->getMarche()->getProduits() as $lProduit) {
								foreach($lParam["detailReservation"] as $lReservation) {
									if($lReservation["idProduit"] == $lProduit->getId()) {
										
										$lStoQuantite = $lReservation['stoQuantite'];
										$lPrix = 0;
										foreach($lProduit->getLots() as $lLot) {
											if($lLot->getId() == $lReservation["stoIdDetailCommande"] ) {
												$lPrix = -1 * ($lStoQuantite / $lLot->getTaille() ) * $lLot->getPrix();
											}
										}
										$lTotal += $lPrix;
										
										$lPdt = array(	"proId" => $lProduit->getId(),
														"nproNom" => $lProduit->getNom(),
														"stoQuantite" => StringUtils::affichageMonetaireFr($lStoQuantite * -1),
														"prix" => StringUtils::affichageMonetaireFr($lPrix),
														"proUniteMesure" => $lProduit->getUnite() );
									
										if(!isset($lData["categories"][$lProduit->getIdCategorie()])) {
											$lData["categories"][$lProduit->getIdCategorie()] = array("nom" => $lProduit->getCproNom(), "produits" => array());
										}
										array_push($lData["categories"][$lProduit->getIdCategorie()]["produits"] , $lPdt);
									}
								}
							}
							
							foreach($lData["categories"] as $lCategorie) {
								$lTemplate->assign_block_vars('categories', array(
									'nom' => $lCategorie["nom"] ));							
								foreach($lCategorie["produits"] as $lProduit) {
									$lTemplate->assign_block_vars('categories.produits', $lProduit );
								}
							}
				
							$lSolde = $lPage->getAdherent()->getCptSolde();
							$lSoldeNv = $lSolde - $lTotal;
	
							$lTemplate->assign_vars( array(
														'idMarche' => $_GET["id_marche"],
														'sigleMonetaire' => SIGLE_MONETAIRE,
														'solde' => StringUtils::affichageMonetaireFr($lSolde),
														'soldeNv' => StringUtils::affichageMonetaireFr($lSoldeNv),
														'comNumero' => $lPage->getMarche()->getNumero(),
														'total' => StringUtils::affichageMonetaireFr($lTotal),
														'dateFinReservation' => StringUtils::extractDate($lPage->getMarche()->getDateFinReservation()),
														'heureFinReservation' => StringUtils::extractDbHeure($lPage->getMarche()->getDateFinReservation()),
														'minuteFinReservation'  => StringUtils::extractDbMinute($lPage->getMarche()->getDateFinReservation() ),
														'dateMarcheDebut' => StringUtils::extractDate($lPage->getMarche()->getDateMarcheDebut()),
														'heureMarcheDebut' => StringUtils::extractDbHeure($lPage->getMarche()->getDateMarcheDebut()),
														'minuteMarcheDebut'  => StringUtils::extractDbMinute($lPage->getMarche()->getDateMarcheDebut() ),
														'heureMarcheFin' => StringUtils::extractDbHeure($lPage->getMarche()->getDateMarcheFin()),
														'minuteMarcheFin'  => StringUtils::extractDbMinute($lPage->getMarche()->getDateMarcheFin() ) ));
						
							if(TestFonction::dateTimeEstPLusGrandeEgale($lPage->getMarche()->getDateFinReservation(),StringUtils::dateTimeAujourdhuiDb())) {		
								$lTemplate->set_filenames( array('boutonValiderReservation' => MOD_COMMANDE . '/' . 'boutonValiderReservation.html') );
								$lTemplate->assign_var_from_handle('GESTION_RESERVATION', 'boutonValiderReservation');
							}
	
							// Pied de Page
							$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
							$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');
							
							
							$lTemplate->set_filenames( array('page' => 'Page.html') );
							$lTemplate->assign_var_from_handle('CONTENU', 'body');
							
							// Stock les infos pour une modification
							
							if(isset($_POST['id-produit'])) {
								foreach($_POST['id-produit'] as $lIdProduit) {
									if(isset($_POST['produit-' . $lIdProduit . '-lot']) && isset($_POST['produit-' . $lIdProduit . '-quantite'])) {
										$lParamRetour["detailReservation"][$lIdProduit] = array(	"id" => "",
																					"stoIdDetailCommande" => $_POST['produit-' . $lIdProduit . '-lot'],
																					"stoQuantite" => StringUtils::decimalFrToDb($_POST['produit-' . $lIdProduit . '-quantite']) * -1 ,
																					"idProduit" => $lIdProduit);
									}
								}
							}
							if(isset($_POST['id-produit-abonnement'])) {
								foreach($_POST['id-produit-abonnement'] as $lIdProduit) {
									if(isset($_POST['produit-abonnement-' . $lIdProduit . '-lot']) && isset($_POST['produit-abonnement-' . $lIdProduit . '-quantite'])) {
										$lParamRetour["detailReservation"][$lIdProduit] = array(	"id" => "",
																					"stoIdDetailCommande" => $_POST['produit-abonnement-' . $lIdProduit . '-lot'],
																					"stoQuantite" => StringUtils::decimalFrToDb($_POST['produit-abonnement-' . $lIdProduit . '-quantite']) * -1 ,
																					"idProduit" => $lIdProduit);
									}
								}
							}
							$_SESSION['val'] = $lParamRetour;
							$_SESSION['msg'] = $lPage->exportToArray();
							
							// Affichage
							$lTemplate->pparse('page');	
							
							
							// Passage des infos pour la validation de la modification
							$lParam = array("detailReservation"=>array());
							
							if(isset($_POST['id-produit'])) {
								foreach($_POST['id-produit'] as $lIdProduit) {
									if(isset($_POST['produit-' . $lIdProduit . '-lot']) && isset($_POST['produit-' . $lIdProduit . '-quantite'])) {
										array_push($lParam["detailReservation"],array(	"id" => "",
																					"stoIdDetailCommande" => $_POST['produit-' . $lIdProduit . '-lot'],
																					"stoQuantite" => StringUtils::decimalFrToDb($_POST['produit-' . $lIdProduit . '-quantite']) * -1 ));
									}
								}
							}
							if(isset($_POST['id-produit-abonnement'])) {
								foreach($_POST['id-produit-abonnement'] as $lIdProduit) {
									if(isset($_POST['produit-abonnement-' . $lIdProduit . '-lot']) && isset($_POST['produit-abonnement-' . $lIdProduit . '-quantite'])) {
										array_push($lParam["detailReservation"],array(	"id" => "",
																					"stoIdDetailCommande" => $_POST['produit-abonnement-' . $lIdProduit . '-lot'],
																					"stoQuantite" => StringUtils::decimalFrToDb($_POST['produit-abonnement-' . $lIdProduit . '-quantite']) * -1 ));
									}
								}
							}
							$_SESSION['id-produit'] = $lParam;
							
						} else {
							$lParam = array();
							if(isset($_POST['id-produit'])) {
								foreach($_POST['id-produit'] as $lIdProduit) {
									if(isset($_POST['produit-' . $lIdProduit . '-lot']) && isset($_POST['produit-' . $lIdProduit . '-quantite'])) {
										$lParam["detailReservation"][$lIdProduit] = array(	"id" => "",
																					"stoIdDetailCommande" => $_POST['produit-' . $lIdProduit . '-lot'],
																					"stoQuantite" => StringUtils::decimalFrToDb($_POST['produit-' . $lIdProduit . '-quantite']) * -1 ,
																					"idProduit" => $lIdProduit);
									}
								}
							}
							if(isset($_POST['id-produit-abonnement'])) {								
								foreach($_POST['id-produit-abonnement'] as $lIdProduit) {
									if(isset($_POST['produit-abonnement-' . $lIdProduit . '-lot']) && isset($_POST['produit-abonnement-' . $lIdProduit . '-quantite'])) {
										
										$lParam["detailReservation"][$lIdProduit] = array(	"id" => "",
																					"stoIdDetailCommande" => $_POST['produit-abonnement-' . $lIdProduit . '-lot'],
																					"stoQuantite" => StringUtils::decimalFrToDb($_POST['produit-abonnement-' . $lIdProduit . '-quantite']) * -1 ,
																					"idProduit" => $lIdProduit);
									}
								}
							}
							$_SESSION['msg'] = $lPage->exportToArray();
							$_SESSION['val'] = $lParam;
							header('location:./index.php?m=MarcheHTML&v=ReservationMarche&fonction=modifierForm&id_marche=' . $_GET["id_marche"]);
						}
						
					} else if( isset($_GET["id_marche"]) ){
						// Il faut au moins un produit
						include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
						include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
						$lVr = new TemplateVR();
						$lVr->setValid(false);
						$lVr->getLog()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
						$lVr->getLog()->addErreur($lErreur);
						$_SESSION['msg'] = $lVr->exportToArray();
						header('location:./index.php?m=MarcheHTML&v=ReservationMarche&fonction=modifierForm&id_marche=' . $_GET["id_marche"]);
					}
				break;
							
			case "modifier":
					if(isset($_SESSION['id-produit']) && isset($_GET["id_marche"])) {
						$lParam = array("detailReservation" => array());
						if(is_array($_SESSION['id-produit'])) {
							$lParam = $_SESSION['id-produit'];
							$lPage = $lControleur->modifierReservation($lParam);

							if($lPage->getValid()) {
								$lLogger->log("Modification de la reservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
								// Retour à Ma réservation avec le message de confirmation
								include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
								include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
								$lVr = new TemplateVR();
								$lVr->setValid(false);
								$lVr->getLog()->setValid(false);
								$lErreur = new VRerreur();
								$lErreur->setCode(MessagesErreurs::ERR_337_CODE);
								$lErreur->setMessage(MessagesErreurs::ERR_337_MSG);
								$lVr->getLog()->addErreur($lErreur);
								$_SESSION['msg'] = $lVr->exportToArray();
								header('location:./index.php?m=MarcheHTML&v=ReservationMarche&fonction=afficher&id_marche=' . $_GET["id_marche"]);	
							} else {						
								$_SESSION['msg'] = $lPage->exportToArray();
								header('location:./index.php?m=MarcheHTML&v=ReservationMarche&fonction=modifierForm&id_marche=' . $_GET["id_marche"]);
							}
						}
					} else if(isset($_GET["id_marche"]) ){
						// Il faut au moins un produit
						include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
						include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
						$lVr = new TemplateVR();
						$lVr->setValid(false);
						$lVr->getLog()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
						$lVr->getLog()->addErreur($lErreur);
						$_SESSION['msg'] = $lVr->exportToArray();
						header('location:./index.php?m=MarcheHTML&v=ReservationMarche&fonction=modifierForm&id_marche=' . $_GET["id_marche"]);
					}
				break;
				
			case "supprimerValider":
				if(isset($_GET["id_marche"])) {
					$lLogger->log("Affichage confirmation de la suppression de la réservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

					// Préparation de l'affichage
					$lTemplate = new Template(CHEMIN_TEMPLATE);	
					
					// Entete
					$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
					$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
					InfobullesUtils::generer($lTemplate); // Messages d'erreur
					$lTemplate->assign_var_from_handle('ENTETE', 'entete');
					
					// Menu
					$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
					$lTemplate->assign_vars( array( 'menu-Marche' => "ui-state-active") );	
					$lTemplate->assign_var_from_handle('MENU', 'menu');
					
					// Body		
					$lTemplate->set_filenames( array('body' => MOD_COMMANDE . '/' . 'ValiderSupprimerReservation.html') );
					$lTemplate->assign_vars( array('idMarche' => $_GET["id_marche"]));
					
					// Pied de Page
					$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
					$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');
					
					
					$lTemplate->set_filenames( array('page' => 'Page.html') );
					$lTemplate->assign_var_from_handle('CONTENU', 'body');
					
					// Affichage
					$lTemplate->pparse('page');	
				}
				break;
			
			case "supprimer":
				if(isset($_GET["id_marche"])) { // Redirection pour contourner un bug
					header('location:./index.php?m=MarcheHTML&v=ReservationMarche&fonction=supprimerAction&id_marche=' . $_GET["id_marche"]);
				}
				break;
				
			case "supprimerAction":
				if(isset($_GET["id_marche"])) {
					$lParam = array("id_commande" => $_GET["id_marche"]);
					$lPage = $lControleur->supprimerReservation($lParam);
					if($lPage->getValid()) {
						$lLogger->log("Suppression de reservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
						include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
						$lVr = new TemplateVR();
						$lVr->setValid(false);
						$lVr->getLog()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_303_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_303_MSG);
						$lVr->getLog()->addErreur($lErreur);
						$_SESSION['msg'] = $lVr->exportToArray();
						header('location:./index.php?m=MarcheHTML&v=MonMarche');
					} else {
						$lLogger->log("Echec de la suppression de reservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs						
						$_SESSION['msg'] = $lPage->exportToArray();
						header('location:./index.php?m=MarcheHTML&v=ReservationMarche&fonction=supprimerValider&id_marche=' . $_GET["id_marche"]);
					}
				}
				break;	
				

			default:
				$lLogger->log("Demande d'accés à ReservationMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
				header('location:./index.php');
				break;
		}
	} else {
		$lLogger->log("Demande d'accés à ReservationMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à ReservationMarche",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=2');
}
?>