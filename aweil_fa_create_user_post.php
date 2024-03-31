<?php
session_start();
$sessid = session_id();
include_once('tennis_conn.php');
//include_once('lib_func.php');
//ini_set('display_errors',0);
extract($_POST);
global $fy_name;
 $con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
$stat=$_SESSION['stat'];
$user = $_POST['user'];
$_SESSION['usr_per'] = $user;

$stmt = "select * from m_user where user_per = '$user' ";
$rs_rec = mysqli_query ($con,$stmt);
$r_rec = mysqli_num_rows($rs_rec); 
echo $r_rec; 
//if ($r_rec[cnt] == "")  $r_rec[cnt] = 0;
if ($r_rec > 0)
{
   echo '<script>alert("ACCOUNT ALREADY EXISTS||");</script>';
        echo '<script>window.location.assign("aweil_fa_create_user.php");</script>';
       exit;
}
if ($stat == "D")
{
  //echo $pass," ",$re_pass;
if ($pass != $re_pass) 
{
        echo '<script>alert("PASSWORDS DONOT MATCH");</script>';
        echo '<script>window.location.assign("aweil_fa_create_user.php");</script>';
       exit;
}
else
{      
		$ins_stmt = "insert into m_user (user_per,user_name,user_role,user_unit,user_passwd)values 
          ('$user','$user_name','$user_role','$fy_name','$pass')";
          //echo $ins_stmt;
        $ins_stmt = mysqli_query($con,$ins_stmt); 
        	echo '<script>alert("DBA ACCOUNT Created SUCCESSFULLY");</script>';
        echo '<script>window.location.assign("aweil_fa_login.php");</script>';

}
}

if ($stat == 'U')
{
$stmt = "select * from m_user where user_role='DBA' and user_passwd='$pass'";
$rs_rec = mysqli_query ($con,$stmt);
$r_rec = mysqli_num_rows($rs_rec);  
if ($r_rec == 0)
{
  echo '<script>alert("INCORRECT DBA PASSWORD");</script>';
  echo '<script>window.location.assign("aweil_fa_create_user.php");</script>';
  exit;
}
else
{
  $pwd = md5("PASSWORD");  
  $ins_stmt = "insert into m_user (user_per,user_name,user_role,user_unit,user_passwd)values 
          ('$user','$user_name','$user_role','$user_unit','$pwd')";
        $ins_stmt = mysqli_query($con,$ins_stmt); 
        	echo '<script>alert("ACCOUNT Created SUCCESSFULLY with default Password");</script>';
        echo '<script>window.location.assign("aweil_fa_login.php");</script>';
}
}

  

?>
