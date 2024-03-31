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
//echo $_SESSION['usr_per']," ",$_SESSION["IN_SESSION"]," ",$_SESSION["ADMIN"];
 ?>
<html>
<body>
<link rel="stylesheet" href="upload_css.css">

<?php
/*
include("aweil_sessionHandler.php");
include("aweil_upl_chkAuthenticity.php");
$usr= $_SESSION['username'];
*/
//$usr = '818127';
echo '<p align = right><a style="cursor:pointer;" onclick="window.close()">Close Window</a></p>';
?>
<input type='hidden' name='usr' id ='usr' value='<?php echo $usr;?>'></td></tr>
<html>
<head>

</head>
	<title>AWEIL File Upload Download</title>

<body >

<form id='upl_dwl'  name = 'upl_dwl' method='POST' action ="upload_multiple.php" enctype="multipart/form-data">
<div class ="heading">
<h1> FILE UPLOAD & DOWNLOAD</h1>
</div>
<input type='hidden' name='nam' id ='nam' value='<?php echo $_GET['nam'];?>'>
<?php
//ini_set('display_errors',0);
//echo "<p ><font color=red>Here we will see the tabular structure of upload of $_GET[typ] File name passed on from previous page : $_GET[nam]</p>";

include ("tennis_conn.php");
include("lib_func.php");

$fin_yr = substr($_GET['nam'],0,9);

$tab= "<table>";
$tab.="<tr><th colspan=5 width=100% align='center'> FILE UPLOADING OF ".$_GET['typ']." for Financial Year ".$fin_yr."</th></tr>";
$tab.="<tr><th>Month</th>
		<th>Reconciliation Sheet(Excel)</th>
		<th>Signed Pdf</th>
		<th>Challan</th>
		<th>Other Document</th></tr>";

$yy = 2024;
$mon = 3;
while(true)
{
  $mon++;
  if ($mon == 13)
  	{
    	$mon = 1;
    	$yy++;
	}
	$inp_typ1 = "Uploaded";
	$inp_typ2 = "Uploaded";
	$inp_typ3 = "Uploaded";
	$inp_typ4 = "Uploaded";
	$dt = str_pad($yy,4,"0",STR_PAD_LEFT)."-".str_pad($mon,2,"0",STR_PAD_LEFT)."-01";
	$mmm = date('M',strtotime($dt));
	$id1 = $_GET['nam']."_".$mmm."_rs";
	$id2 = $_GET['nam']."_".$mmm."_sg";
	$id3 = $_GET['nam']."_".$mmm."_ch";
	$id4 = $_GET['nam']."_".$mmm."_ot";
	$kk = check_files($id1,$fin_yr);
	if ($kk == "N")
	$inp_typ1 = "<input type='file' id = '".$id1."' name = '".$id1."'>";
	$kk = check_files($id2,$fin_yr);
	if ($kk == "N")
	$inp_typ2 = "<input type='file' id = '".$id2."' name = '".$id2."'>";
	$kk = check_files($id3,$fin_yr);
	if ($kk == "N")
	$inp_typ3 = "<input type='file' id = '".$id3."' name = '".$id3."'>";
	$kk = check_files($id4,$fin_yr);
	if ($kk == "N")
	$inp_typ4 = "<input type='file' id = '".$id4."' name = '".$id4."'>";
	$tab.="<tr><td>".$mmm."</td>
		<td >".$inp_typ1."</td>
		<td>".$inp_typ2."</td>
		<td>".$inp_typ3."</td>
		<td>".$inp_typ4."</td></tr>";
 if ($mon == 3)
 break;
}		
$tab.= "</table>";
echo $tab;
function check_files($m_pattern,$fin_yr)
{
  include("tennis_conn.php");
     $con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
     $sql_stmt = "select * from m_upload where fin_yr = '".$fin_yr."' and f_name like '".$m_pattern."%' and stat_cd = 0";
	// echo $sql_stmt,"<br>";
	 $rs_rec = mysqli_query ($con,$sql_stmt);
     $r_rec = mysqli_fetch_assoc($rs_rec);
     $rem="";
     if ($r_rec)
     {
	  $rem = "Y";	  
	   
	 }
	 else
	 {
	   
	   $rem = "N";  
	}

     return $rem;
}
		?>
		<p>
<div class="form-submit-btn">
<input type="submit" value="UPLOAD" name = "sub" >
</div>