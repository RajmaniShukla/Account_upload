<html>
<?php
session_start();
if (! $_SESSION["IN_SESSION"]) {
	header("Location: aweil_fa_login.php");
        exit;
      }
    //ini_set('display_errors',0);
include_once('tennis_conn.php');
$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
//echo $_SESSION['usr_per']," ",$_SESSION["IN_SESSION"]," ",$_SESSION["ADMIN"];
echo "<p align = right><a href='aweil_upl_dwl_menu.php'>Main-Menu  </a> <a href='aweil_fa_logout.php'>Logout</a></p>";
 ?>
<input type='hidden' name='usr' id ='usr' value='<?php echo $usr;?>'></td></tr>
<html>
<head>

<link rel="stylesheet" href="upload_css.css">

</head>
	<title>AWEIL File Deletion Module</title>

<body >
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
<script type="text/javascript">
function win_open(val,nam)
{
  window.open("upload_12.php?typ="+val+"&nam="+nam);
}
function dwl_win_12(nam,val)
{
  window.open("download__files.php?val="+val+"&nam="+nam);
}

function dwl_func(val)
{
  var arr="";
  alert(val);
  if (confirm("Sure to Download the Selected File(s)")==true)
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
  	    
  	    var tt_subs = tt.substring(0,len);
		if (val == tt_subs)
		{
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
   }
   if (sl==0)
   {
     alert("No Files Are Selected for Download!!Select Files!!!!");
     return false;
	}
//   alert(arr);
   
  /*
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
        alert(resp);
		window.open("upl_report.php?val="+resp,"_blank","toolbar=no,scrollbar=no,resizable=no,top=300,left=100,width=800,height=600"); 
        
        var fin_yr = val.substring(0,9);
        var span_id = val.substring(10);
        if (span_id.substring(0,8)== 'MON-RECO')
        {
		  span_id  = span_id.substring(9);
		}
        var typ = 'fold';
//alert(val+"==="+span_id);
        list_files(val,span_id,typ);

        
	  }
    }
  var requrl = "download_files.php?nam="+arr+"&val="+val;

  xmlHttp.open("GET",requrl,true);
  xmlHttp.send(null);

 */
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
  	    
  	    var tt_subs = tt.substring(0,len);
		if (val == tt_subs)
		{
			ele[i].checked = true;
		}	
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
  	    
  	    var tt_subs = tt.substring(0,len);
		if (val == tt_subs)
		{
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
        
        var fin_yr = val.substring(0,9);
        var span_id = val.substring(10);
        if (span_id.substring(0,8)== 'MON-RECO')
        {
		  span_id  = span_id.substring(9);
		}
        var typ = 'fold';
//alert(val+"==="+span_id);
        list_files(val,span_id,typ);

        
	  }
    }
  var requrl = "delete_files.php?nam="+arr;

  xmlHttp.open("GET",requrl,true);
  xmlHttp.send(null);
 }
 
}

function list_files(val,span_id,typ)
{
  //alert(val);
  //alert(span_id);
  var span = "span-"+span_id;
  var del_span = "del-span-"+span_id;
 // var dwl_span = "dwl-span-"+span_id;
  var sel_all_span = "select_all-span-"+span_id;
if (typ=='unfold')
{
var a_tag = "<a style=\"cursor:pointer;\" onclick=\"list_files('"+val+"','"+span_id+"','fold')\">";
document.getElementById(span_id).innerHTML = a_tag+"<font color='red' size='5'>&#x002D</font></a>";
}
else
{
var a_tag = "<a style=\"cursor:pointer;\" onclick=\"list_files('"+val+"','"+span_id+"','unfold')\">";
document.getElementById(span_id).innerHTML = a_tag+"<font color='red' size='5'>&#xFF0B</font></a>";
document.getElementById(span).innerHTML = "";
document.getElementById(del_span).innerHTML = "";
//document.getElementById(dwl_span).innerHTML = "";
document.getElementById(sel_all_span).innerHTML = "";
exit;
}

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
        var noresult = resp.substring(0,1);
        var result   = resp.substring(2);
     //   alert(noresult);
      //  alert(result);
    	document.getElementById(span).innerHTML =  result;
    	if (noresult=="1")
    	{
		  var del_img = '<a style="cursor:pointer;" onclick = "del_func(\''+val+'\')"><img src="delete_color.png" width="50" height = "30" title=\"Delete\"></img></a>';
		  //var dwl_img = '<a style="cursor:pointer;" onclick = "dwl_func(\''+val+'\')"><img src="download.png" width="50" height = "30" title=\"Download\"></img></a>';
	//	  var sel_all = '<a style="cursor:pointer;" onclick = "sel_func(\''+val+'\')"><em><font color="#326A4E" size="5">Select-All</em></em></a>';
		var sel_all = '<a style="cursor:pointer;" onclick = "sel_func(\''+val+'\')"><img src="select-all.png" width="50" height = "30" title=\"Select All\"></img></a>';
		  document.getElementById(del_span).innerHTML = del_img;
		//  document.getElementById(dwl_span).innerHTML = dwl_img;
		  document.getElementById(sel_all_span).innerHTML = sel_all;
		}
	  }
    }
  var requrl = "list_files.php?nam="+val;

  xmlHttp.open("GET",requrl,true);
  xmlHttp.send(null);
 
}


</script>
<?php
//include("../mktg/conn.php");
include ("tennis_conn.php");
include("lib_func.php");
?>


<form id='upl_dwl'  name = 'upl_dwl' method='POST' action ="aweil_file_del.php">

<div class ="heading">
<h1> AWEIL FILE DELETION MODULE</h1>
</div>

<div class ="container">


<h1 class="form-title">Inputs</h1>


<div class="user-input-box">
<label for ="fin_yr"> Financial Year</label>
<select id="fin_yr" name="fin_yr" >
<option value ="S">--Select--</option>
<option value ='2021-2022'>2021-2022</option>
<option value ='2022-2023'>2022-2023</option>
</select>
</div>
<div class="form-submit-btn">
<input type="submit" value="SUBMIT" name = "submit" >
</div>
</div>
<div class ="table_container">
<?php
if (!isset($_POST['submit']))
exit;
$fin_yr = $_POST['fin_yr'];
global $sl,$nam,$nam_global;
$tab = "<h1 class=\"form-title\">Types of Documents for Financial Year ".$fin_yr."</h1></div>";
$tab .= "<table><tr><td width=100% valign='center'>";
$tab .= "<table ><tr><td style=\"text-align:center;font-size:24px;\">Yearly Documents</td></tr>";
	
     $sql_stmt = "select * from m_param where typ = 'ftyp' AND stat=0 order by cd ";
	 $rs_rec = mysqli_query ($con,$sql_stmt);
     $r_rec = mysqli_fetch_assoc($rs_rec);
	 
	 while ($r_rec)
	 {
	   $nam = $fin_yr."_".$r_rec['cd'];
	   $rem = $r_rec['des'];
	     $a_tag = "<a style=\"cursor:pointer;\" onclick=\"list_files('$nam','$r_rec[cd]','unfold')\">";
	   $tab.= "<tr><td width=100%><div style=\"float:left;\"><span id=\"$r_rec[cd]\">$a_tag<font color='red' size='5'>&#xFF0B</font></a></span></div><div style=\"float:left;padding-left:10px;font-size:26px;\">$rem</div><div style=\"float:right;\"><span  id='select_all-span-$r_rec[cd]' ></span><span id='del-span-$r_rec[cd]' ></span></div><br><span id='span-$r_rec[cd]'></span></td></tr>";
	 //  $a_tag = "<a style=\"cursor:pointer;\" onclick=\"list_files('$nam','$r_rec[cd]','unfold')\">";
	 //  $tab.= "<tr><td width=100><div style=\"float:left;\"><span id=\"$r_rec[cd]\">$a_tag<font color='red' size='5'>&#xFF0B</font></span></div><div style=\"float:left;padding-left:10px;font-size:26px;\">$rem</div><div style=\"float:right;\"><span id='select_all-span-$r_rec[cd]' ></span><span id='del-span-$r_rec[cd]'></span><span id='dwl-span-$r_rec[cd]' ></div><br><span id='span-$r_rec[cd]' ></span></td></tr>";
	  $r_rec = mysqli_fetch_assoc($rs_rec);
	 }
     $tab.= "</table>";
	 $tab.="</td><tr>";
	 $tab.= "<tr><td width=100% valign='center'>";
	 $tab .= "<table valign='top'><tr><td style=\"text-align:center;font-size:24px;\">Monthly Documents (12 Months)</td></tr>";
	 $tab .="<tr><td width=100%>";
	 echo $tab;
	 //
	$sl=0;
	$nam="";

	$tab="";
	$tab .='<ul id="myul">';
	$tab .='<li> <span class="caret"><font size="5" color="blue">Monthly Reco</font></span>';
	$tab .= '<ul class="nested">';
    echo $tab;
     $sql_stmt = "select * from m_param where typ = 'MON-RECO' and stat = 0 ";
	 $rs_rec = mysqli_query ($con,$sql_stmt);
     $r_rec = mysqli_fetch_assoc($rs_rec);
	 
	 while ($r_rec)
	 {
	   $nam = $fin_yr."_MON-RECO_".$r_rec['cd'];
	   $prsn = chk_files($nam);
	    if ($prsn == "Y")	 
	   $tab = '<li><a style="cursor:pointer;" onclick="window.open(\'del_12.php?nam='.$nam.'\')">'.$r_rec['des'].'</a></li>';
	   else
	   $tab = '<li>'.$r_rec['des'].'</a></li>';
	  echo $tab;
	  /*
 $nam = $fin_yr."_MON-RECO_".$r_rec[cd];
	  	 $tab = '<li><a style="cursor:pointer;" onclick="window.open(\'upload_12.php?nam='.$nam.'&typ='.$r_rec[des].'\')">'.$r_rec[des].'</a></li>';
	  echo $tab;
*/
	  //echo $r_rec[des]."<br>";
	  $r_rec = mysqli_fetch_assoc($rs_rec);
	 }
	 $sql_stmt = "select * from m_param where typ = 'MON-RECO' and stat = 1 ";
	 $rs_rec = mysqli_query ($con,$sql_stmt);
     $r_rec = mysqli_fetch_assoc($rs_rec);
	 
	 while ($r_rec)
	 {
	    $tab= '<li><span class="caret">'.$r_rec['des'].'</span>';
		$tab.= '<ul class="nested">';
		echo $tab;
	   
	  
	   $nam_global = $fin_yr."_MON-RECO_".$r_rec['cd']."_";
	   $nam = $nam_global;
	   //echo "start:",$r_rec[cd],"<br>";
	   ff($r_rec['cd']);
	   $tab="";
	   
	 
	   for ($i=0;$i<=$sl;$i++)
	   {
	    $tab .= "</ul></li>";
       }
       echo $tab;
       $sl=0;
       $nam="";
	  $r_rec = mysqli_fetch_assoc($rs_rec);
	 }
		//
		$tab.="</td></tr>";
     $tab.= "</table>";
	 $tab.="</td></tr>";
	 $tab .= "</table>";
	 echo $tab;
	 //
	    function ff($cd)
	 {
	   include ("tennis_conn.php");
	   global $sl,$nam_global,$nam;
	   
	 //$nam = $nam_global.$cd."_";  
	 //echo "1:",$nam,"<br>";
     $ssql_stmt = "select count(*)cnt from m_param where typ = '".$cd."' and stat = 0 ";
   $con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
	 $rrs_rec = mysqli_query ($con,$ssql_stmt);
     $rr_rec = mysqli_fetch_assoc($rrs_rec);
	 if ($rr_rec['cnt'] > 0)
	 {
	 	$ssql_stmt = "select * from m_param where typ = '".$cd."' and stat = 0 ";
		$rrs_rec = mysqli_query ($con,$ssql_stmt);
     	$rr_rec = mysqli_fetch_assoc($rrs_rec);
     	$nam_temp = $nam;
	 	while ($rr_rec)
	 	{    
	 	  	 $nam .= $rr_rec['cd']; 
	 	  	 //echo "final:",$nam," ",$sl,"<br>";
	 	  	 $prsn = chk_files($nam);
	         if ($prsn == "Y")
			   $tab = '<li><a style="cursor:pointer;" onclick="window.open(\'del_12.php?nam='.$nam.'\')">'.$rr_rec['des'].'</a></li>';
			 else
			   $tab = '<li>'.$rr_rec['des'].'</li>';
	  	     //$tab = '<li><a style="cursor:pointer;" onclick="window.open(\'upload_12.php?nam='.$nam.'&typ='.$rr_rec[des].'\')">'.$rr_rec[des].'</a></li>';
			
	  		 echo $tab;
			 $nam = $nam_temp;
	  	$rr_rec = mysqli_fetch_assoc($rrs_rec);
	    }
		$nam = $nam_global;	  	
	}
	$ssql_stmt = "select count(*)cnt from m_param where typ = '".$cd."' and stat = 1 ";
    
	 $rrs_rec = mysqli_query ($con,$ssql_stmt);
     $rr_rec = mysqli_fetch_assoc($rrs_rec);
	 if ($rr_rec['cnt'] > 0)
	{
	 $sssql_stmt = "select * from m_param where typ = '".$cd."' and stat = 1 ";

	 $rrrs_rec = mysqli_query ($con,$sssql_stmt);
     $rrr_rec = mysqli_fetch_assoc($rrrs_rec);
	 
	 while ($rrr_rec)
	 {
	   $sl++;
	   $nam .= $rrr_rec['cd']."_";
	   //echo "join:",$nam," ",$sl,"<br>";
	   $tab= '<li><span class="caret">'.$rrr_rec['des'].'</span>';
		$tab.= '<ul class="nested">';
		echo $tab;
	 
	  
	  ff($rrr_rec['cd']);
	  $rrr_rec = mysqli_fetch_assoc($rrrs_rec);
	 } 
	}
	}
	
function chk_files($typ_nam)
{
  include("tennis_conn.php");
 	$fin_yr = substr($typ_nam,0,9);
  	$ssql_stmt = "select count(*)cnt from m_upload where fin_yr = '".$fin_yr."' and cd like '".$typ_nam."%' and stat_cd = 0 ";
    //echo $ssql_stmt;
	$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
	 $rrs_rec = mysqli_query ($con,$ssql_stmt);
     $rr_rec = mysqli_fetch_assoc($rrs_rec);
     if ($rr_rec['cnt'] == "")
     $rr_rec['cnt']=0;
     if ($rr_rec['cnt'] > 0)
     return "Y";
     else
     return "N";
}
?>
</form>
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

