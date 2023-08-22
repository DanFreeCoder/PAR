<!DOCTYPE HTML>
<html lang="eng">

<head>
    <title>IGC Online-PAR</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/css/main.css" />
    <link rel="stylesheet" href="../../assets/datetimepicker/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../assets/toastr/toastr.css">
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
</head>
<style>
    .modal {
        width: 800px;
        height: 800px;
        left: 30%;
        top: 40%;
        margin-left: -150px;
        margin-top: -150px;
    }
</style>

<body id="page-top" class="subpage">
    <!-- Page HEADER -->
    <?php
    include '../../includes/header.php';
    //get user details
    $id = $_SESSION['id'];
    $get = $user->get_user_by_id();
    while ($row = $get->fetch(PDO::FETCH_ASSOC)) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $fullname = $row['fullname'];
        $position = $row['position'];
        $project = $row['project'];
        $email = $row['email'];
        $username = $row['username'];
        if ($row['date_hire'] != '' || $row['date_hire'] != null) {
            $date_hire = date_format(new DateTime($row['date_hire']), 'F j, Y');
        } else {
            $date_hire = '';
        }
    }
    ?>
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
                                <input type="text" id="name" placeholder="Employee's Name" value="<?php echo $fullname; ?>" disabled />
                                <input type="text" id="id" style="color: white; display: none;" value="<?php echo $_SESSION['id']; ?>" />
                            </div>
                            <div class="3u 12u$(xsmall)">
                                <input type="text" id="position" placeholder="Position Title" value="<?php echo $position; ?>" />
                            </div>
                            <div class="3u 12u$(xsmall)">
                                <select id="department">
                                    <?php
                                    if (!$_SESSION['dept']) {
                                        $sel = $rater->view_department();
                                        while ($row = $sel->fetch(PDO::FETCH_ASSOC)) {
                                            echo '<option value=' . $row['id'] . '>' . $row['department'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="' . $_SESSION['dept'] . '">' . $_SESSION['department'] . '</option>';
                                    }
                                    ?>
                                </select>
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
                            <div class="3u$ 12u$(xsmall)">
                                <div class="select-wrapper">
                                    <select id="status">
                                        <option value="0">-Select Employment Status-</option>
                                        <option value="1">Regular</option>
                                        <option value="2">Probationary</option>
                                        <option value="3">Project Based</option>
                                        <option value="4">Casual</option>
                                        <option value="5">Trainee</option>
                                        <option value="6">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="3u$ 12u$(xsmall)">
                                <div class="select-wrapper">
                                    <select id="assessment">
                                        <option value="0">-Performance Assessment-</option>
                                        <option value="1">Annual</option>
                                        <option value="7">Mid Year</option>
                                        <option value="2">5th Month</option>
                                        <option value="3">3rd Month</option>
                                        <option value="5">Training</option>
                                        <option value="6">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="3u 12u$(xsmall)" id="from">
                                <input type="text" id="review-from" class="datepicker" placeholder="Review Period From">
                            </div>
                            <div class="3u 12u$(xsmall)" id="years">
                                <select id="year" style="color: black;" class="form-group">
                                    <?php
                                    $start_year = 2022;
                                    $current_year = date('Y') * 1;
                                    do {
                                        echo '<option value="' . $start_year . '" selected>' . $start_year . '</option>';
                                        $start_year++;
                                    } while ($current_year >= $start_year);
                                    ?>
                                </select>
                            </div>
                            <div class="3u 12u$(xsmall)" id="to">
                                <input type="text" id="review-to" class="datepicker" placeholder="Review Period To" />
                            </div>
                            <!-- Break -->
                            <div class="3u 12u$(xsmall)">
                                <input type="text" id="date-hire" class="datepicker" placeholder="Date Hired" value="<?php echo $date_hire; ?>" disabled />
                            </div>
                            <div class="3u$ 12u$(xsmall)">
                                <div class="select-wrapper">
                                    <select id="rater">
                                        <option value="0" selected disabled>- First Approver -</option>
                                        <option value="2">Immediate Superior</option>
                                        <option value="3">Manager</option>
                                        <option value="4">Sr. Manager</option>
                                        <!-- <option value="5">HR Administrator</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="3u$ 12u$(xsmall)">
                                <div class="select-wrapper">
                                    <select id="assignee">
                                        <option value="0" selected disabled>- Select Rater -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="3u 12u$(xsmall)">
                                <input type="text" id="emp_email" placeholder="IGC Email" value="<?php echo $email; ?>" />
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
                    </div>
                    <!-- A -->
                    <h4><b>A.</b></h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <textarea name="message" id="kra1" placeholder="KRA here" rows="4"></textarea>
                            <div class="text-danger" id="kra1_err" hidden>You have reached the maximum limit for this field.</div>
                        </div>
                        <div id="kra1-checkbox" class="row kra-checkbox">
                            <div class="col-sm-2">
                                <br><br>
                                <span class="checkbox-kra1">
                                    <input type="checkbox" id="kra1-5" value="5" name="kra1-5">
                                    <label for="kra1-5">5</label>
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <br><br>
                                <span class="checkbox-kra1">
                                    <input type="checkbox" id="kra1-4" value="4" name="kra1-4">
                                    <label for="kra1-4">4</label>
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <br><br>
                                <span class="checkbox-kra1">
                                    <input type="checkbox" id="kra1-3" value="3" name="kra1-3">
                                    <label for="kra1-3">3</label>
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <b>RATING</b><br><br>
                                <span class="checkbox-kra1">
                                    <input type="checkbox" id="kra1-2" value="2">
                                    <label for="kra1-2">2</label>
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <br><br>
                                <span class="checkbox-kra1">
                                    <input type="checkbox" id="kra1-1" value="1" name="kra1-1">
                                    <label for="kra1-1">1</label>
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <br><br>
                                <span class="checkbox-kra1">
                                    <input type="checkbox" id="kra1-na" value="0" name="kra1-na">
                                    <label for="kra1-na">NA</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <textarea name="message" id="kpi1" placeholder="Enter KPI's here" rows="4"></textarea>
                            <div class="text-danger" id="kpi1_err" hidden>You have reached the maximum limit for this field.</div>
                        </div>
                        <div class="col-sm-6">
                            COMMENTS
                            <textarea name="message" id="comments1" placeholder="Enter comments here" rows="3"></textarea>
                            <p id="comments1_msg" class="text-danger" hidden>Comments must not be empty.</p>
                            <div class="text-danger" id="comment_1" hidden>You have reached the maximum limit for this field.</div>
                            <div class="text-danger err_msg"></div>
                        </div>
                    </div>
                    <!-- B -->
                    <h4><b>B.</b></h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <textarea name="message" id="kra2" placeholder="KRA here" rows="4"></textarea>
                            <div class="text-danger" id="kra2_err" hidden>You have reached the maximum limit for this field.</div>
                        </div>
                        <div id="kra2-checkbox" class="row kra-checkbox">
                            <div class="col-sm-2">
                                <br><br>
                                <span class="checkbox-kra2">
                                    <input type="checkbox" id="kra2-5" name="kra2-5" value="5">
                                    <label for="kra2-5">5</label>
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <br><br>
                                <span class="checkbox-kra2">
                                    <input type="checkbox" id="kra2-4" name="kra2-4" value="4">
                                    <label for="kra2-4">4</label>
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <br><br>
                                <span class="checkbox-kra2">
                                    <input type="checkbox" id="kra2-3" name="kra2-3" value="3">
                                    <label for="kra2-3">3</label>
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <b>RATING</b><br><br>
                                <span class="checkbox-kra2">
                                    <input type="checkbox" id="kra2-2" name="kra2-2" value="2">
                                    <label for="kra2-2">2</label>
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <br><br>
                                <span class="checkbox-kra2">
                                    <input type="checkbox" id="kra2-1" name="kra2-1" value="1">
                                    <label for="kra2-1">1</label>
                                </span>
                            </div>
                            <div class="col-sm-2">
                                <br><br>
                                <span class="checkbox-kra2">
                                    <input type="checkbox" id="kra2-na" name="kra2-na" value="0">
                                    <label for="kra2-na">NA</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <textarea name="message" id="kpi2" placeholder="Enter KPI's here" rows="4"></textarea>
                            <div class="text-danger" id="kpi2_err" hidden>You have reached the maximum limit for this field.</div>
                        </div>
                        <div class="col-sm-6">
                            COMMENTS
                            <textarea name="message" id="comments2" placeholder="Enter comments here" rows="3"></textarea>
                            <p id="comments2_msg" class="text-danger" hidden>Comments must not be empty.</p>
                            <div class="text-danger" id="comment_2" hidden>You have reached the maximum limit for this field.</div>
                            <div class="text-danger err_msg"></div>
                        </div>
                    </div>
                    <!-- C -->
                    <div class="row">
                        <h4><b>C.</b></h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <textarea name="message" id="kra3" placeholder="KRA here" rows="4"></textarea>
                                <div class="text-danger" id="kra3_err" hidden>You have reached the maximum limit for this field.</div>
                            </div>
                            <div id="kra3-checkbox" class="row kra-checkbox">
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra3">
                                        <input type="checkbox" id="kra3-5" name="kra3-5" value="5">
                                        <label for="kra3-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra3">
                                        <input type="checkbox" id="kra3-4" name="kra3-4" value="4">
                                        <label for="kra3-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra3">
                                        <input type="checkbox" id="kra3-3" name="kra3-3" value="3">
                                        <label for="kra3-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <b>RATING</b><br><br>
                                    <span class="checkbox-kra3">
                                        <input type="checkbox" id="kra3-2" name="kra3-2" value="2">
                                        <label for="kra3-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra3">
                                        <input type="checkbox" id="kra3-1" name="kra3-1" value="1">
                                        <label for="kra3-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra3">
                                        <input type="checkbox" id="kra3-na" name="kra3-na" value="0">
                                        <label for="kra3-na">NA</label>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <textarea name="message" id="kpi3" placeholder="Enter KPI's here" rows="4"></textarea>
                                <div class="text-danger" id="kpi3_err" hidden>You have reached the maximum limit for this field.</div>
                            </div>
                            <div class="col-sm-6">
                                COMMENTS
                                <textarea name="message" id="comments3" placeholder="Enter comments here" rows="3"></textarea>
                                <p id="comments3_msg" class="text-danger" hidden>Comments must not be empty.</p>
                                <div class="text-danger" id="comment_3" hidden>You have reached the maximum limit for this field.</div>
                                <div class="text-danger err_msg"></div>
                            </div>
                        </div>
                    </div><br>
                    <div class="row btnRow1">
                        <div class="col-lg-3">
                            <a id="btnAdd1" class="button fit" style="background-color: #1191EA;"><i class="fa fa-plus-circle"></i><b style="color: whitesmoke;"> ADD KRA & KPI FIELDS</b></a>
                        </div>
                    </div>
                    <!-- D HIDDEN DIV FOR ADDITIONAL INPUTS-->
                    <div class="row kra-kpi4">
                        <h4><b>D.</b></h4><br>
                        <div class="row">
                            <div class="col-sm-6">
                                <textarea name="message" id="kra4" placeholder="KRA here" rows="4"></textarea>
                                <div class="text-danger" id="kra4_err" hidden>You have reached the maximum limit for this field.</div>
                            </div>
                            <div id="kra4-checkbox" class="row kra-checkbox">
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra4">
                                        <input type="checkbox" id="kra4-5" name="kra4-5" value="5">
                                        <label for="kra4-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra4">
                                        <input type="checkbox" id="kra4-4" name="kra4-4" value="4">
                                        <label for="kra4-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra4">
                                        <input type="checkbox" id="kra4-3" name="kra4-3" value="3">
                                        <label for="kra4-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <b>RATING</b><br><br>
                                    <span class="checkbox-kra4">
                                        <input type="checkbox" id="kra4-2" name="kra4-2" value="2">
                                        <label for="kra4-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra4">
                                        <input type="checkbox" id="kra4-1" name="kra4-1" value="1">
                                        <label for="kra4-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra4">
                                        <input type="checkbox" id="kra4-na" name="kra4-na" value="0">
                                        <label for="kra4-na">NA</label>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <textarea name="message" id="kpi4" placeholder="Enter KPI's here" rows="4"></textarea>
                                <div class="text-danger" id="kpi4_err" hidden>You have reached the maximum limit for this field.</div>
                            </div>
                            <div class="col-sm-6">
                                COMMENTS
                                <textarea name="message" id="comments4" placeholder="Enter comments here" rows="3"></textarea>
                                <p id="comments4_msg" class="text-danger" hidden>Comments must not be empty.</p>
                                <div class="text-danger" id="comment_4" hidden>You have reached the maximum limit for this field.</div>
                                <div class="text-danger err_msg"></div>
                            </div>
                        </div>
                    </div><br>
                    <div class="row btnRow2">
                        <div class="col-lg-3">
                            <a id="btnAdd2" class="button fit" style="background-color: #1191EA;"><i class="fa fa-plus-circle"></i><b style="color: whitesmoke;"> ADD KRA & KPI FIELDS</b></a>
                        </div>
                    </div>
                    <!-- E -->
                    <div class="row kra-kpi5">
                        <h4><b>E.</b></h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <textarea name="message" id="kra5" placeholder="KRA here" rows="4"></textarea>
                                <div class="text-danger" id="kra5_err" hidden>You have reached the maximum limit for this field.</div>
                            </div>
                            <div id="kra5-checkbox" class="row kra-checkbox">
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra5">
                                        <input type="checkbox" id="kra5-5" name="kra5-5" value="5">
                                        <label for="kra5-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra5">
                                        <input type="checkbox" id="kra5-4" name="kra5-4" value="4">
                                        <label for="kra5-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra5">
                                        <input type="checkbox" id="kra5-3" name="kra5-3" value="3">
                                        <label for="kra5-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <b>RATING</b><br><br>
                                    <span class="checkbox-kra5">
                                        <input type="checkbox" id="kra5-2" name="kra5-2" value="2">
                                        <label for="kra5-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra5">
                                        <input type="checkbox" id="kra5-1" name="kra5-1" value="1">
                                        <label for="kra5-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra5">
                                        <input type="checkbox" id="kra5-na" name="kra5-na" value="0">
                                        <label for="kra5-na">NA</label>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <textarea name="message" id="kpi5" placeholder="Enter KPI's here" rows="4"></textarea>
                                <div class="text-danger" id="kpi5_err" hidden>You have reached the maximum limit for this field.</div>
                            </div>
                            <div class="col-sm-6">
                                COMMENTS
                                <textarea name="message" id="comments5" placeholder="Enter comments here" rows="3"></textarea>
                                <p id="comments5_msg" class="text-danger" hidden>Comments must not be empty.</p>
                                <div class="text-danger" id="comment_5" hidden>You have reached the maximum limit for this field.</div>
                                <div class="text-danger err_msg"></div>
                            </div>
                        </div>
                    </div><br>
                    <div class="row btnRow3">
                        <div class="col-lg-3">
                            <a id="btnAdd3" class="button fit" style="background-color: #1191EA;"><i class="fa fa-plus-circle"></i><b style="color: whitesmoke;"> ADD KRA & KPI FIELDS</b></a>
                        </div>
                    </div>
                    <!-- F -->
                    <div class="row kra-kpi6">
                        <h4><b>F.</b></h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <textarea name="message" id="kra6" placeholder="KRA here" rows="4"></textarea>
                                <div class="text-danger" id="kra6_err" hidden>You have reached the maximum limit for this field.</div>
                            </div>
                            <div id="kra6-checkbox" class="row kra-checkbox">
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra6">
                                        <input type="checkbox" id="kra6-5" name="kra6-5" value="5">
                                        <label for="kra6-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra6">
                                        <input type="checkbox" id="kra6-4" name="kra6-4" value="4">
                                        <label for="kra6-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra6">
                                        <input type="checkbox" id="kra6-3" name="kra6-3" value="3">
                                        <label for="kra6-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <b>RATING</b><br><br>
                                    <span class="checkbox-kra6">
                                        <input type="checkbox" id="kra6-2" name="kra6-2" value="2">
                                        <label for="kra6-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra6">
                                        <input type="checkbox" id="kra6-1" name="kra6-1" value="1">
                                        <label for="kra6-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-2">
                                    <br><br>
                                    <span class="checkbox-kra6">
                                        <input type="checkbox" id="kra6-na" name="kra6-na" value="0">
                                        <label for="kra6-na">NA</label>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <textarea name="message" id="kpi6" placeholder="Enter KPI's here" rows="4"></textarea>
                                <div class="text-danger" id="kpi6_err" hidden>You have reached the maximum limit for this field.</div>
                            </div>
                            <div class="col-sm-6">
                                COMMENTS
                                <textarea name="message" id="comments6" placeholder="Enter comments here" rows="3"></textarea>
                                <p id="comments6_msg" class="text-danger" hidden>Comments must not be empty.</p>
                                <div class="text-danger" id="comment_6" hidden>You have reached the maximum limit for this field.</div>
                                <div class="text-danger err_msg"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Break -->
                    <h4><b>II. GENERAL PERFORMANCE FACTORS AND BEHAVIORAL INDICATORS</b></h4>
                    <p>Assess the employee’s know-how and know-why in relation to the Company’s six (6) CORE VALUES and four (4) Competencies. For each Factor below, there are three (3) actionable and observable indicators, assess the employee based on the definition and specified indicators using the rating scale of 1 to 5. For the OVERALL PERFORMANCE (OAP), determine the Average rating for Part I multiply it by 60%; for General Performance, get the Average rating multiply it by 40%. Place a check mark on the box corresponding to the Overall Performance Rating (OAP).</p><br>
                    <!-- 1. BIAS FOR RESULT -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>FACTOR</b></h4>
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
                                        <input type="checkbox" id="gp1a-5" value="5">
                                        <label for="gp1a-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1a">
                                        <input type="checkbox" id="gp1a-4" value="4">
                                        <label for="gp1a-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1a">
                                        <input type="checkbox" id="gp1a-3" value="3">
                                        <label for="gp1a-3">3 </label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1a">
                                        <input type="checkbox" id="gp1a-2" value="2">
                                        <label for="gp1a-2">2 </label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1a">
                                        <input type="checkbox" id="gp1a-1" value="1">
                                        <label for="gp1a-1">1 </label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1a">
                                        <input type="checkbox" id="gp1a-na" value="0">
                                        <label for="gp1a-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp1a-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp1b-5" value="5">
                                        <label for="gp1b-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1b">
                                        <input type="checkbox" id="gp1b-4" value="4">
                                        <label for="gp1b-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1b">
                                        <input type="checkbox" id="gp1b-3" value="3">
                                        <label for="gp1b-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1b">
                                        <input type="checkbox" id="gp1b-2" value="2">
                                        <label for="gp1b-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1b">
                                        <input type="checkbox" id="gp1b-1" value="1">
                                        <label for="gp1b-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1b">
                                        <input type="checkbox" id="gp1b-na" value="0">
                                        <label for="gp1b-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp1b-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp1c-5" value="5">
                                        <label for="gp1c-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1c">
                                        <input type="checkbox" id="gp1c-4" value="4">
                                        <label for="gp1c-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1c">
                                        <input type="checkbox" id="gp1c-3" value="3">
                                        <label for="gp1c-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1c">
                                        <input type="checkbox" id="gp1c-2" value="2">
                                        <label for="gp1c-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1c">
                                        <input type="checkbox" id="gp1c-1" value="1">
                                        <label for="gp1c-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp1c">
                                        <input type="checkbox" id="gp1c-na" value="0">
                                        <label for="gp1c-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp1c-comment" placeholder="Enter comments here" rows="4"></textarea>
                                    <div class="text-danger" id="gp1c_err" hidden>You have reached the maximum limit for this field.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- 2. INTEGRITY -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>FACTOR</b></h4>
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
                                        <input type="checkbox" id="gp2a-5" value="5">
                                        <label for="gp2a-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2a">
                                        <input type="checkbox" id="gp2a-4" value="4">
                                        <label for="gp2a-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2a">
                                        <input type="checkbox" id="gp2a-3" value="3">
                                        <label for="gp2a-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2a">
                                        <input type="checkbox" id="gp2a-2" value="2">
                                        <label for="gp2a-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2a">
                                        <input type="checkbox" id="gp2a-1" value="1">
                                        <label for="gp2a-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2a">
                                        <input type="checkbox" id="gp2a-na" value="0">
                                        <label for="gp2a-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp2a-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp2b-5" value="5">
                                        <label for="gp2b-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2b">
                                        <input type="checkbox" id="gp2b-4" value="4">
                                        <label for="gp2b-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2b">
                                        <input type="checkbox" id="gp2b-3" value="3">
                                        <label for="gp2b-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2b">
                                        <input type="checkbox" id="gp2b-2" value="2">
                                        <label for="gp2b-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2b">
                                        <input type="checkbox" id="gp2b-1" value="1">
                                        <label for="gp2b-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2b">
                                        <input type="checkbox" id="gp2b-na" value="0">
                                        <label for="gp2b-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp2b-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp2c-5" value="5">
                                        <label for="gp2c-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2c">
                                        <input type="checkbox" id="gp2c-4" value="4">
                                        <label for="gp2c-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2c">
                                        <input type="checkbox" id="gp2c-3" value="3">
                                        <label for="gp2c-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2c">
                                        <input type="checkbox" id="gp2c-2" value="2">
                                        <label for="gp2c-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2c">
                                        <input type="checkbox" id="gp2c-1" value="1">
                                        <label for="gp2c-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp2c">
                                        <input type="checkbox" id="gp2c-na" value="0">
                                        <label for="gp2c-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp2c-comment" placeholder="Enter comments here" rows="4"></textarea>
                                    <div class="text-danger" id="gp2c_err" hidden>You have reached the maximum limit for this field.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- 3. OWNERSHIP -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>FACTOR</b></h4>
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
                                        <input type="checkbox" id="gp3a-5" value="5">
                                        <label for="gp3a-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3a">
                                        <input type="checkbox" id="gp3a-4" value="4">
                                        <label for="gp3a-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3a">
                                        <input type="checkbox" id="gp3a-3" value="3">
                                        <label for="gp3a-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3a">
                                        <input type="checkbox" id="gp3a-2" value="2">
                                        <label for="gp3a-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3a">
                                        <input type="checkbox" id="gp3a-1" value="1">
                                        <label for="gp3a-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3a">
                                        <input type="checkbox" id="gp3a-na" value="0">
                                        <label for="gp3a-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp3a-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp3b-5" value="5">
                                        <label for="gp3b-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3b">
                                        <input type="checkbox" id="gp3b-4" value="4">
                                        <label for="gp3b-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3b">
                                        <input type="checkbox" id="gp3b-3" value="3">
                                        <label for="gp3b-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3b">
                                        <input type="checkbox" id="gp3b-2" value="2">
                                        <label for="gp3b-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3b">
                                        <input type="checkbox" id="gp3b-1" value="1">
                                        <label for="gp3b-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3b">
                                        <input type="checkbox" id="gp3b-na" value="0">
                                        <label for="gp3b-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp3b-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp3c-5" value="5">
                                        <label for="gp3c-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3c">
                                        <input type="checkbox" id="gp3c-4" value="4">
                                        <label for="gp3c-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3c">
                                        <input type="checkbox" id="gp3c-3" value="3">
                                        <label for="gp3c-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3c">
                                        <input type="checkbox" id="gp3c-2" value="2">
                                        <label for="gp3c-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3c">
                                        <input type="checkbox" id="gp3c-1" value="1">
                                        <label for="gp3c-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp3c">
                                        <input type="checkbox" id="gp3c-na" value="0">
                                        <label for="gp3c-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp3c-comment" placeholder="Enter comments here" rows="4"></textarea>
                                    <div class="text-danger" id="gp3c_err" hidden>You have reached the maximum limit for this field.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- 4. TEAMWORK -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>FACTOR</b></h4>
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
                                    <span class="checkbox-gp4a">
                                        <input type="checkbox" id="gp4a-5" value="5">
                                        <label for="gp4a-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp4a">
                                        <input type="checkbox" id="gp4a-4" value="4">
                                        <label for="gp4a-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp4a">
                                        <input type="checkbox" id="gp4a-3" value="3">
                                        <label for="gp4a-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp4a">
                                        <input type="checkbox" id="gp4a-2" value="2">
                                        <label for="gp4a-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp4a">
                                        <input type="checkbox" id="gp4a-1" value="1">
                                        <label for="gp4a-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp4a">
                                        <input type="checkbox" id="gp4a-na" value="0">
                                        <label for="gp4a-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp4a-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp4b-5" value="5">
                                        <label for="gp4b-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp4b">
                                        <input type="checkbox" id="gp4b-4" value="4">
                                        <label for="gp4b-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp4b">
                                        <input type="checkbox" id="gp4b-3" value="3">
                                        <label for="gp4b-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp4b">
                                        <input type="checkbox" id="gp4b-2" value="2">
                                        <label for="gp4b-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp4b">
                                        <input type="checkbox" id="gp4b-1" value="1">
                                        <label for="gp4b-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp4b">
                                        <input type="checkbox" id="gp4b-na" value="0">
                                        <label for="gp4b-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <br>
                                    <textarea id="gp4b-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp4c-5" value="5">
                                        <label for="gp4c-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp4c">
                                        <input type="checkbox" id="gp4c-4" value="4">
                                        <label for="gp4c-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp4c">
                                        <input type="checkbox" id="gp4c-3" value="3">
                                        <label for="gp4c-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp4c">
                                        <input type="checkbox" id="gp4c-2" value="2">
                                        <label for="gp4c-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp4c">
                                        <input type="checkbox" id="gp4c-1" value="1">
                                        <label for="gp4c-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp4c">
                                        <input type="checkbox" id="gp4c-na" value="0">
                                        <label for="gp4c-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp4c-comment" placeholder="Enter comments here" rows="4"></textarea>
                                    <div class="text-danger" id="gp4c_err" hidden>You have reached the maximum limit for this field.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- 5. INNOVATION -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>FACTOR</b></h4>
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
                                        <input type="checkbox" id="gp5a-5" value="5">
                                        <label for="gp5a-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5a">
                                        <input type="checkbox" id="gp5a-4" value="4">
                                        <label for="gp5a-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5a">
                                        <input type="checkbox" id="gp5a-3" value="3">
                                        <label for="gp5a-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5a">
                                        <input type="checkbox" id="gp5a-2" value="2">
                                        <label for="gp5a-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5a">
                                        <input type="checkbox" id="gp5a-1" value="1">
                                        <label for="gp5a-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5a">
                                        <input type="checkbox" id="gp5a-na" value="0">
                                        <label for="gp5a-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp5a-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp5b-5" value="5">
                                        <label for="gp5b-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5b">
                                        <input type="checkbox" id="gp5b-4" value="4">
                                        <label for="gp5b-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5b">
                                        <input type="checkbox" id="gp5b-3" value="3">
                                        <label for="gp5b-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5b">
                                        <input type="checkbox" id="gp5b-2" value="2">
                                        <label for="gp5b-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5b">
                                        <input type="checkbox" id="gp5b-1" value="1">
                                        <label for="gp5b-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5b">
                                        <input type="checkbox" id="gp5b-na" value="0">
                                        <label for="gp5b-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp5b-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp5c-5" value="5">
                                        <label for="gp5c-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5c">
                                        <input type="checkbox" id="gp5c-4" value="4">
                                        <label for="gp5c-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5c">
                                        <input type="checkbox" id="gp5c-3" value="3">
                                        <label for="gp5c-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5c">
                                        <input type="checkbox" id="gp5c-2" value="2">
                                        <label for="gp5c-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5c">
                                        <input type="checkbox" id="gp5c-1" value="1">
                                        <label for="gp5c-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp5c">
                                        <input type="checkbox" id="gp5c-na" value="0">
                                        <label for="gp5c-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp5c-comment" placeholder="Enter comments here" rows="4"></textarea>
                                    <div class="text-danger" id="gp5c_err" hidden>You have reached the maximum limit for this field.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- 6. CUSTOMER FOCUS -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>FACTOR</b></h4>
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
                                        <input type="checkbox" id="gp6a-5" value="5">
                                        <label for="gp6a-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6a">
                                        <input type="checkbox" id="gp6a-4" value="4">
                                        <label for="gp6a-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6a">
                                        <input type="checkbox" id="gp6a-3" value="3">
                                        <label for="gp6a-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6a">
                                        <input type="checkbox" id="gp6a-2" value="2">
                                        <label for="gp6a-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6a">
                                        <input type="checkbox" id="gp6a-1" value="1">
                                        <label for="gp6a-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6a">
                                        <input type="checkbox" id="gp6a-na" value="0">
                                        <label for="gp6a-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp6a-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp6b-5" value="5">
                                        <label for="gp6b-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6b">
                                        <input type="checkbox" id="gp6b-4" value="4">
                                        <label for="gp6b-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6b">
                                        <input type="checkbox" id="gp6b-3" value="3">
                                        <label for="gp6b-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6b">
                                        <input type="checkbox" id="gp6b-2" value="2">
                                        <label for="gp6b-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6b">
                                        <input type="checkbox" id="gp6b-1" value="1">
                                        <label for="gp6b-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6b">
                                        <input type="checkbox" id="gp6b-na" value="0">
                                        <label for="gp6b-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp6b-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp6c-5" value="5">
                                        <label for="gp6c-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6c">
                                        <input type="checkbox" id="gp6c-4" value="4">
                                        <label for="gp6c-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6c">
                                        <input type="checkbox" id="gp6c-3" value="3">
                                        <label for="gp6c-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6c">
                                        <input type="checkbox" id="gp6c-2" value="2">
                                        <label for="gp6c-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6c">
                                        <input type="checkbox" id="gp6c-1" value="1">
                                        <label for="gp6c-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp6c">
                                        <input type="checkbox" id="gp6c-na" value="0">
                                        <label for="gp6c-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp6c-comment" placeholder="Enter comments here" rows="4"></textarea>
                                    <div class="text-danger" id="gp6c_err" hidden>You have reached the maximum limit for this field.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- 7. WORK STANDARDS -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>FACTOR</b></h4>
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
                                        <input type="checkbox" id="gp7a-5" value="5">
                                        <label for="gp7a-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7a">
                                        <input type="checkbox" id="gp7a-4" value="4">
                                        <label for="gp7a-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7a">
                                        <input type="checkbox" id="gp7a-3" value="3">
                                        <label for="gp7a-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7a">
                                        <input type="checkbox" id="gp7a-2" value="2">
                                        <label for="gp7a-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7a">
                                        <input type="checkbox" id="gp7a-1" value="1">
                                        <label for="gp7a-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7a">
                                        <input type="checkbox" id="gp7a-na" value="0">
                                        <label for="gp7a-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp7a-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp7b-5" value="5">
                                        <label for="gp7b-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7b">
                                        <input type="checkbox" id="gp7b-4" value="4">
                                        <label for="gp7b-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7b">
                                        <input type="checkbox" id="gp7b-3" value="3">
                                        <label for="gp7b-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7b">
                                        <input type="checkbox" id="gp7b-2" value="2">
                                        <label for="gp7b-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7b">
                                        <input type="checkbox" id="gp7b-1" value="1">
                                        <label for="gp7b-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7b">
                                        <input type="checkbox" id="gp7b-na" value="0">
                                        <label for="gp7b-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp7b-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp7c-5" value="5">
                                        <label for="gp7c-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7c">
                                        <input type="checkbox" id="gp7c-4" value="4">
                                        <label for="gp7c-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7c">
                                        <input type="checkbox" id="gp7c-3" value="3">
                                        <label for="gp7c-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7c">
                                        <input type="checkbox" id="gp7c-2" value="2">
                                        <label for="gp7c-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7c">
                                        <input type="checkbox" id="gp7c-1" value="1">
                                        <label for="gp7c-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp7c">
                                        <input type="checkbox" id="gp7c-na" value="0">
                                        <label for="gp7c-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp7c-comment" placeholder="Enter comments here" rows="4"></textarea>
                                    <div class="text-danger" id="gp7c_err" hidden>You have reached the maximum limit for this field.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- 8. JOB KNOWLEDGE -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>FACTOR</b></h4>
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
                                        <input type="checkbox" id="gp8a-5" value="5">
                                        <label for="gp8a-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp8a">
                                        <input type="checkbox" id="gp8a-4" value="4">
                                        <label for="gp8a-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp8a">
                                        <input type="checkbox" id="gp8a-3" value="3">
                                        <label for="gp8a-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp8a">
                                        <input type="checkbox" id="gp8a-2" value="2">
                                        <label for="gp8a-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp8a">
                                        <input type="checkbox" id="gp8a-1" value="1">
                                        <label for="gp8a-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp8a">
                                        <input type="checkbox" id="gp8a-na" value="0">
                                        <label for="gp8a-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <br><textarea id="gp8a-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp8b-5" value="5">
                                        <label for="gp8b-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp8b">
                                        <input type="checkbox" id="gp8b-4" value="4">
                                        <label for="gp8b-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp8b">
                                        <input type="checkbox" id="gp8b-3" value="3">
                                        <label for="gp8b-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp8b">
                                        <input type="checkbox" id="gp8b-2" value="2">
                                        <label for="gp8b-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp8b">
                                        <input type="checkbox" id="gp8b-1" value="1">
                                        <label for="gp8b-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp8b">
                                        <input type="checkbox" id="gp8b-na" value="0">
                                        <label for="gp8b-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp8b-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp8c-5" value="5">
                                        <label for="gp8c-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp8c">
                                        <input type="checkbox" id="gp8c-4" value="4">
                                        <label for="gp8c-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp8c">
                                        <input type="checkbox" id="gp8c-3" value="3">
                                        <label for="gp8c-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp8c">
                                        <input type="checkbox" id="gp8c-2" value="2">
                                        <label for="gp8c-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp8c">
                                        <input type="checkbox" id="gp8c-1" value="1">
                                        <label for="gp8c-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp8c">
                                        <input type="checkbox" id="gp8c-na" value="0">
                                        <label for="gp8c-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp8c-comment" placeholder="Enter comments here" rows="4"></textarea>
                                    <div class="text-danger" id="gp8c_err" hidden>You have reached the maximum limit for this field.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- 9. STRATEGIC AGILITY -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>FACTOR</b></h4>
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
                                        <input type="checkbox" id="gp9a-5" value="5">
                                        <label for="gp9a-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp9a">
                                        <input type="checkbox" id="gp9a-4" value="4">
                                        <label for="gp9a-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp9a">
                                        <input type="checkbox" id="gp9a-3" value="3">
                                        <label for="gp9a-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp9a">
                                        <input type="checkbox" id="gp9a-2" value="2">
                                        <label for="gp9a-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp9a">
                                        <input type="checkbox" id="gp9a-1" value="1">
                                        <label for="gp9a-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp9a">
                                        <input type="checkbox" id="gp9a-na" value="0">
                                        <label for="gp9a-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <br><textarea id="gp9a-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp9b-5" value="5">
                                        <label for="gp9b-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp9b">
                                        <input type="checkbox" id="gp9b-4" value="4">
                                        <label for="gp9b-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp9b">
                                        <input type="checkbox" id="gp9b-3" value="3">
                                        <label for="gp9b-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp9b">
                                        <input type="checkbox" id="gp9b-2" value="2">
                                        <label for="gp9b-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp9b">
                                        <input type="checkbox" id="gp9b-1" value="1">
                                        <label for="gp9b-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp9b">
                                        <input type="checkbox" id="gp9b-na" value="0">
                                        <label for="gp9b-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp9b-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp9c-5" value="5">
                                        <label for="gp9c-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp9c">
                                        <input type="checkbox" id="gp9c-4" value="4">
                                        <label for="gp9c-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp9c">
                                        <input type="checkbox" id="gp9c-3" value="3">
                                        <label for="gp9c-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp9c">
                                        <input type="checkbox" id="gp9c-2" value="2">
                                        <label for="gp9c-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp9c">
                                        <input type="checkbox" id="gp9c-1" value="1">
                                        <label for="gp9c-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp9c">
                                        <input type="checkbox" id="gp9c-na" value="0">
                                        <label for="gp9c-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp9c-comment" placeholder="Enter comments here" rows="4"></textarea>
                                    <div class="text-danger" id="gp9c_err" hidden>You have reached the maximum limit for this field.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- 10. COMMUNICATION -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><b>FACTOR</b></h4>
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
                                        <input type="checkbox" id="gp10a-5" value="5">
                                        <label for="gp10a-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp10a">
                                        <input type="checkbox" id="gp10a-4" value="4">
                                        <label for="gp10a-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp10a">
                                        <input type="checkbox" id="gp10a-3" value="3">
                                        <label for="gp10a-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp10a">
                                        <input type="checkbox" id="gp10a-2" value="2">
                                        <label for="gp10a-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp10a">
                                        <input type="checkbox" id="gp10a-1" value="1">
                                        <label for="gp10a-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br><br>
                                    <span class="checkbox-gp10a">
                                        <input type="checkbox" id="gp10a-na" value="0">
                                        <label for="gp10a-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <br><textarea id="gp10a-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp10b-5" value="5">
                                        <label for="gp10b-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp10b">
                                        <input type="checkbox" id="gp10b-4" value="4">
                                        <label for="gp10b-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp10b">
                                        <input type="checkbox" id="gp10b-3" value="3">
                                        <label for="gp10b-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp10b">
                                        <input type="checkbox" id="gp10b-2" value="2">
                                        <label for="gp10b-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp10b">
                                        <input type="checkbox" id="gp10b-1" value="1">
                                        <label for="gp10b-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp10b">
                                        <input type="checkbox" id="gp10b-na" value="0">
                                        <label for="gp10b-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp10b-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                                        <input type="checkbox" id="gp10c-5" value="5" class="checkbox-gp">
                                        <label for="gp10c-5">5</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp10c">
                                        <input type="checkbox" id="gp10c-4" value="4" class="checkbox-gp">
                                        <label for="gp10c-4">4</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp10c">
                                        <input type="checkbox" id="gp10c-3" value="3" class="checkbox-gp">
                                        <label for="gp10c-3">3</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp10c">
                                        <input type="checkbox" id="gp10c-2" value="2" class="checkbox-gp">
                                        <label for="gp10c-2">2</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp10c">
                                        <input type="checkbox" id="gp10c-1" value="1" class="checkbox-gp">
                                        <label for="gp10c-1">1</label>
                                    </span>
                                </div>
                                <div class="col-sm-1">
                                    <br><br>
                                    <span class="checkbox-gp10c">
                                        <input type="checkbox" id="gp10c-na" value="0" class="checkbox-gp">
                                        <label for="gp10c-na">NA</label>
                                    </span>
                                </div>
                                <div class="col-sm-3">
                                    <textarea id="gp10c-comment" placeholder="Enter comments here" rows="4"></textarea>
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
                            <input type="text" id="kra-total" placeholder="0.00%" value="0" disabled />
                        </div>
                        <div class="col-md-1" style="text-align: right;">
                            <h4>60% =</h4>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="kra-average" placeholder="0.00%" value="0" disabled />
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
                            <input type="text" id="gp-total" placeholder="0.00%" value="0" disabled />
                        </div>
                        <div class="col-md-1" style="text-align: right;">
                            <h4>40% =</h4>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="gp-average" placeholder="0.00%" value="0" disabled />
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-9">
                            <h4><b>Individual Over All Performance (OAP) Rating</b></h4>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="oap-rating" placeholder="0.00%" value="0" disabled>
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
                                        <input type="checkbox" id="rating-5" value="5">
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
                                        <input type="checkbox" id="rating-4" value="4">
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
                                        <input type="checkbox" id="rating-3" value="3">
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
                                        <input type="checkbox" id="rating-2" value="2">
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
                                        <input type="checkbox" id="rating-1" value="1">
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
                                <textarea id="accomplishments" placeholder="Enter details here" rows="4"></textarea>
                                <div class="text-danger err_msg"></div>
                            </div>
                        </div>
                    </div><br>
                    <!-- AREAS FOR DEVELOPMENT -->
                    <div class="development">
                        <div id="prof-dev" class="row">
                            <div class="col-md-12">
                                <h4><b>IV. Areas for Development / Improvement. Complete the following sections as applicable:</b></h4>
                                <div class="col-md-12">
                                    <h4><b>IV A. Recommendations for professional development [seminars, training, OJT, etc.]:</b><br><i>Please check the training program/s which will help address the employee's areas of development</i></h4>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <input type="checkbox" id="area-1" value="Business and Organizational Development">
                                <label for="area-1">Business & Organizational Development</label>
                            </div>
                            <div class="col-md-5">
                                <input type="checkbox" id="area-2" value="Business Communication">
                                <label for="area-2">Business Communication</label>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <input type="checkbox" id="area-3" value="Operational Excellence (Technical)">
                                <label for="area-3">Operational Excellence (Technical)</label>
                            </div>
                            <div class="col-md-5">
                                <input type="checkbox" id="area-4" value="Presentation Skills">
                                <label for="area-4">Presentation Skills</label>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <input type="checkbox" id="area-5" value="Leadership Skills Training">
                                <label for="area-5">Leadership Skills Training</label>
                            </div>
                            <div class="col-md-5">
                                <input type="checkbox" id="area-6" value="Customer Service">
                                <label for="area-6">Customer Service</label>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                                <input type="checkbox" id="area-7" value="Supervisory Skills Training">
                                <label for="area-7">Supervisory Skills Training</label>
                            </div>
                            <div class="col-md-5">
                                <input type="checkbox" id="area-8" value="Personality Development">
                                <label for="area-8">Personality Development</label>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-4"><textarea id="prof-others" placeholder="Others Please Specify" rows="2"></textarea>
                                <div class="text-danger err_msg"></div>
                            </div>
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
                                <div class="col-md-4"><input type="text" id="pin-1" /></div>
                                <div class="col-md-3"><input type="text" id="at-1" /></div>
                                <div class="col-md-3"><input type="text" id="sn-1" /></div>
                                <div class="col-md-2"><input type="text" id="timeline-1" /></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><input type="text" id="pin-2" /></div>
                                <div class="col-md-3"><input type="text" id="at-2" /></div>
                                <div class="col-md-3"><input type="text" id="sn-2" /></div>
                                <div class="col-md-2"><input type="text" id="timeline-2" /></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"><input type="text" id="pin-3" /></div>
                                <div class="col-md-3"><input type="text" id="at-3" /></div>
                                <div class="col-md-3"><input type="text" id="sn-3" /></div>
                                <div class="col-md-2"><input type="text" id="timeline-3" /></div>
                            </div>
                        </div>
                    </div><br>
                    <!-- EMPLOYEE'S COMMENTS -->
                    <div class="comments">
                        <div class="col-md-12">
                            <h4><b>V. EMPLOYEE'S COMMENTS:</b></h4>
                        </div>
                        <div class="col-md-12"><textarea id="emp-comments" placeholder="Enter comments here" rows="2"></textarea>
                            <div class="text-danger err_msg"></div>
                            <b class="text-danger" id="emp_message" style="font-size: small;" hidden>Employee's comment must have at least a minimum of 10 characters.</b>
                            <b class="text-danger" id="emp_message2" style="font-size: small;" hidden> Employee's comment is mandatory. </b>
                        </div>

                    </div><br>
                    <div class="row">
                        <div class="col-md-3">
                            <a id="btnDraft" class="button fit" style="background-color: #1191EA;"><i class="fa fa-save"></i><b style="color: whitesmoke;"> SAVE AS DRAFT</b></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="checkbox" id="show-submit" onchange="valueChanged()">
                            <label for="show-submit">Are you sure you want to submit your Performance Assessment Report?</label>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="col-md-2">
                            <button id="btnSubmit" class="button fit"><i class="fa fa-check-circle"></i><b style="color: whitesmoke;"> SUBMIT PAR</b></button>
                            <a id="btnPrint" class="button fit" style="background-color: #1191EA;"><i class="fa fa-print"></i><b style="color: whitesmoke;"> PRINT PAR</b></a>
                        </div>
                    </div>
                    </form>
                    <!--submit message Modal -->
                    <!-- author: Dan -->
                    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reminder <i class="text-danger bi bi-exclamation-circle"></i></h5>
                                </div>
                                <div class="modal-body">
                                    <p class="m-0"><i class="text-danger bi bi-dash-lg"></i> A signed hard copy must be submitted to HR with a signature.</p>
                                    <p class="m-0"><i class="text-danger bi bi-dash-lg"></i> Maximum characters per input box are 2000.</p>
                                    <p class="m-0"><i class="text-danger bi bi-dash-lg"></i> Restrictions - please aviod using the "&".</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary text-danger" data-bs-dismiss="modal">Understood</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <a class="scroll-to-top rounded" href="#">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Scripts -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/jquery.scrollex.min.js"></script>
    <script src="../../assets/js/skel.min.js"></script>
    <script src="../../assets/js/util.js"></script>
    <script src="../../assets/js/main.js"></script>
    <script src="../../assets/bootstrap/js/popper.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/datetimepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="../../assets/js/jquery.toast.js"></script>
    <script src="../../assets/toastr/toastr.js"></script>
    <?php include 'js/create_par-js.php'; ?>

</body>

</html>