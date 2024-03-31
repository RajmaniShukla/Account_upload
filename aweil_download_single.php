<?php
//ini_set('display_errors',0);
$typ = $_GET['nam'];
$file_loc = "audit_files/".$typ;

if (file_exists($file_loc))
{ 
  $ext = pathinfo($file_loc,PATHINFO_EXTENSION);
  header('Content-type: application/'.$ext.'');
  //header('Content-type: application/'.$ext.'');
  header('Content-Disposition: attachment; filename="'.$file_loc.'"');
  readfile($file_loc);
  
 }     

?>