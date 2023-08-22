<?php
session_start();
if(!(isset($_SESSION['fullname'])))
{
  header('Location: ../../index.php');
}
include '../../config/clsConnection.php';
include '../../objects/clsDetails.php';
include '../../objects/clsUser.php';

$database = new clsConnection();
$db = $database->connect();

$details = new ParDetails($db);
$user = new Users($db);
?>
<!DOCTYPE HTML>
<html lang="eng">
	<head>
		<title>IGC Online-PAR</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../assets/css/main.css"/>
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
        <header id="header">
            <div class="logo"><a href="index.html">Innogroup <span>Online-PAR</span></a></div>
            <a href="#menu"><?php echo $_SESSION['fullname'];?></a>
        </header>
		<!-- Nav -->
        <nav id="menu">
            <ul>
                <div class="row uniform">
                  <div>
                    <!-- get the user details -->
                    <?php
                        $user->id = $_SESSION['id'];
                        $get = $user->get_user_by_id();
                        while($row = $get->fetch(PDO::FETCH_ASSOC))
                        {
                            $firstname = $row['firstname'];
                            $lastname = $row['lastname'];
                            $username = $row['username'];
                            $position = $row['position'];
                            $project = $row['project'];
                            $email = $row['email'];
                            if($row['date_hire'] != null || $row['date_hire'] != ''){
                              $date_hire =  date('F j, Y', strtotime($row['date_hire']));
                            }else{
                                $date_hire = '';
                            }
                        }
                    ?>
                    <center><h3>User Details</h3></center>
                    <input type="text" id="id" style="color: white; display: none;" value="<?php echo $_SESSION['id'];?>"/>
                    <input type="text" id="dept" style="color: white; display: none;" value="<?php echo $_SESSION['dept'];?>"/>
                    <input type="text" id="access" style="color: white; display: none;" value="<?php echo $_SESSION['access'];?>"/>
                    <input type="text" id="role" style="color: white; display: none;" value="<?php echo $_SESSION['role'];?>"/>
                    <input type="text" id="firstname" placeholder="Firstname" style="color: white;" value="<?php echo $firstname;?>" disabled/><br>
                    <input type="text" id="lastname" placeholder="Lastname" style="color: white;" value="<?php echo $lastname;?>" disabled/><br>
                    <input type="text" id="username" placeholder="Username" style="color: white;" value="<?php echo $username;?>" disabled/><br>
                    <input type="text" id="position" placeholder="Job Position/Title" style="color: white;" value="<?php echo $position; ?>" disabled/><br>
                    <input type="text" id="project" placeholder="Unit/Project Assigned/Location" style="color: white;" value="<?php echo $project; ?>" disabled/><br>
                    <input type="text" id="date-hire"  class="datepicker" placeholder="Date Hire" style="color: white;" value="<?php echo $date_hire?>" disabled/><br>
                    <input type="text" id="email" placeholder="Username" style="color: white;" value="<?php echo $email;?>" disabled/><br>
                    <input type="password" id="password" placeholder="New Password" style="color: white;" disabled/>
                </div>
                <div>
                    <a id="btnEdit" class="button"><b>EDIT</b></a>
                    <a id="btnUpdateUser" class="button"><b>SAVE</b></a>
                    <a id="btnLog-out" class="button" style="background-color: #C5250C;" onclick="logout()"><p style="color: whitesmoke;">LOGOUT</p></a>		
                    <a id="btnCancel" class="button" style="background-color: #C5250C;"><p style="color: whitesmoke;">CANCEL</p></a>
                </div>
              </div>
            </ul>
        </nav>
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
                <div class="col-lg-12" style="text-align: right;">
                    <a href="users.php" id="btnAdd"><i class="fa fa-user-circle"></i><b> Go to User's List</b></a>
                </div>
                <div class="box">
                    <div class="content">
                        <center><h2>Employee's PAR Details</h2></center><hr>
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
                          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#unevalTabPanel" role="tab"><span class="fa fa-times-circle"></span> For Approval by App1</a> </li>
                          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#evalTabPanel" role="tab"><span class="fa fa-check-circle"></span> Reviewed PAR</a> </li>
                          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#draftTabPanel" role="tab"><span class="fa fa-edit"></span> Draft PAR</a> </li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#submittedTabPanel" role="tab"><span class="fa fa-check"></span> Submitted PAR</a> </li>
                        </ul>
                        <!-- UNEVALUATED TAB PANEL -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="unevalTabPanel" role="tabpanel"><br>
                                <div class="table-responsive">
                                    <table id="unEvalTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th style="text-align: center;">Department</th>
                                                <th style="text-align: center;">Date Submitted</th>
                                                <th style="text-align: center;">Reviewer</th>
                                                <th style="text-align: center; width: 20%">Action</th>                                   

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                          $view = $details->view_par();
                                          while($row1 = $view->fetch(PDO::FETCH_ASSOC))
                                          {
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            $par_stat = $row1['par_status'];
                                            echo '
                                                <tr>
                                                    <td>'.$row1['emp_name'].'</td>
                                                    <td><center>'.$row1['dept-name'].'</center></td>
                                                    <td><center>'.$date.'</center></td>
                                                    <td><center>'.$row1['reviewer'].' </center></td>
                                                    <td style="width: 20%"><center><a href="#" class="view-par" value="'.$row1['id'].'"><i class="fa fa-file-alt"></i> View PAR</a> || <a href="#" class="print-uneval-par" value="'.$row1['id'].'"><i class="fa fa-print"></i> Print PAR</a></center></td>
                                                </tr>';
                                          }                                                                           
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- REVIEWED PAR TAB PANEL -->
                            <div class="tab-pane" id="evalTabPanel" role="tabpanel"><br>
                                <div class="table-responsive">
                                    <table id="evalTable" class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Employee Name</th>
                                          <th style="text-align: center;">Department</th>
                                          <th style="text-align: center;">Date Review</th>
                                          <th style="text-align: center;">Reviewed by</th>
                                          <th style="text-align: center;">Status</th>
                                          <th style="text-align: center; width: 20%">Action</th>                                     
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $view = $details->view_eval_par();
                                          while($row = $view->fetch(PDO::FETCH_ASSOC))
                                          {
                                            $date = date('F j, Y', strtotime($row['date_evaluated']));
                                            //check status
                                            $par_stat = $row['par_status'];
                                            if($par_stat == 2){
                                              $status = 'Approved by App1';
                                              $action = '<a href="#" class="eval-par" value="'.$row['par_id'].'"><i class="fa fa-file-alt"></i> View PAR</a> || <a href="#" class="print-eval-par" value="'.$row['par_id'].'"><i class="fa fa-print"></i> Print PAR</a>';
                                            }elseif($par_stat == 3){
                                              $status = 'Approved by App2';
                                              $action = '<a href="#" class="eval-par" value="'.$row['par_id'].'"><i class="fa fa-file-alt"></i> View PAR</a> || <a href="#" class="print-eval-par" value="'.$row['par_id'].'"><i class="fa fa-print"></i> Print PAR</a>';
                                            }else{
                                              $status = 'Approved by App3';
                                              $action = '<a href="#" class="print-eval-par" value="'.$row['par_id'].'"><i class="fa fa-print"></i> Print PAR</a>';
                                            }
                                            echo '
                                                <tr>
                                                    <td>'.$row['emp_name'].'</td>
                                                    <td><center>'.$row['dept-name'].'</center></td>
                                                    <td><center>'.$date.'</center></td>
                                                    <td><center>'.$row['fullname'].' </center></td>
                                                    <td><center>'.$status.' </center></td>
                                                    <td style="width: 20%"><center>'.$action.'</center></td>
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
                                  <table id="submittedTable" class="table table-bordered">
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
                                        while($row1 = $view->fetch(PDO::FETCH_ASSOC))
                                        {
                                            //get the reviewer name
                                            if($row1['rater_name'] == 0){
                                                $rater = 'N/A';
                                            }else{
                                                $user->id = $row1['rater_name'];
                                                $get = $user->get_user_by_id();
                                                while($row2 = $get->fetch(PDO:: FETCH_ASSOC))
                                                {
                                                    $rater = $row2['fullname'];
                                                }
                                            }
                                            $date = date('F j, Y', strtotime($row1['date_submit']));
                                            $par_stat = $row1['par_status'];
                                            echo '
                                                <tr>
                                                    <td>'.$row1['emp_name'].'</td>
                                                    <td>'.$row1['dept-name'].'</td>
                                                    <td><center>'.$date.'</center></td>
                                                    <td style="width: 15%"><center>'.$rater.'</center></td>
                                                    <td><center><a href="#" class="view-par" value="'.$row1['id'].'"><i class="fa fa-edit"></i> Edit PAR</a></center></td>
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
                                          while($row1 = $view->fetch(PDO::FETCH_ASSOC))
                                          {
                                              $action = '<center><a href="#" class="print-uneval-par" value="'.$row1['id'].'"><i class="fa fa-print"></i> Print PAR</a></center>';
                                              $date = date('F j, Y', strtotime($row1['date_submit']));
                                              echo '
                                                  <tr>
                                                      <td style="width: 15%">'.$row1['emp_name'].'</td>
                                                      <td style="width: 10%"><center>'.$row1['dept-name'].'</center></td>
                                                      <td style="width: 10%"><center>'.$date.'</center></td>
                                                      <td style="width: 15%"><center>'.$row1['reviewer'].'</center></td>
                                                      <td style="width: 15%"><center>'.$action.'</td>
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
                  $current_year = date('Y')*1;
                  do{
                    echo '<option value="'.$start_year.'" selected>'.$start_year.'</option>';
                    $start_year++;
                  }while($current_year >= $start_year);
                ?>
              </select>
            </div>
          </div>
        </div><!-- end of form-group -->
      </div><!-- end of modal body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btnGenerate"  type="button" class="btn btn-primary">Generate</button>
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
        <a href="#" id="btnLogout" class="button" style="background-color: #C5250C;" onclick="logout()"><p style="color: whitesmoke;">LOGOUT</p></a>	
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