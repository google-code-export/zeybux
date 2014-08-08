<?php
header("content-type: application/x-javascript; charset=UTF-8");
$filename = "./classes/utils/MessagesErreurs.js";
echo file_get_contents($filename);

$filename = "./Configuration/Configuration.js";
echo file_get_contents($filename);
?>