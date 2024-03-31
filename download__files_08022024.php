<html>
<body>
<link rel="stylesheet" href="upload_css.css">
<script type="text/javascript">
function dwl_func(val)
{
  var arr="";
  //alert(val);
  if (confirm("Sure to Download the Selected File(s)")==true)
  {
  var len = val.length;  
  var f = 'upl_dwl';
  var ele = document.forms[f].elements;
  var sl = 0;
  for (var i=0;i< ele.length;i++)
  {
  	if (ele[i].type == 'checkbox')
  	{
  	  if (ele[i].checked == true)
  	  {
  	    
  	    var tt = ele[i].id;
		//alert(val);
  	    //alert(tt);
  	    
  	    
		
			if(sl==0)
			{
			  	arr = tt+"|";
			}
			else
			{
				arr = arr+tt+"|";
			}
			sl++;
			

      }    	
	}
   }
   if (sl==0)
   {
     alert("No Files Are Selected for Download!!Select Files!!!!");
     return false;
	}
//   alert(arr);
   window.open("download_files.php?nam="+arr+"&val="+val);
  }
}
function sel_func(val)
{
  var arr="";
  
  var len = val.length;  
  var f = 'upl_dwl';
  var ele = document.forms[f].elements;
  var sl = 0;
  for (var i=0;i < ele.length;i++)
  {
  	if (ele[i].type == 'checkbox')
  	{
  	  
  	    
  	    var tt = ele[i].id;
		//alert(val);
  	    //alert(tt);
  	    
  	    
		
			ele[i].checked = true;
			
	}
   }
 
}
function del_func(val)
{
  var arr="";
  if (confirm("Sure to Delete the Selected File(s)")==true)
  {
  var len = val.length;  
  var f = 'upl_dwl';
  var ele = document.forms[f].elements;
  var sl = 0;
  for (var i=0;i < ele.length;i++)
  {
  	if (ele[i].type == 'checkbox')
  	{
  	  if (ele[i].checked == true)
  	  {
  	    
  	    var tt = ele[i].id;
		//alert(val);
  	    //alert(tt);
  	    
  	    
			if(sl==0)
			{
			  	arr = tt;
			}
			else
			{
				arr = arr+"|"+tt;
			}
			sl++;
			

      }    	
	}
   }
    if (sl==0)
   {
     alert("No Files Are Selected for Deletion!!Select Files!!!!");
     return false;
	}
//   alert(arr);
   
  var xmlHttp;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
  xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
        
        var resp = xmlHttp.responseText;
		window.open("upl_report.php?val="+resp,"_blank","toolbar=no,scrollbar=no,resizable=no,top=300,left=100,width=800,height=600"); 
        
        

        
	  }
    }
  var requrl = "delete_files.php?nam="+arr;

  xmlHttp.open("GET",requrl,true);
  xmlHttp.send(null);
 }
 
}

</script>
<?php
ini_set('display_errors',0);
/*
include("aweil_sessionHandler.php");
include("aweil_upl_chkAuthenticity.php");
$usr= $_SESSION['username'];
*/
//$usr = '818127';
echo '<p align = right><a style="cursor:pointer;" onclick="window.close()">Close Window</a></p>';
?>
<input type='hidden' name='usr' id ='usr' value='<?php echo $usr;?>'></td></tr>
<html>
<head>

</head>
	<title>AWEIL File Download</title>

<body >

<form id='upl_dwl'  name = 'upl_dwl' method='' action ='' enctype="multipart/form-data">

<input type='hidden' name='nam' id ='nam' value='<?php echo $_GET[nam];?>'>
<?php
ini_set('display_errors',0);
//echo "<p ><font color=red>Here we will see the tabular structure of upload of $_GET[typ] File name passed on from previous page : $_GET[nam]</p>";

include ("tennis_conn.php");
include("lib_func.php");
mysql_connect("$host:$port","$dbUser","$dbPassword") or die("Could not connect to the database!");
mysql_select_db($database);

$nam = $_GET[nam];
$val = $_GET[val];
$fin_yr = substr($nam,0,9);

$tab= "<table>";


$del_img = "<a style=\"cursor:pointer;\" onclick = \"del_func('$nam')\"><img src=\"delete_color.png\" width=50 height = 30 title=\"Delete\"></img></a>";
$dwl_img = "<a style=\"cursor:pointer;\" onclick = \"dwl_func('$nam')\"><img src=\"download.png\" width=50 height = 30 title=\"Download\"></img></a>";
$sel_all = "<a style=\"cursor:pointer;\" onclick = \"sel_func('$nam')\"><img src=\"select-all.png\" width=50 height = 30 title=\"Select All\"></img></a>";
$tab.="<tr><td colspan=5 width=100% align='center'>$sel_all $del_img $dwl_img  </td></tr>";
$tab.="<tr><th colspan=5 width=100% align='center'> File DownLoading of $val for Financial Year $fin_yr</th></tr>";
$tab.="<tr><th>Month</th>
		<th>Reco-Sheet</th>
		<th>Signed Pdf</th>
		<th>Challans</th>
		<th>Other Docs</th></tr>";

$yy = 2024;
$mon = 3;
while(true)
{
  $mon++;
  if ($mon == 13)
  	{
    	$mon = 1;
    	$yy++;
	}
	$dt = str_pad($yy,4,"0",STR_PAD_LEFT)."-".str_pad($mon,2,"0",STR_PAD_LEFT)."-01";
	$mmm = date('M',strtotime($dt));
	
    $id1 = $nam."%".$mmm."_rs%";
	$id2 = $nam."%".$mmm."_sg%";
	$id3 = $nam."%".$mmm."_ch%";
	$id4 = $nam."%".$mmm."_ot%";
	$tab.="<tr><td>$mmm</td>";
	$kk = check_files($id1,$fin_yr);
	$tab.= $kk;
	$kk = check_files($id2,$fin_yr);
	$tab.= $kk;
	$kk = check_files($id3,$fin_yr);
	$tab.= $kk;
	$kk = check_files($id4,$fin_yr);
	$tab.= $kk;
	$tab.= "</tr>";	
		
 if ($mon == 3)
 break;
}		
$tab.= "</table>";
echo $tab;
function check_files($m_pattern,$fin_yr)
{
  include("tennis_conn.php");
  mysql_connect("$host:$port","$dbUser","$dbPassword") or die("Could not connect to the database!");
  mysql_select_db($database);

  $sql_stmt = "select * from m_upload where fin_yr = '$fin_yr' and f_name like '$m_pattern' and stat_cd = '0'";
	 $rs_rec = mysql_query ($sql_stmt);
     $r_rec = mysql_fetch_array($rs_rec);
     $rem="";
     if ($r_rec)
     {
	   
	   $xx = "<input type = \"checkbox\" id = '$r_rec[f_name]' name = '$r_rec[f_name]' >";
	   $rem .= "<td>$xx $r_rec[f_name]</td>";
	 }
	 else
	 {
	   $rem .= '<td> </td>';  
	}

     return $rem;
}
?>
	</form>
	</body>
	</html>