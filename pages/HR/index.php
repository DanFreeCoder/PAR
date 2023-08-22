<?php
// session_start();
// if (!(isset($_SESSION['fullname']))) {
//     header('Location: ../../index.php');
// }
// include '../../config/clsConnection.php';
// include '../../objects/clsDetails.php';
// include '../../objects/clsUser.php';

// $database = new clsConnection();
// $db = $database->connect();

// $details = new ParDetails($db);
// $user = new Users($db);
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
    <link rel="stylesheet" href="../../assets/toastr/toastr.css">
    <link rel="stylesheet" href="../../assets/DataTables/datatables.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
</head>
<style>
    .modal {
        width: 800px;
        height: 800px;
        left: 30%;
        top: 35%;
        margin-left: -150px;
        margin-top: -150px;
    }
</style>

<body id="page-top" class="subpage">
    <!-- Header -->
    <?php include '../../includes/header.php'; ?>
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
                        <h2>Employee's PAR Details</h2>
                    </center>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2s">
                            <a id="btnCreate" class="button fit" style="background-color: #228B22;" href="create_par.php"><i class="fa fa-plus-circle"></i><b style="color: whitesmoke;"> Create PAR</b></a>
                        </div>
                        <div class="col-lg-3">
                            <a id="btnCreate" class="button fit" style="background-color: #228B22;" href="createPAR.php"><i class="fa fa-plus-circle"></i><b style="color: whitesmoke;"> Create Employee PAR</b></a>
                        </div>
                        <div class="col-lg-3">
                            <a id="btnReport" class="button fit" style="background-color: #007bff;" data-toggle="modal" data-target="#reportModal"><i class="fa fa-print"></i><b style="color: whitesmoke;"> Generate Report</b></a>
                        </div>
                    </div>
                    <!-- TAB PANEL -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#uneval1TabPanel" role="tab"><span class="fa fa-times-circle"></span> For Approval by App1</a> </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#uneval2TabPanel" role="tab"><span class="fa fa-times-circle"></span> For Approval by App2</a> </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#uneval3TabPanel" role="tab"><span class="fa fa-times-circle"></span> For Approval by App3</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#approvedTabPanel" role="tab"><span class="fa fa-check-circle"></span> Approved PAR</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#draftTabPanel" role="tab"><span class="fa fa-edit"></span> Draft PAR</a> </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#submittedTabPanel" role="tab"><span class="fa fa-check"></span> Submitted PAR</a> </li>
                    </ul>
                    <!-- UNEVALUATED TAB FOR APPROVAL BY APP1 -->
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane active" id="uneval1TabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                                <table id="unEvalTable1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th style="text-align: center;">Department</th>
                                            <th style="text-align: center;">Date Submitted</th>
                                            <th style="text-align: center;">Reviewer</th>
                                            <th style="text-align: center; width: 20%">Action</th>
                                            <th style="text-align: center; width: 20%">Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //DRAFT STATUS
                                        $view = $details->view_draft_reviewed_par_app1_for_HR();
                                        while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            $par_stat = $row1['par_status'];
                                            echo '
                                                <tr>
                                                    <td>' . $row1['emp_name'] . '</td>
                                                    <td>' . $row1['dept-name'] . '</td>
                                                    <td><center>' . $date . '</center></td>
                                                    <td style="width: 15%"><center>' . $row1['reviewer'] . '</center></td>
                                                    <td><center><a href="#" class="draft-review-par" value="' . $row1['par_id'] . '"><i class="fa fa-edit"></i> Edit PAR</a></center></td>
                                                    <td><center>Draft</center></td>
                                                </tr>';
                                        }
                                        $view = $details->view_uneval_par_approver1_forHR();
                                        while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            $par_stat = $row1['par_status'];
                                            echo '
                                                <tr>
                                                    <td>' . $row1['emp_name'] . '</td>
                                                    <td><center>' . $row1['dept-name'] . '</center></td>
                                                    <td><center>' . $date . '</center></td>
                                                    <td><center>' . $row1['reviewer'] . ' </center></td>
                                                    <td style="width: 20%"><center><a href="uneval_par_app1.php?id=' . $row1['id'] . '" class="view-par1" value="' . $row1['id'] . '"><i class="fa fa-file-alt"></i> View PAR</a> || <a href="#" class="print-uneval-par" value="' . $row1['id'] . '"><i class="fa fa-print"></i> Print PAR</a></center></td>
                                                    <td>For Review</td>
                                                </tr>';
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- UNEVALUATED TAB FOR APPROVAL BY APP2 -->
                        <div class="tab-pane" id="uneval2TabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                                <table id="unEvalTable2" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th style="text-align: center;">Department</th>
                                            <th style="text-align: center;">Date Submitted</th>
                                            <th style="text-align: center; width: 15%">Reviewer</th>
                                            <th style="text-align: center;">Action</th>
                                            <th style="text-align: center;">Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //DRAFT STATUS
                                        $view = $details->view_draft_reviewed_par_app2_for_HR();
                                        while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            $par_stat = $row1['par_status'];
                                            echo '
                                            <tr>
                                                <td>' . $row1['emp_name'] . '</td>
                                                <td>' . $row1['dept-name'] . '</td>
                                                <td><center>' . $date . '</center></td>
                                                <td style="width: 15%"><center>' . $row1['reviewer'] . '</center></td>
                                                <td><center><a href="draft_eval_par_app2.php?id=' . $row1['par_id'] . '" value="' . $row1['par_id'] . '"><i class="fa fa-edit"></i> Edit PAR</a></center></td>
                                                <td><center>Draft</center></td>
                                            </tr>';
                                        }


                                        $view = $details->view_uneval_par_approver2_forHR();
                                        while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            echo '
                                                      <tr>
                                                          <td style="width: 15%">' . $row1['emp_name'] . '</td>
                                                          <td style="width: 10%"><center>' . $row1['dept-name'] . '</center></td>
                                                          <td style="width: 10%"><center>' . $date . '</center></td>
                                                          <td style="width: 15%"><center>' . $row1['reviewer'] . '</center></td>
                                                          <td style="width: 18%"><center><a href="uneval_par_app2.php?id=' . $row1['id'] . '" value="' . $row1['id'] . '"><i class="fa fa-file-alt"></i> View PAR</a> || <a href="#" class="print-par" value="' . $row1['id'] . '"><i class="fa fa-print"></i> Print PAR</a></center></td>
                                                          <td style="width: 10%"><center>For Review</center></td>
                                                      </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- UNEVALUATED TAB FOR APPROVAL BY APP3 -->
                        <div class="tab-pane" id="uneval3TabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                                <table id="unEvalTable3" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th style="text-align: center;">Department</th>
                                            <th style="text-align: center;">Date Submitted</th>
                                            <th style="text-align: center;">Reviewer</th>
                                            <th style="text-align: center;">Action</th>
                                            <th style="text-align: center;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //DRAFT STATUS
                                        $view = $details->view_draft_reviewed_par_app3_for_HR();
                                        while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            $par_stat = $row1['par_status'];
                                            echo '
                                            <tr>
                                                <td>' . $row1['emp_name'] . '</td>
                                                <td>' . $row1['dept-name'] . '</td>
                                                <td><center>' . $date . '</center></td>
                                                <td style="width: 15%"><center>' . $row1['reviewer'] . '</center></td>
                                                <td><center><a href="draft_eval_par_app3.php?id=' . $row1['par_id'] . '" value="' . $row1['par_id'] . '"><i class="fa fa-edit"></i> Edit PAR</a></center></td>
                                                <td><center>Draft</center></td>
                                            </tr>';
                                        }



                                        //GET THE UN EVALUATED LIST FOR APPROVER
                                        $view = $details->view_uneval_par_manager_forHR();
                                        while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            $par_stat = $row1['par_status'];
                                            echo '
                                                    <tr>
                                                        <td>' . $row1['emp_name'] . '</td>
                                                        <td>' . $row1['dept-name'] . '</td>
                                                        <td><center>' . $date . '</center></td>
                                                        <td style="width: 15%"><center>' . $row1['reviewer'] . '</center></td>
                                                        <td><center><a href="uneval_par_app3.php?id=' . $row1['id'] . '" value="' . $row1['id'] . '"><i class="fa fa-file-alt"></i> View PAR</a> || <a href="#" class="print-unevalPAR" value="' . $row1['id'] . '"><i class="fa fa-print"></i> Print PAR</a></center></td>
                                                        <td><center>For Review</center></td>
                                                    </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- EVALUATED TAB OF FINAL APPROVER -->
                        <div class="tab-pane" id="approvedTabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                                <table id="approvedTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%">Employee Name</th>
                                            <th style="text-align: center; width: 10%">Department</th>
                                            <th style="text-align: center; width: 10%">Date Evaluated</th>
                                            <th style="text-align: center; width: 10%">Evaluated By</th>
                                            <th style="text-align: center; width: 18%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $view = $details->view_eval_approved_manager_forHR();
                                        while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {

                                            $action = '<center> <a href="#" class="print-evalPAR" value="' . $row1['par_id'] . '"><i class="fa fa-print"></i> Print PAR</a></center>';

                                            $date = date('F j, Y', strtotime($row1['date_evaluated']));
                                            echo '
                                                    <tr>
                                                        <td style="width: 15%">' . $row1['emp_name'] . '</td>
                                                        <td style="width: 10%">' . $row1['dept-name'] . '</td>
                                                        <td style="width: 10%"><center>' . $date . '</center></td>
                                                        <td style="width: 10%"><center>' . $row1['fullname'] . '</center></td>
                                                        <td style="width: 18%">' . $action . '</td>
                                                    </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- DRAFT PAR TAB PANEL -->
                        <div class="tab-pane" id="draftTabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                                <table id="drafttable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th style="text-align: center;">Department</th>
                                            <th style="text-align: center;">Date Submitted</th>
                                            <th style="text-align: center; width: 15%">Reviewer</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $details->emp_id = $_SESSION['id'];
                                        $view = $details->view_draft_par();
                                        while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            //get the reviewer name
                                            if ($row1['rater_name'] == 0) {
                                                $rater = 'N/A';
                                            } else {
                                                $user->id = $row1['rater_name'];
                                                $get = $user->get_user_by_id();
                                                while ($row2 = $get->fetch(PDO::FETCH_ASSOC)) {
                                                    $rater = $row2['fullname'];
                                                }
                                            }
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            $par_stat = $row1['par_status'];
                                            echo '
                                                <tr>
                                                    <td>' . $row1['emp_name'] . '</td>
                                                    <td>' . $row1['dept-name'] . '</td>
                                                    <td><center>' . $date . '</center></td>
                                                    <td style="width: 15%"><center>' . $rater . '</center></td>
                                                    <td><center><a href="#" class="view-par" value="' . $row1['id'] . '"><i class="fa fa-edit"></i> Edit PAR</a></center></td>
                                                </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- SUBMITTED PAR TAB PANEL -->
                        <div class="tab-pane" id="submittedTabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                                <table id="submittedTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%">Employee Name</th>
                                            <th style="text-align: center; width: 10%">Department</th>
                                            <th style="text-align: center; width: 10%">Date Submitted</th>
                                            <th style="text-align: center; width: 15%">Reviewed by</th>
                                            <th style="text-align: center; width: 15%">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $details->emp_id = $_SESSION['id'];
                                        $view = $details->view_user_par();
                                        while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            $action = '<center><a href="#" class="print-uneval-par" value="' . $row1['id'] . '"><i class="fa fa-print"></i> Print PAR</a></center>';
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            echo '
                                                  <tr>
                                                      <td style="width: 15%">' . $row1['emp_name'] . '</td>
                                                      <td style="width: 10%"><center>' . $row1['dept-name'] . '</center></td>
                                                      <td style="width: 10%"><center>' . $date . '</center></td>
                                                      <td style="width: 15%"><center>' . $row1['reviewer'] . '</center></td>
                                                      <td style="width: 15%"><center>' . $action . '</td>
                                                  </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- REPORT GENERATION MODAL-->
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-file"></span> Create Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="3u 12u$(xsmall)">
                                <label for="exampleInputEmail1">PAR Status</label>
                            </div>
                            <div class="9u 12u$(xsmall)">
                                <select id="par-status" style="color: black;" class="form-group">
                                    <option value="1">For Review</option>
                                    <option value="2">Reviewed</option>
                                    <option value="3" selected>Approved PAR</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="3u 12u$(xsmall)">
                                <label for="exampleInputEmail1">Assessment</label>
                            </div>
                            <div class="9u 12u$(xsmall)">
                                <select id="assessment" style="color: black;" class="form-group">
                                    <option value="0">- Please select assessment type here -</option>
                                    <option value="Annual">Annual</option>
                                    <option value="5th Month">5th Month</option>
                                    <option value="3rd Month">3rd Month</option>
                                    <option value="2nd Month">2nd Month</option>
                                    <option value="Training">Training</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="3u 12u$(xsmall)">
                                <label for="exampleInputEmail1">Year</label>
                            </div>
                            <div class="9u 12u$(xsmall)">
                                <select id="year" style="color: black;" class="form-group">
                                    <?php
                                    $start_year = 2021;
                                    $current_year = date('Y') * 1;
                                    do {
                                        echo '<option value="' . $start_year . '" selected>' . $start_year . '</option>';
                                        $start_year++;
                                    } while ($current_year >= $start_year);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div><!-- end of form-group -->
                </div><!-- end of modal body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btnGenerate" type="button" class="btn btn-primary">Generate</button>
                </div>
            </div>
        </div>
    </div>

    <!-- USER ACCOUNT MODAL NOTIFICATION -->
    <div id="notificationModal" class="modal" tabindex="1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title"><b><br></b></h3>
                </div>
                <div class="modal-body">
                    <p style="color: black;">Congratulation, your password has been successfully updated. You need to login again to complete the process <a href="../controls/logout.php"><b><u>Click here</b></u></a> to continue.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btnLogout" class="button" style="background-color: #C5250C;" onclick="logout()">
                        <p style="color: whitesmoke;">LOGOUT</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
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
    <script src="../../assets/DataTables/datatables.min.js"></script>
    <?php include 'js/index-js.php'; ?>

</body>

</html>