<?php
//include("gpf1/all_php_func.php");
include("../cash_office/lib_func.php");
session_start();
$uid = $_POST[user];
$pwd = $_POST[passwd];
$typ = $_POST[typ];

switch ($typ)
{
case "emp":
    $cnt = card_chk($pwd,$uid);
    
    break;
 default :
   $arr = personal_pwd($pwd,$uid,$typ);     
   $cnt = $arr[0];
   $sec = $arr[1];
   //echo "sss",$sec;
  // exit;
   //$cnt = personal_pwd($pwd,$uid,$typ);     
   break;
}   
 if ($cnt=="")
    {
        $cnt = 0;
    }
    
    
    if ($cnt == 0)
    {
         $sel_stmt = "select count(*)cnt from personal_passwd where uid = '$uid' and passwd is null and func = '$typ' ";
         
		 $sel_stmt = $dbe->query($sel_stmt);
		 $r_pwd   = $sel_stmt -> fetch(PDO::FETCH_ASSOC); 
         $cnt = $r_pwd[CNT];
         if ($cnt == "") $cnt = 0;
         if ($cnt == 0)
         {
			no_access_goToLoginPage();   
		 }
		 else
		 {
		   $loc = "http://mis.rfi.net/mis/fa/fa_modify_user.php";   
		   $sec = "NEW";   
           goToNavPage($loc,$uid,$typ,$sec); 
		 }
		
		
    }
    else
    {
     
     if ($typ == "aweil_upl")
     {
        $loc = "http://mis.rfi.net/mis/cash_office/aweil_file_upload.php";      
        goToNavPage($loc,$uid,$typ,$sec);         
       
      }
     if ($typ == "aweil_cmp")
     {
        $loc = "http://mis.rfi.net/mis/cash_office/aweil_fa_cmps.php";      
        goToNavPage($loc,$uid,$typ,$sec);         
       
      }
    if ($typ == "aweil_vr")
     {
        $loc = "http://mis.rfi.net/mis/cash_office/vr_auth_menu.php";      
        goToNavPage($loc,$uid,$typ,$sec);         
       
      }
    
     
  if ($typ == "aweil_vwcs")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/aweil_sbi_data.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
     if ($typ == "aweil_iden")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/aweil_sbi_data_identification.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
	if ($typ == "aweil_uden")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/aweil_sbi_data_uniden_list.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
     if ($typ == "aweil_idel")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/aweil_sbi_data_iden_list.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
      if ($typ == "aweil_nps")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/nps_generation.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
     if ($typ == "aweil_chk")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/bill_cmp_check.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
     if ($typ == "aweil_pmt")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/payment_range.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
     if ($typ == "aweil_pcfa")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/d_c_pcfa.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
     if ($typ == "aweil_trx")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/aweil_fund_menu.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
      if ($typ == "aweil_head")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/aweil_sale_rep.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
      if ($typ == "aweil_inv")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/aweil_pl_Tb_view.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
     if ($typ == "aweil_inv")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/aweil_foh_voh_AnnexureA.php";
          goToNavPage($loc,$uid,$typ,$sec);
    
     }
     if ($typ == "aweil_inv")
     {
          $loc =  "http://mis.rfi.net/mis/cash_office/inv_oh_menu.php";
          goToNavPage($loc,$uid,$typ,$sec);
      }
     }
     function goToNavPage($loc,$uid,$typ,$sec)
     {
        session_register('username');
		session_register('sessionid');
		session_register('work_cat');
		session_register('stat');
		$_SESSION['username']=$uid;
		$_SESSION['sessionid']= session_id();
		$_SESSION['work_cat'] = $typ;
		$_SESSION['stat'] = $sec; 
         // echo  $_SESSION['username'],"-",$_SESSION['sessionid'],"-",$_SESSION['work_cat'];
          if(registerSession($_SESSION['username'],$_SESSION['sessionid'],$_SESSION['sec']))
		{
	      
          $win = "<script>window.location.href('".$loc."')</script>";
	      $win1 = "<script>window.close()</script>";
          $chk = "<script>if (navigator.appName == \"Microsoft Internet Explorer\") window.location.assign('".$loc."'); else window.location.assign('".$loc."');</script>";
          
          echo $chk;
          //echo $win1;
          /*
          
          print ("<SCRIPT LANGUAGE='JavaScript'>");
          print ("window.open('". $loc);
          print ("')");
          print (" </script> "); 
           */
         }
         else
         {
			goToLoginPage();
		 }
        
     }   
     function registerSession($loginId,$sessionId)
    {
    include ("../cash_office/conn.php");
    $del_stmt = "delete from m_session where loginId = '$loginId' ";
	$del_stmt = $dbe -> prepare($del_stmt);
	$del_stmt -> execute();
	$tm = date("Y-m-d H:i:s");
	$tot_steps = 0;
    $insert_sql = "insert into m_session (loginId, sessionId, totalSteps,lastactivitytime) values('$loginId','$sessionId',$tot_steps,'$tm') ";
    
	$dbe -> exec($insert_sql);
	$error = $dbe  -> errorInfo();
	if ($error["1"])
        {
		return false;
    	}
	       else
	 	return true;
 } 
function goToLoginPage()
{
	session_destroy();
	session_unset();
    echo '<script>
    	window.location.href="http://mis.rfi.net/mis/fa";
		</script>';
	exit();
}
function no_access_goToLoginPage()
{
	session_destroy();
	session_unset();
    
    echo '<script>
    	alert("CHECK USERNAME/PASSWORD!!");
        window.location.href="http://mis.rfi.net/mis/fa";
		</script>';
	exit();
}
function personal_pwd($pwd,$uid,$typ)
{
  include("../mktg/conn.php");
 
 $sel_stmt = "select count(*)cnt from personal_passwd where uid = '$uid' and passwd = '$pwd' and func = '$typ'";
 $sel_stmt = $dbe->query($sel_stmt);
 $r_pwd   = $sel_stmt -> fetch(PDO::FETCH_ASSOC); 
 if ($r_pwd[CNT] == "")
 {
    $r_pwd[CNT] = 0;
 }
 $cnt = $r_pwd[CNT];
 if ($r_pwd[CNT] > 0)
 {
	 $sel_stmt = "select * from personal_passwd where uid = '$uid' and passwd = '$pwd' and func = '$typ'";
	 $sel_stmt = $dbe->query($sel_stmt);
 	$r_pwd   = $sel_stmt -> fetch(PDO::FETCH_ASSOC); 
   
}
 $arr[0]=$cnt;
 $arr[1]=trim($r_pwd[TYP]);
 return $arr;
}
?>