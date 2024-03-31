<?php
session_start();
$sessid = session_id();
//ob_implicit_flush(true);
//ini_set('display_errors',0);
//ob_end_flush();

	$_SESSION['usr_per'] = "X";
	$_SESSION["IN_SESSION"]=false;
	$_SESSION["ADMIN"]=false;
	unset($_SESSION['WHOIS']);
	unset($_SESSION["IN_SESSION"]);
	unset($_SESSION["ADMIN"]);
	header("Location: aweil_fa_login.php");
?>