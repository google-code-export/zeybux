<?php
session_start();
$jsonString = file_get_contents('../conf/identifiant.json');
$cIdentifiant = json_decode($jsonString);

if(isset($_POST['login']) && isset($_POST['pass']) ){
	if($_POST['login'] === $cIdentifiant->login && md5($_POST['pass']) === $cIdentifiant->pass) {
		session_unset();
		$_SESSION['cx'] = 1;
	}
}
header('location:../index.php');
?>
