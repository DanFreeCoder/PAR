<?php
session_start();
include '../config/clsConnection.php';
include '../objects/clsDetails.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$details = new ParDetails($db);
$user = new Users($db);

//APPROVED PAR THROUGH DASHBOARD
$details->id = $_POST['id'];
$details->status = 4;
$upd = $details->approve_par();

if($upd){
    echo 1;
    //get the rater ID
    $details->id = $_POST['id'];
    $get = $details->get_reviewer();
    while($row = $get->fetch(PDO:: FETCH_ASSOC))
    {
        //get approver 1/2 user details
        $user->id = $row['rater'];
        $get = $user->get_user_by_id();
        while($row1 = $get->fetch(PDO:: FETCH_ASSOC))
        {
            $email = $row1['email'];
            $fname = $row1['firstname'];

            if($row1 > 0)
            {           
                //SEND EMAIL NOTIFICATION
                $from = "system.administrator<(noreply@innogroup.com.ph)>"; 
                $to = $email;

                $subject = "Online PAR Notification";
                $message = "<html>
                                <head>
                                </head>
                                    <body style='margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri'>
                                        <div style='background-color: #00C957; padding: 5px; color: white'>
                                            <h3 style='padding: 0; margin: 0;'>Notice: </h3>
                                        </div>
                                        <div style='border: 1px solid #e1e1e1; padding: 5px'>    
                                            Hi ".$fname.", <br><br> <b>".$row['emp_name']."</b> online PAR has been approved by <b>".$_SESSION['fullname']."</b> and the document is now ready for printing.<br><br>
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
            }
            else
            {
                echo 1;
            }
        }
        //get the hr user and send a notification
    $get_hr = $user->get_hr_admin();
    while($row = $get_hr->fetch(PDO:: FETCH_ASSOC))
    {
        $email = $row['email'];
        if($row > 0)
        {           
            //SEND EMAIL NOTIFICATION TO HR ADMIN
            $from = "system.administrator<(noreply@innogroup.com.ph)>"; 
            $to = $email;

            $subject = "Online PAR Notification";
            $message = "<html>
                            <head>
                            </head>
                                <body style='margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri'>
                                    <div style='background-color: #00C957; padding: 5px; color: white'>
                                        <h3 style='padding: 0; margin: 0;'>Notice: </h3>
                                    </div>
                                    <div style='border: 1px solid #e1e1e1; padding: 5px'>    
                                        Hi HR Admin, <br><br> <b>".$_POST['name']."</b> online PAR has been approved by <b>".$_SESSION['fullname']."</b> and the document is now ready for printing.<br><br>
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
        }
        else
        {
            echo 1;
        }
    }
    }
}else{
    echo 0;
}

?>