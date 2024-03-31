<html>
<body>
<form name="e"  enctype="multipart/form-data">
<?php
ini_set('display_errors',0);
$fac_name='105';
$url = "audit_files/";	
$val=$_POST[val];
//if (isset($_FILES['2caih_file'])) {
  
	$filename = $_FILES["caih_file"]["name"];

	$filedata = $_FILES["caih_file"]["tmp_name"];

	$filesize = $_FILES["caih_file"]["size"];

	$ext = pathinfo($_FILES['caih_file']['name'],PATHINFO_EXTENSION);

	if (isset($filename))
	{	
	echo $val."-ss-".$filename;
		move_uploaded_file($filedata,$url.$filename);
	}
//if (isset($_FILES['2cih_file'])) {
	$filename = $_FILES["cih_file"]["name"];

	$filedata = $_FILES["cih_file"]["tmp_name"];

	$filesize = $_FILES["cih_file"]["size"];

	$ext = pathinfo($_FILES['cih_file']['name'],PATHINFO_EXTENSION);
	
		
			if (isset($filename))
	{	
	echo $filename;
		move_uploaded_file($filedata,$url.$filename);
	}
		

	//}
	echo "d";
	
?>
</body>
</form>