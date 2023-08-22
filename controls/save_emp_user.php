<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

$date_hire = date('Y-m-d', strtotime($_POST['date_hire']));
$user->firstname = strtoupper($_POST['firstname']);
$user->lastname = strtoupper($_POST['lastname']);
$user->position = strtoupper($_POST['position']);
$user->project = $_POST['project'];
$user->date_hire = $date_hire;
$user->dept = $_POST['department'];
$user->email = $_POST['email'];
$user->username = $_POST['username'];
$user->user_pass = md5('123456');

$save = $user->addUser_emp();
if ($save) {
    echo 1;
    $from = "system.administrator<(it@innogroup.com.ph)>";
    $to = $_POST['email'];

    $subject = "Online PAR User Message";
    $message = '<html>
                    <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                        <div style="background-color: #00C957; padding: 5px; color: white">
                            <h3 style="padding: 0; margin: 0;">  Message: </h3>
                        </div>
                        <div style="border: 1px solid #e1e1e1; padding: 5px">    
                            Hi ' . $_POST['firstname'] . ', <br><br>
                            Your user account has successfully created. You can create your own PAR through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a>. Sign in by using the username <b>' . $_POST['username'] . '</b> and password of <b>123456</b> to access the system.<br>Please immediately change your password as directed.<br><br>
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
    $headers .= "From: " . $from . "" . "\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
}
