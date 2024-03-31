<?php
ini_set('display_errors',0);
/*
session_start();

$usr= $_SESSION['username'];

if ($usr =="")

{

   echo '<script>

    		alert("Invalid User");

    	    window.location.href="wip_menu.php";

		</script>';

	exit();  

}
*/

?>

<html lang="en">

<head>

<meta charset="UTF-8">

<title>P&L Excel File Upload</title>

</head>



<style type='text/css'>

BODY {

	FONT-SIZE: 11px; FONT-FAMILY: Consolas,sans-serif;

} 

input[type=text],input[type=file],input[type=submit],input[type=button],select,textarea{

  width: 80%;

  padding: 10px 10px;

  margin: 8px 0;

  border: 1px solid #000;

  border-radius: 5px;

  box-sizing: border-box; 

  display: block;

 

  FONT-FAMILY: Consolas,sans-serif;

}

input[type=file]::file-selector-button{

  border: 2px solid #B0CFDE;

  transition : 1s;

  background-color : #79BAEC;

  font-weight:bold;

  border-radius: 5px;

}

input[type=file]::file-selector-button:hover{

   background-color : #E6E6FA;

  border: 2px solid #92C7C7; 

}

	a{text-decoration:none;color:#000000;}

	td { background-color: #F8F6F0;

	padding:8px 15px;

	  border: 2px solid #E1E1E1; }

	

	td:nth-child(4) { text-align: right;font-weight:bold; }

	td:nth-child(10) { text-align: right;font-weight:bold; }

	td { text-align: center;font-weight:bold; }

	tr:hover {background-color: #A5FFFF;}

  

	.fix_table_head{

	  overflow-y: auto;

	  height:110px;

	}

	.fixhd thead th{

	  position:sticky;

	  top:0;

	}

	table{

	  border-collapse:collapse;

	  

	  

	  

	}

	th{

	  padding:8px 15px;

	  border: 2px solid #E1E1E1;

	  background: #A5B05F;

	  align:center;

	}

	

	



</style>

<body>
<script type="text/javascript">
function rt1()
{
var fileselect = document.getElementById('caih_file');
var val = document.getElementById('xx').value;
alert(val);
alert("ss");
var files = fileselect.files;
var file = files[0];

var fileselectt = document.getElementById('cih_file');
var filess = fileselectt.files;
var filee = filess[0];

var formData = new FormData();
	formData.append('val',val);
if (fileselect.files.length == 0)
{}
else{
	formData.append('caih_file',file,file.name);
}
if (fileselectt.files.length == 0)
{}
else{
formData.append('cih_file',filee,filee.name);
}
var xhr = new XMLHttpRequest();
xhr.open('POST','rrt.php',true);
xhr.onload = function(){
  if (xhr.status == 200)
  {
    document.getElementById("r").innerHTML=xhr.responseText;
  }else {document.getElementById("r").innerHTML="not success";}
};
xhr.send(formData);  

}
</script>
<center>



<form name='entry' action='rt.php' method='POST' enctype="multipart/form-data">



<p align='right'><a href='wip_menu.php'>Back To Main Menu</a></p>

<p align='center'><u><h2> File Uploading for Profit & Loss  Module</h2></u></p>

<table align = 'center' width=40%;>

<tr>

<th align='center'><label for=caih_file>Select File

<input type="file" name = "caih_file" id="caih_file">
<input type="file" name = "cih_file" id="cih_file"></th>
<input type="hidden" name = "xx" id="xx" value="xx"></th>
</tr>

<tr>

<th align='center'><span id='r'></span></th>

</tr>



<tr>

<th  align='center'>

<input type="button" name="submit" value="Upload Excel File" onclick="rt1();"/></th>

</table>

</form>

</h3>






<?php

if(!isset($_POST["submit"]))

{

 exit;

} 

//include("mktg/conn.php");	

include("lib_func.php");		



	if (isset($_FILES['2caih_file'])) {
	  echo "ssss";
	}

   	

 ?>

</center>

</body>

</html>

