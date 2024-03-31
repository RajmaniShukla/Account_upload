<?php
session_start();
if (! $_SESSION["IN_SESSION"]) {
	header("Location: aweil_fa_login.php");
        exit;
      }
    ini_set('display_errors',0);
include_once('tennis_conn.php');
mysql_connect("$host:$port","$dbUser","$dbPassword") or die("Could not connect to the database!");
mysql_select_db($database);
$user = $_SESSION['usr_per'];
//echo $_SESSION['usr_per']," ",$_SESSION["IN_SESSION"]," ",$_SESSION["ADMIN"];

 ?>
<?php
$dir_loc = $_GET[dir_loc];
$file_name = $_GET[f_n];
 $file_name_with_path = $dir_loc.$file_name;
  
   $ext = pathinfo($file_name,PATHINFO_EXTENSION);
  
   //header('Content-type: application/'.$ext.'');

 header('Content-type: application/octet-stream');
   header('Content-Disposition: attachment; filename="'.basename($file_name_with_path).'"');
   readfile($file_name_with_path);
   echo '<script>	window.close();</script>';
?> 