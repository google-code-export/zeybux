<?php
session_start();
if(isset($_POST['login']) && isset($_POST['pass']) ){
	if($_POST['login'] === "julien" && $_POST['pass'] === "zeybu") {
		session_unset();
		$_SESSION['cx'] = 1;
	}
}
header('Location: ./index.php');
?>
