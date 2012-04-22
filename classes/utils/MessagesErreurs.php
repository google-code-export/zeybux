<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/01/2010
// Fichier : MessagesErreurs.php
//
// Description : Classe statique de gestion des erreurs
//
//****************************************************************

/**
 * @name MessagesErreurs.php
 * @author Julien PIERRE
 * @since 26/01/2010
 * 
 * @desc Classe statique de gestion des erreurs
 */
class MessagesErreurs
{
	/*Nouveaux messages d'erreur*/
	//Erreurs techniques
	const ERR_101_CODE = 101;
	const ERR_101_MSG = 'La valeur entrée est trop longue.';
	const ERR_102_CODE = 102;
	const ERR_102_MSG = 'Le format du courriel n\'est pas valide.';
	const ERR_103_CODE = 103;
	const ERR_103_MSG = 'Le format de la date n\'est pas valide.';
	const ERR_104_CODE = 104;
	const ERR_104_MSG = 'L\identifiant de l\'objet n\'est pas valide.';
	const ERR_105_CODE = 105;
	const ERR_105_MSG = 'La date saisie n\'existe pas.';
	const ERR_106_CODE = 106;
	const ERR_106_MSG = 'Le format de l\'heure n\'est pas valide.';
	const ERR_107_CODE = 107;
	const ERR_107_MSG = 'L\'heure saisie n\'existe pas.';
	const ERR_108_CODE = 108;
	const ERR_108_MSG = 'Ce champ doit être de type entier.';
	const ERR_109_CODE = 109;
	const ERR_109_MSG = 'Ce champ doit être de type float.';
	const ERR_110_CODE = 110;
	const ERR_110_MSG = 'Le champ "Lots" doit être de type tableau.';
	const ERR_111_CODE = 111;
	const ERR_111_MSG = 'Le champ "Produits" doit être de type tableau.';
	const ERR_112_CODE = 112;
	const ERR_112_MSG = 'Des éléments du marché sont encore en édition.';
	const ERR_113_CODE = 113;
	const ERR_113_MSG = 'Problème technique lors de l\'enregistrement.';
	const ERR_114_CODE = 114;
	const ERR_114_MSG = 'Plusieures lignes dans la base au lieu d\'une attendue.';
	const ERR_115_CODE = 115;
	const ERR_115_MSG = 'Le champ doit être de type tableau.';
	const ERR_116_CODE = 116;
	const ERR_116_MSG = 'Session expirée. Veuillez vous <span class="action-ifb com-cursor-pointer" id="action-ifb-116">reconnecter</span>.';
	const ERR_117_CODE = 117;
	const ERR_117_MSG = 'Format incorrect.';
	const ERR_118_CODE = 118;
	const ERR_118_MSG = 'Echec de l\'envoi du mail.';
		
	//Erreurs fonctionelles
	const ERR_201_CODE = 201;
	const ERR_201_MSG = 'Ce champ est obligatoire.';
	const ERR_202_CODE = 202;
	const ERR_202_MSG = 'La date de fin des réservations doit être avant celle du marché.';
	const ERR_203_CODE = 203;
	const ERR_203_MSG = 'L\'heure de fin des réservations doit être avant celle du marché.';
	const ERR_204_CODE = 204;
	const ERR_204_MSG = 'L\'heure de fin du marché doit être après celle du début.';
	const ERR_205_CODE = 205;
	const ERR_205_MSG = 'La quantité max par adhérent doit être plus petite que le stock.';
	const ERR_206_CODE = 206;
	const ERR_206_MSG = 'La taille du lot doit être plus petite que quantité max par adhérent.';
	const ERR_207_CODE = 207;
	const ERR_207_MSG = 'Le marché doit comporter au moins un produit.';
	const ERR_208_CODE = 208;
	const ERR_208_MSG = 'La date de fin du marché doit être après celle du début.';
	const ERR_209_CODE = 209;
	const ERR_209_MSG = 'La date ne doit pas être passée.';
	const ERR_210_CODE = 210;
	const ERR_210_MSG = 'Un produit demandé n\'existe pas dans le système.';
	const ERR_211_CODE = 211;
	const ERR_211_MSG = 'Ce produit est déjà présent dans le marché.';
	const ERR_212_CODE = 212;
	const ERR_212_MSG = 'Aucune réservation pour ce marché.';
	const ERR_213_CODE = 213;
	const ERR_213_MSG = 'Il faut entrer un prix pour ce produit.';
	const ERR_214_CODE = 214;
	const ERR_214_MSG = 'Il faut entrer une quantité pour ce produit.';
	const ERR_215_CODE = 215;
	const ERR_215_MSG = 'Ce champ doit être positif.';
	const ERR_216_CODE = 216;
	const ERR_216_MSG = 'Aucune donnée pour l\'id donné.';
	const ERR_217_CODE = 217;
	const ERR_217_MSG = 'Quantité commandée supérieure à la quantité maximale autorisée.';
	const ERR_218_CODE = 218;
	const ERR_218_MSG = 'Quantité commandée supérieure à la quantité restant en stock.';
	const ERR_219_CODE = 219;
	const ERR_219_MSG = 'Pas de nouveau marché.';
	const ERR_220_CODE = 220;
	const ERR_220_MSG = 'Vous avez déjà une réservation pour ce marché.';
	const ERR_221_CODE = 221;
	const ERR_221_MSG = 'Les réservations sont cloturées pour ce marché.';
	const ERR_222_CODE = 222;
	const ERR_222_MSG = 'Erreur d\'identification.';
	const ERR_223_CODE = 223;
	const ERR_223_MSG = 'Les mots de passe doivent être identique.';
	const ERR_224_CODE = 224;
	const ERR_224_MSG = 'Ce champ doit être au format courriel.';
	const ERR_225_CODE = 225;
	const ERR_225_MSG = 'La date d\'anniversaire ne peut pas être après celle d\'adhésion.';
	const ERR_226_CODE = 226;
	const ERR_226_MSG = 'L\'adhérent doit pouvoir accéder à un module au minimum.';
	const ERR_227_CODE = 227;
	const ERR_227_MSG = 'Aucun numéro de compte ne correspond à celui saisit.';
	const ERR_228_CODE = 228;
	const ERR_228_MSG = 'Erreur dans la base sur le numéro de compte.';
	const ERR_229_CODE = 229;
	const ERR_229_MSG = 'Un des modules n\'existe pas.';
	const ERR_230_CODE = 230;
	const ERR_230_MSG = 'La date ne peut pas être future.';
	const ERR_231_CODE = 231;
	const ERR_231_MSG = 'Impossible de supprimer cet adhérent.';
	const ERR_232_CODE = 232;
	const ERR_232_MSG = 'Sélectionner un producteur.';
	const ERR_233_CODE = 233;
	const ERR_233_MSG = 'Sélectionner un produit.';
	const ERR_234_CODE = 234;
	const ERR_234_MSG = 'Un producteur demandé n\'existe pas dans le système.';
	const ERR_235_CODE = 235;
	const ERR_235_MSG = 'Le mot de passe actuel n\'est pas valide.';
	const ERR_236_CODE = 236;
	const ERR_236_MSG = 'Choisir une option.';
	const ERR_237_CODE = 237;
	const ERR_237_MSG = 'Le montant dépasse le solde du compte.';
	const ERR_238_CODE = 238;
	const ERR_238_MSG = 'Vous n\'avez pas de réservation pour ce marché.';
	const ERR_239_CODE = 239;
	const ERR_239_MSG = 'Le marché n\'est plus ouvert.';
	const ERR_240_CODE = 240;
	const ERR_240_MSG = 'Le Type de virement n\'est pas valide.';
	const ERR_242_CODE = 242;
	const ERR_242_MSG = 'Le SIREN n\'est pas valide.';
	const ERR_243_CODE = 243;
	const ERR_243_MSG = 'Il faut sélectionner un prix de vente au minimum.';	
	const ERR_244_CODE = 244;
	const ERR_244_MSG = 'Le versement doit être égal au prix du marché.';
	const ERR_245_CODE = 245;
	const ERR_245_MSG = 'La quantité doit être un multiple du lot.';
	const ERR_246_CODE = 246;
	const ERR_246_MSG = 'Ce type de compte n\'existe pas.';
	const ERR_247_CODE = 247;
	const ERR_247_MSG = 'La date de fin de réservation ne peut être avant celle de début de réservation.';
	const ERR_248_CODE = 248;
	const ERR_248_MSG = 'L\'heure de fin de réservation ne peut être avant celle de début de réservation.';
	const ERR_249_CODE = 249;
	const ERR_249_MSG = 'Quantité supérieure à la quantité en maximale.';	
	const ERR_250_CODE = 250;
	const ERR_250_MSG = 'Quantité maximale de réservation atteinte.';
	const ERR_251_CODE = 251;
	const ERR_251_MSG = 'Ce produit est déjà disponible en abonnement.';
	const ERR_252_CODE = 252;
	const ERR_252_MSG = 'La date de fin de suspension doit ere postérieure à celle de début.';
	const ERR_253_CODE = 253;
	const ERR_253_MSG = 'Ce produit est déjà présent en abonnement dans le marché.';
	const ERR_254_CODE = 254;
	const ERR_254_MSG = 'Aucun lot sélectionné.';
	const ERR_255_CODE = 255;
	const ERR_255_MSG = 'Le mot de passe ne doit pas contenir le caractère &.';
	const ERR_256_CODE = 256;
	const ERR_256_MSG = 'Des abonnements sont positionné sur ce lot : la nouvelle quantité doit être multiple de l\'ancienne.';
	const ERR_257_CODE = 257;
	const ERR_257_MSG = 'Des abonnements sont positionné sur ce lot : la nouvelle quantité doit être inférieure ou égale à l\'ancienne.';
	const ERR_258_CODE = 258;
	const ERR_258_MSG = 'Mauvaise adresse mail.';
	const ERR_259_CODE = 259;
	const ERR_259_MSG = 'La limite de stock doit être supérieure à la quantité déjà réservée.';
	const ERR_260_CODE = 260;
	const ERR_260_MSG = 'La limite par adhérent doit être supérieure au plus grand des prix de vente avec réservation.';
	
	//Messages d'Information
	const ERR_301_CODE = 301;
	const ERR_301_MSG = 'Enregistrement Terminé.';
	const ERR_302_CODE = 302;
	const ERR_302_MSG = 'Mot de passe mis à jour.';
	const ERR_303_CODE = 303;
	const ERR_303_MSG = 'Réservation supprimée.';
	const ERR_304_CODE = 304;
	const ERR_304_MSG = 'Quantité maximale de réservation atteinte pour ce produit.';
	const ERR_305_CODE = 305;
	const ERR_305_MSG = 'Connexion réussie.';
	const ERR_306_CODE = 306;
	const ERR_306_MSG = 'Compte mis à jour.';
	const ERR_307_CODE = 307;
	const ERR_307_MSG = 'Virement effectué.';
	const ERR_308_CODE = 308;
	const ERR_308_MSG = 'Virement modifié.';
	const ERR_309_CODE = 309;
	const ERR_309_MSG = 'Virement supprimé.';
	const ERR_310_CODE = 310;
	const ERR_310_MSG = 'Marché modifié.';
	const ERR_311_CODE = 311;
	const ERR_311_MSG = 'Arrêt des réservations et ventes.';
	const ERR_312_CODE = 312;
	const ERR_312_MSG = 'Réservations et ventes ouvertes.';
	const ERR_313_CODE = 313;
	const ERR_313_MSG = 'Le Marché est cloturé.';
	const ERR_314_CODE = 314;
	const ERR_314_MSG = 'Achat Modifié.';
	const ERR_315_CODE = 315;
	const ERR_315_MSG = 'Achat Supprimé.';
	const ERR_316_CODE = 316;
	const ERR_316_MSG = 'Informations mises à jour.';
	const ERR_317_CODE = 317;
	const ERR_317_MSG = 'Catégorie ajoutée.';
	const ERR_318_CODE = 318;
	const ERR_318_MSG = 'Catégorie modifiée.';
	const ERR_319_CODE = 319;
	const ERR_319_MSG = 'Catégorie supprimée.';
	const ERR_320_CODE = 320;
	const ERR_320_MSG = 'Ferme ajoutée.';
	const ERR_321_CODE = 321;
	const ERR_321_MSG = 'Ferme modifiée.';
	const ERR_322_CODE = 322;
	const ERR_322_MSG = 'Ferme supprimée.';
	const ERR_323_CODE = 323;
	const ERR_323_MSG = 'Producteur ajouté.';
	const ERR_324_CODE = 324;
	const ERR_324_MSG = 'Producteur modifié.';
	const ERR_325_CODE = 325;
	const ERR_325_MSG = 'Producteur supprimé.';	
	const ERR_326_CODE = 326;
	const ERR_326_MSG = 'Caractéristique ajoutée.';
	const ERR_327_CODE = 327;
	const ERR_327_MSG = 'Caractéristique modifiée.';
	const ERR_328_CODE = 328;
	const ERR_328_MSG = 'Caractéristique supprimée.';
	const ERR_329_CODE = 329;
	const ERR_329_MSG = 'Produit ajouté.';
	const ERR_330_CODE = 330;
	const ERR_330_MSG = 'Produit modifié.';
	const ERR_331_CODE = 331;
	const ERR_331_MSG = 'Produit supprimé.';
	const ERR_332_CODE = 332;
	const ERR_332_MSG = 'Aucun produit pour cette ferme.';
	const ERR_333_CODE = 333;
	const ERR_333_MSG = 'Les unités de vente ne sont pas identiques.';
	const ERR_334_CODE = 334;
	const ERR_334_MSG = 'Marché ajouté.';
	const ERR_335_CODE = 335;
	const ERR_335_MSG = 'Marché modifié.';
	const ERR_336_CODE = 336;
	const ERR_336_MSG = 'Naviguateur incompatible pour ce type de compte.';
	const ERR_337_CODE = 337;
	const ERR_337_MSG = 'Réservation modifiée.';
	const ERR_338_CODE = 338;
	const ERR_338_MSG = 'Nouvelle réservation enregistrée.';
	const ERR_339_CODE = 339;
	const ERR_339_MSG = 'Compte ajouté.';
	const ERR_340_CODE = 340;
	const ERR_340_MSG = 'Compte modifié.';
	const ERR_341_CODE = 341;
	const ERR_341_MSG = 'Compte supprimé.';
	const ERR_342_CODE = 342;
	const ERR_342_MSG = 'Produit d\'abonnement ajouté.';
	const ERR_343_CODE = 343;
	const ERR_343_MSG = 'Produit d\'abonnement modifié.';
	const ERR_344_CODE = 344;
	const ERR_344_MSG = 'Produit d\'abonnement supprimé.';
	const ERR_345_CODE = 345;
	const ERR_345_MSG = 'Abonnement ajouté.';
	const ERR_346_CODE = 346;
	const ERR_346_MSG = 'Abonnement modifié.';
	const ERR_347_CODE = 347;
	const ERR_347_MSG = 'Abonnement supprimé.';
	const ERR_348_CODE = 348;
	const ERR_348_MSG = 'Abonnement suspendu.';
	const ERR_349_CODE = 349;
	const ERR_349_MSG = 'Suspension supprimée.';
	const ERR_350_CODE = 350;
	const ERR_350_MSG = 'Réservation ajoutée.';
	/*Fin Nouveaux messages d'erreur*/

	/* ERREURS BDD */
	const ERR_600_CODE = 600;
	const ERR_600_MSG = "Echec de la connexion à la base.";
	const ERR_601_CODE = 601;
	const ERR_601_MSG = "Echec de la sélection de la base.";
	const ERR_602_CODE = 602;
	const ERR_602_MSG = "Echec de la fermeture de la connexion.";
	const ERR_603_CODE = 603;
	const ERR_603_MSG = "Echec de l'exécution de la requête.";
}
?>