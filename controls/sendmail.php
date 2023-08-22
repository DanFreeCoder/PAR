<?php
      
//SEND EMAIL NOTIFICATION TO HR ADMIN
$from = "system.administrator<(noreply@innogroup.com.ph)>"; 
$to = 'michelle.bernades@innogroup.com.ph';

$subject = "Online PAR Notification";
$message = "<html>
                <head>
                </head>
                    <body style='margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri'>
                        <div style='background-color: #00C957; padding: 5px; color: white'>
                            <h3 style='padding: 0; margin: 0;'>Notice: </h3>
                        </div>
                        <div style='border: 1px solid #e1e1e1; padding: 5px'>    
                            Hi HR Admin, <br><br> <b>Sample Employe Name</b> online PAR has been approved by <b>Approver 2 Name</b> and the document is now ready for printing.<br><br>
                            Please be reminded that access to this paper is only privy to a few authorized personnel. Therefore, please treat this document with utmost confidentiality.<br><br>
                            Thank you. <br><br> Best Regards, <br>PAR Administrator
                        </div>
                        <br/>
                        <br/>
                        <div style='padding:10px 0px; text-align: center; font-size: 11px; border-top: 1px solid #e1e1e1'>
                            IGC Online PAR System &middot; <a href='http://www.innogroup.com.ph'>Innogroup</a>
                        </div>
                </body>
            </html>";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= "From: ".$from."" . "\r\n" ;

if(mail($to,$subject,$message,$headers))
{
    echo 1;
}
else
{
    echo 0;
}
?>