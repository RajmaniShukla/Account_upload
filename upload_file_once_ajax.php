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
<?php
//ini_set('display_errors',0);
echo "<p align = right><a href='aweil_upl_dwl_menu.php'>Main-Menu  </a> <a href='aweil_fa_logout.php'>Logout</a></p>";
?>
<html>
<body>
<form name="e"  enctype="multipart/form-data">
<?php
//ini_set('display_errors',0);
$nam = $_POST['nam'];
$sl=0;
$nam1 = $nam."_rs";
$nam2 = $nam."_sg";
$nam3 = $nam."_ch";
$nam4 = $nam."_ot";
$tab ="<table>";
$tab.="<tr><th colspan=4 width=100% align='center'> List of Files Uploaded for Financial Year ".substr($nam,0,9)." for ".$nam."</th></tr>";
$tab.="<tr>
			<th width=10%>Sl No.</th>
			<th width=10%>Type</th>
			<th>Original Name</th>
			<th>Transformed File Name</th>
			</tr>	";
$url = "audit_files/";	

	
	if (isset($_FILES[$nam1]))
	{
	  $filename = $_FILES[$nam1]["name"];
	$tf1 = $filename;
	$filedata = $_FILES[$nam1]["tmp_name"];
	$filesize = $_FILES[$nam1]["size"];
	$ext = pathinfo($_FILES[$nam1]['name'],PATHINFO_EXTENSION);
	
	if (!empty($tf1))
	{	
	  	$sl++;
	    $filename = $nam1.".".$ext;
		move_uploaded_file($filedata,$url.$filename);
		ins_data($nam,'ALL','Reco-Sheet',$tf1,$filename);
		$tab.="<tr><td width=10%>".$sl."</td><td>Reco-Sheet</td><td>".$tf1."</td>
		<td>".$filename."</td>		</tr>";
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
		ins_data($nam,'ALL','Signed-PDF',$tf2,$filename);
		$tab.="<tr><td width=10%>".$sl."</td><td>Signed PDF</td><td>".$tf2."</td>
		<td>".$filename."</td>		</tr>";
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
	  		$sl++;
	  		$filename = $nam3.".".$ext;
			move_uploaded_file($filedata,$url.$filename);
			ins_data($nam,'ALL','Challan',$tf3,$filename);
			$tab.="<tr><td width=10%>".$sl."</td><td>Challan</td><td>".$tf3."</td>
		<td>".$filename."</td>		</tr>";
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
	  	$sl++;	
	  	$filename = $nam4.".".$ext;
		move_uploaded_file($filedata,$url.$filename);
		ins_data($nam,'ALL','Other-Docs',$tf4,$filename);
		$tab.="<tr><td width=10%>".$sl."</td><td>Other Docs</td><td>".$tf4."</td>
		<td>".$filename."</td>		</tr>";
	}
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



	echo "File Uploaded";
	
?>
</body>
</form>