<?php
session_start();
require_once("./identifiants.php");
if(isset($_POST['login']) && isset($_POST['pass']) ){
	if($_POST['login'] === LOGIN && md5($_POST['pass']) === PASS) {
		session_unset();
		$_SESSION['cx'] = 1;
	}
}
header('Location: ../index.php');
?>
