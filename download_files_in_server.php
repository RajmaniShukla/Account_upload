<?php 
ini_set('display_errors',0);
include("tennis_conn.php");
$file_name = $_GET[nam];
$val = $_GET[val];
$arr = explode("|",$file_name);
$url = "audit_files/";	
mysql_connect("$host:$port","$dbUser","$dbPassword") or die("Could not connect to the database!");
  mysql_select_db($database);

$tab= "<table class=\"tab\">";
$tab.="<tr><th  width=100% align='center' colspan=2> Following Files Are Downloaded from System in the Directory $val</th></tr>";
$tab.="<tr><th  width=90% align='center'> File Name</th><th  width=90% align='center'> Status</th></tr>";
for ($i=0;$i<count($arr);$i++)
{
 if ($arr[$i] != "")
 { 
	$url1 = $url.$arr[$i];
	if (file_exists($url1))
	{
		if (!is_dir($val))
		{
		  mkdir($val);
		}
		$download_file_name = $val."/".$arr[$i];
		file_put_contents($download_file_name,file_get_contents($url1));
		$tab.='<tr><td width=90%>'.trim($arr[$i]).'</td><td width=10%>Downloaded</td></tr>';
	  }
	
	else
	{
		$tab.='<tr><td width=90%>'.trim($arr[$i]).'</td><td width=10%>NotFound</td></tr>';
	}
 }
	
}
$tab.= '</table>';
echo $tab;
?>