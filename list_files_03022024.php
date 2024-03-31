<?php
ini_set('display_errors',0);
include("tennis_conn.php");
$nam = $_GET[nam];

$fin_yr = substr($nam,0,9);
$nam_rest = substr($nam,10);
$nam_rest = preg_replace ('/_/','-',$nam_rest);


 mysql_connect("$host:$port","$dbUser","$dbPassword") or die("Could not connect to the database!");
     mysql_select_db($database);
     $sql_stmt = "select count(*)cnt from m_upload where fin_yr = '$fin_yr' and f_name like '".$nam."%' and stat_cd = '0'";
     //echo $sql_stmt;
	 $rs_rec = mysql_query ($sql_stmt);
     $r_rec = mysql_fetch_array($rs_rec);
     $cnt=$r_rec[cnt];
     if ($cnt == 0)
     {
       $tab= "0-<table>";
       $tab.="<tr><th colspan=4 width=100% align='center'> List of Files for Financial Year ".substr($nam,0,9)." for $nam_rest</th></tr>";

		$tab.="<tr><td colspan=4 width=100% align='center'><em><font color='red'> No Files Against This Type!!Sorry</font></em></td></tr>";
		
	 }
	 else
	 {
	    $tab= "1-<table>";
       $tab.="<tr><th colspan=4 width=100% align='center'> List of Files for Financial Year ".substr($nam,0,9)." for $nam_rest</th></tr>";

	   $tab.="<tr>
			<th width=10%>Sl No.</th>
			<th width=20%>Type</th>
			<th width=5%>Month</th>
			<th>File Name</th>
			</tr>	";
	 $sql_stmt = "select * from m_upload where fin_yr = '$fin_yr' and f_name like '".$nam."%' and stat_cd = '0'";
	 //echo $sql_stmt;
	 $rs_rec = mysql_query ($sql_stmt);
     $r_rec = mysql_fetch_array($rs_rec);
	 $sl=0;
	 while ($r_rec)
	 {
	   $sl++; 
	    $rem = '<input type = "checkbox" id = "'.$r_rec[f_name].'" name = "'.$r_rec[f_name].'" >';
		$tab.="<tr>
			<td width=10%>$rem $sl</td>
			<td width=20%>$r_rec[typ]</td>
			<td width=5%>$r_rec[mnth]</td>
			<td>$r_rec[f_name]</td>
			</tr>	";
	   
	 	$r_rec = mysql_fetch_array($rs_rec);  
	 } 
	 }
$tab.="</table>";
echo $tab;
?>