<?php
//ini_set('display_errors',0);
$fin_yr = substr($_GET['nam'],0,9);
$typ = substr($_GET['nam'],10); 
$tab= "<table class=\"tab\">";
$tab.="<tr><th colspan=5 width=100% align='center'> FILE UPLOADING OF ".$typ." for Financial Year ".$fin_yr."</th></tr>";
$tab.="<tr><th>Upload</th>
		<th>Reco-Sheet(Excel)</th>
		<th>Signed Pdf</th>
		<th>Challan</th>
		<th>Other Document</th>";
	$inp_typ1 = "Uploaded";
	$inp_typ2 = "Uploaded";
	$inp_typ3 = "Uploaded";
	$inp_typ4 = "Uploaded";
	$id1 = $_GET['nam']."_"."rs";
	$id2 = $_GET['nam']."_"."sg";
	$id3 = $_GET['nam']."_"."ch";
	$id4 = $_GET['nam']."_"."ot";
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
	$tab.='<tr><td><a style="cursor:pointer;" onclick="upl_once(\''.$_GET['nam'].'\')"><img src="upload.png" width="50" height = "30"></img><br><span id = "span-'.$_GET['nam'].'"></span></a></td>
			<td>'.$inp_typ1.'</td>
			<td>'.$inp_typ2.'</td>
			<td>'.$inp_typ3.'</td>
			<td>'.$inp_typ4.'</td></tr>';
$tab.= '</table>';
echo $tab;
function check_files($m_pattern,$fin_yr)
{
  include("tennis_conn.php");
 $con = mysqli_connect("$host","$dbUser","$dbPassword","$database");

     $sql_stmt = "select * from m_upload where fin_yr = '".$fin_yr."' and f_name like '".$m_pattern."%' and stat_cd = 0";
	
	 $rs_rec = mysqli_query ($con,$sql_stmt);
     $r_rec = mysqli_fetch_assoc($rs_rec);
     $rem="";
     if ($r_rec)
     {
	  	  
	   $rem="Y";
	 }
	 else
	 {
	   
	   $rem = "N";
	}

     return $rem;
}
		?>
