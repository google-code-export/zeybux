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
	public static function compilerMessage($pMsg, $pLignesErr, $pPrefixe = "") {
		foreach($pMsg as $lCle => $lMsg) {
			if(isset($lMsg['valid']) && $lMsg['valid'] === false && isset($lMsg['erreurs']) && is_array($lMsg['erreurs']) ) {
				foreach($lMsg['erreurs'] as $lErr) {
					if(isset($pLignesErr[$lCle])) {					
						$pLignesErr[$pPrefixe . $lCle] .= $lErr['code'] . " : " . $lErr['message'] . "<br/>";
					} else {
						$pLignesErr[$pPrefixe . $lCle] = $lErr['code'] . " : " . $lErr['message'] . "<br/>";
					}
				}
			} else if(is_array($lMsg)) {
				InfobullesUtils::compilerMessage($lMsg,&$pLignesErr, $pPrefixe . $lCle);
			}
		}
	}
	
	/**
	* @name genererMessage($pTemplate)
	* @desc 
	*/
	public static function genererMessage($pTemplate) {
		if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { // Message d'erreur
			$pTemplate->set_filenames( array('msg' =>  COMMUN_TEMPLATE . 'MessageInformation.html') );
			
			$lLignesErr = array();
			if(!$_SESSION['msg']['valid']) {
				InfobullesUtils::compilerMessage($_SESSION['msg'],&$lLignesErr);
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