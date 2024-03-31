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
<form name="e"  enctype="multipart/form-data">
<?php
//ini_set('display_errors',0);
$nam = $_POST['nam'];
$tab= "<table>";
$nam_rest = substr($nam,10);
$nam_rest = preg_replace ('/_/','-',$nam_rest);
$tab.="<tr><th colspan=5 width=100% align='center'> List of Files Uploaded for Financial Year ".substr($nam,0,9)." for ".$nam_rest."</th></tr>";
$tab.="<tr>
			<th width=10%>Sl No.</th>
			<th width=10%>Type</th>
			<th width=5%>Month</th>
			<th>Original Name</th>
			<th>Transformed File Name</th>
			</tr>	";
$yy = 2024;
$mon = 3;
$url = "audit_files/";	
$sl=0;
while(true)
{

  $mon++;
  if ($mon == 13)
  	{
    	$mon = 1;
    	$yy++;
	}
	$dt = str_pad($yy,4,"0",STR_PAD_LEFT)."-".str_pad($mon,2,"0",STR_PAD_LEFT)."-01";
	$mmm = date('M',strtotime($dt));
	$nam1 = $nam."_".$mmm."_rs";
	$nam2 = $nam."_".$mmm."_sg";
	$nam3 = $nam."_".$mmm."_ch";
	$nam4 = $nam."_".$mmm."_ot";
	if (isset($_FILES[$nam1]))
	{
	$filename = $_FILES[$nam1]["name"];
	$tf1 = $filename;
	$filedata = $_FILES[$nam1]["tmp_name"];
	$filesize = $_FILES[$nam1]["size"];
	$ext = pathinfo($_FILES[$nam1]['name'],PATHINFO_EXTENSION);
	
	if (!empty($tf1))
	{	
	    $filename = $nam1.".".$ext;
	    $sl++;
		move_uploaded_file($filedata,$url.$filename);
		$tab.="<tr><td width=10%>".$sl."</td><td>Reco-Sheet</td><td>".$mmm."</td><td>".$tf1."</td>
		<td>".$filename."</td>		</tr>";
		ins_data($nam,$mmm,"Reco-Seet",$tf1,$filename);
	}
	}
	if (isset($_FILES[$nam2]))
	{
	$filename = $_FILES[$nam2]["name"];
	$tf2 = $filename;
	$filedata = $_FILES[$nam2]["tmp_name"];
	$filesize = $_FILES[$nam2]["size"];
	$ext = pathinfo($_FILES[$nam2]['name'],PATHINFO_EXTENSION);
	
	if (!empty($tf2))
	{	
	
	   	$sl++;
	    $filename = $nam2.".".$ext;
		move_uploaded_file($filedata,$url.$filename);
		$tab.="<tr><td width=10%>".$sl."</td><td>Signed PDF(s)</td><td>".$mmm."</td><td>".$tf2."</td>
		<td>".$filename."</td>		</tr>";
		ins_data($nam,$mmm,"Signed-PDF",$tf2,$filename);
	}
	}
	if (isset($_FILES[$nam3]))
	{
	$filename = $_FILES[$nam3]["name"];
	$tf3 = $filename;
	$filedata = $_FILES[$nam3]["tmp_name"];
	$filesize = $_FILES[$nam3]["size"];
	$ext = pathinfo($_FILES[$nam3]['name'],PATHINFO_EXTENSION);
	
	if (!empty($tf3))
	{	
		$filename = $nam3.".".$ext;
	    $sl++;
		move_uploaded_file($filedata,$url.$filename);
		$tab.="<tr><td width=10%>".$sl."</td><td>Challans</td><td>".$mmm."</td><td>".$tf3."</td>
		<td>".$filename."</td>		</tr>";
		ins_data($nam,$mmm,"Challan",$tf3,$filename);
	}
	}
	

	if (isset($_FILES[$nam4]))
	{
	$filename = $_FILES[$nam4]["name"];
	$tf4 = $filename;
	$filedata = $_FILES[$nam4]["tmp_name"];
	$filesize = $_FILES[$nam4]["size"];
	$ext = pathinfo($_FILES[$nam4]['name'],PATHINFO_EXTENSION);
	
	if (!empty($tf4))
	{	
		$filename = $nam4.".".$ext;
	  	$sl++;
		move_uploaded_file($filedata,$url.$filename);
		$tab.="<tr><td width=10%>".$sl."</td><td>Other Docs</td><td>".$mmm."</td><td>".$tf4."</td>
		<td>".$filename."</td>		</tr>";
		ins_data($nam,$mmm,"Other-Docs",$tf4,$filename);
	}
	}	
 if ($mon == 3)
 break;
}		

$tab.="</table>";
echo $tab;
function ins_data($nam,$mnth,$typ,$org_f_name,$f_name)
{
  include("tennis_conn.php");
 $con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
  $fin_yr = substr($nam,0,9);
  $org_f_name = preg_replace('/[\x00-\x1F\x7F]/','',$org_f_name);
  $ins_stmt = "insert into m_upload (fin_yr,mnth,typ,cd,f_name,org_f_name,stat_cd,upload_user,upload_dt_time)
  values ('".$fin_yr."','".$mnth."','".$typ."','".$nam."','".$f_name."','".$org_f_name."','0','".$_SESSION['usr_per']."',now())";
  $ins_stmt = mysqli_query($con,$ins_stmt); 
}
?>
<p>
<div class="form-submit-btn">
<input type="button" value="Close Window" name = "sub" onclick="window.close()">
</div>
</body>
</form>