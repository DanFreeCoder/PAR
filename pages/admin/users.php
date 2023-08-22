<!DOCTYPE HTML>
<html lang="eng">
	<head>
		<title>IGC Online-PAR</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../assets/css/main.css"/>
		<link rel="stylesheet" href="../../assets/toastr/toastr.css">
    <link rel="stylesheet" href="../../assets/DataTables/datatables.min.css">
    <link rel="stylesheet" href="../../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../assets/datetimepicker/css/bootstrap-datepicker.css">
	</head>
  <style>
      .modal {
          width: 800px;
          height: 800px;
          left: 30%;
          top: 27%; 
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
                <div class="col-lg-12">
                    <a href="index.php" id="btnAdd"><i class="fa fa-home"></i><b> Home</b></a><a id="btnAdd"><b> / Users</b></a>
                </div>
                <div class="box">
                    <div class="content">
                        <center><h2> Users Detail</h2></center><hr>
                        <div class="row">
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newUserModal"><i class="fa fa-user-circle"></i> Add User</button>
                            </div>
                        </div><br>
                        <!-- TAB PANEL -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#approverTabPanel" role="tab"><span class="fa fa-user-tie"></span> Approvers</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#employeeTabPanel" role="tab"><span class="fa fa-users"></span> Employee's</a> </li>
                        </ul>
                        <!-- TAB CONTENT -->
                        <!-- APPROVER TAB PANEL -->
                        <div class="tab-content tabcontent-border">
                          <div class="tab-pane active" id="approverTabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                              <table id="approverTable" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Fullname</th>
                                    <th style="text-align: center;">Position</th>
                                    <th style="text-align: center;">Role</th>
                                    <th style="text-align: center;">Username</th>
                                    <th style="text-align: center;">Action</th>                                       
                                  </tr>
                                </thead>
                                <tbody id="appTBLbody">
                                  <?php
                                    $get = $user->view_all_approver();
                                    $position = "";
                                    while($row = $get->fetch(PDO::FETCH_ASSOC))
                                    {
                                      $position = '';
                                      $role = '';
                                      //check if the par is already evaluated
                                      if($row['access'] == 1){
                                        $position = 'Administrator';
                                        $role = 'Admin/HR';
                                      }elseif($row['access'] == 2){
                                        $position = 'Supervisor / TeamLead';
                                      }elseif($row['access'] == 3){
                                        $position = 'Manager';
                                      }elseif($row['access'] == 4){
                                        $position = 'Senior Manager';
                                      }else{
                                        $position = 'Employee/Staff';
                                      }
                                      //check the user role
                                      if($row['role'] == 1){
                                        $role = 'Approver 1';
                                      }elseif($row['role'] == 2){
                                        $role = 'Approver 2';
                                      }elseif($row['role'] == 3){
                                        $role = 'Final Approver';
                                      }else{
                                        $role = 'Admin/HR';
                                      }
                                        echo '
                                            <tr>
                                                <td>'.$row['fullname'].'</td>
                                                <td><center>'.$position.'</center></td>
                                                <td><center>'.$role.'</center></td>
                                                <td><center>'.$row['username'].'</center></td>
                                                <td><center><a href="#" class="edit" value="'.$row['id'].'"><i class="fa fa-pen-alt"></i> Edit</a> || <a href="#" class="reset" value="'.$row['id'].'"><i class="fa fa-key"></i> Reset</a> || <a href="#" class="remove" value="'.$row['id'].'"><i class="fa fa-trash"></i> Remove</a></center></td>
                                                
                                            </tr>';
                                    }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <!-- EMPLOYEE'S TAB PANEL -->
                          <div class="tab-pane" id="employeeTabPanel" role="tabpanel"><br>
                            <div class="table-responsive">
                              <table id="employeeTable" class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Fullname</th>
                                    <th style="text-align: center;">Position</th>
                                    <th style="text-align: center;">Username</th>
                                    <th style="text-align: center;">Action</th>                                       
                                  </tr>
                                </thead>
                                <tbody id="empTBLbody">
                                  <?php
                                    $get = $user->view_all_staff();
                                    $position = "";
                                    while($row = $get->fetch(PDO::FETCH_ASSOC))
                                    {
                                      $position = 'Employee/Staff';
                                      echo '
                                          <tr>
                                              <td>'.$row['fullname'].'</td>
                                              <td><center>'.$position.'</center></td>
                                              <td><center>'.$row['username'].'</center></td>
                                              <td style="width: 25%"><center><a href="#" class="edit" value="'.$row['id'].'"><i class="fa fa-pen-alt"></i> Edit</a> || <a href="#" class="reset" value="'.$row['id'].'"><i class="fa fa-key"></i> Reset</a> || <a href="#" class="remove" value="'.$row['id'].'"><i class="fa fa-trash"></i> Remove</a></center></td>
                                              
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

<!-- ADD USER MODAL-->
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-plus-square"></span> Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="3u 12u$(xsmall)">
              <label for="exampleInputEmail1">Firstname</label>
            </div>
            <div class="9u 12u$(xsmall)">
              <input type="text" id="add_firstname" style="color: black;" placeholder="Enter Firstname">
            </div>
          </div>
          <div class="row">
            <div class="3u 12u$(xsmall)">
              <label for="exampleInputEmail1">Lastname</label>
            </div>
            <div class="9u 12u$(xsmall)">
              <input type="text" id="add_lastname" style="color: black;" placeholder="Enter Lastname">
            </div>
          </div>
          <div class="row">
            <div class="3u 12u$(xsmall)">
              <label for="exampleInputEmail1">Date Hire</label>
            </div>
            <div class="9u 12u$(xsmall)">
			        <input type="text" id="add_date-hire" class="datepicker" placeholder="Date Hired" style="color: black;"/>
            </div>
          </div>
		      <div class="row">
            <div class="3u 12u$(xsmall)">
              <label for="exampleInputEmail1">Position</label>
            </div>
            <div class="9u 12u$(xsmall)">
              <input type="text" id="add_position" style="color: black;" placeholder="Enter your Position/Job Title">
            </div>
          </div>
		      <div class="row">
            <div class="3u 12u$(xsmall)">
              <label for="exampleInputEmail1">Project</label>
            </div>
            <div class="9u 12u$(xsmall)">
              <input type="text" id="add_project" style="color: black;" placeholder="Enter your Unit/Project Assigned/Location">
            </div>
          </div>
          <div class="row">
            <div class="3u 12u$(xsmall)">
              <label for="exampleInputEmail1">Email</label>
            </div>
            <div class="9u 12u$(xsmall)">
              <input type="text" id="add_email" style="color: black;" placeholder="Enter Email">
            </div>
          </div>
          <div class="row">
            <div class="3u 12u$(xsmall)">
              <label for="exampleInputEmail1">Department</label>
            </div>
            <div class="9u 12u$(xsmall)">
              <select id="department" style="color: #555;">
                <?php
                  $sel = $rater->view_department();
                  while($row = $sel->fetch(PDO::FETCH_ASSOC))
                  {
                    echo '<option value='.$row['id'].'>'.$row['department'].'</option>';
                  }
                ?>
            </select>
            </div>
          </div>
          <div class="row" style="display: none;">
            <div class="3u 12u$(xsmall)">
              <label for="exampleInputEmail1">Username</label>
            </div>
            <div class="9u 12u$(xsmall)">
              <input type="text" id="add_username" style="color: black;" disabled>
            </div>
          </div>
          <div class="row">
            <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">Access</label>
            </div>
            <div class="9u 12u$(xsmall)">
                <select id="add_access" style="color: black;">
                    <option value="0" selected> - Please select a Position - </option>
                    <option value="1">Administrator</option>
                    <option value="2">Supervisor / Team Leader</option>
                    <option value="3">Manager</option>
                    <option value="4">Senior Manager</option>
                    <option value="6">Employee/Staff</option>
                </select>
            </div>
          </div>
          <div class="row">
            <div class="3u 12u$(xsmall)">
                <label for="exampleInputEmail1">Role</label>
            </div>
            <div class="9u 12u$(xsmall)">
                <select id="add_role" style="color: black;">
                    <option value="0" selected> - Please select a Role - </option>
                    <option value="1">Approver 1</option>
                    <option value="2">Approver 2</option>
                    <option value="3">Approver 3</option>
                    <option value="0">User</option>
                </select>
            </div>
          </div>
        </div><!-- end of form-group -->
      <!-- Alerts -->
      <div id="user_warning" class="alert alert-danger" role="alert"></div>
      <div id="user_success" class="alert alert-success" role="alert"></div>
      </div><!-- end of modal body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btnSave"  type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- UPDATE USER MODAL -->
<!-- ADD USER MODAL-->
<div class="modal fade" id="updUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-plus-square"></span> Update User Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="user-body-modal" class="modal-body">
        <!-- User details will go in here -->
      </div><!-- end of modal body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btnUserUpdate" type="button" class="btn btn-primary">Save</button>
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
<script src="../../assets/js/jquery.toast.js"></script>
<script src="../../assets/toastr/toastr.js"></script>
<script src="../../assets/DataTables/datatables.min.js"></script>
<script src="../../assets/datetimepicker/js/bootstrap-datepicker.min.js"></script>
<?php include 'js/user-js.php'; ?>

</body>
</html>