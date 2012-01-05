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
	* @name genererMessage()
	* @desc 
	*/
	public static function genererMessage($pVrMsg,$pTemplate) {
		$pTemplate->set_filenames( array('msg' =>  COMMUN_TEMPLATE . 'MessageInformation.html') );
		
		$pVrMsg = json_decode($_GET['msg'],true);
		$lLignesErr = array();
		if(!$pVrMsg['valid']) {
			foreach($pVrMsg as $lCle => $lMsg) {
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
					
		return $lLignesErr;
	}
	
	/**
	* @name genererValeur()
	* @desc 
	*/
	public static function genererValeur($pValMsg,$pTemplate) {
		$lValMsg = json_decode($pValMsg,true);
		foreach($lValMsg as $lCle => $lVal) {
			$pTemplate->assign_vars( array( $lCle => $lVal) );
		}
	}
}
?>