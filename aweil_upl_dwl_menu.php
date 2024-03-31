<?php
session_start();
if (! $_SESSION["IN_SESSION"]) {
	header("Location: aweil_fa_login.php");
        exit;
      }
    //ini_set('display_errors',0);
include_once('tennis_conn.php');
$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
$user = $_SESSION['usr_per'];
  	$ssql_stmt = "select * from m_user where user_per = '$user' and user_role in( 'ADMIN','DBA')  ";
	 $rrs_rec = mysqli_query ($con,$ssql_stmt);
     $rr_rec = mysqli_fetch_assoc($rrs_rec);
     if ($rr_rec)
     {
	   $_SESSION["ADMIN"] = "Y";
	}
	else
	{
	  $_SESSION["ADMIN"] = "N";
	}
	$rem="";
if ($_SESSION["ADMIN"] == "Y")
{
  $rem = "<tr><td><a href= \"aweil_file_del.php\">File Deletion </a></td></tr>";
}

?>
<html>
<head>
<style>
*{
  margin:0px;
  padding:0;
  font-family:Consolas, Helvetica, sans-serif;
}
.mdiv{
   position:fixed;
  top : 50%;
  left : 50%;
  transform: translate(-50%,-50%);
  border-radius : 10%;
}
table{
  
  border:collapse:collapse;
  border-spacing:0;
  width:100%;
  border:1px solid #ddd;
  FONT-FAMILY: Consolas,sans-serif;
}
th{text-align:center;padding:8px;font-size:30px;}
td{text-align:center;padding:8px;font-size:25px;font-weight:bold;}
tr:nth-child(odd){background-color:#227447;color:#ffffff;font-weight:bold;}


tr:nth-child(odd) a{
  text-decoration:none;
  color:#ffffff;
}
tr:nth-child(even) a{
  text-decoration:none;
  color:#000000;
}
h2.login_info{
  text-align:center;
  background-color: #191970;
  color:#ffffff;
  font-weight: bold;
  padding:5px;
  font-size:28px;
}
</style>
</head>
<body>
<div class = "mdiv">
<?php
include ("tennis_conn.php");
global $fy_name;
?>

<table >
<tr><th nowrap><h2 class="login_info">Repository Maintenance :<?php echo $fy_name;?></th></h2></tr>
<tr><td><a href="aweil_upl.php" >File Upload</a></td></tr>
<tr><td><a href= "aweil_dwl.php">File Download (ZIP)  </a></td></tr>
<tr><td><a href= "aweil_dwl_selective_view.php">File Selective View </a></td></tr>
<?php echo $rem;?>
<tr><td> <a href= "aweil_fa_logout.php">Log Out </a></td></tr>
</table>

</div>

<body>
</html>
