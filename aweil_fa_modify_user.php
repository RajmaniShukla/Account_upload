<?php
//ini_set('max_execution_time', 3600);
//ini_set('display_errors',0);
session_start();
$sessid = session_id();
ob_implicit_flush(true);
ob_end_flush();
?>
<script Language="JavaScript" Type="text/javascript" src="javascript_files/encrypt.js"></script>
<SCRIPT language=JavaScript type=text/javascript>
function fetch_nam(per)
{
 
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
        
		if (resp == "0")
		{
		  alert("NO SUCH USER!!");
		  document.getElementById("user").value="";
		  document.getElementById("user").focus();
		  return false;
		}
		else
		{
		  document.getElementById("user_name").value=resp;
		}
 	  }
    }
  var requrl = "f_nam.php?per="+per;

  xmlHttp.open("GET",requrl,true);
  xmlHttp.send(null);
 }
 

function upper_case(e,r)
{
var charCode = (e.charCode) ? e.charCode : ((e.which) ? e.which : e.keyCode);
if (charCode >= 65 && charCode <= 90)
{
   r.value = r.value.toUpperCase();
   return false;
}
}
function submitfunc(stat_cd) {
	var perno=document.getElementById("user").value;
    var nam=document.getElementById("user_name").value;
    if (perno.length < 6)
	{
	  document.getElementById("user").value ="";
	  document.getElementById("user").focus();
	  alert ("Personnel Number must be more than Six Characters..!!");
	  document.getElementById("botn").disabled = true;
	document.getElementById("botn").style.backgroundColor = "#56A5EC";

	  return false;
	}  
	

	var pass=document.getElementById("pass").value;
	document.getElementById("pass").value = md5(pass);
	var re_pass=document.getElementById("re_pass").value;
	document.getElementById("re_pass").value = md5(re_pass);
	var new_pass=document.getElementById("new_pass").value;
	document.getElementById("new_pass").value = md5(new_pass);
	if (pass == "")
	{
	  document.getElementById("pass").value ="";
	  document.getElementById("re_pass").value ="";
	  document.getElementById("new_pass").value ="";
	  document.getElementById("botn").disabled = true;
	  document.getElementById("botn").style.backgroundColor = "#56A5EC";

	  alert ("PASSWORD CANNOT BE BLANK...!!");
	  return false;
	}
	if (re_pass == "")
	{
	  document.getElementById("pass").value ="";
	  document.getElementById("re_pass").value ="";
	  document.getElementById("new_pass").value ="";
	  document.getElementById("botn").disabled = true;
	  document.getElementById("botn").style.backgroundColor = "#56A5EC";

	  alert ("PASSWORD CANNOT BE BLANK...!!");
	  return false;
	}
	if (new_pass == "")
	{
	  document.getElementById("pass").value ="";
	  document.getElementById("re_pass").value ="";
	  document.getElementById("new_pass").value ="";
	  document.getElementById("botn").disabled = true;
	  document.getElementById("botn").style.backgroundColor = "#56A5EC";

	  alert ("PASSWORD CANNOT BE BLANK...!!");
	  return false;
	}
	
	
	
	document.getElementById('login_frm').submit();
}

function login_enabled(stat_cd)
{
    
	document.getElementById("botn").disabled = true;
	document.getElementById("botn").style.backgroundColor = "#56A5EC";

  var perno=document.getElementById("user").value;
  var nam=document.getElementById("user_name").value; 	
  
  
  
  
    var pass=document.getElementById("pass").value;
    var re_pass=document.getElementById("re_pass").value;
    var new_pass=document.getElementById("new_pass").value;
  if ((perno.length > 0)&&(pass.length > 0)  &&(re_pass.length > 0) && (new_pass.length>0) )
  {
	  document.getElementById("botn").disabled = false;
	  document.getElementById("botn").style.backgroundColor = "#151b54";
  }	
 

  }

</SCRIPT>
<?php
	$m_today = date("Y-m-d");
	include_once("tennis_conn.php");
    global $fy_name;
    $con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
if (isset($_SESSION['usr_per']))
{
$user = $_SESSION['usr_per'];
  	$ssql_stmt = "select * from m_user where user_per = '".$user."'  ";
	 $rrs_rec = mysqli_query ($con,$ssql_stmt);
     $rr_rec = mysqli_fetch_assoc($rrs_rec);
	// entry for table wage_pis
	//echo '<p style="float:left;font-wieght:bold;font-size:20px;">Welcome  '. $rr_rec[user_name].'</p>';
}
$stat="U";
?>
<input type="hidden" name = "stat" id = "stat" value=<?php echo $stat;?>  >
<link rel="stylesheet" href="fa_login_css.css">
<div class="login___container">

<center>
<form id="login_frm" name="login_frm" action="aweil_fa_modify_user_post.php" method="POST" style="width:95%;">

 
  <div class="container">
   <div class="login_header">
   <img src="AWEIL_LOGO_CRED.png" class="logo"></img> <h2 class="login_info">Repository Account<br>(Change Password) </h2>
   </div>
    <hr>
<table border=0>
	
    
	
    <tr><td width=50%>
    	<label for="user" class="title"><b>Per No</b></label>
    	<input type="text" placeholder="User Personnel No" name="user" id="user" required onkeyup="login_enabled('<?php echo $stat;?>')" onblur="fetch_nam(this.value);">
		</td>
	</tr>
    	<tr><td width=50%>
    	<label for="user_name" class="title"><b>User Name</b></label>
    	<input type="text" placeholder="User Name"  readonly name="user_name" id="user_name" required onkeyup="upper_case(event,this);login_enabled('<?php echo $stat;?>')">
		</td>
	</tr>	
	</tr>
	<?php
	 
      $stat="U";
    
	$tab ="     <tr><td>
       	<label for=\"pass\" class=\"title\"><b>Password</b></label>
    	<input type=\"password\"  placeholder=\"Password\" name=\"pass\" id=\"pass\" onkeyup = \"login_enabled('".$stat."')\">
	</tr>
	    	<tr><td>
    	<label for=\"new_pass\" class=\"title\"><b>New Password</b></label>
    	<input type=\"password\"  placeholder=\"New Password\" name=\"new_pass\" id=\"new_pass\" onkeyup = \"login_enabled('".$stat."')\">
	</tr>	
    	<tr><td>
    	<label for=\"re_pass\" class=\"title\"><b>Re-Type Password</b></label>
    	<input type=\"password\"  placeholder=\"Re-Type Password\" name=\"re_pass\" id=\"re_pass\" onkeyup = \"login_enabled('".$stat."')\">
	</tr>	";
    
	echo $tab;
	?>
	<tr>
		<td><button type="button" id="botn" onclick="submitfunc('<?php echo $stat;?>')" class="login" disabled>Create/Change</button></td>
	</tr>
   </table>
<p align="left">
<a href="aweil_fa_login.php" style="Text-decoration:none;color:#1A8D8D;font-weight:bold">
Go To Login</a>

  </div>
</form>
</center>

