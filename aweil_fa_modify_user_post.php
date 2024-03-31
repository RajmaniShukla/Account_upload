<?php
session_start();
$sessid = session_id();
include_once('tennis_conn.php');
include_once('lib_func.php');
//ini_set('display_errors',0);
extract($_POST);

$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
$_SESSION['usr_per'] = $user;


$stmt = "select count(*)cnt from m_user where user_per='".$user."' ";
$rs_rec = mysqli_query ($con,$stmt);
$r_rec = mysqli_fetch_assoc($rs_rec);  
if (!$r_rec)
{
 
        echo '<script>alert("USER DOESNOT EXIST...Create User First");</script>';
        echo '<script>window.location.assign("aweil_fa_login.php");</script>';
       exit;
  
}

if ($new_pass != $re_pass) 
{
        echo '<script>alert("Password-Retype Passwords Mismatch ...Exiting");</script>';
        echo '<script>window.location.assign("aweil_fa_modify_user.php");</script>';
       exit;
}

$stmt = "select * from m_user where user_per='".$user."' and user_passwd='".$pass."'";
$rs_rec = mysqli_query ($con,$stmt);
$r_rec = mysqli_fetch_assoc($rs_rec);  
if ($pass != $r_rec['user_passwd'])
{
        echo '<script>alert("Invalid OLD Password ...Exiting");</script>';
        echo '<script>window.location.assign("aweil_fa_modify_user.php");</script>';
       exit;
}

	$upd_stmt = "update m_user set user_passwd = '".$new_pass."' where user_per = '".$user."' and user_passwd ='".$pass."' ";
    $ins_stmt = mysqli_query($con,$upd_stmt); 
    	session_destroy();
	session_unset();
	echo '<script>alert("ACCOUNT PASSWORD Modified SUCCESSFULLY");</script>';
        echo '<script>window.location.assign("aweil_fa_login.php");</script>';



?>
