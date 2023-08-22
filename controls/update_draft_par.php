<?php
session_start();
include '../config/clsConnection.php';
include '../objects/clsDetails.php';
include '../objects/clsKra.php';
include '../objects/clsPIP.php';
include '../objects/clsGenPerformance.php';
include '../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$details = new ParDetails($db);
$kra = new Kra_Kpi($db);
$pip = new PerformanceImprovement($db);
$gp = new GenPerformance($db);
$user = new Users($db);


//convert the date
$review_from = date('Y-m-d', strtotime($_POST['from']));
$review_to = date('Y-m-d', strtotime($_POST['to']));
$date_hire = date('Y-m-d', strtotime($_POST['date_hire']));

if ($_POST['action'] == 1) //submit PAR
{
    $details->id = $_POST['id'];
    $details->kra_id = $_POST['kra_id'];
    $details->gp_id = $_POST['gp_id'];
    $details->pip_id = $_POST['pip_id'];
    $details->emp_id = $_POST['emp_id'];
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
    $details->status = 1;

    //kra & kpi details
    $kra->kra_id = $_POST['kra_id'];
    $kra->kra1 = $_POST['kra1'];
    $kra->kpi1 = $_POST['kpi1'];
    $kra->rate1 = $_POST['kra_rating1'];
    $kra->comments1 = $_POST['comments1'];
    $kra->kra2 = $_POST['kra2'];
    $kra->kpi2 = $_POST['kpi2'];
    $kra->rate2 = $_POST['kra_rating2'];
    $kra->comments2 = $_POST['comments2'];
    $kra->kra3 = $_POST['kra3'];
    $kra->kpi3 = $_POST['kpi3'];
    $kra->rate3 = $_POST['kra_rating3'];
    $kra->comments3 = $_POST['comments3'];
    $kra->kra4 = $_POST['kra4'];
    $kra->kpi4 = $_POST['kpi4'];
    $kra->rate4 = $_POST['kra_rating4'];
    $kra->comments4 = $_POST['comments4'];
    $kra->kra5 = $_POST['kra5'];
    $kra->kpi5 = $_POST['kpi5'];
    $kra->rate5 = $_POST['kra_rating5'];
    $kra->comments5 = $_POST['comments5'];
    $kra->kra6 = $_POST['kra6'];
    $kra->kpi6 = $_POST['kpi6'];
    $kra->rate6 = $_POST['kra_rating6'];
    $kra->comments6 = $_POST['comments6'];

    //general performance details
    $gp->gp_id = $_POST['gp_id'];
    $gp->gp1a_rate = $_POST['gp1a_rate'];
    $gp->gp1a_comment = $_POST['gp1a_comment'];
    $gp->gp1b_rate = $_POST['gp1b_rate'];
    $gp->gp1b_comment = $_POST['gp1b_comment'];
    $gp->gp1c_rate = $_POST['gp1c_rate'];
    $gp->gp1c_comment = $_POST['gp1c_comment'];
    $gp->gp2a_rate = $_POST['gp2a_rate'];
    $gp->gp2a_comment = $_POST['gp2a_comment'];
    $gp->gp2b_rate = $_POST['gp2b_rate'];
    $gp->gp2b_comment = $_POST['gp2b_comment'];
    $gp->gp2c_rate = $_POST['gp2c_rate'];
    $gp->gp2c_comment = $_POST['gp2c_comment'];
    $gp->gp3a_rate = $_POST['gp3a_rate'];
    $gp->gp3a_comment = $_POST['gp3a_comment'];
    $gp->gp3b_rate = $_POST['gp3b_rate'];
    $gp->gp3b_comment = $_POST['gp3b_comment'];
    $gp->gp3c_rate = $_POST['gp3c_rate'];
    $gp->gp3c_comment = $_POST['gp3c_comment'];
    $gp->gp4a_rate = $_POST['gp4a_rate'];
    $gp->gp4a_comment = $_POST['gp4a_comment'];
    $gp->gp4b_rate = $_POST['gp4b_rate'];
    $gp->gp4b_comment = $_POST['gp4b_comment'];
    $gp->gp4c_rate = $_POST['gp4c_rate'];
    $gp->gp4c_comment = $_POST['gp4c_comment'];
    $gp->gp5a_rate = $_POST['gp5a_rate'];
    $gp->gp5a_comment = $_POST['gp5a_comment'];
    $gp->gp5b_rate = $_POST['gp5b_rate'];
    $gp->gp5b_comment = $_POST['gp5b_comment'];
    $gp->gp5c_rate = $_POST['gp5c_rate'];
    $gp->gp5c_comment = $_POST['gp5c_comment'];
    $gp->gp6a_rate = $_POST['gp6a_rate'];
    $gp->gp6a_comment = $_POST['gp6a_comment'];
    $gp->gp6b_rate = $_POST['gp6b_rate'];
    $gp->gp6b_comment = $_POST['gp6b_comment'];
    $gp->gp6c_rate = $_POST['gp6c_rate'];
    $gp->gp6c_comment = $_POST['gp6c_comment'];
    $gp->gp7a_rate = $_POST['gp7a_rate'];
    $gp->gp7a_comment = $_POST['gp7a_comment'];
    $gp->gp7b_rate = $_POST['gp7b_rate'];
    $gp->gp7b_comment = $_POST['gp7b_comment'];
    $gp->gp7c_rate = $_POST['gp7c_rate'];
    $gp->gp7c_comment = $_POST['gp7c_comment'];
    $gp->gp8a_rate = $_POST['gp8a_rate'];
    $gp->gp8a_comment = $_POST['gp8a_comment'];
    $gp->gp8b_rate = $_POST['gp8b_rate'];
    $gp->gp8b_comment = $_POST['gp8b_comment'];
    $gp->gp8c_rate = $_POST['gp8c_rate'];
    $gp->gp8c_comment = $_POST['gp8c_comment'];
    $gp->gp9a_rate = $_POST['gp9a_rate'];
    $gp->gp9a_comment = $_POST['gp9a_comment'];
    $gp->gp9b_rate = $_POST['gp9b_rate'];
    $gp->gp9b_comment = $_POST['gp9b_comment'];
    $gp->gp9c_rate = $_POST['gp9c_rate'];
    $gp->gp9c_comment = $_POST['gp9c_comment'];
    $gp->gp10a_rate = $_POST['gp10a_rate'];
    $gp->gp10a_comment = $_POST['gp10a_comment'];
    $gp->gp10b_rate = $_POST['gp10b_rate'];
    $gp->gp10b_comment = $_POST['gp10b_comment'];
    $gp->gp10c_rate = $_POST['gp10c_rate'];
    $gp->gp10c_comment = $_POST['gp10c_comment'];

    //Performance Improvement Plan
    $pip->pip_id = $_POST['pip_id'];
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

    $upd_details = $details->upd_draft_par();
    $upd_kra = $kra->upd_kra();
    $upd_gp = $gp->upd_gp();
    $upd_pip = $pip->upd_pip();

    if ($upd_details) {
        echo 1;
        if ($upd_kra) {
            echo 2;
            if ($upd_gp) {
                echo 3;
                if ($upd_pip) {
                    echo 4;
                    //SEND EMAIL NOTIFICATION TO APPROVER
                    //get the approver email & details
                    $user->id = $_POST['rater_name'];
                    $get = $user->get_user_by_id();
                    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                        $firstname = $row['firstname'];
                        $email = $row['email'];
                    }
                    $from = "system.administrator<(noreply@innogroup.com.ph)>";
                    $to = $email;

                    $subject = "Online PAR Notification";
                    $message = '<html>
                                    <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                                        <div style="background-color: #00C957; padding: 5px; color: white">
                                            <h3 style="padding: 0; margin: 0;">  Message: </h3>
                                        </div>
                                        <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                            Hi, <br><br>
                                            <b>' . $_POST['name'] . '</b> has already submitted his/her PAR online. You can check the PAR through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a>. Sign in by using your spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
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
                        echo 5;
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
} else //UPDATE DRAFT PAR
{
    $details->id = $_POST['id'];
    $details->kra_id = $_POST['kra_id'];
    $details->gp_id = $_POST['gp_id'];
    $details->pip_id = $_POST['pip_id'];
    $details->emp_id = $_SESSION['id'];
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
    $details->status = 4;

    //kra & kpi details
    $kra->kra_id = $_POST['kra_id'];
    $kra->kra1 = $_POST['kra1'];
    $kra->kpi1 = $_POST['kpi1'];
    $kra->rate1 = $_POST['kra_rating1'];
    $kra->comments1 = $_POST['comments1'];
    $kra->kra2 = $_POST['kra2'];
    $kra->kpi2 = $_POST['kpi2'];
    $kra->rate2 = $_POST['kra_rating2'];
    $kra->comments2 = $_POST['comments2'];
    $kra->kra3 = $_POST['kra3'];
    $kra->kpi3 = $_POST['kpi3'];
    $kra->rate3 = $_POST['kra_rating3'];
    $kra->comments3 = $_POST['comments3'];
    $kra->kra4 = $_POST['kra4'];
    $kra->kpi4 = $_POST['kpi4'];
    $kra->rate4 = $_POST['kra_rating4'];
    $kra->comments4 = $_POST['comments4'];
    $kra->kra5 = $_POST['kra5'];
    $kra->kpi5 = $_POST['kpi5'];
    $kra->rate5 = $_POST['kra_rating5'];
    $kra->comments5 = $_POST['comments5'];
    $kra->kra6 = $_POST['kra6'];
    $kra->kpi6 = $_POST['kpi6'];
    $kra->rate6 = $_POST['kra_rating6'];
    $kra->comments6 = $_POST['comments6'];

    //general performance details
    $gp->gp_id = $_POST['gp_id'];
    $gp->gp1a_rate = $_POST['gp1a_rate'];
    $gp->gp1a_comment = $_POST['gp1a_comment'];
    $gp->gp1b_rate = $_POST['gp1b_rate'];
    $gp->gp1b_comment = $_POST['gp1b_comment'];
    $gp->gp1c_rate = $_POST['gp1c_rate'];
    $gp->gp1c_comment = $_POST['gp1c_comment'];
    $gp->gp2a_rate = $_POST['gp2a_rate'];
    $gp->gp2a_comment = $_POST['gp2a_comment'];
    $gp->gp2b_rate = $_POST['gp2b_rate'];
    $gp->gp2b_comment = $_POST['gp2b_comment'];
    $gp->gp2c_rate = $_POST['gp2c_rate'];
    $gp->gp2c_comment = $_POST['gp2c_comment'];
    $gp->gp3a_rate = $_POST['gp3a_rate'];
    $gp->gp3a_comment = $_POST['gp3a_comment'];
    $gp->gp3b_rate = $_POST['gp3b_rate'];
    $gp->gp3b_comment = $_POST['gp3b_comment'];
    $gp->gp3c_rate = $_POST['gp3c_rate'];
    $gp->gp3c_comment = $_POST['gp3c_comment'];
    $gp->gp4a_rate = $_POST['gp4a_rate'];
    $gp->gp4a_comment = $_POST['gp4a_comment'];
    $gp->gp4b_rate = $_POST['gp4b_rate'];
    $gp->gp4b_comment = $_POST['gp4b_comment'];
    $gp->gp4c_rate = $_POST['gp4c_rate'];
    $gp->gp4c_comment = $_POST['gp4c_comment'];
    $gp->gp5a_rate = $_POST['gp5a_rate'];
    $gp->gp5a_comment = $_POST['gp5a_comment'];
    $gp->gp5b_rate = $_POST['gp5b_rate'];
    $gp->gp5b_comment = $_POST['gp5b_comment'];
    $gp->gp5c_rate = $_POST['gp5c_rate'];
    $gp->gp5c_comment = $_POST['gp5c_comment'];
    $gp->gp6a_rate = $_POST['gp6a_rate'];
    $gp->gp6a_comment = $_POST['gp6a_comment'];
    $gp->gp6b_rate = $_POST['gp6b_rate'];
    $gp->gp6b_comment = $_POST['gp6b_comment'];
    $gp->gp6c_rate = $_POST['gp6c_rate'];
    $gp->gp6c_comment = $_POST['gp6c_comment'];
    $gp->gp7a_rate = $_POST['gp7a_rate'];
    $gp->gp7a_comment = $_POST['gp7a_comment'];
    $gp->gp7b_rate = $_POST['gp7b_rate'];
    $gp->gp7b_comment = $_POST['gp7b_comment'];
    $gp->gp7c_rate = $_POST['gp7c_rate'];
    $gp->gp7c_comment = $_POST['gp7c_comment'];
    $gp->gp8a_rate = $_POST['gp8a_rate'];
    $gp->gp8a_comment = $_POST['gp8a_comment'];
    $gp->gp8b_rate = $_POST['gp8b_rate'];
    $gp->gp8b_comment = $_POST['gp8b_comment'];
    $gp->gp8c_rate = $_POST['gp8c_rate'];
    $gp->gp8c_comment = $_POST['gp8c_comment'];
    $gp->gp9a_rate = $_POST['gp9a_rate'];
    $gp->gp9a_comment = $_POST['gp9a_comment'];
    $gp->gp9b_rate = $_POST['gp9b_rate'];
    $gp->gp9b_comment = $_POST['gp9b_comment'];
    $gp->gp9c_rate = $_POST['gp9c_rate'];
    $gp->gp9c_comment = $_POST['gp9c_comment'];
    $gp->gp10a_rate = $_POST['gp10a_rate'];
    $gp->gp10a_comment = $_POST['gp10a_comment'];
    $gp->gp10b_rate = $_POST['gp10b_rate'];
    $gp->gp10b_comment = $_POST['gp10b_comment'];
    $gp->gp10c_rate = $_POST['gp10c_rate'];
    $gp->gp10c_comment = $_POST['gp10c_comment'];

    //Performance Improvement Plan
    $pip->pip_id = $_POST['pip_id'];
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

    $upd_details = $details->upd_draft_par();
    $upd_kra = $kra->upd_kra();
    $upd_gp = $gp->upd_gp();
    $upd_pip = $pip->upd_pip();

    if ($upd_details) {
        if ($upd_kra) {
            if ($upd_gp) {
                if ($upd_pip) {
                    echo 1;
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
}
