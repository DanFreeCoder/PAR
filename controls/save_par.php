<?php
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

//get the current id of par_details
$par_id = '';
$get_PAR = $details->get_par_last_id();
while ($row = $get_PAR->fetch(PDO::FETCH_ASSOC)) {
    if ($row['par_id'] == null) {
        $par_id = 1;
    } else {
        $par_id = $row['par_id'];
    }
}

//get the current id of kra
$kra_id = '';
$get_KRA = $kra->get_kra_last_id();
while ($row = $get_KRA->fetch(PDO::FETCH_ASSOC)) {
    if ($row['kra_id'] == null) {
        $kra_id = 1;
    } else {
        $kra_id = $row['kra_id'];
    }
}
//get the last general performance id
$gp_id = '';
$get_GP = $gp->get_gp_last_id();
while ($row = $get_GP->fetch(PDO::FETCH_ASSOC)) {
    if ($row['gp_id'] == null) {
        $gp_id = 1;
    } else {
        $gp_id = $row['gp_id'];
    }
}
//get the last Performance Improvement Plan id
$pip_id = '';
$get_pip = $pip->get_pip_last_id();
while ($row = $get_pip->fetch(PDO::FETCH_ASSOC)) {
    if ($row['pip_id'] == null) {
        $pip_id = 1;
    } else {
        $pip_id = $row['pip_id'];
    }
}

//get the current id of kra
$sup_kra_id = '';
$get_KRA = $kra->get_supKRA_last_id();
while ($row = $get_KRA->fetch(PDO::FETCH_ASSOC)) {
    if ($row['kra_id'] == null) {
        $sup_kra_id = 1;
    } else {
        $sup_kra_id = $row['kra_id'];
    }
}
//get the last general performance id
$sup_gp_id = '';
$get_GP = $gp->get_supGP_last_id();
while ($row = $get_GP->fetch(PDO::FETCH_ASSOC)) {
    if ($row['gp_id'] == null) {
        $sup_gp_id = 1;
    } else {
        $sup_gp_id = $row['gp_id'];
    }
}
//get the last Performance Improvement Plan id
$sup_pip_id = '';
$get_pip = $pip->get_supPIP_last_id();
while ($row = $get_pip->fetch(PDO::FETCH_ASSOC)) {
    if ($row['pip_id'] == null) {
        $sup_pip_id = 1;
    } else {
        $sup_pip_id = $row['pip_id'];
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

if ($_POST['rater'] == 'HR Administrator') //save as administrator
{
    //par_details
    $details->par_id = $par_id;
    $details->kra_id = $kra_id;
    $details->gp_id = $gp_id;
    $details->pip_id = $pip_id;
    //sup_par
    $details->kra_id = $sup_kra_id;
    $details->gp_id = $sup_gp_id;
    $details->pip_id = $sup_pip_id;
    //details
    $details->emp_id = 0;
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
    $details->rater_name = 2;
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
    $details->status = 2;
    $details->par_status = 4;
    //Performance recommnedation
    $details->recommendation = $_POST['recommendation'];
    $details->gross = $_POST['gross'];
    $details->remarks = $_POST['remarks'];
    $details->date_evaluated = date('Y-m-d');
    $details->eval_by = $_POST['eval_by'];

    //kra & kpi details
    $kra->kra1 = $_POST['kra1'];
    $kra->kpi1 = $_POST['kpi1'];
    $kra->rate1 = $kra_rating1;
    $kra->comments1 = $_POST['comments1'];
    $kra->kra2 = $_POST['kra2'];
    $kra->kpi2 = $_POST['kpi2'];
    $kra->rate2 = $kra_rating2;
    $kra->comments2 = $_POST['comments2'];
    $kra->kra3 = $_POST['kra3'];
    $kra->kpi3 = $_POST['kpi3'];
    $kra->rate3 = $kra_rating3;
    $kra->comments3 = $_POST['comments3'];
    $kra->kra4 = $_POST['kra4'];
    $kra->kpi4 = $_POST['kpi4'];
    $kra->rate4 = $kra_rating4;
    $kra->comments4 = $_POST['comments4'];
    $kra->kra5 = $_POST['kra5'];
    $kra->kpi5 = $_POST['kpi5'];
    $kra->rate5 = $kra_rating5;
    $kra->comments5 = $_POST['comments5'];
    $kra->kra6 = $_POST['kra6'];
    $kra->kpi6 = $_POST['kpi6'];
    $kra->rate6 = $kra_rating6;
    $kra->comments6 = $_POST['comments6'];

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
    $gp->gp4a_rate = $_POST['gp4a_rate'];
    $gp->gp4a_comment = $_POST['gp4a_comment'];
    $gp->gp4b_rate = $_POST['gp4b_rate'];
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

    $save_par = $details->save_details();
    $save_kra = $kra->save_kra();
    $save_gp = $gp->save_gp();
    $save_pip = $pip->save_pip();
    //SUP DETAILS
    $save_SUPpar = $details->save_supPAR();
    $save_SUPkra = $kra->save_supKRA();
    $save_SUPgp = $gp->save_supGP();
    $save_SUPpip = $pip->save_supPIP();

    if ($save_par && $save_kra && $save_gp && $save_pip) {
        if ($save_SUPpar) {
            if ($save_SUPkra) {
                if ($save_SUPgp) {
                    if ($save_SUPpip) {
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
    } else {
        echo 0;
    }
} elseif ($_POST['action'] == 1) //save as draft
{
    //PAR details
    $details->kra_id = $kra_id;
    $details->gp_id = $gp_id;
    $details->pip_id = $pip_id;
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
    $details->status = 4;

    //kra & kpi details
    $kra->kra1 = $_POST['kra1'];
    $kra->kpi1 = $_POST['kpi1'];
    $kra->rate1 = $kra_rating1;
    $kra->comments1 = $_POST['comments1'];
    $kra->kra2 = $_POST['kra2'];
    $kra->kpi2 = $_POST['kpi2'];
    $kra->rate2 = $kra_rating2;
    $kra->comments2 = $_POST['comments2'];
    $kra->kra3 = $_POST['kra3'];
    $kra->kpi3 = $_POST['kpi3'];
    $kra->rate3 = $kra_rating3;
    $kra->comments3 = $_POST['comments3'];
    $kra->kra4 = $_POST['kra4'];
    $kra->kpi4 = $_POST['kpi4'];
    $kra->rate4 = $kra_rating4;
    $kra->comments4 = $_POST['comments4'];
    $kra->kra5 = $_POST['kra5'];
    $kra->kpi5 = $_POST['kpi5'];
    $kra->rate5 = $kra_rating5;
    $kra->comments5 = $_POST['comments5'];
    $kra->kra6 = $_POST['kra6'];
    $kra->kpi6 = $_POST['kpi6'];
    $kra->rate6 = $kra_rating6;
    $kra->comments6 = $_POST['comments6'];

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
    $gp->gp4a_rate = $_POST['gp4a_rate'];
    $gp->gp4a_comment = $_POST['gp4a_comment'];
    $gp->gp4b_rate = $_POST['gp4b_rate'];
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

    $save_par = $details->save_details();
    $save_kra = $kra->save_kra();
    $save_gp = $gp->save_gp();
    $save_pip = $pip->save_pip();

    if ($save_par) {
        if ($save_kra) {
            if ($save_gp) {
                if ($save_pip) {
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
} else //normal process of the PAR(SAVE/SUBMIT)
{
    //PAR details
    $details->kra_id = $kra_id;
    $details->gp_id = $gp_id;
    $details->pip_id = $pip_id;
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

    //KRA & KPI
    $kra->kra1 = $_POST['kra1'];
    $kra->kpi1 = $_POST['kpi1'];
    $kra->rate1 = $kra_rating1;
    $kra->comments1 = $_POST['comments1'];
    $kra->kra2 = $_POST['kra2'];
    $kra->kpi2 = $_POST['kpi2'];
    $kra->rate2 = $kra_rating2;
    $kra->comments2 = $_POST['comments2'];
    $kra->kra3 = $_POST['kra3'];
    $kra->kpi3 = $_POST['kpi3'];
    $kra->rate3 = $_POST['kra_rating3'];
    $kra->comments3 = $_POST['comments3'];
    $kra->kra4 = $_POST['kra4'];
    $kra->kpi4 = $_POST['kpi4'];
    $kra->rate4 = $kra_rating4;
    $kra->comments4 = $_POST['comments4'];
    $kra->kra5 = $_POST['kra5'];
    $kra->kpi5 = $_POST['kpi5'];
    $kra->rate5 = $kra_rating5;
    $kra->comments5 = $_POST['comments5'];
    $kra->kra6 = $_POST['kra6'];
    $kra->kpi6 = $_POST['kpi6'];
    $kra->rate6 = $kra_rating6;
    $kra->comments6 = $_POST['comments6'];

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
    $gp->gp4a_rate = $_POST['gp4a_rate'];
    $gp->gp4a_comment = $_POST['gp4a_comment'];
    $gp->gp4b_rate = $_POST['gp4b_rate'];
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

    $save_par = $details->save_details();
    $save_kra = $kra->save_kra();
    $save_gp = $gp->save_gp();
    $save_pip = $pip->save_pip();

    if ($save_par) {
        if ($save_kra) {
            if ($save_gp) {
                if ($save_pip) {
                    echo 1;
                    //SEND EMAIL NOTIFICATION TO APPROVER
                    //get the approver email & details
                    $user->id = $_POST['rater_name'];
                    $get = $user->get_user_by_id();
                    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
                        $firstname = $row['firstname'];
                        $email = $row['email'];
                    }
                    $from = "system.administrator<(it@innogroup.com.ph)>";
                    $to = $email;

                    $subject = "Online PAR Notification";
                    $message = '<html>
                                    <body style="margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri">
                                        <div style="background-color: #00C957; padding: 5px; color: white">
                                            <h3 style="padding: 0; margin: 0;">  Message: </h3>
                                        </div>
                                        <div style="border: 1px solid #e1e1e1; padding: 5px">    
                                            Hi, <br><br>
                                            <b>' . $_POST['name'] . '</b> has already submitted his/her PAR online. You can check the PAR through this link <a link="www.innogroup.com.ph/par">www.innogroup.com.ph/par</a>. If this is your first time to sign in, use your spark name [first name.last name] to access. Your default password is 123456.<br>Please immediately change your password as directed.<br><br>
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

                    //SEND EMAIL NOTIFICATION FOR EMPLOYEE
                    $from = "system.administrator<(it@innogroup.com.ph)>";
                    $to = $_POST['emp_email'];

                    $subject = "Online PAR Notification";
                    $message = "<html>
                                    <head>
                                    </head>
                                        <body style='margin: 0 auto; padding: 10px; border: 1px solid #e1e1e1; font-family:Calibri'>
                                            <div style='background-color: #00C957; padding: 5px; color: white'>
                                                <h3 style='padding: 0; margin: 0;'>Notice: </h3>
                                            </div>
                                            <div style='border: 1px solid #e1e1e1; padding: 5px'>    
                                                Hi " . $_POST['name'] . ", <br><br> Hello! You have successfuly submitted your PAR. If you don't remember creating your PAR online, please contact the system administrator at local 124 so that we can have this verified.<br><br>
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
                    $headers .= "From: " . $from . "" . "\r\n";

                    if (mail($to, $subject, $message, $headers)) {
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
    } else {
        echo 0;
    }
}
