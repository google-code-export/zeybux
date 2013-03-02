<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2011
// Fichier : CompatibiliteFree.php
//
// Description : Page de compatibilité pour le server free
//
//****************************************************************

// Désactive les magic quotes
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}

// Création des equivalents json
if ( !function_exists('json_decode') ){
    function json_decode($content, $assoc=false){       
	require_once (CHEMIN_CLASSES_UTILS.'/JSON.php');
                if ( $assoc ){
                    $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        } else {
                    $json = new Services_JSON();
                }
        return $json->decode($content);
    }
}

if ( !function_exists('json_encode') ){
    function json_encode($content){
	require_once (CHEMIN_CLASSES_UTILS.'/JSON.php');
                $json = new Services_JSON;
        return $json->encode($content);
    }
}

?>
