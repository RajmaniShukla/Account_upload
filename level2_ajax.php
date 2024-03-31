<?php
include ("tennis_conn.php");
ini_set('display_errors',0);
$typ = $_GET[typ];
$lvl = $_GET[lvl];
$n_lvl = $lvl++;
$typ_nam = "typ_".$typ.$lvl;
$typ_span = "typ_".$typ;
 mysql_connect("$host:$port","$dbUser","$dbPassword") or die("Could not connect to the database!");
 mysql_select_db($database);
$sql_stmt = "select count(*)cnt from m_param where typ = '$typ' ";
//echo $sql_stmt;
	 $rs_rec = mysql_query ($sql_stmt);
     $r_rec = mysql_fetch_array($rs_rec);   
     $cnt = $r_rec[cnt];
     if ($cnt == "") $cnt = 0;
     if ($cnt > 0)
     {
$sel="<label for ='$typ_nam'> Type </label><select id='$typ_nam' name='$typ_nam' onchange=\"level1(this.value,'$n_lvl','$typ_span')\">";
$sel.="<option value = 'S'>--Select Type--</option>";	
     $sql_stmt = "select * from m_param where typ = '$typ'  order by cd ";
	 $rs_rec = mysql_query ($sql_stmt);
     $r_rec = mysql_fetch_array($rs_rec);
	 
	 while ($r_rec)
	 {
		  $sel .= "<option   value = '$r_rec[cd]'> $r_rec[des] </option>";
	  $r_rec = mysql_fetch_array($rs_rec);
	 }
	 $sel .= "</select>";
	 $sel .= "<p><div class=\"user-input-box1\"><span id = '$typ_span'></span></div></p>";

	 echo $sel;
   }
	else
	{
     $sql_stmt = "select * from m_param where cd = '$typ'";
     //echo $sql_stmt;
	 $rs_rec = mysql_query ($sql_stmt);
     $r_rec = mysql_fetch_array($rs_rec);
	 echo "0-".$r_rec['stat'] ;
	  
	}
?>