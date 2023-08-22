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
        top: 40%;
        margin-left: -150px;
        margin-top: -150px;
    }
</style>

<body id="page-top" class="subpage">
    <!-- Page Header -->
    <?php
    include '../../includes/header.php';
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
                        <h2>Employee's PAR Details</h2>
                    </center>
                    <div class="row">
                        <div class="col-lg-3">
                            <a id="btnCreate" class="button fit" style="background-color: #228B22;" href="create_par.php"><i class="fa fa-plus-circle"></i><b style="color: whitesmoke;"> Create Self Assessment</b></a>
                        </div>
                    </div>
                    <hr>
                    <!-- TAB PANEL -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#unevalTabPanel" role="tab"><span class="fa fa-times-circle"></span> PAR For Review</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#evalTabPanel" role="tab"><span class="fa fa-edit"></span> For Final Approval</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#approvedTabPanel" role="tab"><span class="fa fa-check-circle"></span> Approved PAR</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#draftTabPanel" role="tab"><span class="fa fa-edit"></span> Draft Self-Assessment</a> </li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#submittedTabPanel" role="tab"><span class="fa fa-check"></span> Submitted Self-Assessment</a> </li>
                    </ul>
                    <div class="tab-content tabcontent-border">
                        <!-- UNEVALUATED TAB PANEL -->
                        <div class="tab-pane active" id="unevalTabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                                <table id="unEvalTable" class="table table-bordered">
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

                                        $details->eval_by = $_SESSION['id'];
                                        $view = $details->view_draft_reviewed_par();
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

                                        //GET THE UN EVALUATED LIST FOR APPROVER
                                        $details->rater_name = $_SESSION['id'];
                                        $view = $details->view_uneval_par_manager();
                                        while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            $par_stat = $row1['par_status'];
                                            echo '
                                                    <tr>
                                                        <td>' . $row1['emp_name'] . '</td>
                                                        <td>' . $row1['dept-name'] . '</td>
                                                        <td><center>' . $date . '</center></td>
                                                        <td style="width: 15%"><center>' . $row1['reviewer'] . '</center></td>
                                                        <td><center><a href="#" class="view-par" value="' . $row1['id'] . '"><i class="fa fa-file-alt"></i> View PAR</a> || <a href="#" class="print-unevalPAR" value="' . $row1['id'] . '"><i class="fa fa-print"></i> Print PAR</a></center></td>
                                                        <td><center>For Review</center></td>
                                                    </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- DRAFT REVIEW PAR TAB PANEL -->
                        <div class="tab-pane" id="draftReviewTabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                                <table id="draftEvalTable" class="table table-bordered">
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

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- EVALUATED PAR TAB PANEL(FOR FINAL APPROVAL) -->
                        <div class="tab-pane" id="evalTabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                                <table id="evalTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 12%">Employee Name</th>
                                            <th style="text-align: center; width: 8%">Department</th>
                                            <th style="text-align: center; width: 8%">Date Evaluated</th>
                                            <th style="text-align: center; width: 10%">Evaluated By</th>
                                            <th style="text-align: center; width: 25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="evaluatedTable-body">
                                        <?php
                                        //segregate the id's of depts  
                                        if ($_SESSION['id'] == 46) {
                                            //no dispaly as requested by user
                                            echo '
                                                <tr>
                                                    <td style="width: 15%"></td>
                                                    <td style="width: 9%"><center></center></td>
                                                    <td style="width: 9%"><center></center></td>
                                                    <td style="width: 10%"><center></center></td>
                                                    <td style="width: 20%"></button></td>
                                                </tr>';
                                        } else {
                                            $dept_id = $_SESSION['dept'];
                                            $array_id = explode(',', $dept_id);
                                            foreach ($array_id as $value) {
                                                $id = $value;
                                                $details->department = $id;
                                                $view = $details->view_eval_par_manager();
                                                while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                                    if ($row1['par_status'] == 2 || $row1['par_status'] == 3) {
                                                        $action = '<center><a href="#" class="eval-par" value="' . $row1['par_id'] . '"><i class="fa fa-file-alt"></i> View PAR</a>  || <a href="#" class="approve-par" value="' . $row1['sup_par_id'] . '"><i class="fa fa-print"></i> Approve PAR</a> || <a href="#" class="print-evalPAR" value="' . $row1['par_id'] . '"><i class="fa fa-print"></i> Print PAR</a></center>';
                                                    } else {
                                                        $action = '<center><a href="#" class="print-evalPAR" value="' . $row1['par_id'] . '"><i class="fa fa-print"></i> Print PAR</a></center>';
                                                    }
                                                    $date = date('F j, Y', strtotime($row1['date_evaluated']));
                                                    echo '
                                                            <tr>
                                                                <td style="width: 15%">' . $row1['emp_name'] . '</td>
                                                                <td style="width: 9%"><center>' . $row1['dept-name'] . '</center></td>
                                                                <td style="width: 9%"><center>' . $date . '</center></td>
                                                                <td style="width: 10%"><center>' . $row1['fullname'] . '</center></td>
                                                                <td style="width: 20%">' . $action . '</button></td>
                                                            </tr>';
                                                }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- APPROVED PAR TAB PANEL -->
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
                                    <tbody id="approvedTable-body">
                                        <?php
                                        //segregate the id's of depts  
                                        $dept_id = $_SESSION['dept'];
                                        $array_id = explode(',', $dept_id);
                                        foreach ($array_id as $value) {
                                            $id = $value;
                                            $details->department = $id;
                                            $view = $details->view_eval_approved_manager();
                                            while ($row1 = $view->fetch(PDO::FETCH_ASSOC)) {
                                                if ($row1['par_status'] == 2 || $row1['par_status'] == 3) {
                                                    $action = '<center><a href="#" class="eval-par" value="' . $row1['sup_par_id'] . '"><i class="fa fa-file-alt"></i> View PAR</a> || <a href="#" class="print-evalPAR" value="' . $row1['par_id'] . '"><i class="fa fa-print"></i> Print PAR</a></center>';
                                                } else {
                                                    $action = '<center><a href="#" class="print-approvedPAR" value="' . $row1['par_id'] . '"><i class="fa fa-print"></i> Print PAR</a></center>';
                                                }
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
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- DRAFT TAB PANEL -->
                        <div class="tab-pane" id="draftTabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                                <table id="draftTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th style="text-align: center;">Department</th>
                                            <th style="text-align: center;">Date Created</th>
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
                                                        <td><center><a href="#" class="draft-par" value="' . $row1['id'] . '"><i class="fa fa-edit"></i> Edit PAR</a></center></td>
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
                                            $action = '<center><a href="#" class="print-unevalPAR" value="' . $row1['id'] . '"><i class="fa fa-print"></i> Print PAR</a></center>';
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