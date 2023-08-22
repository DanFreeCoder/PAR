<?php
session_start();
include '../config/clsConnection.php';
include '../objects/clsDetails.php';
include '../objects/clsKra.php';
include '../objects/clsGenPerformance.php';
include '../objects/clsPIP.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$details = new ParDetails($db);
$kra = new Kra_Kpi($db);
$gp = new GenPerformance($db);
$pip = new PerformanceImprovement($db);
$user = new Users($db);

//convert the date
$review_from = date('Y-m-d', strtotime($_POST['from']));
$review_to = date('Y-m-d', strtotime($_POST['to']));
$date_hire = date('Y-m-d', strtotime($_POST['date_hire']));

//get the current id of kra
$kra_id = '';
$get_KRA = $kra->get_supKRA_last_id();
while ($row = $get_KRA->fetch(PDO::FETCH_ASSOC)) {
    if ($row['kra_id'] == null) {
        $kra_id = 1;
    } else {
        $kra_id = $row['kra_id'];
    }
}
//get the last general performance id
$gp_id = '';
$get_GP = $gp->get_supGP_last_id();
while ($row = $get_GP->fetch(PDO::FETCH_ASSOC)) {
    if ($row['gp_id'] == null) {
        $gp_id = 1;
    } else {
        $gp_id = $row['gp_id'];
    }
}
//get the last Performance Improvement Plan id
$pip_id = '';
$get_pip = $pip->get_supPIP_last_id();
while ($row = $get_pip->fetch(PDO::FETCH_ASSOC)) {
    if ($row['pip_id'] == null) {
        $pip_id = 1;
    } else {
        $pip_id = $row['pip_id'];
    }
}

//get the last sup_par id
$sup_id = '';
$get_sup = $details->get_sup_last_id();
while ($row = $get_sup->fetch(PDO::FETCH_ASSOC)) {
    if ($row['sup_id'] == null) {
        $sup_id = 1;
    } else {
        $sup_id = $row['sup_id'];
    }
}

//check if the department have APPROVER 2
$status = '';
$user->dept = $_POST['department'];
$check = $user->check_approver2();
while ($row = $check->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    if ($row['count'] > 0) {
        $status = 2;
    } elseif ($_POST['rater'] == 'HR Administrator' || $_POST['access'] == 3) {
        $status = 4;
    } else {
        $status = 3;
    }
}

//kra & kpi rating
//KRA1
if ($_POST['kra_rating1'] == '') {
    $kra_rating1 = 0;
} else {
    $kra_rating1 = $_POST['kra_rating1'];
}
//KRA2
if ($_POST['kra_rating2'] == '') {
    $kra_rating2 = 0;
} else {
    $kra_rating2 = $_POST['kra_rating2'];
}
//KRA3
if ($_POST['kra_rating3'] == '') {
    $kra_rating3 = 0;
} else {
    $kra_rating3 = $_POST['kra_rating3'];
}
//KRA4
if ($_POST['kra_rating4'] == '') {
    $kra_rating4 = 0;
} else {
    $kra_rating4 = $_POST['kra_rating4'];
}
//KRA5
if ($_POST['kra_rating5'] == '') {
    $kra_rating5 = 0;
} else {
    $kra_rating5 = $_POST['kra_rating5'];
}
//KRA6
if ($_POST['kra_rating6'] == '') {
    $kra_rating6 = 0;
} else {
    $kra_rating6 = $_POST['kra_rating6'];
}
//GENERAL PERFORMANCE
//GP1
if ($_POST['gp1a_rate'] == '') {
    $gp1a_rate = 0;
} else {
    $gp1a_rate = $_POST['gp1a_rate'];
}
if ($_POST['gp1b_rate'] == '') {
    $gp1b_rate = 0;
} else {
    $gp1b_rate = $_POST['gp1b_rate'];
}
if ($_POST['gp1c_rate'] == '') {
    $gp1c_rate = 0;
} else {
    $gp1c_rate = $_POST['gp1c_rate'];
}
//GP2
if ($_POST['gp2a_rate'] == '') {
    $gp2a_rate = 0;
} else {
    $gp2a_rate = $_POST['gp2a_rate'];
}
if ($_POST['gp2b_rate'] == '') {
    $gp2b_rate = 0;
} else {
    $gp2b_rate = $_POST['gp2b_rate'];
}
if ($_POST['gp2c_rate'] == '') {
    $gp2c_rate = 0;
} else {
    $gp2c_rate = $_POST['gp2c_rate'];
}
//GP3
if ($_POST['gp3a_rate'] == '') {
    $gp3a_rate = 0;
} else {
    $gp3a_rate = $_POST['gp3a_rate'];
}
if ($_POST['gp3b_rate'] == '') {
    $gp3b_rate = 0;
} else {
    $gp3b_rate = $_POST['gp3b_rate'];
}
if ($_POST['gp3c_rate'] == '') {
    $gp3c_rate = 0;
} else {
    $gp3c_rate = $_POST['gp3c_rate'];
}
//GP4
if ($_POST['gp4a_rate'] == '') {
    $gp4a_rate = 0;
} else {
    $gp4a_rate = $_POST['gp4a_rate'];
}
if ($_POST['gp4b_rate'] == '') {
    $gp4b_rate = 0;
} else {
    $gp4b_rate = $_POST['gp4b_rate'];
}
if ($_POST['gp4c_rate'] == '') {
    $gp4c_rate = 0;
} else {
    $gp4c_rate = $_POST['gp4c_rate'];
}
//GP5
if ($_POST['gp5a_rate'] == '') {
    $gp5a_rate = 0;
} else {
    $gp5a_rate = $_POST['gp5a_rate'];
}
if ($_POST['gp5b_rate'] == '') {
    $gp5b_rate = 0;
} else {
    $gp5b_rate = $_POST['gp5b_rate'];
}
if ($_POST['gp5c_rate'] == '') {
    $gp5c_rate = 0;
} else {
    $gp5c_rate = $_POST['gp5c_rate'];
}
//GP6
if ($_POST['gp6a_rate'] == '') {
    $gp6a_rate = 0;
} else {
    $gp6a_rate = $_POST['gp6a_rate'];
}
if ($_POST['gp6b_rate'] == '') {
    $gp6b_rate = 0;
} else {
    $gp6b_rate = $_POST['gp6b_rate'];
}
if ($_POST['gp6c_rate'] == '') {
    $gp6c_rate = 0;
} else {
    $gp6c_rate = $_POST['gp6c_rate'];
}
//GP7
if ($_POST['gp7a_rate'] == '') {
    $gp7a_rate = 0;
} else {
    $gp7a_rate = $_POST['gp7a_rate'];
}
if ($_POST['gp7b_rate'] == '') {
    $gp7b_rate = 0;
} else {
    $gp7b_rate = $_POST['gp7b_rate'];
}
if ($_POST['gp7c_rate'] == '') {
    $gp7c_rate = 0;
} else {
    $gp7c_rate = $_POST['gp7c_rate'];
}
//GP8
if ($_POST['gp8a_rate'] == '') {
    $gp8a_rate = 0;
} else {
    $gp8a_rate = $_POST['gp8a_rate'];
}
if ($_POST['gp8b_rate'] == '') {
    $gp8b_rate = 0;
} else {
    $gp8b_rate = $_POST['gp8b_rate'];
}
if ($_POST['gp8c_rate'] == '') {
    $gp8c_rate = 0;
} else {
    $gp8c_rate = $_POST['gp8c_rate'];
}
//GP9
if ($_POST['gp9a_rate'] == '') {
    $gp9a_rate = 0;
} else {
    $gp9a_rate = $_POST['gp9a_rate'];
}
if ($_POST['gp9b_rate'] == '') {
    $gp9b_rate = 0;
} else {
    $gp9b_rate = $_POST['gp9b_rate'];
}
if ($_POST['gp9c_rate'] == '') {
    $gp9c_rate = 0;
} else {
    $gp9c_rate = $_POST['gp9c_rate'];
}
//GP10
if ($_POST['gp10a_rate'] == '') {
    $gp10a_rate = 0;
} else {
    $gp10a_rate = $_POST['gp10a_rate'];
}
if ($_POST['gp10b_rate'] == '') {
    $gp10b_rate = 0;
} else {
    $gp10b_rate = $_POST['gp10b_rate'];
}
if ($_POST['gp10c_rate'] == '') {
    $gp10c_rate = 0;
} else {
    $gp10c_rate = $_POST['gp10c_rate'];
}

//from 1st Approver - SAVE to SUP_PAR DB
if ($_POST['action'] == 1) //REVIEWED BY APPROVER 1
{
    //PAR details
    $details->id = $_POST['id'];
    $details->par_id = $_POST['id'];
    $details->kra_id = $kra_id;
    $details->gp_id = $gp_id;
    $details->pip_id = $pip_id;
    $details->sup_id = $sup_id;
    $details->emp_name = $_POST['name'];
    $details->position = $_POST['position'];
    $details->department = $_POST['department'];
    $details->project = $_POST['project'];
    $details->emp_status = $_POST['emp_status'];
    $details->assessment = $_POST['assessment'];
    $details->review_from = $review_from;
    $details->review_to = $review_to;
    $details->date_hire = $date_hire;
    $details->rater = $_POST['rater'];
    $details->rater_name = $_POST['rater_name'];
    $details->emp_email = $_POST['emp_email'];
    $details->kra_total = $_POST['kra_total'];
    $details->gp_total = $_POST['gp_total'];
    $details->kra_average = $_POST['kra_average'];
    $details->gp_average = $_POST['gp_average'];
    $details->oap_total = $_POST['oap_total'];
    $details->oap_scale = $_POST['oap_scale'];
    $details->accomplishment = $_POST['accomplishments'];
    $details->prof_dev = $_POST['prof_dev'];
    $details->prof_others = $_POST['prof_others'];
    $details->emp_comment = $_POST['emp_comment'];
    $details->date_submit = date('Y-m-d');
    $details->eval_by = $_POST['eval_by'];
    $details->status = $status;
    $details->par_status = $status;
    //Performance recommnedation
    $details->recommendation = $_POST['recommendation'];
    $details->gross = $_POST['gross'];
    $details->remarks = $_POST['remarks'];
    $details->date_evaluated = date('Y-m-d');

    //kra & kpi details
    $kra->kra1 = $_POST['kra1'];
    $kra->kpi1 = $_POST['kpi1'];
    $kra->rate1 = $kra_rating1;
    $kra->comments1 = $_POST['comments1'];
    $kra->sup_com1 = $_POST['sup_com1'];
    $kra->kra2 = $_POST['kra2'];
    $kra->kpi2 = $_POST['kpi2'];
    $kra->rate2 = $kra_rating2;
    $kra->comments2 = $_POST['comments2'];
    $kra->sup_com2 = $_POST['sup_com2'];
    $kra->kra3 = $_POST['kra3'];
    $kra->kpi3 = $_POST['kpi3'];
    $kra->rate3 = $kra_rating3;
    $kra->comments3 = $_POST['comments3'];
    $kra->sup_com3 = $_POST['sup_com3'];
    $kra->kra4 = $_POST['kra4'];
    $kra->kpi4 = $_POST['kpi4'];
    $kra->rate4 = $kra_rating4;
    $kra->comments4 = $_POST['comments4'];
    $kra->sup_com4 = $_POST['sup_com4'];
    $kra->kra5 = $_POST['kra5'];
    $kra->kpi5 = $_POST['kpi5'];
    $kra->rate5 = $kra_rating5;
    $kra->comments5 = $_POST['comments5'];
    $kra->sup_com5 = $_POST['sup_com5'];
    $kra->kra6 = $_POST['kra6'];
    $kra->kpi6 = $_POST['kpi6'];
    $kra->rate6 = $kra_rating6;
    $kra->comments6 = $_POST['comments6'];
    $kra->sup_com6 = $_POST['sup_com6'];

    //general performance details
    $gp->gp1a_rate = $gp1a_rate;
    $gp->gp1a_comment = $_POST['gp1a_comment'];
    $gp->gp1b_rate = $gp1b_rate;
    $gp->gp1b_comment = $_POST['gp1b_comment'];
    $gp->gp1c_rate = $gp1c_rate;
    $gp->gp1c_comment = $_POST['gp1c_comment'];
    $gp->gp2a_rate = $gp2a_rate;
    $gp->gp2a_comment = $_POST['gp2a_comment'];
    $gp->gp2b_rate = $gp2b_rate;
    $gp->gp2b_comment = $_POST['gp2b_comment'];
    $gp->gp2c_rate = $gp2c_rate;
    $gp->gp2c_comment = $_POST['gp2c_comment'];
    $gp->gp3a_rate = $gp3a_rate;
    $gp->gp3a_comment = $_POST['gp3a_comment'];
    $gp->gp3b_rate = $gp3b_rate;
    $gp->gp3b_comment = $_POST['gp3b_comment'];
    $gp->gp3c_rate = $gp3c_rate;
    $gp->gp3c_comment = $_POST['gp3c_comment'];
    $gp->gp4a_rate = $gp4a_rate;
    $gp->gp4a_comment = $_POST['gp4a_comment'];
    $gp->gp4b_rate = $gp4b_rate;
    $gp->gp4b_comment = $_POST['gp4b_comment'];
    $gp->gp4c_rate = $gp4c_rate;
    $gp->gp4c_comment = $_POST['gp4c_comment'];
    $gp->gp5a_rate = $gp5a_rate;
    $gp->gp5a_comment = $_POST['gp5a_comment'];
    $gp->gp5b_rate = $gp5b_rate;
    $gp->gp5b_comment = $_POST['gp5b_comment'];
    $gp->gp5c_rate = $gp5c_rate;
    $gp->gp5c_comment = $_POST['gp5c_comment'];
    $gp->gp6a_rate = $gp6a_rate;
    $gp->gp6a_comment = $_POST['gp6a_comment'];
    $gp->gp6b_rate = $gp6b_rate;
    $gp->gp6b_comment = $_POST['gp6b_comment'];
    $gp->gp6c_rate = $gp6c_rate;
    $gp->gp6c_comment = $_POST['gp6c_comment'];
    $gp->gp7a_rate = $gp7a_rate;
    $gp->gp7a_comment = $_POST['gp7a_comment'];
    $gp->gp7b_rate = $gp7b_rate;
    $gp->gp7b_comment = $_POST['gp7b_comment'];
    $gp->gp7c_rate = $gp7c_rate;
    $gp->gp7c_comment = $_POST['gp7c_comment'];
    $gp->gp8a_rate = $gp8a_rate;
    $gp->gp8a_comment = $_POST['gp8a_comment'];
    $gp->gp8b_rate = $gp8b_rate;
    $gp->gp8b_comment = $_POST['gp8b_comment'];
    $gp->gp8c_rate = $gp8c_rate;
    $gp->gp8c_comment = $_POST['gp8c_comment'];
    $gp->gp9a_rate = $gp9a_rate;
    $gp->gp9a_comment = $_POST['gp9a_comment'];
    $gp->gp9b_rate = $gp9b_rate;
    $gp->gp9b_comment = $_POST['gp9b_comment'];
    $gp->gp9c_rate = $gp9c_rate;
    $gp->gp9c_comment = $_POST['gp9c_comment'];
    $gp->gp10a_rate = $gp10a_rate;
    $gp->gp10a_comment = $_POST['gp10a_comment'];
    $gp->gp10b_rate = $gp10b_rate;
    $gp->gp10b_comment = $_POST['gp10b_comment'];
    $gp->gp10c_rate = $gp10c_rate;
    $gp->gp10c_comment = $_POST['gp10c_comment'];

    //Performance Improvement Plan
    $pip->pin1 = $_POST['pin1'];
    $pip->at1 = $_POST['at1'];
    $pip->sn1 = $_POST['sn1'];
    $pip->time1 = $_POST['timeline1'];
    $pip->pin2 = $_POST['pin2'];
    $pip->at2 = $_POST['at2'];
    $pip->sn2 = $_POST['sn2'];
    $pip->time2 = $_POST['timeline2'];
    $pip->pin3 = $_POST['pin3'];
    $pip->at3 = $_POST['at3'];
    $pip->sn3 = $_POST['sn3'];
    $pip->time3 = $_POST['timeline3'];

    $save_par = $details->save_supPAR();
    $save_kra = $kra->save_supKRA();
    $save_gp = $gp->save_supGP();
    $save_pip = $pip->save_supPIP();
    $upd_stat = $details->upd_stat();

    if ($save_par) {
        if ($save_kra) {
            if ($save_gp) {
                if ($save_pip) {
                    if ($upd_stat) {
                        echo 1;
                        //get the name of evaluator
                        $user->id = $_POST['eval_by'];
                        $get = $user->get_user_by_id();
                        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                            $fullname = $row['fullname'];
                        }

                        $user->dept = $_POST['department'];
                        $get = $user->check_approver2();
                        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                            if ($row['count'] == 0) //if no approver 2
                            {
                                //get the managers details
                                $user->dept = $_POST['department'];
                                $get2 = $user->get_approver3_email();
                                while ($row = $get2->fetch(PDO::FETCH_ASSOC)) {
                                    $email = $row['email'];
                                    //send email notification to approvers
                                    $from = "system.administrator<(it@innogroup.com.ph)>";
                                    $to = $email;

                                    $subject = "Online PAR Notification";
                                    $message = '<html>
                                                    <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                                                        <div style="background-color: #00C957; padding: 5px; color: white">
                                                            <h3 style="padding: 0; margin: 0;">Message: </h3>
                                                        </div>
                                                        <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                                            Hi, <br><br>
                                                            Greetings!<br><br>
                                                            <b>' . $fullname . '</b> has reviewed the ' . $_POST['assessment'] . ' PAR of <b>' . $_POST['name'] . '</b>. You can check the PAR contents through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a> and If this is your first time to sign in, use your spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
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
                                    $headers .= "From: " . $from . "" . "\r\n";

                                    if (mail($to, $subject, $message, $headers)) {
                                        echo 1;
                                    } else {
                                        echo 0;
                                    }
                                }
                                if ($_SESSION['role'] != 1) {
                                    //send email to hr
                                    $hr = $user->get_hr_admin();
                                    while ($row = $hr->fetch(PDO::FETCH_ASSOC)) {
                                        $email = $row['email'];
                                        //send email to hr
                                        $from = "system.administrator<(it@innogroup.com.ph)>";
                                        $to = $email;

                                        $subject = "Online PAR Notification";
                                        $message = '<html>
                                   <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                                       <div style="background-color: #00C957; padding: 5px; color: white">
                                           <h3 style="padding: 0; margin: 0;">Message: </h3>
                                       </div>
                                       <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                           Hi HR admin, <br><br>
                                           Greetings!<br><br>
                                           <b>' . $fullname . '</b> has reviewed the ' . $_POST['assessment'] . ' PAR of <b>' . $_POST['name'] . '</b>. You can check the PAR contents through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a> and If this is your first time to sign in, useyour spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
                                           If access is unsuccessful, kindly contact HR at local 107 for assistance.<br><br>
                                           Best Regards, <br>PAR Administrator
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
                                    }
                                }
                            } else {
                                $user->dept = $_POST['department'];
                                $get = $user->get_approver2_email();
                                while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                    $email = $row['email'];
                                    //send email notification to approvers
                                    $from = "system.administrator<(it@innogroup.com.ph)>";
                                    $to = $email;

                                    $subject = "Online PAR Notification";
                                    $message = '<html>
                                                    <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                                                        <div style="background-color: #00C957; padding: 5px; color: white">
                                                            <h3 style="padding: 0; margin: 0;">Message: </h3>
                                                        </div>
                                                        <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                                            Hi, <br><br>
                                                            Greetings!<br><br>
                                                            <b>' . $fullname . '</b> has reviewed the ' . $_POST['assessment'] . ' PAR of <b>' . $_POST['name'] . '</b>. You can check the PAR contents through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a> and If this is your first time to sign in, useyour spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
                                                            If access is unsuccessful, kindly contact HR at local 107 for assistance.<br><br>
                                                            Best Regards, <br>PAR Administrator
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
                                }
                                if ($_SESSION['role'] != 1) {
                                    //send email to hr
                                    $hr = $user->get_hr_admin();
                                    while ($row = $hr->fetch(PDO::FETCH_ASSOC)) {
                                        $email = $row['email'];
                                        //send email to hr
                                        $from = "system.administrator<(it@innogroup.com.ph)>";
                                        $to = $email;

                                        $subject = "Online PAR Notification";
                                        $message = '<html>
                                   <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                                       <div style="background-color: #00C957; padding: 5px; color: white">
                                           <h3 style="padding: 0; margin: 0;">Message: </h3>
                                       </div>
                                       <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                           Hi HR admin, <br><br>
                                           Greetings!<br><br>
                                           <b>' . $fullname . '</b> has reviewed the ' . $_POST['assessment'] . ' PAR of <b>' . $_POST['name'] . '</b>. You can check the PAR contents through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a> and If this is your first time to sign in, useyour spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
                                           If access is unsuccessful, kindly contact HR at local 107 for assistance.<br><br>
                                           Best Regards, <br>PAR Administrator
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
                                    }
                                }
                            }
                        }
                    } else {
                        echo 0;
                    }
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} elseif ($_POST['action'] == 2) //UPDATE EVALUATED PAR (SUP DB) - APPROVER 2
{
    $kra_id = '';
    $gp_id = '';
    $pip_id = '';
    //get ids
    $details->id = $_POST['id'];
    $get = $details->get_par_ids();
    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
        $kra_id = $row['kra_id'];
        $gp_id = $row['gp_id'];
        $pip_id = $row['pip_id'];
    }
    //check role
    if ($_POST['role'] == 1) {
        $par_stat = 2; //Approver 1
    } elseif ($_POST['role'] == 2) {
        $par_stat = 3; //Approver 2
    } else {
        $par_stat = 4; //Approver 3
    }

    //PAR details
    $details->id = $_POST['id'];
    $details->rater_name = $_POST['rater_name'];
    $details->kra_total = $_POST['kra_total'];
    $details->gp_total = $_POST['gp_total'];
    $details->kra_average = $_POST['kra_average'];
    $details->gp_average = $_POST['gp_average'];
    $details->oap_total = $_POST['oap_total'];
    $details->oap_scale = $_POST['oap_scale'];
    $details->accomplishment = $_POST['accomplishments'];
    $details->prof_dev = $_POST['prof_dev'];
    $details->prof_others = $_POST['prof_others'];
    $details->emp_comment = $_POST['emp_comment'];
    $details->date_submit = date('Y-m-d');
    $details->eval_by = $_POST['eval_by'];
    $details->par_status = $par_stat;
    //Performance recommnedation
    $details->recommendation = $_POST['recommendation'];
    $details->gross = $_POST['gross'];
    $details->remarks = $_POST['remarks'];
    $details->date_evaluated = date('Y-m-d');

    //kra & kpi details
    $kra->kra_id = $kra_id;
    $kra->kra1 = $_POST['kra1'];
    $kra->kpi1 = $_POST['kpi1'];
    $kra->rate1 = $kra_rating1;
    $kra->comments1 = $_POST['comments1'];
    $kra->sup_com1 = $_POST['sup_com1'];
    $kra->kra2 = $_POST['kra2'];
    $kra->kpi2 = $_POST['kpi2'];
    $kra->rate2 = $kra_rating2;
    $kra->comments2 = $_POST['comments2'];
    $kra->sup_com2 = $_POST['sup_com2'];
    $kra->kra3 = $_POST['kra3'];
    $kra->kpi3 = $_POST['kpi3'];
    $kra->rate3 = $kra_rating3;
    $kra->comments3 = $_POST['comments3'];
    $kra->sup_com3 = $_POST['sup_com3'];
    $kra->kra4 = $_POST['kra4'];
    $kra->kpi4 = $_POST['kpi4'];
    $kra->rate4 = $kra_rating4;
    $kra->comments4 = $_POST['comments4'];
    $kra->sup_com4 = $_POST['sup_com4'];
    $kra->kra5 = $_POST['kra5'];
    $kra->kpi5 = $_POST['kpi5'];
    $kra->rate5 = $kra_rating5;
    $kra->comments5 = $_POST['comments5'];
    $kra->sup_com5 = $_POST['sup_com5'];
    $kra->kra6 = $_POST['kra6'];
    $kra->kpi6 = $_POST['kpi6'];
    $kra->rate6 = $kra_rating6;
    $kra->comments6 = $_POST['comments6'];
    $kra->sup_com6 = $_POST['sup_com6'];

    //general performance details
    $gp->gp_id = $gp_id;
    $gp->gp1a_rate = $gp1a_rate;
    $gp->gp1a_comment = $_POST['gp1a_comment'];
    $gp->gp1b_rate = $gp1b_rate;
    $gp->gp1b_comment = $_POST['gp1b_comment'];
    $gp->gp1c_rate = $gp1c_rate;
    $gp->gp1c_comment = $_POST['gp1c_comment'];
    $gp->gp2a_rate = $gp2a_rate;
    $gp->gp2a_comment = $_POST['gp2a_comment'];
    $gp->gp2b_rate = $gp2b_rate;
    $gp->gp2b_comment = $_POST['gp2b_comment'];
    $gp->gp2c_rate = $gp2c_rate;
    $gp->gp2c_comment = $_POST['gp2c_comment'];
    $gp->gp3a_rate = $gp3a_rate;
    $gp->gp3a_comment = $_POST['gp3a_comment'];
    $gp->gp3b_rate = $gp3b_rate;
    $gp->gp3b_comment = $_POST['gp3b_comment'];
    $gp->gp3c_rate = $gp3c_rate;
    $gp->gp3c_comment = $_POST['gp3c_comment'];
    $gp->gp4a_rate = $gp4a_rate;
    $gp->gp4a_comment = $_POST['gp4a_comment'];
    $gp->gp4b_rate = $gp4b_rate;
    $gp->gp4b_comment = $_POST['gp4b_comment'];
    $gp->gp4c_rate = $gp4c_rate;
    $gp->gp4c_comment = $_POST['gp4c_comment'];
    $gp->gp5a_rate = $gp5a_rate;
    $gp->gp5a_comment = $_POST['gp5a_comment'];
    $gp->gp5b_rate = $gp5b_rate;
    $gp->gp5b_comment = $_POST['gp5b_comment'];
    $gp->gp5c_rate = $gp5c_rate;
    $gp->gp5c_comment = $_POST['gp5c_comment'];
    $gp->gp6a_rate = $gp6a_rate;
    $gp->gp6a_comment = $_POST['gp6a_comment'];
    $gp->gp6b_rate = $gp6b_rate;
    $gp->gp6b_comment = $_POST['gp6b_comment'];
    $gp->gp6c_rate = $gp6c_rate;
    $gp->gp6c_comment = $_POST['gp6c_comment'];
    $gp->gp7a_rate = $gp7a_rate;
    $gp->gp7a_comment = $_POST['gp7a_comment'];
    $gp->gp7b_rate = $gp7b_rate;
    $gp->gp7b_comment = $_POST['gp7b_comment'];
    $gp->gp7c_rate = $gp7c_rate;
    $gp->gp7c_comment = $_POST['gp7c_comment'];
    $gp->gp8a_rate = $gp8a_rate;
    $gp->gp8a_comment = $_POST['gp8a_comment'];
    $gp->gp8b_rate = $gp8b_rate;
    $gp->gp8b_comment = $_POST['gp8b_comment'];
    $gp->gp8c_rate = $gp8c_rate;
    $gp->gp8c_comment = $_POST['gp8c_comment'];
    $gp->gp9a_rate = $gp9a_rate;
    $gp->gp9a_comment = $_POST['gp9a_comment'];
    $gp->gp9b_rate = $gp9b_rate;
    $gp->gp9b_comment = $_POST['gp9b_comment'];
    $gp->gp9c_rate = $gp9c_rate;
    $gp->gp9c_comment = $_POST['gp9c_comment'];
    $gp->gp10a_rate = $gp10a_rate;
    $gp->gp10a_comment = $_POST['gp10a_comment'];
    $gp->gp10b_rate = $gp10b_rate;
    $gp->gp10b_comment = $_POST['gp10b_comment'];
    $gp->gp10c_rate = $gp10c_rate;
    $gp->gp10c_comment = $_POST['gp10c_comment'];

    //Performance Improvement Plan
    $pip->pip_id = $pip_id;
    $pip->pin1 = $_POST['pin1'];
    $pip->at1 = $_POST['at1'];
    $pip->sn1 = $_POST['sn1'];
    $pip->time1 = $_POST['timeline1'];
    $pip->pin2 = $_POST['pin2'];
    $pip->at2 = $_POST['at2'];
    $pip->sn2 = $_POST['sn2'];
    $pip->time2 = $_POST['timeline2'];
    $pip->pin3 = $_POST['pin3'];
    $pip->at3 = $_POST['at3'];
    $pip->sn3 = $_POST['sn3'];
    $pip->time3 = $_POST['timeline3'];

    $upd_par = $details->upd_supPAR();
    $upd_kra = $kra->upd_supKRA();
    $upd_gp = $gp->upd_supGP();
    $upd_pip = $pip->upd_supPIP();

    if ($upd_par) {
        echo 1;
        if ($upd_kra) {
            echo 2;
            if ($upd_gp) {
                echo 3;
                if ($upd_pip) {
                    echo 4;
                    //get the name of evaluator
                    $user->id = $_POST['eval_by'];
                    $get = $user->get_user_by_id();
                    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                        $fullname = $row['fullname'];
                    }

                    //send email to hr after reviewed by approver 2
                    $hr = $user->get_hr_admin();
                    while ($row = $hr->fetch(PDO::FETCH_ASSOC)) {
                        $email = $row['email'];
                        //send email to hr
                        $from = "system.administrator<(it@innogroup.com.ph)>";
                        $to = $email;

                        $subject = "Online PAR Notification";
                        $message = '<html>
                                             <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                                                 <div style="background-color: #00C957; padding: 5px; color: white">
                                                     <h3 style="padding: 0; margin: 0;">Message: </h3>
                                                 </div>
                                                 <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                                     Hi, <br><br>
                                                     Greetings!<br><br>
                                                     <b>' . $fullname . '</b> has reviewed the ' . $_POST['assessment'] . ' PAR of <b>' . $_POST['name'] . '</b>. You can check the PAR contents through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a> and If this is your first time to sign in, useyour spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
                                                     If access is unsuccessful, kindly contact HR at local 107 for assistance.<br><br>
                                                     Best Regards, <br>PAR Administrator
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
                    }
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} elseif ($_POST['action'] == 3) //SAVE as DRAFT
{
    $kra_id = '';
    $gp_id = '';
    $pip_id = '';
    //get ids
    $details->id = $_POST['id'];
    $get = $details->get_par_ids();
    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
        $kra_id = $row['kra_id'];
        $gp_id = $row['gp_id'];
        $pip_id = $row['pip_id'];
    }

    //PAR details
    $details->id = $_POST['id'];
    $details->rater_name = $_POST['rater_name'];
    $details->kra_total = $_POST['kra_total'];
    $details->gp_total = $_POST['gp_total'];
    $details->kra_average = $_POST['kra_average'];
    $details->gp_average = $_POST['gp_average'];
    $details->oap_total = $_POST['oap_total'];
    $details->oap_scale = $_POST['oap_scale'];
    $details->accomplishment = $_POST['accomplishments'];
    $details->prof_dev = $_POST['prof_dev'];
    $details->prof_others = $_POST['prof_others'];
    $details->emp_comment = $_POST['emp_comment'];
    $details->date_submit = date('Y-m-d');
    $details->eval_by = $_POST['eval_by'];
    $details->par_status = 1;
    //Performance recommnedation
    $details->recommendation = $_POST['recommendation'];
    $details->gross = $_POST['gross'];
    $details->remarks = $_POST['remarks'];
    $details->date_evaluated = date('Y-m-d');

    //kra & kpi details
    $kra->kra_id = $kra_id;
    $kra->kra1 = $_POST['kra1'];
    $kra->kpi1 = $_POST['kpi1'];
    $kra->rate1 = $kra_rating1;
    $kra->comments1 = $_POST['comments1'];
    $kra->sup_com1 = $_POST['sup_com1'];
    $kra->kra2 = $_POST['kra2'];
    $kra->kpi2 = $_POST['kpi2'];
    $kra->rate2 = $kra_rating2;
    $kra->comments2 = $_POST['comments2'];
    $kra->sup_com2 = $_POST['sup_com2'];
    $kra->kra3 = $_POST['kra3'];
    $kra->kpi3 = $_POST['kpi3'];
    $kra->rate3 = $kra_rating3;
    $kra->comments3 = $_POST['comments3'];
    $kra->sup_com3 = $_POST['sup_com3'];
    $kra->kra4 = $_POST['kra4'];
    $kra->kpi4 = $_POST['kpi4'];
    $kra->rate4 = $kra_rating4;
    $kra->comments4 = $_POST['comments4'];
    $kra->sup_com4 = $_POST['sup_com4'];
    $kra->kra5 = $_POST['kra5'];
    $kra->kpi5 = $_POST['kpi5'];
    $kra->rate5 = $kra_rating5;
    $kra->comments5 = $_POST['comments5'];
    $kra->sup_com5 = $_POST['sup_com5'];
    $kra->kra6 = $_POST['kra6'];
    $kra->kpi6 = $_POST['kpi6'];
    $kra->rate6 = $kra_rating6;
    $kra->comments6 = $_POST['comments6'];
    $kra->sup_com6 = $_POST['sup_com6'];

    //general performance details
    $gp->gp_id = $gp_id;
    $gp->gp1a_rate = $gp1a_rate;
    $gp->gp1a_comment = $_POST['gp1a_comment'];
    $gp->gp1b_rate = $gp1b_rate;
    $gp->gp1b_comment = $_POST['gp1b_comment'];
    $gp->gp1c_rate = $gp1c_rate;
    $gp->gp1c_comment = $_POST['gp1c_comment'];
    $gp->gp2a_rate = $gp2a_rate;
    $gp->gp2a_comment = $_POST['gp2a_comment'];
    $gp->gp2b_rate = $gp2b_rate;
    $gp->gp2b_comment = $_POST['gp2b_comment'];
    $gp->gp2c_rate = $gp2c_rate;
    $gp->gp2c_comment = $_POST['gp2c_comment'];
    $gp->gp3a_rate = $gp3a_rate;
    $gp->gp3a_comment = $_POST['gp3a_comment'];
    $gp->gp3b_rate = $gp3b_rate;
    $gp->gp3b_comment = $_POST['gp3b_comment'];
    $gp->gp3c_rate = $gp3c_rate;
    $gp->gp3c_comment = $_POST['gp3c_comment'];
    $gp->gp4a_rate = $gp4a_rate;
    $gp->gp4a_comment = $_POST['gp4a_comment'];
    $gp->gp4b_rate = $gp4b_rate;
    $gp->gp4b_comment = $_POST['gp4b_comment'];
    $gp->gp4c_rate = $gp4c_rate;
    $gp->gp4c_comment = $_POST['gp4c_comment'];
    $gp->gp5a_rate = $gp5a_rate;
    $gp->gp5a_comment = $_POST['gp5a_comment'];
    $gp->gp5b_rate = $gp5b_rate;
    $gp->gp5b_comment = $_POST['gp5b_comment'];
    $gp->gp5c_rate = $gp5c_rate;
    $gp->gp5c_comment = $_POST['gp5c_comment'];
    $gp->gp6a_rate = $gp6a_rate;
    $gp->gp6a_comment = $_POST['gp6a_comment'];
    $gp->gp6b_rate = $gp6b_rate;
    $gp->gp6b_comment = $_POST['gp6b_comment'];
    $gp->gp6c_rate = $gp6c_rate;
    $gp->gp6c_comment = $_POST['gp6c_comment'];
    $gp->gp7a_rate = $gp7a_rate;
    $gp->gp7a_comment = $_POST['gp7a_comment'];
    $gp->gp7b_rate = $gp7b_rate;
    $gp->gp7b_comment = $_POST['gp7b_comment'];
    $gp->gp7c_rate = $gp7c_rate;
    $gp->gp7c_comment = $_POST['gp7c_comment'];
    $gp->gp8a_rate = $gp8a_rate;
    $gp->gp8a_comment = $_POST['gp8a_comment'];
    $gp->gp8b_rate = $gp8b_rate;
    $gp->gp8b_comment = $_POST['gp8b_comment'];
    $gp->gp8c_rate = $gp8c_rate;
    $gp->gp8c_comment = $_POST['gp8c_comment'];
    $gp->gp9a_rate = $gp9a_rate;
    $gp->gp9a_comment = $_POST['gp9a_comment'];
    $gp->gp9b_rate = $gp9b_rate;
    $gp->gp9b_comment = $_POST['gp9b_comment'];
    $gp->gp9c_rate = $gp9c_rate;
    $gp->gp9c_comment = $_POST['gp9c_comment'];
    $gp->gp10a_rate = $gp10a_rate;
    $gp->gp10a_comment = $_POST['gp10a_comment'];
    $gp->gp10b_rate = $gp10b_rate;
    $gp->gp10b_comment = $_POST['gp10b_comment'];
    $gp->gp10c_rate = $gp10c_rate;
    $gp->gp10c_comment = $_POST['gp10c_comment'];

    //Performance Improvement Plan
    $pip->pip_id = $pip_id;
    $pip->pin1 = $_POST['pin1'];
    $pip->at1 = $_POST['at1'];
    $pip->sn1 = $_POST['sn1'];
    $pip->time1 = $_POST['timeline1'];
    $pip->pin2 = $_POST['pin2'];
    $pip->at2 = $_POST['at2'];
    $pip->sn2 = $_POST['sn2'];
    $pip->time2 = $_POST['timeline2'];
    $pip->pin3 = $_POST['pin3'];
    $pip->at3 = $_POST['at3'];
    $pip->sn3 = $_POST['sn3'];
    $pip->time3 = $_POST['timeline3'];

    $upd_par = $details->upd_supPAR();
    $upd_kra = $kra->upd_supKRA();
    $upd_gp = $gp->upd_supGP();
    $upd_pip = $pip->upd_supPIP();

    if ($upd_par) {
        if ($upd_kra) {
            if ($upd_gp) {
                if ($upd_pip) {
                    echo 3;
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} elseif ($_POST['action'] == 4) //APPROVED PAR
{
    //PAR details
    $details->id = $_POST['id'];
    $details->par_id = $_POST['id'];
    $details->kra_id = $kra_id;
    $details->gp_id = $gp_id;
    $details->pip_id = $pip_id;
    $details->sup_id = $sup_id;
    $details->emp_name = $_POST['name'];
    $details->position = $_POST['position'];
    $details->department = $_POST['department'];
    $details->project = $_POST['project'];
    $details->emp_status = $_POST['emp_status'];
    $details->assessment = $_POST['assessment'];
    $details->review_from = $review_from;
    $details->review_to = $review_to;
    $details->date_hire = $date_hire;
    $details->rater = $_POST['rater'];
    $details->rater_name = $_POST['rater_name'];
    $details->emp_email = $_POST['emp_email'];
    $details->kra_total = $_POST['kra_total'];
    $details->gp_total = $_POST['gp_total'];
    $details->kra_average = $_POST['kra_average'];
    $details->gp_average = $_POST['gp_average'];
    $details->oap_total = $_POST['oap_total'];
    $details->oap_scale = $_POST['oap_scale'];
    $details->accomplishment = $_POST['accomplishments'];
    $details->prof_dev = $_POST['prof_dev'];
    $details->prof_others = $_POST['prof_others'];
    $details->emp_comment = $_POST['emp_comment'];
    $details->date_submit = date('Y-m-d');
    $details->eval_by = $_POST['eval_by'];
    $details->status = 4;
    $details->par_status = 4;
    //Performance recommnedation
    $details->recommendation = $_POST['recommendation'];
    $details->gross = $_POST['gross'];
    $details->date_evaluated = date('Y-m-d');

    //kra & kpi details
    $kra->kra1 = $_POST['kra1'];
    $kra->kpi1 = $_POST['kpi1'];
    $kra->rate1 = $kra_rating1;
    $kra->comments1 = $_POST['comments1'];
    $kra->sup_com1 = $_POST['sup_com1'];
    $kra->kra2 = $_POST['kra2'];
    $kra->kpi2 = $_POST['kpi2'];
    $kra->rate2 = $kra_rating2;
    $kra->comments2 = $_POST['comments2'];
    $kra->sup_com2 = $_POST['sup_com2'];
    $kra->kra3 = $_POST['kra3'];
    $kra->kpi3 = $_POST['kpi3'];
    $kra->rate3 = $kra_rating3;
    $kra->comments3 = $_POST['comments3'];
    $kra->sup_com3 = $_POST['sup_com3'];
    $kra->kra4 = $_POST['kra4'];
    $kra->kpi4 = $_POST['kpi4'];
    $kra->rate4 = $kra_rating4;
    $kra->comments4 = $_POST['comments4'];
    $kra->sup_com4 = $_POST['sup_com4'];
    $kra->kra5 = $_POST['kra5'];
    $kra->kpi5 = $_POST['kpi5'];
    $kra->rate5 = $kra_rating5;
    $kra->comments5 = $_POST['comments5'];
    $kra->sup_com5 = $_POST['sup_com5'];
    $kra->kra6 = $_POST['kra6'];
    $kra->kpi6 = $_POST['kpi6'];
    $kra->rate6 = $kra_rating6;
    $kra->comments6 = $_POST['comments6'];
    $kra->sup_com6 = $_POST['sup_com6'];

    //general performance details
    $gp->gp1a_rate = $gp1a_rate;
    $gp->gp1a_comment = $_POST['gp1a_comment'];
    $gp->gp1b_rate = $gp1b_rate;
    $gp->gp1b_comment = $_POST['gp1b_comment'];
    $gp->gp1c_rate = $gp1c_rate;
    $gp->gp1c_comment = $_POST['gp1c_comment'];
    $gp->gp2a_rate = $gp2a_rate;
    $gp->gp2a_comment = $_POST['gp2a_comment'];
    $gp->gp2b_rate = $gp2b_rate;
    $gp->gp2b_comment = $_POST['gp2b_comment'];
    $gp->gp2c_rate = $gp2c_rate;
    $gp->gp2c_comment = $_POST['gp2c_comment'];
    $gp->gp3a_rate = $gp3a_rate;
    $gp->gp3a_comment = $_POST['gp3a_comment'];
    $gp->gp3b_rate = $gp3b_rate;
    $gp->gp3b_comment = $_POST['gp3b_comment'];
    $gp->gp3c_rate = $gp3c_rate;
    $gp->gp3c_comment = $_POST['gp3c_comment'];
    $gp->gp4a_rate = $gp4a_rate;
    $gp->gp4a_comment = $_POST['gp4a_comment'];
    $gp->gp4b_rate = $gp4b_rate;
    $gp->gp4b_comment = $_POST['gp4b_comment'];
    $gp->gp4c_rate = $gp4c_rate;
    $gp->gp4c_comment = $_POST['gp4c_comment'];
    $gp->gp5a_rate = $gp5a_rate;
    $gp->gp5a_comment = $_POST['gp5a_comment'];
    $gp->gp5b_rate = $gp5b_rate;
    $gp->gp5b_comment = $_POST['gp5b_comment'];
    $gp->gp5c_rate = $gp5c_rate;
    $gp->gp5c_comment = $_POST['gp5c_comment'];
    $gp->gp6a_rate = $gp6a_rate;
    $gp->gp6a_comment = $_POST['gp6a_comment'];
    $gp->gp6b_rate = $gp6b_rate;
    $gp->gp6b_comment = $_POST['gp6b_comment'];
    $gp->gp6c_rate = $gp6c_rate;
    $gp->gp6c_comment = $_POST['gp6c_comment'];
    $gp->gp7a_rate = $gp7a_rate;
    $gp->gp7a_comment = $_POST['gp7a_comment'];
    $gp->gp7b_rate = $gp7b_rate;
    $gp->gp7b_comment = $_POST['gp7b_comment'];
    $gp->gp7c_rate = $gp7c_rate;
    $gp->gp7c_comment = $_POST['gp7c_comment'];
    $gp->gp8a_rate = $gp8a_rate;
    $gp->gp8a_comment = $_POST['gp8a_comment'];
    $gp->gp8b_rate = $gp8b_rate;
    $gp->gp8b_comment = $_POST['gp8b_comment'];
    $gp->gp8c_rate = $gp8c_rate;
    $gp->gp8c_comment = $_POST['gp8c_comment'];
    $gp->gp9a_rate = $gp9a_rate;
    $gp->gp9a_comment = $_POST['gp9a_comment'];
    $gp->gp9b_rate = $gp9b_rate;
    $gp->gp9b_comment = $_POST['gp9b_comment'];
    $gp->gp9c_rate = $gp9c_rate;
    $gp->gp9c_comment = $_POST['gp9c_comment'];
    $gp->gp10a_rate = $gp10a_rate;
    $gp->gp10a_comment = $_POST['gp10a_comment'];
    $gp->gp10b_rate = $gp10b_rate;
    $gp->gp10b_comment = $_POST['gp10b_comment'];
    $gp->gp10c_rate = $gp10c_rate;
    $gp->gp10c_comment = $_POST['gp10c_comment'];

    //Performance Improvement Plan
    $pip->pin1 = $_POST['pin1'];
    $pip->at1 = $_POST['at1'];
    $pip->sn1 = $_POST['sn1'];
    $pip->time1 = $_POST['timeline1'];
    $pip->pin2 = $_POST['pin2'];
    $pip->at2 = $_POST['at2'];
    $pip->sn2 = $_POST['sn2'];
    $pip->time2 = $_POST['timeline2'];
    $pip->pin3 = $_POST['pin3'];
    $pip->at3 = $_POST['at3'];
    $pip->sn3 = $_POST['sn3'];
    $pip->time3 = $_POST['timeline3'];

    $save_par = $details->save_supPAR();
    $save_kra = $kra->save_supKRA();
    $save_gp = $gp->save_supGP();
    $save_pip = $pip->save_supPIP();
    $upd_stat = $details->upd_stat();

    $assess = '';
    if ($_POST['assessment'] == 1) {
        $assess = 'Annual';
    } elseif ($_POST['assessment'] == 7) {
        $assess = 'Mid Year';
    } elseif ($_POST['assessment'] == 2) {
        $assess = '5th Month';
    } elseif ($_POST['assessment'] == 3) {
        $assess = '3rd Month';
    } elseif ($_POST['assessment'] == 4) {
        $assess = '2nd Month';
    } elseif ($_POST['assessment'] == 5) {
        $assess = 'Training';
    } elseif ($_POST['assessment'] == 6) {
        $assess = 'Others';
    }
    if ($save_par) {
        if ($save_kra) {
            if ($save_gp) {
                if ($save_pip) {
                    if ($upd_stat) {
                        echo 1;
                        //get the name of evaluator
                        $user->id = $_POST['eval_by'];
                        $get = $user->get_user_by_id();
                        while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                            $fullname = $row['fullname'];
                        }

                        //check if approver 2 exist                        
                        //get the email of next approver
                        if ($status == 2) {
                            $user->dept = $_POST['department'];
                            $get = $user->get_approver2_email();
                            while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                                $email = $row['email'];
                                //send email notification to approvers
                                $from = "system.administrator<(noreply@innogroup.com.ph)>";
                                $to = $email;

                                $subject = "Online PAR Notification";
                                $message = '<html>
                                                <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                                                    <div style="background-color: #00C957; padding: 5px; color: white">
                                                        <h3 style="padding: 0; margin: 0;">Message: </h3>
                                                    </div>
                                                    <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                                        Hi, <br><br>
                                                        Greetings!<br><br>
                                                        <b>' . $fullname . '</b> has approved the ' . $assess . ' PAR of <b>' . $_POST['name'] . '</b>. You can check the PAR through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a> and Sign in by using your spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
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
                                $headers .= "From: " . $from . "" . "\r\n";

                                if (mail($to, $subject, $message, $headers)) {
                                    echo 1;
                                } else {
                                    echo 0;
                                }
                            }
                        }

                        $user->email = $_POST['emp_email'];
                        $send_user = $user->send_email_to_user();
                        while ($row = $send_user->fetch(PDO::FETCH_ASSOC)) {
                            $email = $row['email'];

                            //send email to user
                            $from = "system.administrator<(it@innogroup.com.ph)>";
                            $to = $email;

                            $subject = "Online PAR Notification";
                            $message = '<html>
                                            <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                                                <div style="background-color: #00C957; padding: 5px; color: white">
                                                    <h3 style="padding: 0; margin: 0;">Message: </h3>
                                                </div>
                                                <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                                    Hi ,<br><br>
                                                    <b>' . $fullname . '</b>. has approved your ' . $assess . ' PAR. You can check the PAR contents through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a> and If this is your first time to sign in, useyour spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
                                                    If access is unsuccessful, kindly contact HR at local 107 for assistance.<br><br>
                                                    Best Regards, <br>PAR Administrator
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
                        }

                        //send email to hr after approved by approver 3
                        $hr = $user->get_hr_admin();
                        while ($row = $hr->fetch(PDO::FETCH_ASSOC)) {
                            $email = $row['email'];
                            //send email to hr
                            $from = "system.administrator<(it@innogroup.com.ph)>";
                            $to = $email;

                            $subject = "Online PAR Notification";
                            $message = '<html>
                         <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                             <div style="background-color: #00C957; padding: 5px; color: white">
                                 <h3 style="padding: 0; margin: 0;">Message: </h3>
                             </div>
                             <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                 Hi HR admin, <br><br>
                                 Greetings!<br><br>
                                 <b>' . $fullname . '</b> has approved the ' . $assess . ' PAR of <b>' . $_POST['name'] . '</b>. You can check the PAR contents through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a> and If this is your first time to sign in, useyour spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
                                 If access is unsuccessful, kindly contact HR at local 107 for assistance.<br><br>
                                 Best Regards, <br>PAR Administrator
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
                        }
                    } else {
                        echo 0;
                    }
                } else {
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
} else {
    echo 0;
}
