<?php
error_reporting(0);
    include('qrlib.php');


    // how to save PNG codes to server
    
    $tempDir = 'qrcode/';
    
    $codeContents = 'This Goes From File';
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    //$fileName = '005_file_'.md5($codeContents).'.png';
    $fileName = "L".$_POST[i1].'.png';
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
      $upi_intent = "upi://pay?pa=abc@axis&pn=eerrorcomments&am=1000&cu=INR";
      QRcode::png($upi_intent, $fileName,3,5);
      //QRcode::png($upi_intent, $pngAbsoluteFilePath,3,5);
        //QRcode::png($codeContents, $pngAbsoluteFilePath);
    //    echo 'File generated!';
     //   echo '<hr />';
    } else {
       // echo 'File already generated! We can use this cached file to speed up site on common codes!';
        //echo '<hr />';
    }
    
    //echo 'Server PNG File: '.$pngAbsoluteFilePath;
    //echo '<hr />';
    
    // displaying
    //echo '<img src="'.$urlRelativeFilePath.'" />';
	echo $fileName;
    ?>
    