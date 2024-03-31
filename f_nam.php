<?php
ini_set('display_errors',0);
include_once('tennis_conn.php');
mysql_connect("$host:$port","$dbUser","$dbPassword") or die("Could not connect to the database!");
mysql_select_db($database);
$user = $_GET[per];
  	$ssql_stmt = "select * from m_user where user_per = '$user'  ";
	 $rrs_rec = mysql_query ($ssql_stmt);
     $rr_rec = mysql_fetch_array($rrs_rec);
     if ($rr_rec)
     {
	   echo $rr_rec[user_name];
	}
	else
	{
	  echo "0";
	}
?>