<?php
//ini_set('display_errors',0);
include("tennis_conn.php");
$nam = $_GET['nam'];

$fin_yr = substr($nam,0,9);
$nam_rest = substr($nam,10);
$nam_rest = preg_replace ('/_/','-',$nam_rest);


	$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
     $sql_stmt = "select count(*)cnt from m_upload where fin_yr = '".$fin_yr."' and f_name like '".$nam."%' and stat_cd = 0";
     //echo $sql_stmt;
	 $rs_rec = mysqli_query ($con,$sql_stmt);
     $r_rec = mysqli_fetch_assoc($rs_rec);
     $cnt=$r_rec['cnt'];
     if ($cnt == 0)
     {
       
       
$tab= "0-<table>";
       $tab.="<tr><th colspan=4 width=100% align='center'> List of Files for Financial Year ".substr($nam,0,9)." for ".$nam_rest."</th></tr>";

		$tab.="<tr><td colspan=4 width=100% align='center'><em><font color='red'> No Files Against This Type!!Sorry</font></em></td></tr>";

		
	 }
	 else
	 {
	   $tab= "1-<table class=\"tab\">";
$tab.="<tr><th colspan=4 width=100% align='center'> List of Files for Financial Year ".substr($nam,0,9)." for ".$nam_rest."</th></tr>";

$tab.="<tr>
		<th>Reco-Sheet</th>
		<th>Signed Pdf</th>
		<th>Challan</th>
		<th>Other Document</th>";
	$tab.="<tr>";
	$id1 = $nam."_"."rs";
	$id2 = $nam."_"."sg";
	$id3 = $nam."_"."ch";
	$id4 = $nam."_"."ot";
	$kk = chk_files($fin_yr,$id1);
	$tab .= $kk;
	$kk = chk_files($fin_yr,$id2);
	$tab .= $kk;
	$kk = chk_files($fin_yr,$id3);
	$tab .= $kk;
	$kk = chk_files($fin_yr,$id4);
	$tab .= $kk;
	
	 }
$tab.="</table>";
echo $tab;
function chk_files($fin_yr,$m_pattern)
{
  include("tennis_conn.php");
   $con = mysqli_connect("$host","$dbUser","$dbPassword","$database");

  $sql_stmt = "select * from m_upload where fin_yr = '".$fin_yr."' and f_name like '".$m_pattern."%' and stat_cd = 0";
	//echo $sql_stmt,"<br>"; 
	 $rs_rec = mysqli_query ($con,$sql_stmt);
     $r_rec = mysqli_fetch_assoc($rs_rec);
     $rem = "";
	 if ($r_rec)
     {
       
	 
	$f_name = '<a style="cursor:pointer;" onclick="window.open(\'aweil_download_single.php?nam='.$r_rec['f_name'].'\')">'.$r_rec['f_name'].'</a>';
	 
	   
	   $rem .= "<td nowrap>".$f_name."</td>";
	   
	}
	else
	{
	  
	  $rem = "<td> </td>";
	}
	return $rem;
}
?>