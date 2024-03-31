<?php
ini_set('max_execution_time', 3600);
session_start();
$sessid = session_id();
ob_implicit_flush(true);
ob_end_flush();
?>
<SCRIPT language=JavaScript type=text/javascript src='javascript_files/encrypt.js'></SCRIPT>
<SCRIPT language=JavaScript type=text/javascript>

function submitPopup() {
	
	var perno=document.getElementById("f_perno").value;
	var pass=document.getElementById("pass").value;
	
	document.getElementById("pass").value = md5(pass);
	document.getElementById('f_login').submit();
}
</SCRIPT>
<?php
	$m_today = date("Y-m-d");
	include_once("conn.php");
 	
	
?>

<link rel="stylesheet" href="wage_css.css">
<center>
<div class="login_container">

<form id="f_login" name="f_login" action="login_prcc.php" method="POST" style=" width:400px">

 
  
  <div class="login_header">
   <img src="FINAL_LOGO.jpg" class="logo"></img> <h2 class="login_info">Inventory Login </h2>
   </div>
    <hr>
<table border=0>
	<tr><td width=50%>
    	<label for="f_perno" class="title"><b>User Name</b></label>
    	<input type="text" placeholder="User Name" name="f_perno" id="f_perno" required >
		</td>
	</tr>
    <tr><td>
    	<label for="pass" class="title"><b>Password</b></label>
    	<input type="password"  placeholder="Password" name="pass" id="pass" >
	</tr>
	<tr>
		<td><button type="button" onclick="submitPopup()" class="btn">Login</button></td>
	</tr>
   </table>


<a href="modify_user.php" style="Text-decoration:none;color:#B3562D;font-weight:bold">
Modify Password </a></p>
  </div>
</form>
</center>

