<?php
require_once "./classes/utils/spyc.php";

//$Data = spyc_load_file('spyc.yaml');
//spyc_dump_file('spyc2.yaml',$Data);

//var_dump($Data2);
if(isset($_GET['titre'])) {
	echo $_GET['titre'];
	
?>	
	
<form action="" method="post">
	<input type="text" name="titre" value="<?php echo $_GET['titre']; ?>"/>
	
	<input type="submit" />
</form>
	
<?php 	
} else {
?>
<form action="" method="post">
	<input type="text" name="titre" />
	<input type="submit" />
</form>
<?php } ?>