<html>
<?php
session_start();
if (! $_SESSION["IN_SESSION"]) {
	header("Location: aweil_fa_login.php");
        exit;
      }
    //ini_set('display_errors',0);
include_once('tennis_conn.php');
$user = $_SESSION['usr_per'];
$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
//echo $_SESSION['usr_per']," ",$_SESSION["IN_SESSION"]," ",$_SESSION["ADMIN"];
echo "<p align = right><a href='aweil_upl_dwl_menu.php'>Main-Menu  </a> <a href='aweil_fa_logout.php'>Logout</a></p>";
 ?>
<input type='hidden' name='usr' id ='usr' value='<?php echo $usr;?>'></td></tr>
<html>
<head>

<link rel="stylesheet" href="upload_css.css">

</head>
	<title>AWEIL File Upload Download</title>

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
function upload_file(val)
{
alert("FILE UPLOADED"+val);
  var span_id = "span-"+val;
  
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
     
	   document.getElementById(span_id).innerHTML = xmlHttp.responseText;
	  //document.getElementById(span_id).innerHTML = "<p><font color=red size=2px>Files Uploaded</font></p>";
	}
    }
  var requrl = "upl_file.php?nam="+val;

  xmlHttp.open("POST",requrl,true);
  xmlHttp.send(null);

}
function upl_once(nam)
{
var nam1 = nam + "_rs";
var nam2 = nam + "_sg";
var nam3 = nam + "_ch";
var nam4 = nam + "_ot";
//alert(nam);
var span_id = "span-"+nam;  
//alert(span_id)
var formData = new FormData();
formData.append('nam',nam);

var fileselect1 = document.getElementById(nam1);
if (fileselect1 != null)
{
var files1 = fileselect1.files;
var file1 = files1[0];
if (fileselect1.files.length == 0)
{}
else{
	formData.append(nam1,file1,file1.name);
}
}


var fileselect2 = document.getElementById(nam2);
if (fileselect2 != null)
{
var files2 = fileselect2.files;
var file2 = files2[0];
if (fileselect2.files.length == 0)
{}
else{
formData.append(nam2,file2,file2.name);
}
}


var fileselect3 = document.getElementById(nam3);
if (fileselect3 != null)
{
var files3 = fileselect3.files;
var file3 = files3[0];
if (fileselect3.files.length == 0)
{}
else{
formData.append(nam3,file3,file3.name);
}
}


var fileselect4 = document.getElementById(nam4);
if (fileselect4 != null)
{
var files4 = fileselect4.files;
var file4 = files4[0];
if (fileselect4.files.length == 0)
{}
else{
  
formData.append(nam4,file4,file4.name);
}
}





var xhr = new XMLHttpRequest();
xhr.open('POST','upload_file_once_ajax.php',true);
xhr.onload = function(){
  if (xhr.status == 200)
  {
    var sp = nam.substring(10);
    //alert(sp);
    alert(xhr.responseText);
    document.getElementById(sp).innerHTML="";
    document.getElementById(nam).checked =false;
    
	//    document.getElementById(span_id).innerHTML=xhr.responseText;
	window.open("upl_report.php?val="+xhr.responseText,"_blank","toolbar=no,scrollbar=no,resizable=no,top=300,left=100,width=800,height=600");
  }else {document.getElementById(span_id).innerHTML="not success";}
};
xhr.send(formData);  

}
function win_open(val,nam)
{
  window.open("upload_12.php?typ="+val+"&nam="+nam);
}
function kk(f)
{
  var val,nam="";
  var ele = document.forms[f].elements;
  for (var i=0;i < ele.length-1;i++)
  {
  	val  = ele[i].id;
  	
		var tt = document.getElementById(val).value;
	    //alert(tt);
        nam = nam + tt;   
        //alert (nam);
  }
  //alert( nam);
  return nam;
}
function level1(val,span_id)
{
//alert(val+span_id);
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
		
      
      var cbox = document.getElementById(val);
      if (cbox.checked == true)
      {
	  	document.getElementById(span_id).innerHTML = xmlHttp.responseText;  
	  }
	  else
	  {
	    document.getElementById(span_id).innerHTML = "";
	  }
	}
    }
  var requrl = "upload_once.php?nam="+val;

  xmlHttp.open("GET",requrl,true);
  xmlHttp.send(null);
 
}


</script>
<?php
//include("../mktg/conn.php");
include ("tennis_conn.php");
include("lib_func.php");
?>


<form id='upl_dwl'  name = 'upl_dwl' method='POST' action ="aweil_upl.php">

<div class ="heading">
<h1> AWEIL FILE UPLOAD MODULE</h1>
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
$tab = "<h1 class=\"form-title\">Upload Documents for Financial Year ".$fin_yr."</h1></div>";
$tab .= "<table><tr><td width=100% valign='center'>";
$tab .= "<table ><tr><td style=\"text-align:center;font-size:24px;\">Yearly Documents(One-time)</td></tr>";
	
     
     $sql_stmt = "select * from m_param where typ = 'ftyp' and stat= 0 order by cd ";
	 $rs_rec = mysqli_query ($con,$sql_stmt);
     $r_rec = mysqli_fetch_assoc($rs_rec);
	 while ($r_rec)
	 {
	   $nam = $fin_yr."_".$r_rec['cd'];
	   //$rem ='<a style="cursor:pointer;" onclick="level1(\''.$nam.'\',\''.$r_rec[cd].'\')">'.$r_rec[des];
	   $rem = '<input type = "checkbox" id = "'.$nam.'" name = "'.$nam.'" onclick="level1(\''.$nam.'\',\''.$r_rec['cd'].'\')">'.$r_rec['des'];
       $tab.= "<tr><td width=100%><div style=\"float:left;\">".$rem."</div> <div style=\"float:right;\"> <font color='red' size='2' align=right><em>After selecting files click upload image to Upload</em></font></div></a><br><span id='".$r_rec['cd']."' ></span></td></tr>";
	  $r_rec = mysqli_fetch_assoc($rs_rec);
	 }
     $tab.= "</table>";
	 $tab.="</td><tr>";
	 $tab.= "<tr><td width=50%>";
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
	  	 $tab = '<li><a style="cursor:pointer;" onclick="window.open(\'upload_12.php?nam='.$nam.'&typ='.$r_rec['des'].'\')">'.$r_rec['des'].'</a></li>';
	  echo $tab;
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
	   //$nam_global = $fin_yr."_MON-RECO_";
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
	  function ff($cd)
	 {
	   include ("tennis_conn.php");
	   global $sl,$nam_global,$nam;
	   
	 //$nam = $nam_global.$cd."_";  
	 //echo "1:",$nam,"<br>";
     $ssql_stmt = "select count(*)cnt from m_param where typ = '$cd' and stat = 0 ";
     $con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
	 $rrs_rec = mysqli_query ($con,$ssql_stmt);
     $rr_rec = mysqli_fetch_assoc($rrs_rec);
	 if ($rr_rec['cnt'] > 0)
	 {
	 	$ssql_stmt = "select * from m_param where typ = '$cd' and stat = 0 ";
		$rrs_rec = mysqli_query ($con,$ssql_stmt);
     	$rr_rec = mysqli_fetch_assoc($rrs_rec);
     	$nam_temp = $nam;
	 	while ($rr_rec)
	 	{    
	 	  	 $nam .= $rr_rec['cd']; 
	 	  	 //echo "final:",$nam," ",$sl,"<br>";
	  	     $tab = '<li><a style="cursor:pointer;" onclick="window.open(\'upload_12.php?nam='.$nam.'&typ='.$rr_rec['des'].'\')">'.$rr_rec['des'].'</a></li>';
	  		 echo $tab;
			 $nam = $nam_temp;
	  	$rr_rec = mysqli_fetch_assoc($rrs_rec);
	    }
		$nam = $nam_global;	  	
	}
	$ssql_stmt = "select count(*)cnt from m_param where typ = '$cd' and stat = 1 ";
    
	 $rrs_rec = mysqli_query ($con,$ssql_stmt);
     $rr_rec = mysqli_fetch_assoc($rrs_rec);
	 if ($rr_rec['cnt'] > 0)
	{
	 $sssql_stmt = "select * from m_param where typ = '$cd' and stat = 1 ";

	 $rrrs_rec = mysqli_query ($con,$sssql_stmt);
     $rrr_rec = mysqli_fetch_assoc($rrrs_rec);
	 
	 while ($rrr_rec)
	 {
	   $sl++;
	   $nam .= $rrr_rec[cd]."_";
	   //echo "join:",$nam," ",$sl,"<br>";
	   $tab= '<li><span class="caret">'.$rrr_rec[des].'</span>';
		$tab.= '<ul class="nested">';
		echo $tab;
	 
	  
	  ff($rrr_rec[cd]);
	  $rrr_rec = mysqli_fetch_assoc($rrrs_rec);
	 } 
	}
	
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

