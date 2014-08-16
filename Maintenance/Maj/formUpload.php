<form method="POST" action="./index.php?m=Maj&e=3" enctype="multipart/form-data">
     <!-- On limite le fichier à 10000Ko -->
     <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
     Fichier : <input type="file" name="avatar">
     <input type="submit" name="envoyer" value="Envoyer le package">
</form>
