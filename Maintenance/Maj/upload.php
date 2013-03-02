<?php
$lUploadOk = false;
$dossier = DOSSIER_UPLOAD;
$fichier = basename($_FILES['avatar']['name']);
$taille_maxi = 10000000;
$taille = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.tar.gz');
$extension = strrchr(substr($_FILES['avatar']['name'], 0, strlen($_FILES['avatar']['name'])-3 ), '.') . strrchr($_FILES['avatar']['name'], '.');

$lRetour = '<br/><br/><a id="lien_btn_fermer_acces" href="./index.php?m=Maj&amp;e=21">
			<button class="com-btn-edt ui-state-default ui-corner-all com-button com-center">Retour</button>
		</a>';

//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type .tar.gz';
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
		echo 'Upload effectué avec succès.<br/><br/>';
		$lUploadOk = true;
     }
     else //Sinon (la fonction renvoie FALSE).
     {
		echo 'Echec de l\'upload.';
     echo $lRetour;
     }
}
else
{
     echo $erreur;
     echo $lRetour;
}
?>
