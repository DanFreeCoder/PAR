<?php
include '../config/clsConnection.php';
include '../objects/clsDetails.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$details = new ParDetails($db);
$user = new Users($db);

//get the emp supervisor details
$sup_name = '';
$sup_email = '';
$user->id  = $_POST['rater_id'];
$get_reviewer = $user->get_user_by_id();
while($row = $get_reviewer->fetch(PDO:: FETCH_ASSOC))
{
    $sup_name = $row['firstname'];
    $sup_email = $row['email'];
}
//update performance recommendation
$details->id = $_POST['id'];
$details->recommendation = $_POST['recommendation'];
$details->gross = $_POST['gross'];
$details->remarks = $_POST['remarks'];
$details->declined = $_POST['reason'];
$upd = $details->upd_hr_recommend();

if($upd)
{
    if($get_reviewer)
    {
        $from = "system.administrator<(noreply@innogroup.com.ph)>"; 
        $to = $sup_email;

        $subject = "Online PAR Notification";
        $message = '<html>
                        <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                            <div style="background-color: #00C957; padding: 5px; color: white">
                                <h3 style="padding: 0; margin: 0;">  Message: </h3>
                            </div>
                            <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                Hi '.$sup_name.', <br><br>
                                <b>'.$_POST['emp_name'].'</b> online PAR has been marked for revision. You may refer below for the revision reason/s.<br><b>'.$_POST['reason'].'</b><br><br>
                                Thank you. <br><br>
                                Thank You, <br>PAR Administrator
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
        echo 1;
    }
    else
    {
        echo 0;
    }
}
else
{
    echo 0;
}
?>