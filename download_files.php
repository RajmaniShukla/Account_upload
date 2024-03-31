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
//echo "<p align = right><a href='aweil_upl_dwl_menu.php'>Main-Menu  </a> <a href='aweil_fa_logout.php'>Logout</a></p>";
 ?>
<html>
<body>
<link rel="stylesheet" href="upload_css.css">
<form name="e"  enctype="multipart/form-data">
<?php 
//ini_set('display_errors',0);
include("tennis_conn.php");
$file_name = $_GET['nam'];
$val = $_GET['val'];
$fin_yr = substr($val,0,9);
$arr = explode("|",$file_name);
$no_of_files = count($arr);
$no_of_files = $no_of_files - 1 ;

$url = "audit_files/";	
$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
$tab= "<table class=\"tab\">";
$tab.="<tr><th  width=100% align='center' colspan=2> Following Files Are Downloaded from System in the Directory $val</th></tr>";
$tab.="<tr><th  width=90% align='center'> File Name</th><th  width=90% align='center'> Status</th></tr>";

$sql_stmt = "select count(*)cnt from m_upload where fin_yr = '$fin_yr' and f_name like '$val%' and stat_cd = '0'";
//echo $sql_stmt;
$rs_rec = mysqli_query ($con,$sql_stmt);
$r_rec = mysqli_fetch_assoc($rs_rec);
if ($r_rec[cnt] == "") $r_rec['cnt'] = 0;
/*
echo $no_of_files." ".$r_rec[cnt];
exit;
*/
if($no_of_files == $r_rec['cnt'])
{
  $zip_file = $val.".zip";
  touch($zip_file);
  $zip = new ZipArchive;
  $this_zip = $zip->open($zip_file);
  $dir_loc = "audit_files/";
  $sql_stmt = "select * from m_upload where fin_yr = '$fin_yr' and f_name like '$val%' and stat_cd = '0'";
  $rs_rec = mysqli_query ($con,$sql_stmt);
  $r_rec = mysqli_fetch_assoc($rs_rec);
  while($r_rec)
  {
   $file_name = $r_rec['f_name'];
   $file_name_with_path = $dir_loc.$file_name;
   $zip->addFile($file_name_with_path,$file_name);
   $tab.='<tr><td width=90%>'.trim($r_rec['f_name']).'</td><td width=10%>Downloaded</td></tr>'; 
   $r_rec = mysqli_fetch_assoc($rs_rec); 
  }
  //$tab.= '</table>:'.$zip_file;
  $tab.= '</table>';
  $this_zip = $zip->close($zip_file);
 if (file_exists($zip_file))
{ 
  header('Content-type: application/zip');
  header('Content-Disposition: attachment; filename="'.$zip_file.'"');
  readfile($zip_file);
  unlink($zip_file);
 } 
//echo $tab;
}
else
{
  $dir_loc = "audit_files/";
  for($i=0;$i<$no_of_files;$i++)
  {
    
   $file_name = $arr[$i];
  
   echo '<script>window.open("download_once.php?dir_loc='.$dir_loc.'&f_n='.$file_name.'");</script>';
     $tab.='<tr><td width=90%>'.trim($file_name).'</td><td width=10%>Downloaded</td></tr>'; 
   
  }
  //$tab.= '</table>:'.$zip_file;
  $tab.= '</table>';
  //echo $tab;
 echo '<script>	window.close();</script>';
}

?>
<p>
<div class="form-submit-btn">
<input type="button" value="Close Window" name = "sub" onclick="window.close()">
</div>
</form>
</body>
</html>