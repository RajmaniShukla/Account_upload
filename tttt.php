<?php
ini_set('display_errors',0);
include("tennis_conn.php");
mysql_connect("$host:$port","$dbUser","$dbPassword") or die("Could not connect to the database!");
mysql_select_db($database);
global $fy_name;
$typ = "2021-2022_MON-RECO";
$zip_file = $fy_name."-".$typ.".zip";
//echo $zip_file,"<br>";
if (file_exists($zip_file))
{
  unlink($zip_file);
}
touch($zip_file);
$zip = new ZipArchive;

$fin_yr = "2021-2022";
$dir_loc = "audit_files/";
$zip->open($zip_file,ZipArchive::CREATE);

  $dir_stmt = "select distinct cd from m_upload where fin_yr = '$fin_yr' and stat_cd = '0' order by cd desc";
  echo $dir_stmt,"<br>";
  $rs_rec = mysql_query ($dir_stmt);
  $r_rec = mysql_fetch_array($rs_rec);
  while($r_rec)
  {
    
  $dir = $r_rec[cd];
  
  $mon_stat = "N";
  $pattern = '/_MON-RECO/i';
  if (preg_match($pattern,$dir)==1)
    $mon_stat = "Y";
  $dir1 = file_name_filter($dir);	  
  if ($mon_stat == "N")
  {  
	$dir__stmt = "select * from m_upload where fin_yr = '$fin_yr' and cd = '$dir' and stat_cd = '0'";
    $rs__rec = mysql_query ($dir__stmt);
    $r__rec = mysql_fetch_array($rs__rec);
  	while($r__rec)
  	{
  	
  	  	$file_name_with_path = $dir_loc.$r__rec[f_name];
  	    $file_name_zip_path =  $dir1."/".$r__rec[f_name];
  	    echo $file_name_with_path,"<br>";
  	    echo $file_name_zip_path,"<br>";
  	    $zip->addFile($file_name_with_path,$file_name_zip_path);
  		$r__rec = mysql_fetch_array($rs__rec);
  	}
  	
  	$r_rec = mysql_fetch_array($rs_rec);
   }

  
  else
  {
	$dir__stmt = "select distinct cd from m_upload where fin_yr = '$fin_yr' and cd = '$dir' and stat_cd = '0'";
    $rs__rec = mysql_query ($dir__stmt);
    $r__rec = mysql_fetch_array($rs__rec);
    while($r__rec)
  	{
    	$dir___stmt = "select distinct mnth from m_upload where fin_yr = '$fin_yr' and cd = '$dir' and stat_cd = '0'";
	    $rs___rec = mysql_query ($dir___stmt);
    	$r___rec = mysql_fetch_array($rs___rec);
  		while($r___rec)
  		{
  		$mnth = $r___rec[mnth];
  			$dir____stmt = "select * from m_upload where fin_yr = '$fin_yr' and cd = '$dir' and mnth = '$mnth' and stat_cd = '0'";
	    	$rs____rec = mysql_query ($dir____stmt);
    		$r____rec = mysql_fetch_array($rs____rec);
  			while($r____rec)
  			{
  	  			echo "saikat:",$r___rec[mnth],"<br>";
				$file_name_with_path = $dir_loc.$r____rec[f_name];
		  	    $file_name_zip_path =  $dir1."/".trim($mnth)."/".$r____rec[f_name];
  	    		echo $file_name_with_path,"<br>";
		  	    echo $file_name_zip_path,"<br>";
  	    		$zip->addFile($file_name_with_path,$file_name_zip_path);
  	    		$r____rec = mysql_fetch_array($rs____rec);	
  	    	}	
  		$r___rec = mysql_fetch_array($rs___rec);
  		}
  	   $r__rec = mysql_fetch_array($rs__rec);
  	 }
  	$r_rec = mysql_fetch_array($rs_rec);
  	}
   }

  	
$zip->close();
if (file_exists($zip_file))
{ 
  header('Content-type: application/zip');
  header('Content-Disposition: attachment; filename="'.$zip_file.'"');
  readfile($zip_file);
  unlink($zip_file);
 }     
function file_name_filter($nam)
{
  include("tennis_conn.php");
  global $fy_name;
  $dir1 = $fy_name."-".$nam;
  $pattern = '/_MON-RECO/i';
  $dir1 = preg_replace($pattern,'',$dir1);
  $pattern = '/_/i';
  $dir1 = preg_replace($pattern,'',$dir1);

  return $dir1;
}
/*
	    
$dir = "2021-2022_MON-RECO_IT-TDS_194C";
$zip -> addEmptyDir($dir);
$file1 = "audit_files/2021-2022_MON-RECO_194H_194H1_Jun_sg.docx";
$file2 = "audit_files/2021-2022_MON-RECO_194H_194H1_Apr_rs.docx";
$file11 = $dir."/2021-2022_MON-RECO_194H_194H1_Jun_sg.docx"; 
$file22 = $dir."/2021-2022_MON-RECO_194H_194H1_Apr_rs.docx";


   $zip->addFile($file1,$file11);
   $zip->addFile($file2,$file22); 
  
   
  
 $dir = "2021-2022_MON-RECO_IT-TCS_206CIH";
  $zip -> addEmptyDir($dir);
  
$file1 = "audit_files/2021-2022_MON-RECO_IT-TCS_206C(I)H_Jun_sg.xlsx";
$file2 = "audit_files/2021-2022_MON-RECO_IT-TCS_206C(I)H_Sep_sg.pdf";
$file11 = $dir."/2021-2022_MON-RECO_IT-TCS_206C(I)H_Jun_sg.xlsx"; 
$file22 = $dir."/2021-2022_MON-RECO_IT-TCS_206C(I)H_Sep_sg.pdf";

   $zip->addFile($file1,$file11);
   $zip->addFile($file2,$file22); 
*/  

//}

 

/*
if (file_exists($zip_file))
{
  header('Content-type: application/zip');
  header('Content-Disposition: attachment; filename="'.$zip_file.'"');
  readfile($zip_file);
  unlink($zip_file);
}
*/
?>