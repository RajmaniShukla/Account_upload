<?php
session_start();
if (! $_SESSION["IN_SESSION"]) {
	header("Location: aweil_fa_login.php");
        exit;
      }
    ini_set('display_errors',0);
include_once('tennis_conn.php');
$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
$user = $_SESSION['usr_per'];
 ?>
<?php
//ini_set('display_errors',0);
include("tennis_conn.php");
$val = $_GET['nam'];
$arr = explode("|",$val);
$url = "audit_files/";	
$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");

$tab= "<table class=\"tab\">";
$tab.="<tr><th  width=100% align='center'> Following Files Are Deleted from System</th></tr>";
for ($i=0;$i<count($arr);$i++)
{
  
$url1 = $url.$arr[$i];
	unlink($url1);
  $del_stmt = "delete from m_upload where f_name = '".$arr[$i]."'";

  $del_stmt = mysqli_query($con,$del_stmt); 
	$tab.='<tr><td>'.$arr[$i].'</td></tr>';
}
$tab.= '</table>';
echo $tab;
?>