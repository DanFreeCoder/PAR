<?php
session_start();
include '../config/clsConnection.php';
include '../objects/clsDetails.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$details = new ParDetails($db);
$user = new Users($db);

$details->id = $_POST['id'];
$details->oap_scale = $_POST['oap_scale'];
$details->accomplishment = $_POST['accomplishments'];
$details->recommendation = $_POST['recommendation'];
$details->gross = $_POST['gross'];
$details->remarks = $_POST['remarks'];
$upd = $details->accept_par_app2();

if($upd){
    echo 1;
    //get approver 1/2 user details
    $user->id = $_POST['rater'];
    $get = $user->get_user_by_id();
    while($row = $get->fetch(PDO:: FETCH_ASSOC))
    {
        $dept = $row['dept'];
        //get the approver 3 details
        $user->dept = $dept;
        $get_app3 = $user->check_approver3();
        while($row2 = $get_app3->fetch(PDO:: FETCH_ASSOC))
        {
            $email = $row2['email'];
            $fname = $row2['firstname'];
            if($row > 0)
            {           
                //SEND EMAIL NOTIFICATION FOR APPROVER 3
                $from = "system.administrator<(noreply@innogroup.com.ph)>"; 
                $to = $email;

                $subject = "Online PAR Notification";
                $message = '<html>
                                <head>
                                </head>
                                    <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                                        <div style="background-color: #00C957; padding: 5px; color: white">
                                            <h3 style="padding: 0; margin: 0;">Notice: </h3>
                                        </div>
                                        <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                            Hi '.$fname.', <br><br> <b>'.$_POST['name'].'</b> online PAR has reviewed by <b>'.$_SESSION['fullname'].'</b> You can check the PAR contents through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a> and If this is your first time to sign in, use your spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
                                            If access is unsuccessful, kindly contact HR at local 107 for assistance.<br><br>
                                            Thank you. <br><br> Best Regards, <br>PAR Administrator
                                        </div>
                                        <br/>
                                        <br/>
                                        <div style="padding:10px 0px; text-align: center; font-size: 11px; border-top: 1px solid #e1e1e1">
                                            IGC Online PAR System &middot; <a href="http://www.innogroup.com.ph">Innogroup</a>
                                        </div>
                                </body>
                            </html>';

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