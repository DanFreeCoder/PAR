<?php
include '../config/clsConnection.php';
include '../objects/clsDetails.php';

$database = new clsConnection();
$db = $database->connect();

$par = new ParDetails($db);

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}

//initialize variable
$year = $_GET['year'];
$assessment = $_GET['assessment'];
$stat = $_GET['status'];
if($stat == 1){
    $report = 'For Review';
}elseif($stat == 2){
    $report = 'Under Review';
}else{
    $report = 'Approved';
}

// Excel file name for download 
$fileName = 'PAR Report('.$year.'('.$assessment.'-'.$report.')).xls';
// 1st Column names 
$fields1 = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'BIAS FOR RESULT', '', '', '', '', '', 'INTEGRITY', '', '', '', '',  '', 'OWNERSHIP', '', '', '', '', '', 'TEAMWORK', '', '', '', '', '', 'INNOVATIVE', '', '', '', '', '', 'CUSTOMER FOCUS', '', '', '', '', '', 'WORK STANDARD', '', '', '', '', '', 'JOB KNOWLEDGE', '', '', '', '', '', 'STRATEGIC AGILITY', '', '', '', '', '', 'COMMUNICATION', '', '', '', '', '', '', 'Performance Improvement Plan');
// Display column names as first row 
$excelData = implode("\t", array_values($fields1)) . "\n"; 
// 2nd Column names 
$fields2 = array('Emp Name', 'Position', 'Department', 'Project', 'Status', 'Assessment', 'From', 'To', 'Date Hire', 'KRA AVG', 'GP-AVG', '60%', '40%', 'TOTAL', 'Emp Comment', 'Performance Rec', 'Gross', 'Remarks', 'KRA-1', 'KPI-1', 'Rating', 'Comment-1', 'Sup Comment-1', 'KRA-2', 'KPI-2', 'Rating', 'Comment-2', 'Sup Comment-2', 'KRA-3', 'KPI-3', 'Rating', 'Comment-3', 'Sup Comment-3', 'KRA-4', 'KPI-4', 'Rating', 'Comment-4', 'Sup Comment-4', 'KRA-5', 'KPI-5', 'Rating',  'Comment-5', 'Sup Comment-5', 'KRA-6', 'KPI-6', 'Rating', 'Comment-6', 'Sup Comment-6', 'I', 'Comment', 'II', 'Comment', 'III', 'Comment', 'I', 'Comment', 'II', 'Comment', 'III',  'Comment', 'I', 'Comment', 'II', 'Comment', 'III', 'Comment', 'I', 'Comment', 'II', 'Comment', 'III', 'Comment', 'I', 'Comment', 'II', 'Comment', 'III', 'Comment', 'I', 'Comment', 'II', 'Comment', 'III', 'Comment', 'I', 'Comment', 'II', 'Comment', 'III', 'Comment', 'I', 'Comment', 'II', 'Comment', 'III', 'Comment', 'I', 'Comment', 'II', 'Comment', 'III', 'Comment', 'I', 'Comment', 'II', 'Comment', 'III', 'Comment', 'Accomplishment', 'Trainings', 'PIP-1', 'AT-1', 'T/SN-1', 'Timeline-1', 'PIP-2', 'AT-2', 'T/SN-2', 'Timeline-2', 'PIP-3', 'AT-3', 'T/SN-3', 'Timeline-3','Date Reviewed/Approve');
// Display column names as second row 
$excelData .= implode("\t", array_values($fields2)) . "\n"; 

if($stat == 1)//get the PAR for Review
{
    $par->date_submit = $year;
    $par->assessment = $assessment;
    $data = $par->get_report_uneval();
    while($row = $data->fetch(PDO::FETCH_ASSOC))
    { 
        extract($row);
        if($row > 0)
        {
            $lineData = array($row['emp_name'], $row['position'], $row['dept-name'], $row['project'], $row['emp_status'], $row['assessment'], $row['review_from'], $row['review_to'],$row['date_hire'],$row['kra_total'],$row['gp_total'],$row['kra_average'],$row['gp_average'],$row['oap_total'],$row['emp_comment'],$row['recommendation'],$row['gross'],$row['kra1'],$row['rate1'],$row['kpi1'],$row['comments1'],$row['kra2'],$row['rate2'],$row['kpi2'],$row['comments2'],$row['kra3'],$row['rate3'],$row['kpi3'],$row['comments3'],$row['kra4'],$row['rate4'],$row['kpi4'],$row['comments4'],$row['kra5'],$row['rate5'],$row['kpi5'],$row['comments5'],$row['kra6'],$row['rate6'],$row['kpi6'],$row['comments6'],$row['gp1a_rate'],$row['gp1a_comment'],$row['gp1b_rate'],$row['gp1b_comment'],$row['gp1c_rate'],$row['gp1c_comment'],$row['gp2a_rate'],$row['gp2a_comment'],$row['gp2b_rate'],$row['gp2b_comment'],$row['gp2c_rate'],$row['gp2c_comment'],$row['gp3a_rate'],$row['gp3a_comment'],$row['gp3b_rate'],$row['gp3b_comment'],$row['gp3c_rate'],$row['gp3c_comment'],$row['gp4a_rate'],$row['gp4a_comment'],$row['gp4b_rate'],$row['gp4b_comment'],$row['gp4c_rate'],$row['gp4c_comment'],$row['gp5a_rate'],$row['gp5a_comment'],$row['gp5b_rate'],$row['gp5b_comment'],$row['gp5c_rate'],$row['gp5c_comment'],$row['gp6a_rate'],$row['gp6a_comment'],$row['gp6b_rate'],$row['gp6b_comment'],$row['gp6c_rate'],$row['gp6c_comment'],$row['gp7a_rate'],$row['gp7a_comment'],$row['gp7b_rate'],$row['gp7b_comment'],$row['gp7c_rate'],$row['gp7c_comment'],$row['gp8a_rate'],$row['gp8a_comment'],$row['gp8b_rate'],$row['gp8b_comment'],$row['gp8c_rate'],$row['gp8c_comment'],$row['gp9a_rate'],$row['gp9a_comment'],$row['gp9b_rate'],$row['gp9b_comment'],$row['gp9c_rate'],$row['gp9c_comment'],$row['gp10a_rate'],$row['gp10a_comment'],$row['gp10b_rate'],$row['gp10b_comment'],$row['gp10c_rate'],$row['gp10c_comment'],$row['accomplishment'],$row['prof_dev'],$row['pin1'],$row['at1'],$row['sn1'],$row['time1'],$row['pin2'],$row['at2'],$row['sn2'],$row['time2'],$row['pin3'],$row['at3'],$row['sn3'],$row['time3']); 
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
        else
        {
            $excelData .= 'No records found...'. "\n"; 
        }
    }
}
//get the PAR Under Review
if($stat == 2)
{
    $par->date_evaluated = $year;
    $par->assessment = $assessment;
    $data = $par->get_report_evaluated();
    while($row = $data->fetch(PDO::FETCH_ASSOC))
    { 
        extract($row);
        if($row > 0)
        {
           $lineData = array($row['emp_name'], $row['position'], $row['dept-name'], $row['project'], $row['emp_status'], $row['assessment'], $row['review_from'], $row['review_to'],$row['date_hire'],$row['kra_total'],$row['gp_total'],$row['kra_average'],$row['gp_average'],$row['oap_total'],$row['emp_comment'],$row['recommendation'],$row['gross'],$row['remarks'],$row['kra1'],$row['kpi1'],$row['rate1'],$row['comments1'],$row['sup_com1'],$row['kra2'],$row['kpi2'],$row['rate2'],$row['comments2'],$row['sup_com2'],$row['kra3'],$row['kpi3'],$row['rate3'],$row['comments3'],$row['sup_com3'],$row['kra4'],$row['kpi4'],$row['rate4'],$row['comments4'],$row['sup_com4'],$row['kra5'],$row['kpi5'],$row['rate5'],$row['comments5'],$row['sup_com5'],$row['kra6'],$row['kpi6'],$row['rate6'],$row['comments6'],$row['sup_com6'],$row['gp1a_rate'],$row['gp1a_comment'],$row['gp1b_rate'],$row['gp1b_comment'],$row['gp1c_rate'],$row['gp1c_comment'],$row['gp2a_rate'],$row['gp2a_comment'],$row['gp2b_rate'],$row['gp2b_comment'],$row['gp2c_rate'],$row['gp2c_comment'],$row['gp3a_rate'],$row['gp3a_comment'],$row['gp3b_rate'],$row['gp3b_comment'],$row['gp3c_rate'],$row['gp3c_comment'],$row['gp4a_rate'],$row['gp4a_comment'],$row['gp4b_rate'],$row['gp4b_comment'],$row['gp4c_rate'],$row['gp4c_comment'],$row['gp5a_rate'],$row['gp5a_comment'],$row['gp5b_rate'],$row['gp5b_comment'],$row['gp5c_rate'],$row['gp5c_comment'],$row['gp6a_rate'],$row['gp6a_comment'],$row['gp6b_rate'],$row['gp6b_comment'],$row['gp6c_rate'],$row['gp6c_comment'],$row['gp7a_rate'],$row['gp7a_comment'],$row['gp7b_rate'],$row['gp7b_comment'],$row['gp7c_rate'],$row['gp7c_comment'],$row['gp8a_rate'],$row['gp8a_comment'],$row['gp8b_rate'],$row['gp8b_comment'],$row['gp8c_rate'],$row['gp8c_comment'],$row['gp9a_rate'],$row['gp9a_comment'],$row['gp9b_rate'],$row['gp9b_comment'],$row['gp9c_rate'],$row['gp9c_comment'],$row['gp10a_rate'],$row['gp10a_comment'],$row['gp10b_rate'],$row['gp10b_comment'],$row['gp10c_rate'],$row['gp10c_comment'],$row['accomplishment'],$row['prof_dev'],$row['pin1'],$row['at1'],$row['sn1'],$row['time1'],$row['pin2'],$row['at2'],$row['sn2'],$row['time2'],$row['pin3'],$row['at3'],$row['sn3'],$row['time3']);
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
        else
        {
            $excelData .= 'No records found...'. "\n"; 
        }
    }
}
//get the APPROVED PAR
if($stat == 3)
{
    $par->date_evaluated = $year;
    $par->assessment = $assessment;
    $data = $par->get_report_approved();
    while($row = $data->fetch(PDO::FETCH_ASSOC))
    { 
        $date_review = date('m/d/Y', strtotime($row['date_evaluated']));
        extract($row);
        if($row > 0)
        {
            $lineData = array($row['emp_name'], $row['position'], $row['dept-name'], $row['unit_name'], $row['emp_status'], $row['assessment'], $row['review_from'], $row['review_to'],$row['date_hire'],$row['kra_total'],$row['gp_total'],$row['kra_average'],$row['gp_average'],$row['oap_total'],$row['emp_comment'],$row['recommendation'],$row['gross'],$row['remarks'],$row['kra1'],$row['kpi1'],$row['rate1'],$row['comments1'],$row['sup_com1'],$row['kra2'],$row['kpi2'],$row['rate2'],$row['comments2'],$row['sup_com2'],$row['kra3'],$row['kpi3'],$row['rate3'],$row['comments3'],$row['sup_com3'],$row['kra4'],$row['kpi4'],$row['rate4'],$row['comments4'],$row['sup_com4'],$row['kra5'],$row['kpi5'],$row['rate5'],$row['comments5'],$row['sup_com5'],$row['kra6'],$row['kpi6'],$row['rate6'],$row['comments6'],$row['sup_com6'],$row['gp1a_rate'],$row['gp1a_comment'],$row['gp1b_rate'],$row['gp1b_comment'],$row['gp1c_rate'],$row['gp1c_comment'],$row['gp2a_rate'],$row['gp2a_comment'],$row['gp2b_rate'],$row['gp2b_comment'],$row['gp2c_rate'],$row['gp2c_comment'],$row['gp3a_rate'],$row['gp3a_comment'],$row['gp3b_rate'],$row['gp3b_comment'],$row['gp3c_rate'],$row['gp3c_comment'],$row['gp4a_rate'],$row['gp4a_comment'],$row['gp4b_rate'],$row['gp4b_comment'],$row['gp4c_rate'],$row['gp4c_comment'],$row['gp5a_rate'],$row['gp5a_comment'],$row['gp5b_rate'],$row['gp5b_comment'],$row['gp5c_rate'],$row['gp5c_comment'],$row['gp6a_rate'],$row['gp6a_comment'],$row['gp6b_rate'],$row['gp6b_comment'],$row['gp6c_rate'],$row['gp6c_comment'],$row['gp7a_rate'],$row['gp7a_comment'],$row['gp7b_rate'],$row['gp7b_comment'],$row['gp7c_rate'],$row['gp7c_comment'],$row['gp8a_rate'],$row['gp8a_comment'],$row['gp8b_rate'],$row['gp8b_comment'],$row['gp8c_rate'],$row['gp8c_comment'],$row['gp9a_rate'],$row['gp9a_comment'],$row['gp9b_rate'],$row['gp9b_comment'],$row['gp9c_rate'],$row['gp9c_comment'],$row['gp10a_rate'],$row['gp10a_comment'],$row['gp10b_rate'],$row['gp10b_comment'],$row['gp10c_rate'],$row['gp10c_comment'],$row['accomplishment'],$row['prof_dev'],$row['pin1'],$row['at1'],$row['sn1'],$row['time1'],$row['pin2'],$row['at2'],$row['sn2'],$row['time2'],$row['pin3'],$row['at3'],$row['sn3'],$row['time3'],$date_review);
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($lineData)) . "\n"; 
        }
        else
        {
            $excelData .= 'No records found...'. "\n"; 
        }
    }
    //Display column nmae as third row
    $fields3 = array('TRAININGS', 'COUNT');
    $excelData .= implode("\t", array_values($fields3)) . "\n"; 
    //Display the count result of Professional Development
    $count = $par->count_dev();
    while($row = $count->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        if($row > 0){
            $result = array($row['prof_dev'], $row['counter']);
            array_walk($lineData, 'filterData'); 
            $excelData .= implode("\t", array_values($result)) . "\n"; 
        }else{
            $result .= 'No records found...'. "\n"; 
        }
       
    }
}

// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;
?>