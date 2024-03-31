<html>
<body>
<style>
ul,#myul
{
  list-style-type:none;
}
#myul
{
  margin:0;
  padding:0;
}
.caret{
  cursor:pointer;
  user-select:none;
}
.caret::before{
  content: "\002B";
  color:black;
  display: inline-block;
  margin-right:6px;
  font-weight:bold;
  font-size:24px;
  
}
.caret-down::before{
  content: "\002D";
  font-weight:bold;
  font-size:24px;
  
}
.nested
{
  display:none;
}
.active
{
  display:block;
}

</style>
<?php
//include("../mktg/conn.php");
include ("tennis_conn.php");
include("lib_func.php");
ini_set('display_errors',0);
global $sl,$nam,$nam_global;
$sl=0;
$nam="";
$fin_yr="2022-2023";
$tab="";
$tab .='<ul id="myul">';
$tab .='<li> <span class="caret"><font size="6" color="blue">Monthly Reco</font></span>';
$tab .= '<ul class="nested">';
    echo $tab;
     mysql_connect("$host:$port","$dbUser","$dbPassword") or die("Could not connect to the database!");
     mysql_select_db($database);
     $sql_stmt = "select * from m_param where typ = 'MON-RECO' and stat = '0' ";
	 $rs_rec = mysql_query ($sql_stmt);
     $r_rec = mysql_fetch_array($rs_rec);
	 
	 while ($r_rec)
	 {
	   $nam = $fin_yr."_MON-RECO_".$r_rec[cd];
	  	 $tab = '<li><a style="cursor:pointer;" onclick="window.open(\'upload_12.php?nam='.$nam.'&typ='.$r_rec[des].'\')">'.$r_rec[des].'</a></li>';
	  echo $tab;
	  //echo $r_rec[des]."<br>";
	  $r_rec = mysql_fetch_array($rs_rec);
	 }
	 $sql_stmt = "select * from m_param where typ = 'MON-RECO' and stat = '1' ";
	 $rs_rec = mysql_query ($sql_stmt);
     $r_rec = mysql_fetch_array($rs_rec);
	 
	 while ($r_rec)
	 {
	   $tab= '<li><span class="caret">'.$r_rec[des].'</span>';
		$tab.= '<ul class="nested">';
		echo $tab;
	   $nam_global = $fin_yr."_MON-RECO_";
	   
	   ff($r_rec[cd]);
	   $tab="";
	   
	 
	   for ($i=0;$i<=$sl;$i++)
	   {
	    $tab .= "</ul></li>";
       }
       echo $tab;
       $sl=0;
       $nam="";
	  $r_rec = mysql_fetch_array($rs_rec);
	 }
	 function ff($cd)
	 {
	   include ("tennis_conn.php");
	   global $sl,$nam_global,$nam;
	   
	 $nam = $nam_global.$cd."_";  
	 mysql_connect("$host:$port","$dbUser","$dbPassword") or die("Could not connect to the database!");
     mysql_select_db($database);
     $ssql_stmt = "select count(*)cnt from m_param where typ = '$cd' and stat = '0' ";
   
	 $rrs_rec = mysql_query ($ssql_stmt);
     $rr_rec = mysql_fetch_array($rrs_rec);
	 if ($rr_rec[cnt] > 0)
	 {
	 	$ssql_stmt = "select * from m_param where typ = '$cd' and stat = '0' ";
		$rrs_rec = mysql_query ($ssql_stmt);
     	$rr_rec = mysql_fetch_array($rrs_rec);
	 	while ($rr_rec)
	 	{    
	 	  	 $nam .= $rr_rec[cd]; 
	  	     $tab = '<li><a style="cursor:pointer;" onclick="window.open(\'upload_12.php?nam='.$nam.'&typ='.$rr_rec[des].'\')">'.$rr_rec[des].'</a></li>';
	  		 echo $tab;
			
	  	$rr_rec = mysql_fetch_array($rrs_rec);
	    }
		$nam = $nam_global;	  	
	}
	$ssql_stmt = "select count(*)cnt from m_param where typ = '$cd' and stat = '1' ";
    
	 $rrs_rec = mysql_query ($ssql_stmt);
     $rr_rec = mysql_fetch_array($rrs_rec);
	 if ($rr_rec[cnt] > 0)
	{
	 $sssql_stmt = "select * from m_param where typ = '$cd' and stat = '1' ";

	 $rrrs_rec = mysql_query ($sssql_stmt);
     $rrr_rec = mysql_fetch_array($rrrs_rec);
	 
	 while ($rrr_rec)
	 {
	   $sl++;
	   $nam .= $rrr_rec[cd]."_";
	   $tab= '<li><span class="caret">'.$rrr_rec[des].'</span>';
		$tab.= '<ul class="nested">';
		echo $tab;
	 
	  
	  ff($rrr_rec[cd]);
	  $rrr_rec = mysql_fetch_array($rrrs_rec);
	 } 
	}
	
	}
?>	
		<script >
var toggler=document.getElementsByClassName("caret");
var i = 0;
for(i=0;i<toggler.length;i++)
{
  toggler[i].addEventListener("click",function()
  {
  	this.parentElement.querySelector(".nested").classList.toggle("active");
	this.classList.toggle("caret-down");
	  
  }
  );
  
}

</script>
</body>
</html>		