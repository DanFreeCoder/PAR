<?php
include '../../config/clsConnection.php';
include '../../objects/clsDetails.php';

$database = new clsConnection();
$db = $database->connect();

$par = new ParDetails($db);

$date_hire = date_format(new DateTime($_GET['date_hire']), 'F j, Y');
if($_GET['oap_scale'] == 1){
	$oap = 'Fall Short of Expertise';
}elseif($_GET['oap_scale'] == 2){
	$oap = 'Improvemnt Needed';
}elseif($_GET['oap_scale'] == 3){
	$oap = 'Meets Expectation';
}elseif($_GET['oap_scale'] == 4){
	$oap = 'Exceeds Expectation';
}elseif($_GET['oap_scale'] == 5){
	$oap = 'Outstanding';
}else{
	$oap = 'Rating not Found!';
}
//PROFEESIONAL DEVELOPMENT
$data = explode(',', $_GET['prof_dev']);

$tbl1 = "";
$tbl2 = "";
$tbl3 = "";
$tbl4 = "";
$tbl5 = "";
$tbl6 = "";

$tbl1 .= '<tr>
			<td style="border: 1px solid black">'."Employee's Name".'</td>
			<td style="border: 1px solid black"colspan="3" align="center"><b>'.$_GET['name'].'</b></td>
		</tr>
		<tr>
			<td style="border: 1px solid black">Department</td>
			<td style="border: 1px solid black">'.$_GET['department'].'</td>
			<td style="border: 1px solid black">Date Hire</td>
			<td style="border: 1px solid black">'.$date_hire.'</td>
		</tr>
		<tr>
			<td style="border: 1px solid black">Position Title</td>
			<td style="border: 1px solid black">'.$_GET['position'].'</td>
			<td style="border: 1px solid black">Employment Status</td>
			<td style="border: 1px solid black">'.$_GET['emp_status'].'</td>
		</tr>
		<tr>
			<td style="border: 1px solid black">Unit/Project Assigned</td>
			<td style="border: 1px solid black">'.$_GET['project'].'</td>
			<td style="border: 1px solid black">Performance Assessment</td>
			<td style="border: 1px solid black">'.$_GET['assessment'].'</td>
		</tr>
		<tr>
			<td style="border: 1px solid black">Rater</td>
			<td style="border: 1px solid black" colspan="3" align="center"><b>'.$_GET['rater_name'].'</b></td>
		</tr>';
//KRA & KPI
$tbl2 .= '<tr>
			<td width="3%" style="border-top-style:1px; border-bottom-style:1px; border-left-style:1px">A.</td>
			<td width="45%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px">KRA <br>'.$row['kra1'].'</td>
			<td width="6%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px" align="center" rowspan="2">RATE <br><br>'.$row['rate1'].'</td>
			<td width="23%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px" rowspan="2">EMPLOYEE COMMENTS <br>'.$row['comments1'].'</td>
			<td width="23%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px" rowspan="2">SUPERVISOR COMMENTS <br>'.$row['sup_com1'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px"></td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KPI <br>'.$row['kpi1'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px">B.</td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KRA <br>'.$row['kra2'].'</td>
			<td width="6%" style="border-bottom-style:1px; border-right-style:1px" align="center" rowspan="2">RATE <br><br>'.$row['rate2'].'</td>
			<td width="23%" style="border-bottom-style:1px; border-right-style:1px" rowspan="2">EMPLOYEE COMMENTS <br>'.$row['comments2'].'</td>
			<td width="23%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px" rowspan="2">SUPERVISOR COMMENTS <br>'.$row['sup_com2'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px"></td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KPI <br>'.$row['kpi2'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px">C.</td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KRA <br>'.$row['kra3'].'</td>
			<td width="6%" style="border-bottom-style:1px; border-right-style:1px" align="center" rowspan="2">RATE <br><br>'.$row['rate3'].'</td>
			<td width="23%" style="border-bottom-style:1px; border-right-style:1px" rowspan="2">EMPLOYEE COMMENTS <br>'.$row['comments3'].'</td>
			<td width="23%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px" rowspan="2">SUPERVISOR COMMENTS <br>'.$row['sup_com3'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px"></td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KPI <br>'.$row['kpi3'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px">D.</td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KRA <br>'.$row['kra4'].'</td>
			<td width="6%" style="border-bottom-style:1px; border-right-style:1px" align="center" rowspan="2">RATE <br><br>'.$row['rate4'].'</td>
			<td width="23%" style="border-bottom-style:1px; border-right-style:1px" rowspan="2">EMPLOYEE COMMENTS <br>'.$row['comments4'].'</td>
			<td width="23%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px" rowspan="2">SUPERVISOR COMMENTS <br>'.$row['sup_com4'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px"></td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KPI <br>'.$row['kpi4'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px">E.</td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KRA <br>'.$row['kra5'].'</td>
			<td width="6%" style="border-bottom-style:1px; border-right-style:1px" align="center" rowspan="2">RATE <br><br>'.$row['rate5'].'</td>
			<td width="23%" style="border-bottom-style:1px; border-right-style:1px" rowspan="2">EMPLOYEE COMMENTS <br>'.$row['comments5'].'</td>
			<td width="23%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px" rowspan="2">SUPERVISOR COMMENTS <br>'.$row['sup_com5'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px"></td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KPI <br>'.$row['kpi5'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px">F.</td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KRA <br>'.$row['kra6'].'</td>
			<td width="6%" style="border-bottom-style:1px; border-right-style:1px" align="center" rowspan="2">RATE <br><br>'.$row['rate6'].'</td>
			<td width="23%" style="border-bottom-style:1px; border-right-style:1px" rowspan="2">EMPLOYEE COMMENTS <br>'.$row['comments6'].'</td>
			<td width="23%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px" rowspan="2">SUPERVISOR COMMENTS <br>'.$row['sup_com6'].'</td>
		  </tr>
		  <tr>
			<td width="3%" style="border-bottom-style:1px; border-left-style:1px"></td>
			<td width="45%" style="border-bottom-style:1px; border-right-style:1px">KPI <br>'.$row['kpi6'].'</td>
		  </tr>';
//GENERAL PERFORMANCE
$tbl3 .= '<tr>
			<td width="17%" style="border-top-style:1px; border-bottom-style:1px; border-left-style:1px"><b>BIAS FOR RESULTS</b></td>
			<td width="7%" style="border:1px solid black" align="center">RATE</td>
			<td width="25%" style="border:1px solid black" >COMMENTS</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black" ><b>CUSTOMER FOCUS</b></td>
			<td width="6%" style="border:1px solid black" >RATE</td>
			<td width="25%" style="border:1px solid black" >COMMENTS</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black" >I.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp1a_rate'].'</td>
			<td width="25%" style="border:1px solid black" >'.$_GET['gp1a_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">I.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp6a_rate'].'</td>
			<td width="25%" style="border:1px solid black" >'.$_GET['gp6a_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black" >II.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp1b_rate'].'</td>
			<td width="25%" style="border:1px solid black" >'.$_GET['gp1b_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">II.</td>
			<td width="6%" style="border:1px solid black"  align="center">'.$_GET['gp6b_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp6b_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black" >III.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp1c_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp1c_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">III.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp6c_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp6c_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black" ><b>INTEGRITY</b></td>
			<td width="7%" style="border:1px solid black" align="center">RATE</td>
			<td width="25%" style="border:1px solid black">COMMENTS</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black"><b>WORK STANDARDS</b></td>
			<td width="6%" style="border:1px solid black" align="center">RATE</td>
			<td width="25%" style="border:1px solid black">COMMENTS</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">I.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp2a_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp2a_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">I.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp7a_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp7a_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">II.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp2b_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp2b_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">II.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp7b_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp7b_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">III.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp2c_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp2c_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">III.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp7c_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp7c_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black"><b>OWNERSHIP</b></td>
			<td width="7%" style="border:1px solid black" align="center">RATE</td>
			<td width="25%" style="border:1px solid black">COMMENTS</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black"><b>JOB KNOWLEDGE</b></td>
			<td width="6%" style="border:1px solid black" align="center">RATE</td>
			<td width="25%" style="border:1px solid black">COMMENTS</td>
		</tr>
		<tr>
			<td width="17%"style="border:1px solid black">I.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp3a_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp3a_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">I.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp8a_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp8a_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">II.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp3b_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp3b_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">II.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp8b_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp8b_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">III.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp3c_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp3c_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">III.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp8c_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp8c_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black"><b>TEAMWORK</b></td>
			<td width="7%" style="border:1px solid black" align="center">RATE</td>
			<td width="25%" style="border:1px solid black">COMMENTS</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black"><b>STRATEGIC AGILITY</b></td>
			<td width="6%" style="border:1px solid black" align="center">RATE</td>
			<td width="25%" style="border:1px solid black">COMMENTS</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">I.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp4a_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp4a_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">I.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp9a_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp9a_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">II.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp4b_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp4b_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">II.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp9b_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp9b_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">III.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp4c_rate'].'</td>
			<td width="25%" style="border:1px solid black" >'.$_GET['gp4c_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">III.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp9c_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp9c_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black"><b>INNOVATION</b></td>
			<td width="7%" style="border:1px solid black" align="center">RATE</td>
			<td width="25%" style="border:1px solid black">COMMENTS</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black"><b>COMMUNICATION</b></td>
			<td width="6%" style="border:1px solid black" align="center">RATE</td>
			<td width="25%" style="border:1px solid black">COMMENTS</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">I.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp5a_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp5a_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">I.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp10a_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp10a_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">II.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp5b_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp5b_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">II.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp10b_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp10b_comment'].'</td>
		</tr>
		<tr>
			<td width="17%" style="border:1px solid black">III.</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp5c_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp5c_comment'].'</td>
			<td width="2%"></td>
			<td width="18%" style="border:1px solid black">III.</td>
			<td width="6%" style="border:1px solid black" align="center">'.$_GET['gp10c_rate'].'</td>
			<td width="25%" style="border:1px solid black">'.$_GET['gp10c_comment'].'</td>
		</tr><br>';
//ACCOMPLISHMENT
$tbl4 .='<tr>
			<td width="45%"colspan="3"><b>III. ACCOMPLISHMENT</b></td>
			<td width="2%"></td>
			<td colspan="3"><b>OVER-ALL PERFORMANCE</b></td>
		</tr>
		<tr>
			<td width="45%" style="border:1px solid black" colspan="3" rowspan="4">'.$_GET['accomplishments'].'</td>
			<td width="2%" style="border-left-style:1px"></td>
			<td width="39%" style="border-top-style:1px; border-bottom-style:1px; border-left-style:1px">Key Result Area</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['kra_total'].'</td>
			<td width="7%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px" align="center">'.$_GET['kra_average'].'</td>
		</tr>
		<tr>
			<td width="2%" style="border-left-style:1px"></td>
			<td width="39%" style="border-top-style:1px; border-bottom-style:1px; border-left-style:1px">General Performance</td>
			<td width="7%" style="border:1px solid black" align="center">'.$_GET['gp_total'].'</td>
			<td width="7%" style="border-top-style:1px; border-bottom-style:1px; border-right-style:1px" align="center">'.$_GET['gp_average'].'</td>
		</tr>
		<tr>
			<td width="2%" style="border-left-style:1px"></td>
			<td width="39%" style="border-top-style:1px; border-bottom-style:1px; border-left-style:1px">Individual OAP Rating</td>
			<td width="7%" style="border-top-style:1px; border-bottom-style:1px;"></td>
			<td width="7%" style="border-top-style:1px; border-bottom-style:1px; border-left-style:1px; border-right-style:1px" align="center">'.$_GET['oap_total'].'</td>	
		</tr>
		<tr>
			<td width="2%" style="border-left-style:1px"></td>
			<td width="25%" style="border-bottom-style:1px; border-left-style:1px"><b>OAP Rating</b></td>
			<td width="6%" style="border-bottom-style:1px;" align="right"><b>'.$_GET['oap_scale'].'</b></td>
			<td width="22%" style="border-bottom-style:1px; border-right-style:1px"><b>- '.$oap.'</b></td>
		</tr>';
//AREAS FOR DEVELOPMENT / IMPROVEMENT
$tbl5 .= '<tr>
			<td width="2%"></td>
			<td width="54%" style="border-bottom-style:1px" colspan="3"><b>IV A. Recommendations for professional development</b></td>
			<td style="border-bottom-style:1px"></td>
			<td style="border-bottom-style:1px"></td>
			<td style="border-bottom-style:1px"></td>
		</tr>
		<tr>
			<td width="2%"></td>
			<td width="45%"><input type="checkbox" name="rec1" value="Business and Organizational Development"'.(in_array("Business and Organizational Development",$data) ? ' checked="checked" ' : '') .'>Business & Organizational Development</td>
			<td width="2%"></td>
			<td width="45%"><input type="checkbox" name="rec1" value="Business Communication"'.(in_array("Business Communication",$data) ? ' checked="checked" ' : '') .'>Business Communication</td>
			<td></td>
		</tr>
		<tr>
			<td width="2%"></td>
			<td width="45%"><input type="checkbox" name="rec1" value="Operational Excellence (Technical)"'.(in_array("Operational Excellence (Technical)",$data) ? ' checked="checked" ' : '') .'>Operational Excellence (Technical)</td>
			<td width="2%"></td>
			<td width="45%"><input type="checkbox" name="rec1" value="Presentation Skills"'.(in_array("Presentation Skills",$data) ? ' checked="checked" ' : '') .'>Presentation Skills</td>
			<td></td>
		</tr>
		<tr>
			<td width="2%"></td>
			<td width="45%"><input type="checkbox" name="rec1" value="Leadership Skills Training"'.(in_array("Leadership Skills Training",$data) ? ' checked="checked" ' : '') .'>Leadership Skills Training</td>
			<td width="2%"></td>
			<td width="45%"><input type="checkbox" name="rec1" value="Customer Service"'.(in_array("Customer Service",$data) ? ' checked="checked" ' : '') .'>Customer Service</td>
			<td></td>
		</tr>
		<tr>
			<td width="2%"></td>
			<td width="44%"><input type="checkbox" name="rec1" value="Supervisory Skills Training"'.(in_array("Supervisory Skills Training",$data) ? ' checked="checked" ' : '') .'>Supervisory Skills Training</td>
			<td width="3%"></td>
			<td width="44%"><input type="checkbox" name="rec1" value="Personality Development"'.(in_array("Personality Development",$data) ? ' checked="checked" ' : '') .'>Personality Development</td>
			<td></td>
		</tr>
		<tr>
			<td width="2%"></td>
			<td width="45%"></td>
			<td width="3%"></td>
			<td width="20%">Others, please specify: </td>
			<td width="29%" style="border-bottom-style:1px">'.$_GET['prof_others'].'</td>
		</tr><br>
		<tr>
			<td width="2%"></td>
			<td width="52%" style="border-bottom-style:1px" colspan="3"><b>IV B. Performance Improvement Plan</b></td>
			<td style="border-bottom-style:1px"></td>
			<td style="border-bottom-style:1px"></td>
		</tr>
		<tr>
			<td width="2%"  style="border-right-style:1px"></td>
			<td width="34%" style="border-style:solid black 1px" align="center">Performance Improvement Needed</td>
			<td width="25%" style="border-style:solid black 1px" align="center">Agreed Tasks</td>
			<td width="25%" style="border-style:solid black 1px" align="center">Tools/Support Needed</td>
			<td width="12%" style="border-style:solid black 1px" align="center">Timeline</td>
		</tr>
		<tr>
			<td width="2%"  style="border-right-style:1px"></td>
			<td width="34%" style="border-style:solid black 1px">'.$_GET['pin1'].'</td>
			<td width="25%" style="border-style:solid black 1px">'.$_GET['at1'].'</td>
			<td width="25%" style="border-style:solid black 1px">'.$_GET['sn1'].'</td>
			<td width="12%" style="border-style:solid black 1px">'.$_GET['timeline1'].'</td>
		</tr>
		<tr>
			<td width="2%"  style="border-right-style:1px"></td>
			<td width="34%" style="border-style:solid black 1px">'.$_GET['pin2'].'</td>
			<td width="25%" style="border-style:solid black 1px">'.$_GET['at2'].'</td>
			<td width="25%" style="border-style:solid black 1px">'.$_GET['sn2'].'</td>
			<td width="12%" style="border-style:solid black 1px">'.$_GET['timeline2'].'</td>
		</tr>
		<tr>
			<td width="2%"  style="border-right-style:1px"></td>
			<td width="34%" style="border-style:solid black 1px">'.$_GET['pin3'].'</td>
			<td width="25%" style="border-style:solid black 1px">'.$_GET['at3'].'</td>
			<td width="25%" style="border-style:solid black 1px">'.$_GET['sn3'].'</td>
			<td width="12%" style="border-style:solid black 1px">'.$_GET['timeline3'].'</td>
		</tr>
		<br>
		<tr>
			<td colspan="4"><b>IV. EMPLOYEE COMMENTS</b></td>
		</tr>
		<tr>
			<td width="100%" style="border-style:solid black 1px; border-left-style: 1px" rowspan="3">'.$row['emp_comment'].'</td>
		</tr>
		<tr>
			<td></td>
		</tr>';
$tbl6 .= '<tr>
			<td align="center"><b>DISCUSSION / REVIEW WITH EMPLOYEE</b></td>
		</tr>
		<tr>
			<td width="50%" style="border-top-style:1px; border-left-style: 1px" rowspan="2"></td>
			<td width="50%" style="border-top-style:1px; border-right-style:1px; border-left-style: 1px" rowspan="2"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td align="center" style="border-left-style:1px;">'."EMPLOYEE'S Signature Over Printed Name".'</td>
			<td align="center" style="border-left-style:1px; border-right-style:1px;">'."IMMEDIATE SUPERIOR'S Signature Over Printed Name".'</td>
		</tr>
		<tr>
			<td align="center" style="border-left-style:1px; border-bottom-style:1px; border-right-style:1px;">DATE:</td>
			<td align="center" style="border-bottom-style:1px; border-right-style:1px;">DATE:</td>
		</tr>
		<tr>
			<td width="50%" style="border-left-style: 1px" rowspan="2"></td>
			<td width="50%" style="border-right-style:1px; border-left-style: 1px" rowspan="2"></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td align="center" style="border-left-style:1px;">'."MANAGER'S (2nd Level) Signature Over Printed Name".'</td>
			<td align="center" style="border-left-style:1px; border-right-style:1px;">Received by HR Department:</td>
		</tr>
		<tr>
			<td align="center" style="border-left-style:1px; border-bottom-style:1px; border-right-style:1px;">DATE:</td>
			<td align="center" style="border-bottom-style:1px; border-right-style:1px;">DATE:</td>
		</tr><br>';

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include_emp_par.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('IGC ONLINE PAR v1.0');
$pdf->SetSubject('TCPDF Tutorial');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
//$pdf->setFooterData(array(0,64,0), array(0,64,128));

//remove the header and footer data
$pdf->setPrintHeader(false);
//$pdf->setPrintFooter(false);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 8, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


// Set some content to print
$html = <<<EOD
<html>
<head>
<style>

</style>
</head>
<body>
<div>
	<table cellpadding="3" style="font-size: 10px;">
		<tbody>
		<tr>
			<th align="center" colspan="4" style="border-bottom-style:1px;"><h2><b>PERFORMANCE ASSESSMENT REPORT (PAR)</b></h2></th>
		</tr>
		$tbl1
		</tbody>
	</table><br>
	<div><b>I. KRAs & KPIs</b></div>
	<table cellpadding="3" style="font-size: 10px">
		<tbody>
		$tbl2
		</tbody>
	</table><br>
	<div><b>II. GENERAL PERFORMANCE</b></div>
	<table cellpadding="3" style="font-size: 10px">
		<tbody>
		$tbl3
		</tbody>
	</table><br><br>
	<table nobr="true" cellpadding="3" style="font-size: 10px">
		<tbody>
		$tbl4
		</tbody>
	</table><br>
	<table cellpadding="3" style="font-size: 10px">
	<div><b>IV. AREAS FOR DEVELOPMENT / IMPROVEMENT</b></div>
		<tbody>
		$tbl5
		</tbody>
	</table><br>
	<table nobr="true" cellpadding="3" style="font-size: 10px">
		<tbody>
		$tbl6
		</tbody>
	</table><br>
</div>
</body>
</html>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('printReport.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
