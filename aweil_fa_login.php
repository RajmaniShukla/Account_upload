<?php
//#151b54
ini_set('max_execution_time', 3600);
session_start();
$sessid = session_id();
ob_implicit_flush(true);
ob_end_flush();
?>
<script Language="JavaScript" Type="text/javascript" src="javascript_files/encrypt.js"></script>
<SCRIPT language=JavaScript type=text/javascript>

function submitfunc() {
	
	var perno=document.getElementById("user").value;
	var pass=document.getElementById("passwd").value;
//	alert(perno);
	document.getElementById("passwd").value = md5(pass);
//alert(document.getElementById("passwd").value);
	document.getElementById('login_frm').submit();
}
function login_enabled()
{
    document.getElementById("botn").disabled = true;
	document.getElementById("botn").style.backgroundColor = "#56A5EC";
	
  var perno=document.getElementById("user").value;
	var pass=document.getElementById("passwd").value;
  if ((perno.length>0 ) && (pass.length>0)) 
  {
   	  document.getElementById("botn").disabled = false;
	  document.getElementById("botn").style.backgroundColor = "#151b54";
	}
}
</SCRIPT>
<?php
	$m_today = date("Y-m-d");
	include_once("tennis_conn.php");
 	
	
?>

<link rel="stylesheet" href="fa_login_css.css">
<center>
<div class="login_container">

<form id="login_frm" name="login_frm" action="aweil_fa_upl_Verifylogin.php" method="POST" style=" width:400px">

 
  
  <div class="login_header">
   <img src="AWEIL_LOGO_CRED.png" class="logo"></img> <h2 class="login_info">Repository Login</h2>
   </div>
    <hr>
<table border=0>
	<tr><td width=50%>
    	<label for="user" class="title"><b>User Name</b></label>
    	<input type="text" placeholder="User Name" name="user" id="user" required onkeyup="login_enabled();" >
		</td>
	</tr>
    <tr><td>
    	<label for="passwd" class="title"><b>Password</b></label>
    	<input type="password"  placeholder="Password" name="passwd" id="passwd" onkeyup="login_enabled();">
	</tr>
	<tr>
		<td><button type="button" id="botn" onclick="submitfunc()" class="login" disabled>Login</button></td>
	</tr>
   </table>
<input type="hidden"  name="typ" id="typ" value="aweil_fa" >

<p><a href="aweil_fa_create_user.php" style="Text-decoration:none;color:#004225;font-weight:bold">
Create User </a> <a href="aweil_fa_modify_user.php" style="Text-decoration:none;color:#151B8D;font-weight:bold">
Change Password </a></p>
<p style="Text-decoration:none;color:#A55D35;font-weight:bold">For first time login use default password as "PASSWORD"</p>
  </div>
</form>
</center>

