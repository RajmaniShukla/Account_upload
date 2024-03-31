<?php
session_start();
$sessid = session_id();
ob_implicit_flush(true);
ob_end_flush();
//ini_set('display_errors',0);
include_once('tennis_conn.php');
include_once('lib_func.php');
$this_file = basename($_SERVER['PHP_SELF']);

extract($_POST);

if ($user == "") {
	echo "No User with this account Number! Sorry Retry!";
        echo "<a href='aweil_fa_login.php'>Login Page</a>";
	exit;
}
	$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
  	$ssql_stmt = "select * from m_user where user_per = '$user' and user_passwd = '$passwd'  ";
	 $rrs_rec = mysqli_query ($con,$ssql_stmt);
     $rr_rec = mysqli_fetch_assoc($rrs_rec);
	//echo $rr_rec['user_unit'];
if (!$rr_rec)
{
       echo '<script>alert("Not A Valid User Input!!Retry");</script>';
        echo '<script>window.location.assign("aweil_fa_logout.php");</script>';
       exit;
}

$def_passwd = md5("PASSWORD");
if ($rr_rec['user_passwd'] == $passwd)
 {
  //echo "ddd";  
	$_SESSION['usr_per'] = $user;
   	if ($rr_rec['user_passwd'] == $def_passwd)
   	{
   	  //echo "pp";
		//header("Location: aweil_fa_modify_user.php");
		echo '<script>window.location.assign("aweil_fa_modify_user.php");</script>';
	}
	
	
	 $_SESSION["IN_SESSION"] = true;
	echo '<script>window.location.assign("aweil_upl_dwl_menu.php");</script>';
	//header("Location: aweil_upl_dwl_menu.php");
}
else {
	echo "Sorry Login Again!";
	echo "<a href='aweil_fa_login.php'>Login Page</a>";
}
?>
