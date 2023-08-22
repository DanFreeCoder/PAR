<?php
session_start();
if (!(isset($_SESSION['fullname']))) {
	header('Location: ../../index.php');
}
?>
<!DOCTYPE HTML>
<html lang="eng">

<head>
	<title>IGC Online-PAR</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/main.css" />
	<link rel="stylesheet" href="../../assets/datetimepicker/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="../../assets/toastr/toastr.css">
</head>

<body id="page-top" class="subpage">
	<!-- Header -->
	<header id="header">
		<div class="logo"><a href="index.html">Innogroup <span>Online-PAR</span></a></div>
		<a href="index.php"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Cancel</a>
		<div class="progress-bar" id="mybar" style="height:12px; background-color:#04AA6D; width:0%; margin:0; padding:0;"></div>
	</header>
	<!-- One -->
	<section id="One" class="wrapper style3">
		<div class="inner">
			<header class="align-center">
				<p>Web Base</p>
				<h2>Performance Assessment Report</h2>
			</header>
		</div>
	</section>
	<!-- Two -->
	<?php
	include '../../config/clsConnection.php';
	include '../../objects/clsDetails.php';
	include '../../objects/clsUser.php';

	$database = new clsConnection();
	$db = $database->connect();

	$details = new ParDetails($db);
	$user = new Users($db);
	//get PAR Details
	$details->par_id = $_GET['id'];
	$sel = $details->get_draft_par_details();
	while ($row2 = $sel->fetch(PDO::FETCH_ASSOC)) {
		//PAR Details
		$sup_id = $row2['sup-id'];
		$details_id = $row2['details_id'];
		$emp_name = $row2['emp_name'];
		$position = $row2['position'];
		$dept_id = $row2['department'];
		$department = $row2['dept-name'];
		$project = $row2['project'];
		$emp_status = $row2['emp_status'];
		$assessment  = $row2['assessment'];
		$from = date_format(new DateTime($row2['review_from']), 'F j, Y');
		$to = date_format(new DateTime($row2['review_to']), 'F j, Y');
		$date_hire = date_format(new DateTime($row2['date_hire']), 'F j, Y');
		$rater = $row2['rater'];
		$rater_name = $row2['rater_fullname'];
		$rater_id = $row2['rater_id'];
		$emp_email = $row2['emp_email'];
		$kra_total = $row2['kra_total'];
		$gp_total = $row2['gp_total'];
		$kra_average = $row2['kra_average'];
		$gp_average = $row2['gp_average'];
		$oap_total = $row2['oap_total'];
		$oap_scale = $row2['oap_scale'];
		$accomplishment = $row2['accomplishment'];
		$prof_dev = $row2['prof_dev'];
		$prof_others = $row2['prof_others'];
		$emp_comment = $row2['emp_comment'];
		$recommendation = $row2['recommendation'];
		$gross = $row2['gross'];
		$remarks = $row2['remarks'];
		$par_status = $row2['par_status'];
		//kra_kpi
		$kra_id = $row2['kra_id'];
		$kra1 = $row2['kra1'];
		$kpi1  = $row2['kpi1'];
		$comments1  = $row2['comments1'];
		$sup_com1 = $row2['sup_com1'];
		$rate1 = $row2['rate1'];
		$kra2 = $row2['kra2'];
		$kpi2  = $row2['kpi2'];
		$comments2 = $row2['comments2'];
		$sup_com2 = $row2['sup_com2'];
		$rate2 = $row2['rate2'];
		$kra3 = $row2['kra3'];
		$kpi3 = $row2['kpi3'];
		$comments3 = $row2['comments3'];
		$sup_com3  = $row2['sup_com3'];
		$rate3 = $row2['rate3'];
		$kra4 = $row2['kra4'];
		$kpi4  = $row2['kpi4'];
		$comments4  = $row2['comments4'];
		$sup_com4  = $row2['sup_com4'];
		$rate4 = $row2['rate4'];
		$kra5 = $row2['kra5'];
		$kpi5  = $row2['kpi5'];
		$comments5  = $row2['comments5'];
		$sup_com5  = $row2['sup_com5'];
		$rate5 = $row2['rate5'];
		$kra6 = $row2['kra6'];
		$kpi6  = $row2['kpi6'];
		$comments6  = $row2['comments6'];
		$sup_com6  = $row2['sup_com6'];
		$rate6 = $row2['rate6'];
		//general performance
		$gp_id = $row2['gp_id'];
		$gp1a_rate = $row2['gp1a_rate'];
		$gp1a_comment = $row2['gp1a_comment'];
		$gp1b_rate = $row2['gp1b_rate'];
		$gp1b_comment = $row2['gp1b_comment'];
		$gp1c_rate = $row2['gp1c_rate'];
		$gp1c_comment = $row2['gp1c_comment'];
		$gp2a_rate = $row2['gp2a_rate'];
		$gp2a_comment = $row2['gp2a_comment'];
		$gp2b_rate = $row2['gp2b_rate'];
		$gp2b_comment = $row2['gp2b_comment'];
		$gp2c_rate = $row2['gp2c_rate'];
		$gp2c_comment = $row2['gp2c_comment'];
		$gp3a_rate = $row2['gp3a_rate'];
		$gp3a_comment = $row2['gp3a_comment'];
		$gp3b_rate = $row2['gp3b_rate'];
		$gp3b_comment = $row2['gp3b_comment'];
		$gp3c_rate = $row2['gp3c_rate'];
		$gp3c_comment = $row2['gp3c_comment'];
		$gp4a_rate = $row2['gp4a_rate'];
		$gp4a_comment = $row2['gp4a_comment'];
		$gp4b_rate = $row2['gp4b_rate'];
		$gp4b_comment = $row2['gp4b_comment'];
		$gp4c_rate = $row2['gp4c_rate'];
		$gp4c_comment = $row2['gp4c_comment'];
		$gp5a_rate = $row2['gp5a_rate'];
		$gp5a_comment = $row2['gp5a_comment'];
		$gp5b_rate = $row2['gp5b_rate'];
		$gp5b_comment = $row2['gp5b_comment'];
		$gp5c_rate = $row2['gp5c_rate'];
		$gp5c_comment = $row2['gp5c_comment'];
		$gp6a_rate = $row2['gp6a_rate'];
		$gp6a_comment = $row2['gp6a_comment'];
		$gp6b_rate = $row2['gp6b_rate'];
		$gp6b_comment = $row2['gp6b_comment'];
		$gp6c_rate = $row2['gp6c_rate'];
		$gp6c_comment = $row2['gp6c_comment'];
		$gp7a_rate = $row2['gp7a_rate'];
		$gp7a_comment = $row2['gp7a_comment'];
		$gp7b_rate = $row2['gp7b_rate'];
		$gp7b_comment = $row2['gp7b_comment'];
		$gp7c_rate = $row2['gp7c_rate'];
		$gp7c_comment = $row2['gp7c_comment'];
		$gp8a_rate = $row2['gp8a_rate'];
		$gp8a_comment = $row2['gp8a_comment'];
		$gp8b_rate = $row2['gp8b_rate'];
		$gp8b_comment = $row2['gp8b_comment'];
		$gp8c_rate = $row2['gp8c_rate'];
		$gp8c_comment = $row2['gp8c_comment'];
		$gp9a_rate = $row2['gp9a_rate'];
		$gp9a_comment = $row2['gp9a_comment'];
		$gp9b_rate = $row2['gp9b_rate'];
		$gp9b_comment = $row2['gp9b_comment'];
		$gp9c_rate = $row2['gp9c_rate'];
		$gp9c_comment = $row2['gp9c_comment'];
		$gp10a_rate = $row2['gp10a_rate'];
		$gp10a_comment = $row2['gp10a_comment'];
		$gp10b_rate = $row2['gp10b_rate'];
		$gp10b_comment = $row2['gp10b_comment'];
		$gp10c_rate = $row2['gp10c_rate'];
		$gp10c_comment = $row2['gp10c_comment'];
		//pip
		$pip_id = $row2['pip_id'];
		$pin1 = $row2['pin1'];
		$at1 = $row2['at1'];
		$sn1 = $row2['sn1'];
		$time1 = $row2['time1'];
		$pin2 = $row2['pin2'];
		$at2 = $row2['at2'];
		$sn2 = $row2['sn2'];
		$time2 = $row2['time2'];
		$pin3 = $row2['pin3'];
		$at3 = $row2['at3'];
		$sn3 = $row2['sn3'];
		$time3 = $row2['time3'];
	}

	?>
	<section id="two" class="wrapper style2">
		<div class="inner">
			<div class="box">
				<div class="content">
					<center>
						<h2>Employee Details</h2>
					</center>
					<hr>
					<form method="post" action="#">
						<div class="row uniform">
							<div class="3u 12u$(xsmall)">
								<input type="text" id="id" style="display:none" value="<?php echo $sup_id; ?>" /> <!-- SUP_PAR ID -->
								<input type="text" id="par-id" style="display:none" value="<?php echo $details_id; ?>" />
								<input type="text" id="user-id" style="display:none" value="<?php echo $_SESSION['id']; ?>" />
								<input type="text" id="rater-id" style="display:none" value="<?php echo $rater_id; ?>" />
								<input type="text" id="name" placeholder="Employee's Name" value="<?php echo $emp_name; ?>" disabled />
							</div>
							<div class="3u 12u$(xsmall)">
								<input type="text" id="position" placeholder="Position Title" value="<?php echo $position; ?>" disabled />
							</div>
							<div class="3u 12u$(xsmall)">
								<input type="text" id="department" placeholder="Department" value="<?php echo $department; ?>" disabled />
							</div>
							<div class="3u 12u$(xsmall)">
								<?php
								//count the dept unit/s
								$user->dept_id = $_SESSION['dept'];
								$count = $user->count_unit();
								while ($row_count = $count->fetch(PDO::FETCH_ASSOC)) {
									if ($row_count['counts'] > 0) {
										//get the list of units
										echo '<select id="project">';
										$user->dept_id = $_SESSION['dept'];
										$sel = $user->view_unit();
										while ($row = $sel->fetch(PDO::FETCH_ASSOC)) {
											if ($row['id'] == $_SESSION['unit']) {
												echo '<option value=' . $row['id'] . ' selected>' . $row['unit_name'] . '</option>';
											} else {
												echo '<option value=' . $row['id'] . '>' . $row['unit_name'] . '</option>';
											}
										}
										echo '</select>';
									} else {
										//get the COMMON UNITS(HEAD OFFICE)
										echo '<select id="project">';
										$sel = $user->view_common_unit();
										while ($row = $sel->fetch(PDO::FETCH_ASSOC)) {
											echo '<option value=' . $row['id'] . ' selected>' . $row['unit_name'] . '</option>';
										}
										echo '</select>';
									}
								}
								?>
							</div>
							<!-- Break -->
							<div class="3u 12u$(xsmall)">
								<select id="status">
									<option value="0" <?php echo ($emp_status == '-Select Employment Status-' || $emp_status == 0) ? 'selected' : ''; ?>>-Select Employment Status-</option>
									<option value="1" <?php echo ($emp_status == 'Regular' || $emp_status == 1) ? 'selected' : ''; ?>>Regular</option>
									<option value="2" <?php echo ($emp_status == 'Probationary' || $emp_status == 2) ? 'selected' : ''; ?>>Probationary</option>
									<option value="3" <?php echo ($emp_status == 'Project Based' || $emp_status == 3) ? 'selected' : ''; ?>>Project Based</option>
									<option value="4" <?php echo ($emp_status == 'Casual' || $emp_status == 4) ? 'selected' : ''; ?>>Casual</option>
									<option value="5" <?php echo ($emp_status == 'Trainee' || $emp_status == 5) ? 'selected' : ''; ?>>Trainee</option>
									<option value="6" <?php echo ($emp_status == 'Others' || $emp_status == 6) ? 'selected' : ''; ?>>Others</option>
								</select>
							</div>
							<div class="3u 12u$(xsmall)">
								<select id="assessment">
									<option value="0" <?php echo ($assessment == '-Performance Assessment-' || $assessment == 0) ? 'selected' : ''; ?>>-Performance Assessment-</option>
									<option value="1" <?php echo ($assessment == 'Annual' || $assessment == 1) ? 'selected' : ''; ?>>Annual</option>
									<option value="7" <?php echo ($assessment == 'Mid Year' || $assessment == 7) ? 'selected' : ''; ?>>Mid Year</option>
									<option value="2" <?php echo ($assessment == '5th Month' || $assessment == 2) ? 'selected' : ''; ?>>5th Month</option>
									<option value="3" <?php echo ($assessment == '3rd Month' || $assessment == 3) ? 'selected' : ''; ?>>3rd Month</option>
									<option value="5" <?php echo ($assessment == 'Training' || $assessment == 5) ? 'selected' : ''; ?>>Training</option>
									<option value="6" <?php echo ($assessment == 'Others' || $assessment == 6) ? 'selected' : ''; ?>>Others</option>
								</select>
							</div>
							<div class="3u 12u$(xsmall)" id="years">
								<select id="year" style="color: black;" class="form-group" disabled>
									<?php
									echo '<option value="' . $from . '" selected>' . $from . '</option>';
									$start_year = 2022;
									$current_year = date('Y') * 1;
									do {
										echo '<option value="' . $start_year . '">' . $start_year . '</option>';
										$start_year++;
									} while ($current_year >= $start_year);
									?>
								</select>
							</div>
							<div class="3u 12u$(xsmall)" id="from">
								<input type="text" id="review-from" class="datepicker" placeholder="Review Period From" value="<?php echo $from; ?>" disabled>
							</div>
							<div class="3u 12u$(xsmall)" id="to">
								<input type="text" id="review-to" class="datepicker" placeholder="Review Period To" value="<?php echo $to; ?>" disabled>
							</div>
							<!-- Break -->
							<div class="3u 12u$(xsmall)">
								<input type="text" id="date-hire" class="datepicker" placeholder="Date Hired" value="<?php echo $date_hire; ?>" disabled>
							</div>
							<div class="3u 12u$(xsmall)">
								<select id="rater">
									<?php
									if ($rater == 'Immediate Superior' || $rater == 2) {
										echo '<option value="0" disabled>- First Approver -</option>
														  <option value="2" selected>Immediate Superior</option>
														  <option value="3">Manager</option>
														  <option value="4">Sr. Manager</option>';
									} elseif ($rater == 'Manager' || $rater == 3) {
										echo '<option value="0" disabled>- First Approver -</option>
														  <option value="2">Immediate Superior</option>
														  <option value="3" selected>Manager</option>
														  <option value="4">Sr. Manager</option>';
									} elseif ($rater == 'Sr. Manager' || $rater == 4) {
										echo '<option value="0" disabled>- First Approver -</option>
														  <option value="2">Immediate Superior</option>
														  <option value="3">Manager</option>
														  <option value="4" selected>Sr. Manager</option>';
									} else {
										echo '<option value="0" selected disabled>- First Approver -</option>
														  <option value="2">Immediate Superior</option>
														  <option value="3">Manager</option>
														  <option value="4">Sr. Manager</option>';
									}
									?>

									<!-- <option value="5">HR Administrator</option> -->
								</select>
							</div>
							<div class="3u 12u$(xsmall)">
								<input type="text" id="rater-name" value="<?php echo $rater_name; ?>" disabled>
								<input type="text" id="rater-id" value="<?php echo $rater_id; ?>" style="display: none;">
								<input type="text" id="eval-by" value="<?php echo $_SESSION['id']; ?>" style="display: none;">
							</div>
							<div class="3u 12u$(xsmall)">
								<input type="text" id="email" value="<?php echo $emp_email; ?>" disabled>
							</div>
					</form>
				</div>
			</div>
		</div>
		<div class="inner">
			<div class="box">
				<div class="content">
					<p>Objective: Performance Assessment is conducted to serve as a communication tool to promote alignment of expectations, provide periodic feedback on performance, drive performance improvement and promote employee development.</p>
					<!-- Criteria -->
					<h4>Performance Rating Criteria</h4>
					<p>Consider the employee's performance in each category and designate the level of performance that most accurately describes the person's job performance within the review period on a scale of 1 to 5:</p>

					<div class="table-wrapper">
						<table>
							<thead>
								<tr>
									<th style="width: 25%;">Rating Scale</th>
									<th style="width: 75%;">Definition</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><b>5 - Outstanding</b></td>
									<td>Consistently and clearly exceeds expectations requiring little to no supervision.</td>
								</tr>
								<tr>
									<td><b>4 - Exceeds Expectations</b></td>
									<td>Surpasses acceptable level of expectations requiring minimum supervision.</td>
								</tr>
								<tr>
									<td><b>3 - Meets Expectations</b></td>
									<td>Meets the performance standards and objectives within the agreed and aligned set of expectations. Is competent and dependable within the required supervision.</td>
								</tr>
								<tr>
									<td><b>2 - Needs Improvement</b></td>
									<td>Falls short of the required performance standards and objectives within the agreed and aligned set of expectations.<br>
										2.1 Additional training, coaching, supervision and/or learning time is required
										to meet performance standards.<br>
										2.2 Otherwise, a Performance Improvement Plan maybe needed.</td>
								</tr>
								<tr>
									<td><b>1 - Poor Performance</b></td>
									<td>Non-performance of the required standards and objectives within the agreed and aligned set of expectations. A Performance Improvement Plan (PIP) is a must.</td>
								</tr>
								<tr>
									<td><b>N/A - Not Applicable</b></td>
									<td>Assessment of the performance standards and objectives is not relevant and/or demonstrated during the review period.</td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- KRA -->
					<h4><b>I. KEY RESULTS AREA (KRA) and KEY PERFORMANCE INDICATOR (KPI)</b></h4>
					<p>List down the major KRAs of the Employee based on the main work responsibilities and duties with specific Key Performance Indicators. Provide three (3) to five (5) individual objectives aligned between Rater and Ratee. All of the five (5) shall be within that of the person's job responsibilities/functions either as individual contributor or in a teaming / work process environment. Average of the KRA is sixty percent (60%) of the Individual Overall Rating.</p>
					<!-- Break -->
					<div class="row">
						<div class="col-sm-3">
							<h4>
								<center>KRA and KPI's</center>
							</h4>
						</div>
						<div class="col-sm-6">
							<h4></h4>
						</div>
						<div class="col-sm-3">
							<h4>
								<center>Comments</center>
							</h4>
						</div>
					</div>
					<!-- A -->
					<h4><b>A.</b></h4>
					<div class="row">
						<div class="col-sm-6">
							<textarea name="message" id="kra1" placeholder="KRA here" rows="4"><?php echo $kra1; ?></textarea>
							<div class="text-danger" id="kra1_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div id="kra1-checkbox" class="row">
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra1">
									<?php
									if ($rate1 == '5') {
										echo '<input type="checkbox" id="kra1-5" value="5" checked>';
									} else {
										echo '<input type="checkbox" id="kra1-5" value="5" >';
									}
									?>
									<label for="kra1-5">5</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra1">
									<?php
									if ($rate1 == '4') {
										echo '<input type="checkbox" id="kra1-4" value="4" checked>';
									} else {
										echo '<input type="checkbox" id="kra1-4" value="4" >';
									}
									?>
									<label for="kra1-4">4</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra1">
									<?php
									if ($rate1 == '3') {
										echo '<input type="checkbox" id="kra1-3" value="3" checked>';
									} else {
										echo '<input type="checkbox" id="kra1-3" value="3" >';
									}
									?>
									<label for="kra1-3">3</label>
								</span>
							</div>
							<div class="col-sm-2">
								<b>RATING</b><br><br>
								<span class="checkbox-kra1">
									<?php
									if ($rate1 == '2') {
										echo '<input type="checkbox" id="kra1-2" value="2" checked>';
									} else {
										echo '<input type="checkbox" id="kra1-2" value="2">';
									}
									?>
									<label for="kra1-2">2</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra1">
									<?php
									if ($rate1 == '1') {
										echo '<input type="checkbox" id="kra1-1" value="1" checked>';
									} else {
										echo '<input type="checkbox" id="kra1-1" value="1" >';
									}
									?>
									<label for="kra1-1">1</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra1">
									<?php
									if ($rate1 == '0' || $rate1 == null) {
										echo '<input type="checkbox" id="kra1-na" value="0" checked>';
									} else {
										echo '<input type="checkbox" id="kra1-na" value="0">';
									}
									?>
									<label for="kra1-na">NA</label>
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<textarea name="message" id="kpi1" placeholder="Enter KPI's here" rows="4"><?php echo $kpi1; ?></textarea>
							<div class="text-danger" id="kpi1_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="comments1" placeholder="Enter comments here" rows="4" disabled><?php echo $comments1; ?></textarea>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="sup-comment1" placeholder="Supervisor's comments here" rows="4"><?php echo $sup_com1; ?></textarea>
							<div class="text-danger" id="comment_1" hidden>You have reached the maximum limit for this field.</div>
						</div>
					</div>
					<!-- B -->
					<h4><b>B.</b></h4>
					<div class="row">
						<div class="col-sm-6">
							<textarea name="message" id="kra2" placeholder="KRA here" rows="4"><?php echo $kra2; ?></textarea>
							<div class="text-danger" id="kra2_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div id="kra2-checkbox" class="row">
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra2">
									<?php
									if ($rate2 == '5') {
										echo '<input type="checkbox" id="kra2-5" value="5" checked>';
									} else {
										echo '<input type="checkbox" id="kra2-5" value="5">';
									}
									?>
									<label for="kra2-5">5</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra2">
									<?php
									if ($rate2 == '4') {
										echo '<input type="checkbox" id="kra2-4" value="4" checked>';
									} else {
										echo '<input type="checkbox" id="kra2-4" value="4">';
									}
									?>
									<label for="kra2-4">4</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra2">
									<?php
									if ($rate2 == '3') {
										echo '<input type="checkbox" id="kra2-3" value="3" checked>';
									} else {
										echo '<input type="checkbox" id="kra2-3" value="3">';
									}
									?>
									<label for="kra2-3">3</label>
								</span>
							</div>
							<div class="col-sm-2">
								<b>RATING</b><br><br>
								<span class="checkbox-kra2">
									<?php
									if ($rate2 == '2') {
										echo '<input type="checkbox" id="kra2-2" value="2" checked>';
									} else {
										echo '<input type="checkbox" id="kra2-2" value="2">';
									}
									?>
									<label for="kra2-2">2</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra2">
									<?php
									if ($rate2 == '1') {
										echo '<input type="checkbox" id="kra2-1" value="1" checked>';
									} else {
										echo '<input type="checkbox" id="kra2-1" value="1">';
									}
									?>
									<label for="kra2-1">1</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra2">
									<?php
									if ($rate2 == '0' || $rate2 == null) {
										echo '<input type="checkbox" id="kra2-na" value="0" checked>';
									} else {
										echo '<input type="checkbox" id="kra2-na" value="0">';
									}
									?>
									<label for="kra2-na">NA</label>
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<textarea name="message" id="kpi2" placeholder="Enter KPI's here" rows="4"><?php echo $kpi2; ?></textarea>
							<div class="text-danger" id="kpi2_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="comments2" placeholder="Enter comments here" rows="4" disabled><?php echo $comments2; ?></textarea>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="sup-comment2" placeholder="Supervisor's comments here" rows="4"><?php echo $sup_com2; ?></textarea>
							<div class="text-danger" id="comment_2" hidden>You have reached the maximum limit for this field.</div>
						</div>
					</div>
					<!-- C -->
					<h4><b>C.</b></h4>
					<div class="row">
						<div class="col-sm-6">
							<textarea name="message" id="kra3" placeholder="KRA here" rows="4"><?php echo $kra3; ?></textarea>
							<div class="text-danger" id="kra3_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div id="kra3-checkbox" class="row">
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra3">
									<?php
									if ($rate3 == '5') {
										echo '<input type="checkbox" id="kra3-5" value="5" checked>';
									} else {
										echo '<input type="checkbox" id="kra3-5" value="5">';
									}
									?>
									<label for="kra3-5">5</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra3">
									<?php
									if ($rate3 == '4') {
										echo '<input type="checkbox" id="kra3-4" value="4" checked>';
									} else {
										echo '<input type="checkbox" id="kra3-4" value="4">';
									}
									?>
									<label for="kra3-4">4</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra3">
									<?php
									if ($rate3 == '3') {
										echo '<input type="checkbox" id="kra3-3" value="3" checked>';
									} else {
										echo '<input type="checkbox" id="kra3-3" value="3">';
									}
									?>
									<label for="kra3-3">3</label>
								</span>
							</div>
							<div class="col-sm-2">
								<b>RATING</b><br><br>
								<span class="checkbox-kra3">
									<?php
									if ($rate3 == '2') {
										echo '<input type="checkbox" id="kra3-2" value="2" checked>';
									} else {
										echo '<input type="checkbox" id="kra3-2" value="2">';
									}
									?>
									<label for="kra3-2">2</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra3">
									<?php
									if ($rate3 == '1') {
										echo '<input type="checkbox" id="kra3-1" value="1" checked>';
									} else {
										echo '<input type="checkbox" id="kra3-1" value="1">';
									}
									?>
									<label for="kra3-1">1</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra3">
									<?php
									if ($rate3 == '0' || $rate3 == null) {
										echo '<input type="checkbox" id="kra3-na" value="0" checked>';
									} else {
										echo '<input type="checkbox" id="kra3-na" value="0">';
									}
									?>
									<label for="kra3-na">NA</label>
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<textarea name="message" id="kpi3" placeholder="Enter KPI's here" rows="4"><?php echo $kpi3; ?></textarea>
							<div class="text-danger" id="kpi3_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="comments3" placeholder="Enter comments here" rows="4" disabled><?php echo $comments3; ?></textarea>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="sup-comment3" placeholder="Supervisor's comments here" rows="4"><?php echo $sup_com3; ?></textarea>
							<div class="text-danger" id="comment_3" hidden>You have reached the maximum limit for this field.</div>
						</div>
					</div>
					<!-- D -->
					<h4><b>D.</b></h4>
					<div class="row">
						<div class="col-sm-6">
							<textarea name="message" id="kra4" placeholder="KRA here" rows="4"><?php echo $kra4; ?></textarea>
							<div class="text-danger" id="kra4_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div id="kra4-checkbox" class="row">
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra4">
									<?php
									if ($rate4 == '5') {
										echo '<input type="checkbox" id="kra4-5" value="5" checked>';
									} else {
										echo '<input type="checkbox" id="kra4-5" value="5">';
									}
									?>
									<label for="kra4-5">5</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra4">
									<?php
									if ($rate4 == '4') {
										echo '<input type="checkbox" id="kra4-4" value="4" checked>';
									} else {
										echo '<input type="checkbox" id="kra4-4" value="4">';
									}
									?>
									<label for="kra4-4">4</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra4">
									<?php
									if ($rate4 == '3') {
										echo '<input type="checkbox" id="kra4-3" value="3" checked>';
									} else {
										echo '<input type="checkbox" id="kra4-3" value="3">';
									}
									?>
									<label for="kra4-3">3</label>
								</span>
							</div>
							<div class="col-sm-2">
								<b>RATING</b><br><br>
								<span class="checkbox-kra4">
									<?php
									if ($rate4 == '2') {
										echo '<input type="checkbox" id="kra4-2" value="2" checked>';
									} else {
										echo '<input type="checkbox" id="kra4-2" value="2">';
									}
									?>
									<label for="kra4-2">2</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra4">
									<?php
									if ($rate4 == '1') {
										echo '<input type="checkbox" id="kra4-1" value="1" checked>';
									} else {
										echo '<input type="checkbox" id="kra4-1" value="1">';
									}
									?>
									<label for="kra4-1">1</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra4">
									<?php
									if ($rate4 == '0' || $rate4 == null) {
										echo '<input type="checkbox" id="kra4-na" value="0" checked>';
									} else {
										echo '<input type="checkbox" id="kra4-na" value="0">';
									}
									?>
									<label for="kra4-na">NA</label>
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<textarea name="message" id="kpi4" placeholder="Enter KPI's here" rows="4"><?php echo $kpi4; ?></textarea>
							<div class="text-danger" id="kpi4_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="comments4" placeholder="Enter comments here" rows="4" disabled><?php echo $comments4; ?></textarea>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="sup-comment4" placeholder="Supervisor's comments here" rows="4"><?php echo $sup_com4; ?></textarea>
							<div class="text-danger" id="comment_4" hidden>You have reached the maximum limit for this field.</div>
						</div>
					</div>
					<!-- E -->
					<h4><b>E.</b></h4>
					<div class="row">
						<div class="col-sm-6">
							<textarea name="message" id="kra5" placeholder="KRA here" rows="4"><?php echo $kra5; ?></textarea>
							<div class="text-danger" id="kra5_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div id="kra5-checkbox" class="row">
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra5">
									<?php
									if ($rate5 == '5') {
										echo '<input type="checkbox" id="kra5-5" value="5" checked>';
									} else {
										echo '<input type="checkbox" id="kra5-5" value="5">';
									}
									?>
									<label for="kra5-5">5</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra5">
									<?php
									if ($rate5 == '4') {
										echo '<input type="checkbox" id="kra5-4" value="4" checked>';
									} else {
										echo '<input type="checkbox" id="kra5-4" value="4">';
									}
									?>
									<label for="kra5-4">4</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra5">
									<?php
									if ($rate5 == '3') {
										echo '<input type="checkbox" id="kra5-3" value="3" checked>';
									} else {
										echo '<input type="checkbox" id="kra5-3" value="3">';
									}
									?>
									<label for="kra5-3">3</label>
								</span>
							</div>
							<div class="col-sm-2">
								<b>RATING</b><br><br>
								<span class="checkbox-kra5">
									<?php
									if ($rate5 == '2') {
										echo '<input type="checkbox" id="kra5-2" value="2" checked>';
									} else {
										echo '<input type="checkbox" id="kra5-2" value="2">';
									}
									?>
									<label for="kra5-2">2</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra5">
									<?php
									if ($rate5 == '1') {
										echo '<input type="checkbox" id="kra5-1" value="1" checked>';
									} else {
										echo '<input type="checkbox" id="kra5-1" value="1">';
									}
									?>
									<label for="kra5-1">1</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra5">
									<?php
									if ($rate5 == '0' || $rate5 == null) {
										echo '<input type="checkbox" id="kra5-na" value="0" checked>';
									} else {
										echo '<input type="checkbox" id="kra5-na" value="0">';
									}
									?>
									<label for="kra5-na">NA</label>
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<textarea name="message" id="kpi5" placeholder="Enter KPI's here" rows="4"><?php echo $kpi5; ?></textarea>
							<div class="text-danger" id="kpi5_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="comments5" placeholder="Enter comments here" rows="4" disabled><?php echo $comments5; ?></textarea>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="sup-comment5" placeholder="Supervisor's comments here" rows="4"><?php echo $sup_com5; ?></textarea>
							<div class="text-danger" id="comment_5" hidden>You have reached the maximum limit for this field.</div>
						</div>

					</div>
					<!-- F -->
					<h4><b>F.</b></h4>
					<div class="row">
						<div class="col-sm-6">
							<textarea name="message" id="kra6" placeholder="KRA here" rows="4"><?php echo $kra6; ?></textarea>
							<div class="text-danger" id="kra6_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div id="kra6-checkbox" class="row">
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra6">
									<?php
									if ($rate6 == '5') {
										echo '<input type="checkbox" id="kra6-5" value="5" checked>';
									} else {
										echo '<input type="checkbox" id="kra6-5" value="5">';
									}
									?>
									<label for="kra6-5">5</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra6">
									<?php
									if ($rate6 == '4') {
										echo '<input type="checkbox" id="kra6-4" value="4" checked>';
									} else {
										echo '<input type="checkbox" id="kra6-4" value="4">';
									}
									?>
									<label for="kra6-4">4</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra6">
									<?php
									if ($rate6 == '3') {
										echo '<input type="checkbox" id="kra6-3" value="3" checked>';
									} else {
										echo '<input type="checkbox" id="kra6-3" value="3">';
									}
									?>
									<label for="kra6-3">3</label>
								</span>
							</div>
							<div class="col-sm-2">
								<b>RATING</b><br><br>
								<span class="checkbox-kra6">
									<?php
									if ($rate6 == '2') {
										echo '<input type="checkbox" id="kra6-2" value="2" checked>';
									} else {
										echo '<input type="checkbox" id="kra6-2" value="2">';
									}
									?>
									<label for="kra6-2">2</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra6">
									<?php
									if ($rate6 == '1') {
										echo '<input type="checkbox" id="kra6-1" value="1" checked>';
									} else {
										echo '<input type="checkbox" id="kra6-1" value="1">';
									}
									?>
									<label for="kra6-1">1</label>
								</span>
							</div>
							<div class="col-sm-2">
								<br><br>
								<span class="checkbox-kra6">
									<?php
									if ($rate6 == '0' || $rate6 == null) {
										echo '<input type="checkbox" id="kra6-na" value="0" checked>';
									} else {
										echo '<input type="checkbox" id="kra6-na" value="0">';
									}
									?>
									<label for="kra6-na">NA</label>
								</span>
							</div>
						</div>
						<div class="col-sm-6">
							<textarea name="message" id="kpi6" placeholder="Enter KPI's here" rows="4"><?php echo $kpi6; ?></textarea>
							<div class="text-danger" id="kpi6_err" hidden>You have reached the maximum limit for this field.</div>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="comments6" placeholder="Enter comments here" rows="4" disabled><?php echo $comments6; ?></textarea>
						</div>
						<div class="col-sm-3">
							<textarea name="message" id="sup-comment6" placeholder="Supervisor's comments here" rows="4"><?php echo $sup_com6; ?></textarea>
							<div class="text-danger" id="comment_6" hidden>You have reached the maximum limit for this field.</div>
						</div>
					</div><br>
					<hr>
					<!-- Break -->
					<h4><b>II. GENERAL PERFORMANCE FACTORS AND BEHAVIORAL INDICATORS</b></h4>
					<!-- <p>Assess the employee’s know-how and know-why  in relation to the Company’s  six (6) CORE VALUES and  four (4) Competencies. For each Factor below, there are three (3) actionable and observable indicators, assess the employee based on the definition and specified indicators using the rating scale of 1 to 5. For the OVERALL PERFORMANCE (OAP),  determine the Average rating  for Part I multiply it by 60%; for General Performance, get the Average rating multiply it by 40%.  Place a check mark on the box corresponding to the Overall Performance Rating (OAP).</p><br> -->
					<!-- 1. BIAS FOR RESULT -->
					<div class="row">
						<div class="col-sm-12">
							<!-- <h4><b>FACTOR</b></h4> -->
							<p><b>1. BIAS FOR RESULT</b> - The extent in which an employee deliver results that will earn the trust and confidence of one's customer. The employee embraces personal accountability and seek opportunities and actively respond to problems/complaints.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<center>
								<h4>INDICATORS</h4>
							</center>
						</div>
						<div class="col-sm-6">
							<center>
								<h4>RATING</h4>
							</center>
						</div>
						<div class="col-sm-3">
							<center>
								<h4>COMMENTS</h4>
							</center>
						</div>
						<!-- Break -->
						<div class="col-md-12">
							<div id="gp1a" class="row">
								<div class="col-sm-3">
									<p>Makes a realistic and workable plan, targets with a clear commitment to achieve the desired outcome.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1a">
										<?php
										if ($gp1a_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-5" value="5">';
										}
										?>
										<label for="gp1a-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1a">
										<?php
										if ($gp1a_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-4" value="4">';
										}
										?>
										<label for="gp1a-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1a">
										<?php
										if ($gp1a_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-3" value="3">';
										}
										?>
										<label for="gp1a-3">3 </label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1a">
										<?php
										if ($gp1a_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-2" value="2">';
										}
										?>
										<label for="gp1a-2">2 </label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1a">
										<?php
										if ($gp1a_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-1" value="1">';
										}
										?>
										<label for="gp1a-1">1 </label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1a">
										<?php
										if ($gp1a_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1a-na" value="0">';
										}
										?>
										<label for="gp1a-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp1a-comment" placeholder="Enter comments here" rows="4"><?php echo $gp1a_comment; ?></textarea>
									<div class="text-danger" id="gp1a_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp1b" class="row">
								<div class="col-sm-3">
									<p>Provides guidance to others for meeting specific results while remaining accountable.</p><br>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1b">
										<?php
										if ($gp1b_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-5" value="5">';
										}
										?>
										<label for="gp1b-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1b">
										<?php
										if ($gp1b_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-4" value="4">';
										}
										?>
										<label for="gp1b-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1b">
										<?php
										if ($gp1b_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-3" value="3">';
										}
										?>
										<label for="gp1b-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1b">
										<?php
										if ($gp1b_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-2" value="2">';
										}
										?>
										<label for="gp1b-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1b">
										<?php
										if ($gp1b_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-1" value="1">';
										}
										?>
										<label for="gp1b-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1b">
										<?php
										if ($gp1b_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1b-na" value="0">';
										}
										?>
										<label for="gp1b-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp1b-comment" placeholder="Enter comments here" rows="4"><?php echo $gp1b_comment; ?></textarea>
									<div class="text-danger" id="gp1b_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp1c" class="row">
								<div class="col-sm-3">
									<p>Makes good decision with confidence based on a mixture of analysis, wisdom, experience, consultation and judgment.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1c">
										<?php
										if ($gp1c_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-5" value="5">';
										}
										?>
										<label for="gp1c-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1c">
										<?php
										if ($gp1c_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-4" value="4">';
										}
										?>
										<label for="gp1c-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1c">
										<?php
										if ($gp1c_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-3" value="3">';
										}
										?>
										<label for="gp1c-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1c">
										<?php
										if ($gp1c_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-2" value="2">';
										}
										?>
										<label for="gp1c-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1c">
										<?php
										if ($gp1c_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-1" value="1">';
										}
										?>
										<label for="gp1c-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp1c">
										<?php
										if ($gp1c_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp1c-na" value="0">';
										}
										?>
										<label for="gp1c-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp1c-comment" placeholder="Enter comments here" rows="4"><?php echo $gp1c_comment; ?></textarea>
									<div class="text-danger" id="gp1c_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- 2. INTEGRITY -->
					<div class="row">
						<div class="col-sm-12">
							<!-- <h4><b>FACTOR</b></h4> -->
							<p><b>2. INTEGRITY</b> - The extent in which the employee guarantees to always uphold in all dealings with internal and external parties. Employees serves with utmost honesty, strict against fraud and competence. The employee delivers what he/she promised.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<center>
								<h4>INDICATORS</h4>
							</center>
						</div>
						<div class="col-sm-6">
							<center>
								<h4>RATING</h4>
							</center>
						</div>
						<div class="col-sm-3">
							<center>
								<h4>COMMENTS</h4>
							</center>
						</div>
						<!-- Break -->
						<div class="col-md-12">
							<div id="gp2a" class="row">
								<div class="col-sm-3">
									<p>Follows company policies, established procedures and processes, rules and regulations in the performance of the job functions.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2a">
										<?php
										if ($gp2a_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-5" value="5">';
										}
										?>
										<label for="gp2a-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2a">
										<?php
										if ($gp2a_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-4" value="4">';
										}
										?>
										<label for="gp2a-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2a">
										<?php
										if ($gp2a_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-3" value="3">';
										}
										?>
										<label for="gp2a-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2a">
										<?php
										if ($gp2a_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-2" value="2">';
										}
										?>
										<label for="gp2a-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2a">
										<?php
										if ($gp2a_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-1" value="1">';
										}
										?>
										<label for="gp2a-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2a">
										<?php
										if ($gp2a_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2a-na" value="0">';
										}
										?>
										<label for="gp2a-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp2a-comment" placeholder="Enter comments here" rows="4"><?php echo $gp2a_comment; ?></textarea>
									<div class="text-danger" id="gp2a_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp2b" class="row">
								<div class="col-sm-3">
									<p>Maintains maturity and professionalism in keeping commitments and ensuring the job is done right.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2b">
										<?php
										if ($gp2b_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-5" value="5">';
										}
										?>
										<label for="gp2b-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2b">
										<?php
										if ($gp2b_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-4" value="4">';
										}
										?>
										<label for="gp2b-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2b">
										<?php
										if ($gp2b_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-3" value="3">';
										}
										?>
										<label for="gp2b-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2b">
										<?php
										if ($gp2b_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-2" value="2">';
										}
										?>
										<label for="gp2b-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2b">
										<?php
										if ($gp2b_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-1" value="1">';
										}
										?>
										<label for="gp2b-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2b">
										<?php
										if ($gp2b_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2b-na" value="0">';
										}
										?>
										<label for="gp2b-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp2b-comment" placeholder="Enter comments here" rows="4"><?php echo $gp2a_comment; ?></textarea>
									<div class="text-danger" id="gp2b_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div><br>
							<!-- Break -->
							<div id="gp2c" class="row">
								<div class="col-sm-3">
									<br>
									<p>Keeps matters of confidence, admits and corrects mistakes, and is seen as trustworthy.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2c">
										<?php
										if ($gp2c_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-5" value="5">';
										}
										?>
										<label for="gp2c-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2c">
										<?php
										if ($gp2c_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-4" value="4">';
										}
										?>
										<label for="gp2c-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2c">
										<?php
										if ($gp2c_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-3" value="3">';
										}
										?>
										<label for="gp2c-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2c">
										<?php
										if ($gp2c_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-2" value="2">';
										}
										?>
										<label for="gp2c-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2c">
										<?php
										if ($gp2c_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-1" value="1">';
										}
										?>
										<label for="gp2c-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp2c">
										<?php
										if ($gp2c_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp2c-na" value="0">';
										}
										?>
										<label for="gp2c-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp2c-comment" placeholder="Enter comments here" rows="4"><?php echo $gp2c_comment; ?></textarea>
									<div class="text-danger" id="gp2c_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- 3. OWNERSHIP -->
					<div class="row">
						<div class="col-sm-12">
							<!-- <h4><b>FACTOR</b></h4> -->
							<p><b>3. OWNERSHIP</b> - The extent in which the employee assures to always uphold the company’s welfare and to act or make decisions for and in behalf of the company - with the company’s best interest in mind.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<center>
								<h4>INDICATORS</h4>
							</center>
						</div>
						<div class="col-sm-6">
							<center>
								<h4>RATING</h4>
							</center>
						</div>
						<div class="col-sm-3">
							<center>
								<h4>COMMENTS</h4>
							</center>
						</div>
						<!-- Break -->
						<div class="col-md-12">
							<div id="gp3a" class="row">
								<div class="col-sm-3">
									<p>Accepts willingly job assignments, additional duties, taking accountability and responsibility in owning the job ensuring it gets done despite any changes.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3a">
										<?php
										if ($gp3a_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-5" value="5">';
										}
										?>
										<label for="gp3a-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3a">
										<?php
										if ($gp3a_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-4" value="4">';
										}
										?>
										<label for="gp3a-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3a">
										<?php
										if ($gp3a_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-3" value="3">';
										}
										?>
										<label for="gp3a-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3a">
										<?php
										if ($gp3a_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-2" value="2">';
										}
										?>
										<label for="gp3a-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3a">
										<?php
										if ($gp3a_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-1" value="1">';
										}
										?>
										<label for="gp3a-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3a">
										<?php
										if ($gp3a_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3a-na" value="0">';
										}
										?>
										<label for="gp3a-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp3a-comment" placeholder="Enter comments here" rows="4"><?php echo $gp3a_comment; ?></textarea>
									<div class="text-danger" id="gp3a_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp3b" class="row">
								<div class="col-sm-3">
									<p>Takes full responsibility both in individual work outcome as well as one's role in a team's shared performance goals and objectives.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3b">
										<?php
										if ($gp3b_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-5" value="5">';
										}
										?>
										<label for="gp3b-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3b">
										<?php
										if ($gp3b_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-4" value="4">';
										}
										?>
										<label for="gp3b-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3b">
										<?php
										if ($gp3b_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-3" value="3">';
										}
										?>
										<label for="gp3b-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3b">
										<?php
										if ($gp3b_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-2" value="2">';
										}
										?>
										<label for="gp3b-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3b">
										<?php
										if ($gp3b_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-1" value="1">';
										}
										?>
										<label for="gp3b-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3b">
										<?php
										if ($gp3b_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3b-na" value="0">';
										}
										?>
										<label for="gp3b-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp3b-comment" placeholder="Enter comments here" rows="4"><?php echo $gp3b_comment; ?></textarea>
									<div class="text-danger" id="gp3b_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp3c" class="row">
								<div class="col-sm-3">
									<p>Acts with an owner's mindset in making decisions, understanding how one's inputs are aligned and part of the larger organization's objectives.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3c">
										<?php
										if ($gp3c_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-5" value="5">';
										}
										?>
										<label for="gp3c-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3c">
										<?php
										if ($gp3c_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-4" value="4">';
										}
										?>
										<label for="gp3c-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3c">
										<?php
										if ($gp3c_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-3" value="3">';
										}
										?>
										<label for="gp3c-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3c">
										<?php
										if ($gp3c_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-2" value="2">';
										}
										?>
										<label for="gp3c-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3c">
										<?php
										if ($gp3c_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-1" value="1">';
										}
										?>
										<label for="gp3c-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp3c">
										<?php
										if ($gp3c_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp3c-na" value="0">';
										}
										?>
										<label for="gp3c-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp3c-comment" placeholder="Enter comments here" rows="4"><?php echo $gp3c_comment; ?></textarea>
									<div class="text-danger" id="gp3c_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- 4. TEAMWORK -->
					<div class="row">
						<div class="col-sm-12">
							<!-- <h4><b>FACTOR</b></h4> -->
							<p><b>4. TEAMWORK</b> - Communicate openly and encourage cooperative efforts across all levels in the company. We must be fully aware that our actions impact all those within the community and we take responsibility for undertaking such actions</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<center>
								<h4>INDICATORS</h4>
							</center>
						</div>
						<div class="col-sm-6">
							<center>
								<h4>RATING</h4>
							</center>
						</div>
						<div class="col-sm-3">
							<center>
								<h4>COMMENTS</h4>
							</center>
						</div>
						<!-- Break -->
						<div class="col-md-12">
							<div id="gp4a" class="row">
								<div class="col-sm-3">
									<p>Relates appropriately to internal and external stakeholders, builds trust and collaborative working relationship putting the team's interest ahead of self.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5a">
										<?php
										if ($gp4a_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-5" value="5">';
										}
										?>
										<label for="gp4a-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4a">
										<?php
										if ($gp4a_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-4" value="4">';
										}
										?>
										<label for="gp4a-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4a">
										<?php
										if ($gp4a_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-3" value="3">';
										}
										?>
										<label for="gp4a-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4a">
										<?php
										if ($gp4a_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-2" value="2">';
										}
										?>
										<label for="gp4a-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4a">
										<?php
										if ($gp4a_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-1" value="1">';
										}
										?>
										<label for="gp4a-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4a">
										<?php
										if ($gp4a_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4a-na" value="0">';
										}
										?>
										<label for="gp4a-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp4a-comment" placeholder="Enter comments here" rows="4"><?php echo $gp4a_comment; ?></textarea>
									<div class="text-danger" id="gp4a_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp4b" class="row">
								<div class="col-sm-3">
									<p>Uses tact and diplomacy to work cohesively with the team encouraging open and timely communication, effective coordination and synergy to promote positive atmosphere even in difficult situations.</p>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp4b">
										<?php
										if ($gp4b_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-5" value="5">';
										}
										?>
										<label for="gp4b-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp4b">
										<?php
										if ($gp4b_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-4" value="4">';
										}
										?>
										<label for="gp4b-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp4b">
										<?php
										if ($gp4b_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-3" value="3">';
										}
										?>
										<label for="gp4b-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp4b">
										<?php
										if ($gp4b_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-2" value="2">';
										}
										?>
										<label for="gp4b-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp4b">
										<?php
										if ($gp4b_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-1" value="1">';
										}
										?>
										<label for="gp4b-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp4b">
										<?php
										if ($gp4b_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4b-na" value="0">';
										}
										?>
										<label for="gp4b-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<br>
									<textarea id="gp4b-comment" placeholder="Enter comments here" rows="4"><?php echo $gp4b_comment; ?></textarea>
									<div class="text-danger" id="gp4b_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp4c" class="row">
								<div class="col-sm-3">
									<p>Builds and fosters commitment, pride and trust within the team by making valuable contribution, and follows through on agreements and deliverables to achieve shared, stretched goals and outcomes.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4c">
										<?php
										if ($gp4c_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-5" value="5">';
										}
										?>
										<input type="checkbox" class="checkbox-recommend" id="gp4c-5" value="5">
										<label for="gp4c-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4c">
										<?php
										if ($gp4c_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-4" value="4">';
										}
										?>
										<label for="gp4c-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4c">
										<?php
										if ($gp4c_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-3" value="3">';
										}
										?>
										<label for="gp4c-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4c">
										<?php
										if ($gp4c_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-2" value="2">';
										}
										?>
										<label for="gp4c-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4c">
										<?php
										if ($gp4c_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-2" value="2">';
										}
										?>
										<label for="gp4c-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp4c">
										<?php
										if ($gp4c_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp4c-na" value="0">';
										}
										?>
										<label for="gp4c-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp4c-comment" placeholder="Enter comments here" rows="4"><?php echo $gp4c_comment; ?></textarea>
									<div class="text-danger" id="gp4c_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- 5. INNOVATION -->
					<div class="row">
						<div class="col-sm-12">
							<!-- <h4><b>FACTOR</b></h4> -->
							<p><b>5. INNOVATION</b> - Commitment of the employee to give satisfaction to clients be developing quality products, proposes improved work methods, suggest ideas to eliminate waste and find new and better ways of doing things to promote work efficiencies and create products that can address customers’ dynamic needs.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<center>
								<h4>INDICATORS</h4>
							</center>
						</div>
						<div class="col-sm-6">
							<center>
								<h4>RATING</h4>
							</center>
						</div>
						<div class="col-sm-3">
							<center>
								<h4>COMMENTS</h4>
							</center>
						</div>
						<!-- Break -->
						<div class="col-md-12">
							<div id="gp5a" class="row">
								<div class="col-sm-3">
									<p>Displays openness to new ideas and solutions to improve current products, services and processes that will enhance customer satisfaction.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5a">
										<?php
										if ($gp5a_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-5" value="5">';
										}
										?>
										<label for="gp5a-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5a">
										<?php
										if ($gp5a_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-4" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-4" value="4">';
										}
										?>
										<label for="gp5a-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5a">
										<?php
										if ($gp5a_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-3" value="3">';
										}
										?>
										<label for="gp5a-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5a">
										<?php
										if ($gp5a_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-2" value="2">';
										}
										?>
										<label for="gp5a-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5a">
										<?php
										if ($gp5a_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-1" value="1">';
										}
										?>
										<label for="gp5a-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5a">
										<?php
										if ($gp5a_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5a-na" value="0">';
										}
										?>
										<label for="gp5a-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp5a-comment" placeholder="Enter comments here" rows="4"><?php echo $gp5a_comment; ?></textarea>
									<div class="text-danger" id="gp5a_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp5b" class="row">
								<div class="col-sm-3">
									<p>Introduces new ideas, improvement tools and effective solutions that enhance current level of execution and company branding.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5b">
										<?php
										if ($gp5b_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-5" value="5">';
										}
										?>
										<label for="gp5b-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5b">
										<?php
										if ($gp5b_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-4" value="4">';
										}
										?>
										<label for="gp5b-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5b">
										<?php
										if ($gp5b_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-3" value="3">';
										}
										?>
										<label for="gp5b-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5b">
										<?php
										if ($gp5b_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-2" value="2">';
										}
										?>
										<label for="gp5b-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5b">
										<?php
										if ($gp5b_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-1" value="1">';
										}
										?>
										<label for="gp5b-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5b">
										<?php
										if ($gp5b_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5b-na" value="0">';
										}
										?>
										<label for="gp5b-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp5b-comment" placeholder="Enter comments here" rows="4"><?php echo $gp5b_comment; ?></textarea>
									<div class="text-danger" id="gp5b_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp5c" class="row">
								<div class="col-sm-3">
									<p>Facilitates creative and divergent ideas and suggestions, and with good judgement, implements viable and cost-effective solutions to the company's evolving challenges.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5c">
										<?php
										if ($gp5c_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-5" value="5">';
										}
										?>
										<label for="gp5c-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5c">
										<?php
										if ($gp5c_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-4" value="4">';
										}
										?>
										<label for="gp5c-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5c">
										<?php
										if ($gp5c_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-3" value="3">';
										}
										?>
										<label for="gp5c-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5c">
										<?php
										if ($gp5c_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-2" value="2">';
										}
										?>
										<label for="gp5c-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5c">
										<?php
										if ($gp5c_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-1" value="1">';
										}
										?>
										<label for="gp5c-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp5c">
										<?php
										if ($gp5c_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp5c-na" value="0">';
										}
										?>
										<label for="gp5c-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp5c-comment" placeholder="Enter comments here" rows="4"><?php echo $gp5c_comment; ?></textarea>
									<div class="text-danger" id="gp5c_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- 6. CUSTOMER FOCUS -->
					<div class="row">
						<div class="col-sm-12">
							<!-- <h4><b>FACTOR</b></h4> -->
							<p><b>6. CUSTOMER FOCUS</b> - The extent in which the employee provides customer with services that are always aimed at training their ultimate satisfaction. One understands the customer (internal and external) needs and requirements, and strive to exceed customer expectation when delivering our services.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<center>
								<h4>INDICATORS</h4>
							</center>
						</div>
						<div class="col-sm-6">
							<center>
								<h4>RATING</h4>
							</center>
						</div>
						<div class="col-sm-3">
							<center>
								<h4>COMMENTS</h4>
							</center>
						</div>
						<!-- Break -->
						<div class="col-md-12">
							<div id="gp6a" class="row">
								<div class="col-sm-3">
									<p>Focuses on providing positive customer experience, value-added products and services resulting in strong competitive advantage and strategic market positioning</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6a">
										<?php
										if ($gp6a_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-5" value="5">';
										}
										?>
										<label for="gp6a-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6a">
										<?php
										if ($gp6a_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-4" value="4">';
										}
										?>
										<label for="gp6a-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6a">
										<?php
										if ($gp6a_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-3" value="3">';
										}
										?>
										<label for="gp6a-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6a">
										<?php
										if ($gp6a_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-2" value="2">';
										}
										?>
										<label for="gp6a-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6a">
										<?php
										if ($gp6a_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-1" value="1">';
										}
										?>
										<label for="gp6a-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6a">
										<?php
										if ($gp6a_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6a-na" value="0">';
										}
										?>
										<label for="gp6a-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp6a-comment" placeholder="Enter comments here" rows="4"><?php echo $gp6a_comment; ?></textarea>
									<div class="text-danger" id="gp6a_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp6b" class="row">
								<div class="col-sm-3">
									<p>Delivers timely responses and provides high level of service standards creating a positive client interaction in meeting their needs and expectations.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6b">
										<?php
										if ($gp6b_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-5" value="5">';
										}
										?>
										<label for="gp6b-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6b">
										<?php
										if ($gp6b_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-4" value="4">';
										}
										?>
										<label for="gp6b-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6b">
										<?php
										if ($gp6b_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-3" value="3">';
										}
										?>
										<label for="gp6b-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6b">
										<?php
										if ($gp6b_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-2" value="2">';
										}
										?>
										<label for="gp6b-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6b">
										<?php
										if ($gp6b_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-1" value="1">';
										}
										?>
										<label for="gp6b-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6b">
										<?php
										if ($gp6b_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6b-na" value="0">';
										}
										?>
										<label for="gp6b-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp6b-comment" placeholder="Enter comments here" rows="4"><?php echo $gp6b_comment; ?></textarea>
									<div class="text-danger" id="gp6b_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp6c" class="row">
								<div class="col-sm-3">
									<p>Maintains customer centric mindset in dealing with internal and external customers in the performance and delivery of commitments.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6c">
										<?php
										if ($gp6c_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-5" value="5">';
										}
										?>
										<label for="gp6c-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6c">
										<?php
										if ($gp6c_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-4" value="4">';
										}
										?>
										<label for="gp6c-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6c">
										<?php
										if ($gp6c_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-3" value="3">';
										}
										?>
										<label for="gp6c-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6c">
										<?php
										if ($gp6c_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-2" value="2">';
										}
										?>
										<label for="gp6c-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6c">
										<?php
										if ($gp6c_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-1" value="1">';
										}
										?>
										<label for="gp6c-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp6c">
										<?php
										if ($gp6c_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp6c-na" value="0">';
										}
										?>
										<label for="gp6c-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp6c-comment" placeholder="Enter comments here" rows="4"><?php echo $gp6c_comment; ?></textarea>
									<div class="text-danger" id="gp6c_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- 7. WORK STANDARDS -->
					<div class="row">
						<div class="col-sm-12">
							<!-- <h4><b>FACTOR</b></h4> -->
							<p><b>7. WORK STANDARDS</b> - The extent to which an employee's work is accurate and comprehensive following established processes and procedures. Required output is thorough and self-check has been performed.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<center>
								<h4>INDICATORS</h4>
							</center>
						</div>
						<div class="col-sm-6">
							<center>
								<h4>RATING</h4>
							</center>
						</div>
						<div class="col-sm-3">
							<center>
								<h4>COMMENTS</h4>
							</center>
						</div>
						<!-- Break -->
						<div class="col-md-12">
							<div id="gp7a" class="row">
								<div class="col-sm-3">
									<p>Able to prioritize high impact activities and deliverables ensuring the most urgent and important are done on time.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7a">
										<?php
										if ($gp7a_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-5" value="5">';
										}
										?>
										<label for="gp7a-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7a">
										<?php
										if ($gp7a_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-4" value="4">';
										}
										?>
										<label for="gp7a-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7a">
										<?php
										if ($gp7a_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-3" value="3">';
										}
										?>
										<label for="gp7a-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7a">
										<?php
										if ($gp7a_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-2" value="2">';
										}
										?>
										<label for="gp7a-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7a">
										<?php
										if ($gp7a_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-1" value="1">';
										}
										?>
										<label for="gp7a-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7a">
										<?php
										if ($gp7a_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7a-na" value="0">';
										}
										?>
										<label for="gp7a-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp7a-comment" placeholder="Enter comments here" rows="4"><?php echo $gp7a_comment; ?></textarea>
									<div class="text-danger" id="gp7a_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div><br>
							<!-- Break -->
							<div id="gp7b" class="row">
								<div class="col-sm-3">
									<p>Performs work with enthusiasm in completing every expected output/deliverables despite challenges and setbacks. Has a mindset of completion.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7b">
										<?php
										if ($gp7b_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-5" value="5">';
										}
										?>
										<label for="gp7b-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7b">
										<?php
										if ($gp7b_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-4" value="4">';
										}
										?>
										<label for="gp7b-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7b">
										<?php
										if ($gp7b_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-3" value="3">';
										}
										?>
										<label for="gp7b-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7b">
										<?php
										if ($gp7b_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-2" value="2">';
										}
										?>
										<label for="gp7b-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7b">
										<?php
										if ($gp7b_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-1" value="1">';
										}
										?>
										<label for="gp7b-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7b">
										<?php
										if ($gp7b_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7b-na" value="0">';
										}
										?>
										<label for="gp7b-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp7b-comment" placeholder="Enter comments here" rows="4"><?php echo $gp7b_comment; ?></textarea>
									<div class="text-danger" id="gp7b_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp7c" class="row">
								<div class="col-sm-3">
									<p>Delivers accurate and complete work with a sense of urgency following established work flows and processes, making logical and practical use of resources.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7c">
										<?php
										if ($gp7c_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-5" value="5">';
										}
										?>
										<label for="gp7c-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7c">
										<?php
										if ($gp7c_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-4" value="4">';
										}
										?>
										<label for="gp7c-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7c">
										<?php
										if ($gp7c_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-3" value="3">';
										}
										?>
										<label for="gp7c-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7c">
										<?php
										if ($gp7c_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-2" value="2">';
										}
										?>
										<label for="gp7c-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7c">
										<?php
										if ($gp7c_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-1" value="1">';
										}
										?>
										<label for="gp7c-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp7c">
										<?php
										if ($gp7c_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp7c-na" value="0">';
										}
										?>
										<label for="gp7c-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp7c-comment" placeholder="Enter comments here" rows="4"><?php echo $gp7c_comment; ?></textarea>
									<div class="text-danger" id="gp7c_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- 8. JOB KNOWLEDGE -->
					<div class="row">
						<div class="col-sm-12">
							<!-- <h4><b>FACTOR</b></h4> -->
							<p><b>8. JOB KNOWLEDGE</b> - The extent to which an employee possesses & demonstrates an understanding of the work implications, instructions, processes, equipment & materials required to perform the job. Employee possesses the practical & technical knowledge required of the job & the ability to "see the bigger picture".</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<center>
								<h4>INDICATORS</h4>
							</center>
						</div>
						<div class="col-sm-6">
							<center>
								<h4>RATING</h4>
							</center>
						</div>
						<div class="col-sm-3">
							<center>
								<h4>COMMENTS</h4>
							</center>
						</div>
						<!-- Break -->
						<div class="col-md-12">
							<div id="gp8a" class="row">
								<div class="col-sm-3">
									<p>Possesses and demonstrates functional and technical knowledge (know -how and know-why) and skills necessary to perform assigned job responsibilities in alignment with various work processes, instructions and procedures.</p>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp8a">
										<?php
										if ($gp8a_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-5" value="5">';
										}
										?>
										<label for="gp8a-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp8a">
										<?php
										if ($gp8a_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-4" value="4">';
										}
										?>
										<label for="gp8a-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp8a">
										<?php
										if ($gp8a_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-3" value="3">';
										}
										?>
										<label for="gp8a-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp8a">
										<?php
										if ($gp8a_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-2" value="2">';
										}
										?>
										<label for="gp8a-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp8a">
										<?php
										if ($gp8a_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-1" value="1">';
										}
										?>
										<label for="gp8a-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp8a">
										<?php
										if ($gp8a_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8a-na" value="0">';
										}
										?>
										<label for="gp8a-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<br><textarea id="gp8a-comment" placeholder="Enter comments here" rows="4"><?php echo $gp8a_comment; ?></textarea>
									<div class="text-danger" id="gp8a_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp8b" class="row">
								<div class="col-sm-3">
									<p>Has the ability to think, plan, see and deliver what is required in the assigned work and willingly shares knowledge and learnings to others. </p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8b">
										<?php
										if ($gp8b_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-5" value="5">';
										}
										?>
										<label for="gp8b-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8b">
										<?php
										if ($gp8b_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-4" value="4">';
										}
										?>
										<label for="gp8b-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8b">
										<?php
										if ($gp8b_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-3" value="3">';
										}
										?>
										<label for="gp8b-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8b">
										<?php
										if ($gp8b_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-2" value="2">';
										}
										?>
										<label for="gp8b-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8b">
										<?php
										if ($gp8b_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-1" value="1">';
										}
										?>
										<label for="gp8b-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8b">
										<?php
										if ($gp8b_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8b-na" value="0">';
										}
										?>
										<label for="gp8b-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp8b-comment" placeholder="Enter comments here" rows="4"><?php echo $gp8b_comment; ?></textarea>
									<div class="text-danger" id="gp8b_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp8c" class="row">
								<div class="col-sm-3">
									<p>Displays ability to learn new things needed to upgrade and advance both technical and professional capability to improve performance, meet changing requirements and readiness to higher responsibilities.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8c">
										<?php
										if ($gp8c_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-5" value="5">';
										}
										?>
										<label for="gp8c-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8c">
										<?php
										if ($gp8c_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-4" value="4">';
										}
										?>
										<label for="gp8c-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8c">
										<?php
										if ($gp8c_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-3" value="3">';
										}
										?>
										<label for="gp8c-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8c">
										<?php
										if ($gp8c_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-2" value="2">';
										}
										?>
										<label for="gp8c-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8c">
										<?php
										if ($gp8c_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-1" value="1">';
										}
										?>
										<label for="gp8c-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp8c">
										<?php
										if ($gp8c_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp8c-na" value="0">';
										}
										?>
										<label for="gp8c-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp8c-comment" placeholder="Enter comments here" rows="4"><?php echo $gp8c_comment; ?></textarea>
									<div class="text-danger" id="gp8c_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- 9. STRATEGIC AGILITY -->
					<div class="row">
						<div class="col-sm-12">
							<!-- <h4><b>FACTOR</b></h4> -->
							<p><b>9. STRATEGIC AGILITY</b> - The ability to continuously adjust and creatively adapt strategic approaches as conditions change while embracing the opportunities with innovation. Assesses risks, its impact and strategies to mitigate adverse outcomes.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<center>
								<h4>INDICATORS</h4>
							</center>
						</div>
						<div class="col-sm-6">
							<center>
								<h4>RATING</h4>
							</center>
						</div>
						<div class="col-sm-3">
							<center>
								<h4>COMMENTS</h4>
							</center>
						</div>
						<!-- Break -->
						<div class="col-md-12">
							<div id="gp9a" class="row">
								<div class="col-sm-3">
									<p>Demonstrates ability and willingness to act swiftly and make progress while taking appropriate actions to resolve challenges and seize opportunities to create value for the company.</p>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp9a">
										<?php
										if ($gp9a_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-5" value="5">';
										}
										?>
										<label for="gp9a-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp9a">
										<?php
										if ($gp9a_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-4" value="4">';
										}
										?>
										<label for="gp9a-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp9a">
										<?php
										if ($gp9a_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-3" value="3">';
										}
										?>
										<label for="gp9a-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp9a">
										<?php
										if ($gp9a_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-2" value="2">';
										}
										?>
										<label for="gp9a-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp9a">
										<?php
										if ($gp9a_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-1" value="1">';
										}
										?>
										<label for="gp9a-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp9a">
										<?php
										if ($gp9a_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9a-na" value="0">';
										}
										?>
										<label for="gp9a-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<br><textarea id="gp9a-comment" placeholder="Enter comments here" rows="4"><?php echo $gp9a_comment; ?></textarea>
									<div class="text-danger" id="gp9a_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp9b" class="row">
								<div class="col-sm-3">
									<p>Anticipates changes in work, strategies, priorities and organizational requirements, and makes necessary adjustments to ensure desired outcome are on track and achieved.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9b">
										<?php
										if ($gp9b_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-5" value="5">';
										}
										?>
										<label for="gp9b-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9b">
										<?php
										if ($gp9b_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-4" value="4">';
										}
										?>
										<label for="gp9b-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9b">
										<?php
										if ($gp9b_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-3" value="3">';
										}
										?>
										<label for="gp9b-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9b">
										<?php
										if ($gp9b_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-2" value="2">';
										}
										?>
										<label for="gp9b-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9b">
										<?php
										if ($gp9b_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-1" value="1">';
										}
										?>
										<label for="gp9b-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9b">
										<?php
										if ($gp9b_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9b-na" value="0">';
										}
										?>
										<label for="gp9b-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp9b-comment" placeholder="Enter comments here" rows="4"><?php echo $gp9b_comment; ?></textarea>
									<div class="text-danger" id="gp9b_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp9c" class="row">
								<div class="col-sm-3">
									<p>Identifies risks, challenges and opportunities that comes with changing business environment and fostering innovation and solutions to stay competitive and relevant.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9c">
										<?php
										if ($gp9c_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-5" value="5">';
										}
										?>
										<label for="gp9c-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9c">
										<?php
										if ($gp9c_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-4" value="4">';
										}
										?>
										<label for="gp9c-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9c">
										<?php
										if ($gp9c_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-3" value="3">';
										}
										?>
										<label for="gp9c-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9c">
										<?php
										if ($gp9c_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-2" value="2">';
										}
										?>
										<label for="gp9c-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9c">
										<?php
										if ($gp9c_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-1" value="1">';
										}
										?>
										<label for="gp9c-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp9c">
										<?php
										if ($gp9c_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp9c-na" value="0">';
										}
										?>
										<label for="gp9c-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp9c-comment" placeholder="Enter comments here" rows="4"><?php echo $gp9c_comment; ?></textarea>
									<div class="text-danger" id="gp9c_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- 10. COMMUNICATION -->
					<div class="row">
						<div class="col-sm-12">
							<!-- <h4><b>FACTOR</b></h4> -->
							<p><b>10. COMMUNICATION</b> - The effective use of language both verbal and non-verbal as a flexible tool to share and collect information, exchange ideas and explore a variety of perspectives, adjust style and content to each unique individual, audience and circumstances.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3">
							<center>
								<h4>INDICATORS</h4>
							</center>
						</div>
						<div class="col-sm-6">
							<center>
								<h4>RATING</h4>
							</center>
						</div>
						<div class="col-sm-3">
							<center>
								<h4>COMMENTS</h4>
							</center>
						</div>
						<!-- Break -->
						<div class="col-md-12">
							<div id="gp10a" class="row">
								<div class="col-sm-3">
									<p>Conveys timely, accurate and complete information to others in the team and organization to ensure proper handling of sensitive information; understanding of what is required; and sound decisions are made.</p>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp10a">
										<?php
										if ($gp10a_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-5" value="5">';
										}
										?>
										<label for="gp10a-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp10a">
										<?php
										if ($gp10a_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-4" value="4">';
										}
										?>
										<label for="gp10a-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp10a">
										<?php
										if ($gp10a_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-3" value="3">';
										}
										?>
										<label for="gp10a-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp10a">
										<?php
										if ($gp10a_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-2" value="2">';
										}
										?>
										<label for="gp10a-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp10a">
										<?php
										if ($gp10a_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-1" value="1">';
										}
										?>
										<label for="gp10a-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br><br>
									<span class="checkbox-gp10a">
										<?php
										if ($gp10a_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10a-na" value="0">';
										}
										?>
										<label for="gp10a-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<br><textarea id="gp10a-comment" placeholder="Enter comments here" rows="4"><?php echo $gp10a_comment; ?></textarea>
									<div class="text-danger" id="gp10a_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp10b" class="row">
								<div class="col-sm-3">
									<p>Expresses one's thoughts, messages and feedback both verbal and non-verbal with confidence, simplicity and propriety to all internal and external stakeholders.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10b">
										<?php
										if ($gp10b_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-5" value="5">';
										}
										?>
										<label for="gp10b-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10b">
										<?php
										if ($gp10b_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-4" value="4">';
										}
										?>
										<label for="gp10b-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10b">
										<?php
										if ($gp10b_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-3" value="3">';
										}
										?>
										<label for="gp10b-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10b">
										<?php
										if ($gp10b_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-2" value="2">';
										}
										?>
										<label for="gp10b-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10b">
										<?php
										if ($gp10b_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-1" value="1">';
										}
										?>
										<label for="gp10b-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10b">
										<?php
										if ($gp10b_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10b-na" value="0">';
										}
										?>
										<label for="gp10b-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp10b-comment" placeholder="Enter comments here" rows="4"><?php echo $gp10b_comment; ?></textarea>
									<div class="text-danger" id="gp10b_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
							<!-- Break -->
							<div id="gp10c" class="row">
								<div class="col-sm-3">
									<p>Displays ability to listen, understand and articulate issues of importance to effectively collaborate shared goals and outcomes.</p>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10c">
										<?php
										if ($gp10c_rate == '5') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-5" value="5">';
										}
										?>
										<label for="gp10c-5">5</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10c">
										<?php
										if ($gp10c_rate == '4') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-4" value="4">';
										}
										?>
										<label for="gp10c-4">4</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10c">
										<?php
										if ($gp10c_rate == '3') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-3" value="3" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-3" value="3">';
										}
										?>
										<label for="gp10c-3">3</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10c">
										<?php
										if ($gp10c_rate == '2') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-2" value="2" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-2" value="2">';
										}
										?>
										<label for="gp10c-2">2</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10c">
										<?php
										if ($gp10c_rate == '1') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-1" value="1">';
										}
										?>
										<label for="gp10c-1">1</label>
									</span>
								</div>
								<div class="col-sm-1">
									<br><br>
									<span class="checkbox-gp10c">
										<?php
										if ($gp10c_rate == '0') {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-na" value="0" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-recommend" id="gp10c-na" value="0">';
										}
										?>
										<label for="gp10c-na">NA</label>
									</span>
								</div>
								<div class="col-sm-3">
									<textarea id="gp10c-comment" placeholder="Enter comments here" rows="4"><?php echo $gp10c_comment; ?></textarea>
									<div class="text-danger" id="gp10c_err" hidden>You have reached the maximum limit for this field.</div>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!-- OVER-ALL PERFORMANCE -->
					<h4><b>OVER-ALL PERFORMANCE </b>- Rate employee's over-all performance in comparison to position, duties and responsibilities</h4>
					<div class="row">
						<div class="col-md-4">
							<h4><b>Key Result Areas</b></h4>
						</div>
						<div class="col-md-1" style="text-align: right;">
							<h4>Average</h4>
						</div>
						<div class="col-md-3">
							<input type="text" id="kra-total" placeholder="0.00%" value="<?php echo $kra_total; ?>" disabled />
						</div>
						<div class="col-md-1" style="text-align: right;">
							<h4>60% =</h4>
						</div>
						<div class="col-md-3">
							<input type="text" id="kra-average" placeholder="0.00%" value="<?php echo $kra_average; ?>" disabled />
						</div>
					</div><br>
					<!-- Break -->
					<div class="row">
						<div class="col-md-4">
							<h4><b>General Performance</b></h4>
						</div>
						<div class="col-md-1" style="text-align: right;">
							<h4>Average</h4>
						</div>
						<div class="col-md-3">
							<input type="text" id="gp-total" placeholder="0.00%" value="<?php echo $gp_total; ?>" disabled />
						</div>
						<div class="col-md-1" style="text-align: right;">
							<h4>40% =</h4>
						</div>
						<div class="col-md-3">
							<input type="text" id="gp-average" placeholder="0.00%" value="<?php echo $gp_average; ?>" disabled />
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-9">
							<h4><b>Individual Over All Performance (OAP) Rating</b></h4>
						</div>
						<div class="col-md-3">
							<input type="text" id="oap-rating" placeholder="0.00%" value="<?php echo $oap_total; ?>" disabled />
						</div>
					</div>
					<hr><br>
					<!-- Break -->
					<div class="OAP rating">
						<!-- Break -->
						<div class="row">
							<div class="col-md-3">
								<h4><b>OAP Rating</b></h4>
							</div>
							<div class="col-md-3">
								<h4><b>Rating</b></h4>
							</div>
							<div class="col-md-4">
								<h4><b>Rating Scale</b></h4>
							</div>
							<div class="col-md-2"></div>
						</div>
						<div id="oap-scale">
							<div class="row">
								<div class="col-md-3">
									<h4>5</h4>
								</div>
								<div class="col-md-3">
									<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5</h4>
								</div>
								<div class="col-md-4">
									<h4>Outstanding</h4>
								</div>
								<div class="col-md-2">
									<span class="checkbox-oap">
										<?php
										if ($oap_scale == '5') {
											echo '<input type="checkbox" class="checkbox-oap-rating" id="rating-5" value="5" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-oap-rating"id="rating-5" value="5">';
										}
										?>
										<label for="rating-5"></label>
									</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<h4>4.0 to 4.9</h4>
								</div>
								<div class="col-md-3">
									<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4</h4>
								</div>
								<div class="col-md-4">
									<h4>Exceeds Expectation</h4>
								</div>
								<div class="col-md-2">
									<span class="checkbox-oap">
										<?php
										if ($oap_scale == '4') {
											echo '<input type="checkbox" class="checkbox-oap-rating" id="rating-4" value="4" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-oap-rating" id="rating-4" value="4">';
										}
										?>
										<label for="rating-4"></label>
									</span>
								</div>

							</div>
							<div class="row">
								<div class="col-md-3">
									<h4>3.0 to 3.9</h4>
								</div>
								<div class="col-md-3">
									<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3</h4>
								</div>
								<div class="col-md-4">
									<h4>Meets Expectation</h4>
								</div>
								<div class="col-md-2">
									<span class="checkbox-oap">
										<?php
										if ($oap_scale == '3') {
											echo '<input type="checkbox" id="rating-3" class="checkbox-oap-rating" value="3" checked>';
										} else {
											echo '<input type="checkbox" id="rating-3" class="checkbox-oap-rating" value="3">';
										}
										?>
										<label for="rating-3"></label>
									</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<h4>2.0 to 2.9</h4>
								</div>
								<div class="col-md-3">
									<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2</h4>
								</div>
								<div class="col-md-4">
									<h4>Improvement Needed</h4>
								</div>
								<div class="col-md-2">
									<span class="checkbox-oap">
										<?php
										if ($oap_scale == '2') {
											echo '<input type="checkbox" id="rating-2" class="checkbox-oap-rating" value="2" checked>';
										} else {
											echo '<input type="checkbox" id="rating-2" class="checkbox-oap-rating" value="2">';
										}
										?>
										<label for="rating-2"></label>
									</span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<h4>1.0 to 1.9</h4>
								</div>
								<div class="col-md-3">
									<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1</h4>
								</div>
								<div class="col-md-4">
									<h4>Fall Short of Expectations</h4>
								</div>
								<div class="col-md-2">
									<span class="checkbox-oap">
										<?php
										if ($oap_scale == '1') {
											echo '<input type="checkbox" class="checkbox-oap-rating" id="rating-1" value="1" checked>';
										} else {
											echo '<input type="checkbox" class="checkbox-oap-rating" id="rating-1" value="1">';
										}
										?>
										<label for="rating-1"></label>
									</span>
								</div>
							</div>
						</div>
					</div>
					<!-- ACCOMPLISHMENTS -->
					<div class="Accomplishments">
						<div class="row">
							<div class="col-md-12">
								<h4><b>III. Accomplishments or new abilities demonstrated affecting overall performance rating given.</b><br>(Please provide supporting documents)</h4>
							</div>
							<div class="col-sm-12">
								<textarea id="accomplishments" placeholder="Enter details here" rows="4"><?php echo $accomplishment; ?></textarea>
							</div>
						</div>
					</div><br>
					<!-- AREAS FOR DEVELOPMENT -->
					<div class="development">
						<div id="prof-dev" class="row">
							<div class="col-md-12">
								<h4><b>IV. Areas for Development / Improvement. Complete the following sections as applicable:</b></h4>
								<div class="col-md-12">
									<h4><b>IV A. Recommendations for professional development [seminars, training, OJT, etc.]: </b><b style="color: red;">*</b><br><i>Please check the training program/s which will help address the employee's areas of development</i></h4>
								</div>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-6">
								<?php
								$data = explode(',', $prof_dev);
								$result = in_array('Business & Organizational Development', $data);
								if ($result) {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-1" value="Business & Organizational Development" checked>';
								} else {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-1" value="Business & Organizational Development">';
								}
								?>
								<label for="area-1">Business & Organizational Development</label>
							</div>
							<div class="col-md-5">
								<?php
								$data = explode(',', $prof_dev);
								$result = in_array('Business Communication', $data);
								if ($result) {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-2" value="Business Communication" checked>';
								} else {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-2" value="Business Communication">';
								}
								?>
								<label for="area-2">Business Communication</label>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-6">
								<?php
								$data = explode(',', $prof_dev);
								$result = in_array('Operational Excellence (Technical)', $data);
								if ($result) {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-3" value="Operational Excellence (Technical)" checked>';
								} else {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-3" value="Operational Excellence (Technical)">';
								}
								?>
								<label for="area-3">Operational Excellence (Technical)</label>
							</div>
							<div class="col-md-5">
								<?php
								$data = explode(',', $prof_dev);
								$result = in_array('Presentation Skills', $data);
								if ($result) {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-4" value="Presentation Skills" checked>';
								} else {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-4" value="Presentation Skills">';
								}
								?>
								<label for="area-4">Presentation Skills</label>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-6">
								<?php
								$data = explode(',', $prof_dev);
								$result = in_array('Leadership Skills Training', $data);
								if ($result) {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-5" value="Leadership Skills Training" checked>';
								} else {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-5" value="Leadership Skills Training">';
								}
								?>
								<label for="area-5">Leadership Skills Training</label>
							</div>
							<div class="col-md-5">
								<?php
								$data = explode(',', $prof_dev);
								$result = in_array('Customer Service', $data);
								if ($result) {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-6" value="Customer Service" checked>';
								} else {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-6" value="Customer Service">';
								}
								?>
								<label for="area-6">Customer Service</label>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-6">
								<?php
								$data = explode(',', $prof_dev);
								$result = in_array('Supervisory Skills Training', $data);
								if ($result) {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-7" value="Supervisory Skills Training" checked>';
								} else {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-7" value="Supervisory Skills Training">';
								}
								?>
								<label for="area-7">Supervisory Skills Training</label>
							</div>
							<div class="col-md-5">
								<?php
								$data = explode(',', $prof_dev);
								$result = in_array('Personality Development', $data);
								if ($result) {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-8" value="Personality Development" checked>';
								} else {
									echo '<input type="checkbox" class="checkbox-recommend" id="area-8" value="Personality Development">';
								}
								?>
								<label for="area-8">Personality Development</label>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-4"><textarea id="prof-others" placeholder="Others Please Specify" rows="2" disabled><?php echo $prof_others; ?></textarea></div>
						</div><br>
						<!-- Performance Improvement Plan -->
						<div class="col-md-12">
							<h4><b>IV B. Performance Improvement Plan</b> (Please fill out for OAP below 3)</h4>
							<div class="row">
								<div class="col-md-4">Performance Improvement Needed</div>
								<div class="col-md-3">Agreed Tasks</div>
								<div class="col-md-3">Tools/Support Needed</div>
								<div class="col-md-2">Timeline</div>
							</div>
							<div class="row">
								<div class="col-md-4"><input type="text" id="pin-1" value="<?php echo $pin1; ?>" disabled></div>
								<div class="col-md-3"><input type="text" id="at-1" value="<?php echo $at1; ?>" disabled></div>
								<div class="col-md-3"><input type="text" id="sn-1" value="<?php echo $sn1; ?>" disabled></div>
								<div class="col-md-2"><input type="text" id="timeline-1" value="<?php echo $time1; ?>" disabled></div>
							</div>
							<div class="row">
								<div class="col-md-4"><input type="text" id="pin-2" value="<?php echo $pin2; ?>" disabled></div>
								<div class="col-md-3"><input type="text" id="at-2" value="<?php echo $at2; ?>" disabled></div>
								<div class="col-md-3"><input type="text" id="sn-2" value="<?php echo $sn2; ?>" disabled></div>
								<div class="col-md-2"><input type="text" id="timeline-2" value="<?php echo $time2; ?>" disabled></div>
							</div>
							<div class="row">
								<div class="col-md-4"><input type="text" id="pin-3" value="<?php echo $pin3; ?>" disabled></div>
								<div class="col-md-3"><input type="text" id="at-3" value="<?php echo $at3; ?>" disabled></div>
								<div class="col-md-3"><input type="text" id="sn-3" value="<?php echo $sn3; ?>" disabled></div>
								<div class="col-md-2"><input type="text" id="timeline-3" value="<?php echo $time3; ?>" disabled></div>
							</div>
						</div>
					</div><br>
					<!-- EMPLOYEE'S COMMENTS -->
					<div class="comments">
						<div class="col-md-12">
							<h4><b>V. EMPLOYEE'S COMMENTS:</b></h4>
						</div>
						<div class="col-md-12"><textarea id="emp-comments" placeholder="Enter comments here" rows="2" disabled><?php echo $emp_comment; ?></textarea></div>
					</div><br>
					<!-- HR REFERENCE -->
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<h4><b>RECOMMENDATION OF THE FINAL APPROVER </b><b style="color: red;">*</b></h4>
								<center>
									<h4><b>Performance Recommendation</b></h4>
								</center>
							</div>
						</div>
						<div class="row checkbox-recommend">
							<div class="col-md-1"></div>
							<div class="col-md-5 checkbox-hr">
								<?php
								$data = explode(',', $recommendation);
								$result = in_array('No Change', $data);
								if ($result) {
									echo '<input type="checkbox" id="recommend-0" value="No Change" checked>';
								} else {
									echo '<input type="checkbox" id="recommend-0" value="No Change">';
								}
								?>
								<label for="recommend-0">No Change</label>
							</div>
							<div class="col-md-5">
								<?php
								$data = explode(',', $recommendation);
								$result = in_array('For Regularization', $data);
								if ($result) {
									echo '<input type="checkbox" id="recommend-1" value="For Regularization" checked>';
								} else {
									echo '<input type="checkbox" id="recommend-1" value="For Regularization">';
								}
								?>
								<label for="recommend-1">For Regularization</label>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-1"></div>
							<div class="col-md-5 checkbox-hr">
								<?php
								$data = explode(',', $recommendation);
								$result = in_array('End of Employment', $data);
								if ($result) {
									echo '<input type="checkbox" id="recommend-2" value="End of Employment" checked>';
								} else {
									echo '<input type="checkbox" id="recommend-2" value="End of Employment">';
								}
								?>
								<label for="recommend-2">End of Employment</label>
							</div>

							<div class="col-md-5">
								<?php
								$data = explode(',', $recommendation);
								$result = in_array('For Promotion', $data);
								if ($result) {
									echo '<input type="checkbox" id="recommend-3" value="For Promotion" checked>';
								} else {
									echo '<input type="checkbox" id="recommend-3" value="For Promotion">';
								}
								?>
								<label for="recommend-3">For Promotion</label>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-1"></div>
							<div class="col-md-5 checkbox-hr">
								<?php
								$data = explode(',', $recommendation);
								$result = in_array('Transfer Department / Unit / Project', $data);
								if ($result) {
									echo '<input type="checkbox" id="recommend-4" value="Transfer Department / Unit / Project" checked>';
								} else {
									echo '<input type="checkbox" id="recommend-4" value="Transfer Department / Unit / Project">';
								}
								?>
								<label for="recommend-4">Transfer Department / Unit / Project</label>
							</div>
							<div class="col-md-6">
								<?php
								$data = explode(',', $recommendation);
								$result = in_array('For Salary Adjustment', $data);
								if ($result) {
									echo '<input class="hr-recommend" type="checkbox" id="recommend-5" value="For Salary Adjustment" checked>';
								} else {
									echo '<input type="checkbox" id="recommend-5" value="For Salary Adjustment">';
								}
								?>
								<label for="recommend-5">For Salary Adjustment</label>
							</div>
							<div class="col-md-1"></div>
							<div class="col-md-5 checkbox-hr">
								<?php
								$data = explode(',', $recommendation);
								$result = in_array('Mid-Year Assessment', $data);
								if ($result) {
									echo '<input type="checkbox" id="recommend-6" value="Mid-Year Assessment" checked>';
								} else {
									echo '<input type="checkbox" id="recommend-6" value="Mid-Year Assessment">';
								}
								?>
								<label for="recommend-6">Mid-Year/Annual Assessment</label>
							</div>
							<div class="col-md-5"></div>
							<div class="col-md-1"></div>
							<div class="col-md-1"></div>

							<div class="col-md-5">
								<textarea id="gross-pay" placeholder="Please specify monthly gross pay" rows="2"></textarea>
							</div>
							<div class="col-md-5">
								<textarea id="gross-remarks" placeholder="Please input remarks here" rows="2"></textarea>
							</div>
						</div>
					</div>
					<br>
					<div class="row main-btn">
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;
						<?php
						if ($par_status == 4) {
							echo '<div class="col-md-3">
													<a id="btnPrintApproved" class="button fit" style="background-color: #1191EA;"><i class="fa fa-print"></i><b style="color: whitesmoke;"> PRINT PAR</b></a>
													</div>';
						} else {
							echo '<div class="col-md-3">
													<a id="btnSubmit" class="button fit"><i class="fa fa-check-circle"></i><b style="color: whitesmoke;"> SUBMIT & APPROVE</b></a>
													<a id="btnPrint" class="button fit" style="background-color: #1191EA; display: none"><i class="fa fa-print"></i><b style="color: whitesmoke;"> PRINT PAR</b></a>
												  </div>
												  <div class="col-md-3">
													<a id="btnDraft" class="button fit" style="background-color: #1191EA;"><i class="fa fa-save"></i><b style="color: whitesmoke;"> SAVE AS DRAFT</b></a>
												  </div>';
						}
						?>
					</div><br>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer id="footer">
		<div class="copyright">
			&copy; Innogroup of Companies. All rights reserved 2021.
		</div>
	</footer>
	<!-- Scroll to top -->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
	</a>
	<!-- Scripts -->
	<script src="../../assets/js/jquery.min.js"></script>
	<script src="../../assets/js/jquery.scrollex.min.js"></script>
	<script src="../../assets/js/skel.min.js"></script>
	<script src="../../assets/js/util.js"></script>
	<script src="../../assets/js/main.js"></script>
	<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="../../assets/datetimepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="../../assets/js/jquery.toast.js"></script>
	<script src="../../assets/toastr/toastr.js"></script>
	<?php include 'js/draft_eval_par-js.php'; ?>


</body>

</html>