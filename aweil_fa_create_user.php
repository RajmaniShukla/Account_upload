<?php
ini_set('max_execution_time', 3600);
ini_set('display_errors',0);
session_start();
$sessid = session_id();
ob_implicit_flush(true);
ob_end_flush();
?>
<script Language="JavaScript" Type="text/javascript" src="javascript_files/encrypt.js"></script>
<SCRIPT language=JavaScript type=text/javascript>
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
	if (nam == "")
	{
	 
	  document.getElementById("user_name").value ="";
	  document.getElementById("botn").disabled = true;
	document.getElementById("botn").style.backgroundColor = "#56A5EC";

	  alert ("PASSWORD CANNOT BE BLANK...!!");
	  return false;
	} 
	if (stat_cd == "D")
	{
	var pass=document.getElementById("pass").value;
	document.getElementById("pass").value = md5(pass);
	var re_pass=document.getElementById("re_pass").value;
	document.getElementById("re_pass").value = md5(re_pass);
	if (pass == "")
	{
	  document.getElementById("pass").value ="";
	  document.getElementById("re_pass").value ="";
	  document.getElementById("botn").disabled = true;
	document.getElementById("botn").style.backgroundColor = "#56A5EC";

	  alert ("PASSWORD CANNOT BE BLANK...!!");
	  return false;
	}
	if (re_pass == "")
	{
	  document.getElementById("pass").value ="";
	  document.getElementById("re_pass").value ="";
	 document.getElementById("botn").disabled = true;
	document.getElementById("botn").style.backgroundColor = "#56A5EC";

	  alert ("PASSWORD CANNOT BE BLANK...!!");
	  return false;
	}
	}
	if (stat_cd == "U")
	{
	var pass=document.getElementById("pass").value;
	document.getElementById("pass").value = md5(pass);
	if (pass == "")
	{
	  document.getElementById("pass").value ="";
	document.getElementById("botn").disabled = true;
	document.getElementById("botn").style.backgroundColor = "#56A5EC";

	 
	  alert ("DBA PASSWORD CANNOT BE BLANK...!!");
	  return false;
	}
	
	}
	
	document.getElementById('login_frm').submit();
}

function login_enabled(stat_cd)
{
    
	document.getElementById("botn").disabled = true;
	document.getElementById("botn").style.backgroundColor = "#56A5EC";

  var perno=document.getElementById("user").value;
  var nam=document.getElementById("user_name").value; 	
  
  
  if (stat_cd == 'D')
  {
    var pass=document.getElementById("pass").value;
    var re_pass=document.getElementById("re_pass").value;
  if ((perno.length > 0)&&(pass.length > 0)  &&(re_pass.length > 0) && (nam.length>0) )
  {
	  document.getElementById("botn").disabled = false;
	  document.getElementById("botn").style.backgroundColor = "#151b54";
  }	
 }
  if (stat_cd == 'U')
  {
    var pass=document.getElementById("pass").value;
    
  if ((perno.length > 0)&&(pass.length > 0)  &&(nam.length > 0))
  {
	  document.getElementById("botn").disabled = false;
	  document.getElementById("botn").style.backgroundColor = "#151b54";
  }	

  }
  
	
}
</SCRIPT>
<?php
	$m_today = date("Y-m-d");
	include_once("tennis_conn.php");
    global $fy_name;
   
	// entry for table wage_pis
	
?>
<input type="hidden" name = "stat" id = "stat" value=<?php echo $stat;?>  >
<link rel="stylesheet" href="fa_login_css.css">
<div class="login___container">

<center>
<form id="login_frm" name="login_frm" action="aweil_fa_create_user_post.php" method="POST" style="width:95%;">

 
  <div class="container">
   <div class="login_header">
   <img src="AWEIL_LOGO_CRED.png" class="logo"></img> <h2 class="login_info">Repository Account Creation </h2>
   </div>
    <hr>
<table border=0>

	<?php 
	$con = mysqli_connect("$host","$dbUser","$dbPassword","$database");
  	$ssql_stmt = "select * from m_user where user_role = 'DBA'  ";
	 $rrs_rec = mysqli_query ($con,$ssql_stmt);
     $rr_rec = mysqli_num_rows($rrs_rec);
     //if ($rr_rec[cnt] == "")
     //	$rr_rec[cnt] = 0;
     if ($rr_rec > 0)
    	{
		$stat = "U";
		$_SESSION['stat'] = $stat;
			$tab = "	<tr><td>
	    	<label for=\"user_role\" class=\"title\"><b>User Role</b></label>
    	<select name=\"user_role\" id=\"user_role\" >
			<option value='ADMIN'>ADMIN</option>
    		<option value='USER' selected>USER</option></select></td></tr>
		";
    		
    	}
     else
     {
       $stat = "D";
       $_SESSION['stat'] = $stat;
	$tab ="    	<tr><td>
	    	<label for=\"user_role\" class=\"title\"><b>User Role</b></label>
    	<select name=\"user_role\" id=\"user_role\" >
    	    <option value='DBA'>DBA</option></select></td></tr>";
    }
	echo $tab;
	?>
    <tr><td width=50%>
    	<label for="user" class="title"><b>Per No</b></label>
    	<input type="text" placeholder="User Personnel No" name="user" id="user" required onkeyup="login_enabled('<?php echo $stat;?>')">
		</td>
	</tr>
    	<tr><td width=50%>
    	<label for="user_name" class="title"><b>User Name</b></label>
    	<input type="text" placeholder="User Name" name="user_name" id="user_name" required onkeyup="upper_case(event,this);login_enabled('<?php echo $stat;?>')">
		</td>
	</tr>	
	</tr>
	<?php
	 if ($stat == "U")
    	{
	$tab = "<tr><td> 
       	<label for=\"dba_pass\" class=\"title\"><b>DBA Password</b></label>
    	<input type=\"password\"  placeholder=\"DBA Password\" name=\"pass\" id=\"pass\" onkeyup = \"login_enabled('$stat')\" >
	</tr>
      	<select name=\"user_unit\" id=\"user_unit\" >
			<option value='$fy_name' selected>$fy_name</option>
    		<option value='HQ'>HQ</option></select></td></tr>";
    		
    	}
     else
     {
	$tab ="<tr><td>
       	<label for=\"pass\" class=\"title\"><b>Password</b></label>
    	<input type=\"password\"  placeholder=\"Password\" name=\"pass\" id=\"pass\" onkeyup = \"login_enabled('$stat')\">
	</tr>
    	<tr><td>
    	<label for=\"re_pass\" class=\"title\"><b>Re-Type Password</b></label>
    	<input type=\"password\"  placeholder=\"Re-Type Password\" name=\"re_pass\" id=\"re_pass\" onkeyup = \"login_enabled('$stat')\">
	</tr>	";
    }
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

