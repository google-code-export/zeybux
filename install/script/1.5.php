<?php

$fp = fopen('../configuration/Titre.php', 'w');
fwrite($fp,"<?php\n");
fwrite($fp,"//****************************************************************\n");
fwrite($fp,"//\n");
fwrite($fp,"// Createur : Julien PIERRE\n");
fwrite($fp,"// Date de creation : 25/06/2011\n");
fwrite($fp,"// Fichier : Titre.php\n");
fwrite($fp,"//\n");
fwrite($fp,"// Description : Informations sur le Titre du site\n");
fwrite($fp,"//\n");
fwrite($fp,"//****************************************************************\n");
fwrite($fp,"define(\"ZEYBUX_TITRE_DEBUT\",\"\");\n");
fwrite($fp,"define(\"ZEYBUX_TITRE_FIN\",\"Zeybux \" . ZEYBUX_VERSION . \" - Outil de gestion\");\n");
fwrite($fp,"define(\"ZEYBUX_TITRE_SITE\", \"Les Amis du ZEYBU\");\n");
fwrite($fp,"define(\"ZEYBUX_ADRESSE_SITE\", \"http://marche.lesamisduzeybu.fr\");\n");
fwrite($fp,"?>\n");
fclose($fp);

// Ajout du fichier de config du proprietaire
$fp = fopen('../configuration/Proprietaire.php', 'a');
fwrite($fp,"<?php\n");
fwrite($fp,"define(\"PROP_RESP_MARCHE_NOM\", \"VIOLETTE\");\n");
fwrite($fp,"define(\"PROP_RESP_MARCHE_PRENOM\", \"Chantal\");\n");
fwrite($fp,"define(\"PROP_RESP_MARCHE_POSTE\", \"Responsable Zeybu Marché\");\n");
fwrite($fp,"define(\"PROP_RESP_MARCHE_TEL\", \"06 34 68 46 87\");\n");
fwrite($fp,"?>\n");
fclose($fp);

?>