<?php
session_start();
if(isset($_POST['login']) && isset($_POST['pass']) ){
	if($_POST['login'] === "julien" && md5($_POST['pass']) === "aa38021dc334a856cbdcb2af9ac4d739") {
		session_unset();
		$_SESSION['cx'] = 1;
	}
}
header('Location: ./index.php');
?>
