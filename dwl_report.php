<html>
<body>
<link rel="stylesheet" href="upload_css.css">
<form name="e"  enctype="multipart/form-data">
<?php
ini_set('display_errors',0);
$tab = $_GET[val];
$arr = explode(":",$tab);
$tab=$arr[0];
$zip_file = $arr[1];
echo $zip_file;
if (file_exists($zip_file))
{ 
  header('Content-type: application/zip');
  header('Content-Disposition: attachment; filename="'.$zip_file.'"');
  readfile($zip_file);
  unlink($zip_file);
 } 

echo $tab;
?>
<p>
<div class="form-submit-btn">
<input type="button" value="Close Window" name = "sub" onclick="window.close()">
</div>
</body>
</form>