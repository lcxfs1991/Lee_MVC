<?php
Class Helper_mail implements Function_interface {
    public function __construct() {
        
    }

    public function getInput($to,$subject,$msg,$from){

    	$headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From:$from" . "\r\n";
        mail($to, $subject, $msg, $headers);
    	
    }
}
?>
