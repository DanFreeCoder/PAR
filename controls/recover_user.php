<?php
include '../config/clsConnection.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$user = new Users($db);

$user->email = $_POST['email'];

$send = $user->forgot_password_email();
while ($row = $send->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $email = $row['email'];
}
if ($send) {
    
    echo 1;
    $from = "system.administrator<(it@innogroup.com.ph)>";
    $to = $email;

    $subject = "[PAR Online]Please Reset your Password";
    $message = '<html>
                        <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                            <div style="background-color: #00C957; padding: 5px; color: white">
                                <h3 style="padding: 0; margin: 0;">  Message: </h3>
                            </div>
                            <div style="border: 1px solid #e1e1e1; padding: 5px">    
                            <h3>PAR Password Reset</h3>
                            We heard that you lost your PAR password. Sorry about that!<br>
                            But don`t worry! You can use the following link to reset your password:<br>
                            click: <a href="https://www.innogroup.com.ph/par/pages/user/reset_password.php?id=' . $id . '">www.innogroup.com.ph/par</a>
                            </div>
                            <br/>
                            <br/>
                            <div style="padding:10px 0px; text-align: center; font-size: 11px; border-top: 1px solid #e1e1e1">
                             PAR Online &middot; <a href="https://www.innogroup.com.ph/par">Innogroup</a>
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
