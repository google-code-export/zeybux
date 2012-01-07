<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/01/2012
// Fichier : InfobullesUtils.php
//
// Description : Classe statique permettant de générer les infobulles
//
//****************************************************************

// Inclusion des classes

/**
 * @name InfobullesUtils
 * @author Julien PIERRE
 * @since 05/01/2012
 * 
 * @desc Classe statique permettant de générer les infobulles
 */
class InfobullesUtils
{
	/**
	* @name generer($pTemplate)
	* @desc 
	*/
	public static function generer($pTemplate) {
		InfobullesUtils::genererMessage($pTemplate); // Message d'erreur
		InfobullesUtils::genererValeur($pTemplate); // Valeur des champs du formulaire
		InfobullesUtils::init();
	}
	
	/**
	* @name genererMessage($pTemplate)
	* @desc 
	*/
	public static function genererMessage($pTemplate) {
		if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { // Message d'erreur
			$pTemplate->set_filenames( array('msg' =>  COMMUN_TEMPLATE . 'MessageInformation.html') );
			//$pVrMsg = json_decode($_SESSION['msg'],true);
			$lLignesErr = array();
			if(!$_SESSION['msg']['valid']) {
				foreach($_SESSION['msg'] as $lCle => $lMsg) {
					if($lMsg['valid'] === false) {
						foreach($lMsg['erreurs'] as $lErr) {
							if(isset($lLignesErr[$lCle])) {					
								$lLignesErr[$lCle] .= $lErr['code'] . " : " . $lErr['message'] . "<br/>";
							} else {
								$lLignesErr[$lCle] = $lErr['code'] . " : " . $lErr['message'] . "<br/>";
							}
						}
					}
				}
			}
			
			if(isset($lLignesErr["log"]) && !empty($lLignesErr["log"])) {
				$pTemplate->assign_vars( array( 'MSG_INFORMATION' => $lLignesErr["log"]) ); 
				$pTemplate->assign_var_from_handle('MESSAGE_INFORMATION', 'msg');	
			}						
			
			foreach($lLignesErr as $lCle => $lErr) {
				$pTemplate->assign_vars( array( 'class-err-' . $lCle => "ui-state-error",
												'class-err-msg-' . $lCle => "ui-state-highlight message-erreur-champ",
												'err-' . $lCle => $lErr	) );
			}
		}
	}
	
	/**
	* @name genererValeur($pTemplate)
	* @desc 
	*/
	public static function genererValeur($pTemplate) {
		if(isset($_SESSION['val']) && !empty($_SESSION['val'])) { // Valeur des champs du formulaire
			//$lValMsg = json_decode($_SESSION['val'],true);
			foreach($_SESSION['val'] as $lCle => $lVal) {
				$pTemplate->assign_vars( array( $lCle => $lVal) );
			}
		}
	}
	
	/**
	* @name init()
	* @desc 
	*/
	public static function init() {
		if(isset($_SESSION['msg']) ) {
			unset($_SESSION['msg']);
		}
		if(isset($_SESSION['val']) ) {
			unset($_SESSION['val']);
		}
	}
}
?>